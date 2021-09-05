<?php

require_once('./models/Model.php');
require_once('./models/PostImage.php');

class Post extends Model
{
    protected $table = 'posts';

    /**
     * Lấy post chưa bị soft delete
     * 
     * @return array
     */
    public function all()
    {
        $sql = "SELECT posts.*, categories.name AS 'category', users.name AS 'user' FROM posts 
            INNER JOIN categories ON posts.category_id = categories.id
            INNER JOIN users ON posts.user_id = users.id
            ORDER BY date DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get first six posts
     * 
     * @return array
     */
    public function getFirstSixPostInformation($category = null, $notIn = null)
    {
        $where = 'WHERE posts.deleted_at IS NULL';

        $category_id = $category ?? null;

        if ($category_id && $notIn) {
            $where .= " AND category_id = $category_id AND posts.id NOT IN($notIn)  ";
        }

        $sql = "SELECT posts.*, categories.name AS 'category', users.name AS 'user' FROM `posts` 
        INNER JOIN categories ON posts.category_id = categories.id 
        INNER JOIN users ON posts.user_id = users.id
        $where
        ORDER BY date DESC
        LIMIT 6";

        $result = $this->conn->query($sql);

        if (isset($result->num_rows) && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    /**
     * Get first post
     * 
     * @return array
     */
    public function getFirstPostInformation($param, $category = null)
    {
        $where = 'WHERE posts.deleted_at IS NULL';

        $category_id = $param['category'] ?? null;

        if ($category_id) {
            $where .= " AND category_id = $category_id ";
        }

        $sql = "SELECT posts.*, categories.name AS 'category', users.name AS 'user' FROM `posts` 
        INNER JOIN categories ON posts.category_id = categories.id 
        INNER JOIN users ON posts.user_id = users.id
        $where
        ORDER BY date DESC
        LIMIT 1";

        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    /**
     * Get next six posts after first post
     * 
     * @param array $param
     * 
     * @return array
     */
    public function getNextSixPostInformation($param, $category = null)
    {
        $where = 'WHERE posts.deleted_at IS NULL';

        $category_id = $param['category'] ?? null;

        if ($category_id) {
            $where .= " AND category_id = $category_id ";
        }

        $page = $param['page'] ?? 1;
        $offset = ($page - 1) * 6 + 1;
        $sql = "SELECT posts.*, categories.name AS 'category', users.name AS 'user' FROM `posts`
        INNER JOIN categories ON posts.category_id = categories.id 
        INNER JOIN users ON posts.user_id = users.id
        $where
        ORDER BY date DESC
        LIMIT 6 OFFSET $offset";

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Thêm bài viết
     * 
     * @param array $post
     * @param array $file
     * 
     * @return array
     */
    public function create($post, $file)
    {
        array_pop($post);
        $uploadFileDirectory = 'public' . MY_DIRECTORY_SEPARATOR . 'storage';
        $textErr = $this->validateText($post);
        $img = $this->validateImage($file, $uploadFileDirectory);
        $user_id = $_SESSION['user']['id'];
        $cover_name = $img['fileHandle'][0]['name'];

        $err = [];
        $err = array_merge($err, $textErr, $img['err']);

        $isValidated = true;

        if (count($err) > 0) {
            $isValidated = false;
            return $err;
        }

        if ($isValidated) {
            $keys = array_keys($post);
            $values = array_values($post);

            $keys = array_map(function ($value) {
                return "`" . $value . "`";
            }, $keys);

            $values = array_map(function ($value) {
                if ($value == "") {
                    $value = date('Y-m-d');
                }
                // thêm backslash vào sau ký tự ' để tránh lỗi
                $valueHandle = str_replace("'","\'",htmlentities(trim(htmlentities($value))));
                return "'" . $valueHandle . "'";
            }, $values);

            $keys = array_merge(
                $keys,
                [
                    '`user_id`',
                    '`cover_path`',
                    '`cover_name`'
                ]
            );

            $values = array_merge(
                $values,
                [
                    "'" . $user_id . "'",
                    "'./" . $uploadFileDirectory . "'",
                    "'" . $cover_name . "'"
                ]
            );

            $keys = implode(', ', $keys);
            $values = implode(', ', $values);
            $sql = "INSERT INTO `posts` ($keys) VALUES ($values)";
            // die($sql);
            $newPost = $this->conn->query($sql);
            if ($newPost) {
                $lastPostId = $this->getLastPostId();
                $img_path = "'./" . $uploadFileDirectory . "'";
                foreach ($img['fileHandle'] as $img) {
                    $img_tmp = $img['tmp'];
                    $img_name = $img['name'];
                    if ($img_tmp != 'nofile') {
                        move_uploaded_file($img_tmp, $uploadFileDirectory . MY_DIRECTORY_SEPARATOR . $img_name);
                    }
                    $img_sql = "INSERT INTO `post_image`
                            VALUES (NULL, '$lastPostId', $img_path, '$img_name')";
                    $newImg = $this->conn->query($img_sql);
                }
            }
        }
        return [];
    }

    /**
     * Update bài viết
     * 
     * @param int $id
     * @param array $post
     * @param array $file
     * 
     * @return array
     */
    public function update($post_id, $post, $file)
    {
        array_pop($post);
        $uploadFileDirectory = 'public' . MY_DIRECTORY_SEPARATOR . 'storage';
        $textErr = $this->validateText($post);
        $img = $this->validateImage($file, $uploadFileDirectory);
        $user_id = $_SESSION['user']['id'];
        $cover_name = $img['fileHandle'][0]['name'];

        $err = [];
        $err = array_merge($err, $textErr, $img['err']);

        $isValidated = true;

        if (count($err) > 0) {
            $isValidated = false;
            return $err;
        }

        if ($isValidated) {
            $keys = array_keys($post);
            $values = array_values($post);

            $keys = array_map(function ($value) {
                return "`" . $value . "`";
            }, $keys);

            $values = array_map(function ($value) {
                if ($value == "") {
                    $value = date('Y-m-d');
                }
                $valueHandle = str_replace("'","\'",htmlentities(trim(htmlentities($value))));
                return "'" . $valueHandle . "'";
            }, $values);

            $keys = array_merge(
                $keys,
                [
                    '`user_id`',
                    '`cover_path`',
                    '`cover_name`'
                ]
            );

            $values = array_merge(
                $values,
                [
                    "'" . $user_id . "'",
                    "'./" . $uploadFileDirectory . "'",
                    "'" . $cover_name . "'"
                ]
            );

            $sets = [];
            $setsArray = array_combine($keys, $values);
            foreach ($setsArray as $key => $value) {
                $sets[] = $key . " = " . $value;
            }
            $sets = implode(', ', $sets);

            $sql = "UPDATE `posts` SET $sets WHERE posts.id = $post_id";
            // die($sql);
            $newPost = $this->conn->query($sql);
            if ($newPost) {
                $lastPostId = $this->getLastPostId();
                $img_path = "'./" . $uploadFileDirectory . "'";
                foreach ($img['fileHandle'] as $img) {
                    $img_tmp = $img['tmp'];
                    $img_name = $img['name'];
                    $img_index = $img['index'];
                    if ($img_tmp != 'nofile') {
                        move_uploaded_file($img_tmp, $uploadFileDirectory . MY_DIRECTORY_SEPARATOR . $img_name);
                    }
                    $img_sql = "UPDATE `post_image` SET img_name = '$img_name' WHERE id = $img_index AND post_id = $post_id";
                    $newImg = $this->conn->query($img_sql);
                }
            }
        }
        return [];
    }

    /**
     * Validate image
     * 
     * @param array $file
     * 
     * @return array
     */
    public function validateImage($file, $uploadFileDirectory)
    {
        $err = [];
        $fileHandle = [];
        $acceptableExtensions = ['jpg', 'jpeg', 'png'];

        if (!is_dir($uploadFileDirectory)) {
            mkdir($uploadFileDirectory);
        }

        foreach ($file['error'] as $index => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $originalName = $file['name'][$index];
                $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);
                if (!in_array($fileExtension, $acceptableExtensions)) {
                    $err['img_' . $index] = "Vui lòng chọn đúng định dạng ảnh (png, jpg, jpeg)";
                } else {
                    $fileHandle[$index]['tmp'] = $file['tmp_name'][$index];
                    $fileHandle[$index]['name'] = md5($_SESSION['user']['id'] . $index . $originalName . date('d-m-Y h:i:s')) . '.png';
                    $fileHandle[$index]['index'] = $file['index'][$index] ?? null;
                }
            } elseif ($error == UPLOAD_ERR_NO_FILE) {
                $fileHandle[$index]['tmp'] = 'nofile';
                $fileHandle[$index]['name'] = 'noname';
                $fileHandle[$index]['index'] = $file['index'][$index] ?? null;
            } elseif ($error == MY_UPLOAD_FILE_NO_FILE) {
                $fileHandle[$index]['tmp'] = 'nofile';
                $fileHandle[$index]['name'] = $file['name'][$index];
                $fileHandle[$index]['index'] = $file['index'][$index] ?? null;
            } else {
                $err['img_' . $index] = 'Tải ảnh lên không thành công';
                $fileHandle[$index]['tmp'] = 'nofile';
                $fileHandle[$index]['name'] = 'noname';
                $fileHandle[$index]['index'] = $file['index'][$index] ?? null;
            }
        }

        return compact('err', 'fileHandle');
    }

    /**
     * Validate text
     * 
     * @param array $post
     * 
     * @return array
     */
    public function validateText($post)
    {
        $err = [];
        foreach ($post as $key => $value) {
            if ($key == 'date') {
                continue;
            }
            if (trim($value) == "") {
                $err[$key] = 'Vui lòng nhập trường này';
            }
        }
        return $err;
    }

    /**
     * Lấy id bài viết gần nhất
     * 
     * @return int
     */
    public function getLastPostId()
    {
        $sql = 'SELECT * FROM posts WHERE posts.deleted_at IS NULL ORDER BY id DESC LIMIT 1';
        $result = $this->conn->query($sql);
        $post = $result->fetch_assoc();
        $id = $post['id'];
        return $id;
    }

    /**
     * Lấy thông tin bài viết
     * 
     * @param int $id
     * 
     * @return array
     */
    public function show($id)
    {
        $sql = "SELECT users.name as 'user', posts.*, categories.name, categories.image FROM posts 
        INNER JOIN categories ON posts.category_id = categories.id
        INNER JOIN users ON posts.user_id = users.id 
        WHERE posts.id = $id AND posts.deleted_at IS NULL";
        $post = $this->conn->query($sql);
        return $post->fetch_assoc();
    }

    /**
     * Xoá mềm bài viết
     * 
     * @param int $id
     * 
     * @return void
     */
    public function destroy($id)
    {
        $time = date("Y-m-d H:i:s");
        $sql = "UPDATE `posts` SET `deleted_at` = '$time' WHERE `posts`.`id` = $id";
        return $this->conn->query($sql);
    }
}

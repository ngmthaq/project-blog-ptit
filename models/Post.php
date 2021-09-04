<?php

require_once('./models/Model.php');

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
     * @param array $param
     * 
     * @return array
     */
    public function create($post, $file)
    {
        array_pop($post);
        $uploadFileDirectory = 'public' . MY_DIRECTORY_SEPARATOR . 'storage';
        $textErr = $this->validateText($post);
        $img = $this->validateImage($file, $uploadFileDirectory);

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
                return "'" . htmlentities($value) . "'";
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
                    "'" . $_SESSION['user']['id'] . "'",
                    "'./" . $uploadFileDirectory . "'",
                    "'" . $img['fileHandle'][0]['name'] . "'"
                ]
            );

            $keys = implode(', ', $keys);
            $values = implode(', ', $values);

            $sql = "INSERT INTO `posts` ($keys) VALUES ($values)";
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
                }
            } elseif ($error == UPLOAD_ERR_NO_FILE) {
                $fileHandle[$index]['tmp'] = 'nofile';
                $fileHandle[$index]['name'] = 'noname';
            } else {
                $err['img_' . $index] = 'Tải ảnh lên không thành công';
                $fileHandle[$index]['tmp'] = 'nofile';
                $fileHandle[$index]['name'] = 'noname';
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
            if ($value == "") {
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
        $sql = "SELECT users.name as 'user', posts.*, categories.* FROM posts 
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

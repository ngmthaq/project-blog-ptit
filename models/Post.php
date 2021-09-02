<?php

require_once('./models/Model.php');

class Post extends Model
{
    protected $table = 'posts';

    /**
     * Get first six posts
     * 
     * @return array
     */
    public function getFirstSixPostInformation($category = null)
    {
        $sql = "SELECT posts.*, categories.name AS 'category', users.name AS 'user' FROM `posts` 
        INNER JOIN categories ON posts.category_id = categories.id 
        INNER JOIN users ON posts.user_id = users.id
        ORDER BY date DESC
        LIMIT 6";

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get first post
     * 
     * @return array
     */
    public function getFirstPostInformation($param, $category = null)
    {
        $where = '';

        $category_id = $param['category'] ?? null;

        if ($category_id) {
            $where = " WHERE category_id = $category_id ";
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
        $where = '';

        $category_id = $param['category'] ?? null;

        if ($category_id) {
            $where = " WHERE category_id = $category_id ";
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
        echo "<pre>";

        $uploadFileDirectory = 'public' . MY_DIRECTORY_SEPARATOR . 'storage';
        $isValidated = true;

        $validateText = $this->validateText($post);
        $validateImage = $this->validateImage($file, $uploadFileDirectory);
        $uploadFile = $this->getImageInformation($file);

        if (count($validateText) > 0) {
            print_r($validateText);
            $isValidated = false;
        }

        if (count($validateImage['error']) > 0) {
            print_r($validateImage['error']);
            $isValidated = false;
        } else {
            if (count($validateImage['name']) > 0) {
                print_r($validateImage['name']);
                $isValidated = false;
            }

            if (count($validateImage['size']) > 0) {
                print_r($validateImage['size']);
                $isValidated = false;
            }
        }

        if ($isValidated) {
            print_r($uploadFile);
            $category_id = trim($_POST['category_id']);
            $user_id = $_SESSION['user']['id'];
            $title = trim($_POST['title']);
            $subtitle = trim($_POST['subtitle']);
            $paragraph_1 = trim($_POST['paragraph_1']);
            $paragraph_2 = trim($_POST['paragraph_2']);
            $paragraph_3 = trim($_POST['paragraph_3']);
            $date = $_POST['date'] != "" ? $_POST['date'] : date('Y-m-d');
            $file_path = trim('./' . $uploadFileDirectory);

            foreach ($uploadFile as $file) {
                $file_name = $file['file_name'];
                $sql = "INSERT INTO `posts` (`id`, `category_id`, `user_id`, `title`, `subtitle`, `paragraph_1`, `paragraph_2`, `paragraph_3`, `cover_path`, `cover_name`, `date`) 
                    VALUES (NULL, $category_id, $user_id, '$title', '$subtitle', '$paragraph_1', '$paragraph_2', '$paragraph_3', '$file_path', '$file_name', '$date')";
                $newPost = $this->conn->query($sql);
                break;
            }

            foreach ($uploadFile as $file) {
                move_uploaded_file($file['tmp_name'], $uploadFileDirectory . MY_DIRECTORY_SEPARATOR . $file['file_name']);
                $file_name = $file['file_name'];
                if ($newPost) {
                    $lastPostId = $this->getLastPostId();
                    $img_sql =  "INSERT INTO `post_image` (`id`, `post_id`, `img_path`, `img_name`) 
                        VALUES (NULL, $user_id, '$file_path', '$file_name')";
                    $postImg = $this->conn->query($img_sql);
                    if ($postImg) {
                        header('location: index.php?controller=admin&action=manager');
                    }
                }
            }
        }

        die;
    }

    /**
     * Lấy thông tin ảnh
     * 
     * @param array $file
     * 
     * @return array
     */
    public function getImageInformation($file)
    {
        $uploadFile = [];
        foreach ($file['name'] as $index => $value) {
            $uploadFile[$index]['file_name'] = md5('user_' . $_SESSION['user']['id'] . '_img_' . $index . '_name_' . $value . '_upload_at_' . date('d-m-Y h:i:s')) . '.png';
        }

        foreach ($file['tmp_name'] as $index => $value) {
            $uploadFile[$index]['tmp_name'] = $value;
        }

        return $uploadFile;
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
        $acceptableExtensions = ['jpg', 'jpeg', 'png'];

        $err['error'] = [];
        foreach ($file['error'] as $index => $value) {
            if ($value != UPLOAD_ERR_OK) {
                $err['error'][$index] = 'Thiếu ảnh hoặc tải ảnh lên không thành công';
            }
        }

        if (count($err['error']) == 0) {
            $err['name'] = [];
            foreach ($file['name'] as $index => $value) {
                $fileExtension = pathinfo($value, PATHINFO_EXTENSION);
                if (!in_array($fileExtension, $acceptableExtensions)) {
                    $err['name'][$index] = 'Vui lòng chọn đúng định dạng ảnh';
                }
            }

            $err['size'] = [];
            foreach ($file['size'] as $index => $value) {
                if ($value > 3145728) {
                    $err['size'][$index] = 'Vui lòng chọn file dưới 3MB';
                }
            }

            if (!is_dir($uploadFileDirectory)) {
                mkdir($uploadFileDirectory);
            }
        }

        return $err;
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
                break;
            }
            if (trim($value) == '') {
                $err[$key] = "Vui lòng nhập trường này";
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
        $sql = 'SELECT * FROM posts ORDER BY id DESC LIMIT 1';
        $result = $this->conn->query($sql);
        $post = $result->fetch_assoc();
        $id = $post['id'];
        return $id;
    }
}

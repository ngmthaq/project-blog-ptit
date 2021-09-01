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

        echo '<pre>';
        print_r($file ?? 'none');
        echo '</pre>';

        $validateText = true;
        $textErr = $this->validateText($post);
        if (count($textErr) > 0) {
            $validateText = false;

            echo '<pre>';
            print_r($textErr ?? 'none');
            echo '</pre>';
        }

        $isValitdated = true;
        $validateImage = ($validateText) ? $this->validateImage($file) : [];

        if (count($validateImage) > 0) {
            if (count($validateImage['err']['error']) > 0) {
                $isValitdated = false;
                echo '<pre>';
                print_r($validateImage['err']['error'] ?? 'none');
                echo '</pre>';
            } else {
                if (count($validateImage['err']['size']) > 0) {
                    $isValitdated = false;
                    echo '<pre>';
                    print_r($validateImage['err']['size'] ?? 'none');
                    echo '</pre>';
                } else {
                    if (count($validateImage['err']['name']) > 0) {
                        $isValitdated = false;
                        echo '<pre>';
                        print_r($validateImage['err']['name'] ?? 'none');
                        echo '</pre>';
                    } else {
                        echo '<pre>';
                        print_r($validateImage['uploadFile'] ?? 'none');
                        echo '</pre>';
                    }
                }
            }
        }



        die;
    }

    /**
     * Validate iamge
     * 
     * @param array $file
     * 
     * @return array
     */
    public function validateImage($file)
    {
        $err = [];
        $uploadFile = [];
        $acceptableExtensions = ['jpg', 'jpeg', 'png'];
        $uploadFileDirectory = 'public' . MY_DIRECTORY_SEPARATOR . 'storage';

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
                } else {
                    $uploadFile[$index]['file_name'] = md5($_SESSION['user']['id'] . $index . $value . date('d-m-Y h:i:s')) . '.png';
                }
            }

            foreach ($file['tmp_name'] as $index => $value) {
                $uploadFile[$index]['tmp_name'] = $value;
            }

            $err['size'] = [];
            foreach ($file['size'] as $index => $value) {
                if ($value > 3145728) {
                    $err['size'][$index] = 'Vui lòng chọn ảnh dưới 3MB';
                }
            }

            if (!is_dir($uploadFileDirectory)) {
                mkdir($uploadFileDirectory);
            }
        }

        return [
            'err' => $err,
            'uploadFile' => $uploadFile
        ];
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
            if (trim($value) == '') {
                $err[$key] = "Vui lòng nhập trường này";
            }
        }
        return $err;
    }

    /**
     * Lấy bài viết gần nhất
     * 
     * @return int
     */
    public function getLastPost()
    {
        $sql = 'SELECT * FROM posts ORDER BY id DESC LIMIT 1';
        $result = $this->conn->query($sql);
        $post = $result->fetch_assoc();
        $id = $post['id'];
        return $id;
    }
}

<?php

require_once('./models/Category.php');
require_once('./models/Post.php');
require_once('./models/User.php');

class AdminController
{
    protected $category;
    protected $post;
    protected $user;

    public function __construct()
    {
        $this->category = new Category();
        $this->post = new Post();
        $this->user = new User();
    }

    /**
     * Đăng nhập
     * 
     * @return void
     */
    public function index()
    {
        $err = [];
        $isInput = true;
        $isValidated = true;
        if (isset($_POST['user_name']) && isset($_POST['password'])) {
            $user_name = trim($_POST['user_name']);
            $password = md5(trim($_POST['password']));

            if ($user_name == '') {
                $err['user_name'] = 'Vui lòng nhập tài khoản';
                $isInput = false;
            }
            if ($password == '') {
                $err['password'] = 'Vui lòng nhập mật khẩu';
                $isInput = false;
            }

            if ($isInput) {
                $result = $this->user->getUserInformation($_POST);
                if (!$result) {
                    $err['user'] = 'Sai tài khoản hoặc mật khẩu';
                } else {
                    if (strcmp($password, $result['password']) != 0) {
                        $err['password'] = 'Sai tài khoản hoặc mật khẩu';
                    } else {
                        $_SESSION['user'] = $result;
                        header('location: index.php?controller=admin&action=manager');
                    }
                }
            }
        }
        require_once('./views/homepage/login.php');
    }

    /**
     * Trang quản lý
     * 
     * @return void
     */
    public function manager()
    {
        $name = $_SESSION['user']['name'];
        $posts = $this->post->all();
        require_once('./views/homepage/manager.php');
    }

    /**
     * Thêm bài viết
     * 
     * @return void
     */
    public function newPost()
    {
        if (isset($_POST['submit'])) {
            $isValidated = true;
            $isInput = true;
            $err = [];

            if (trim($_POST['title']) == "") {
                $isInput = false;
                $err['title'] = 'Vui lòng nhập tiêu đề';
            }

            if (trim($_POST['subtitle']) == "") {
                $isInput = false;
                $err['subtitle'] = 'Vui lòng nhập tiêu đề phụ';
            }

            if (trim($_POST['paragraph_1']) == "") {
                $isInput = false;
                $err['paragraph_1'] = 'Vui lòng nhập đoạn 1';
            }

            if (trim($_POST['paragraph_2']) == "") {
                $isInput = false;
                $err['paragraph_2'] = 'Vui lòng nhập đoạn 2';
            }

            if (trim($_POST['paragraph_3']) == "") {
                $isInput = false;
                $err['paragraph_3'] = 'Vui lòng nhập đoạn 3';
            }

            if ($isInput) {
                $directory = 'public' . MY_DIRECTORY_SEPARATOR . 'storage';
                $acceptableExtensions = ['jpg', 'jpeg', 'png'];
                foreach ($_FILES['img'] as $index => $file) {
                    if ($file['error'] == UPLOAD_ERR_OK) {
                        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                        if (in_array($fileExtension, $acceptableExtensions)) {
                            if (!is_dir($directory)) {
                                mkdir($directory);
                            }
                            $file_name = md5($file['name'].$_SESSION['user'].date('d-m-Y H:i:s'));
                            move_uploaded_file($file['tmp_name'], $directory . MY_DIRECTORY_SEPARATOR . 'a');
                        } else {
                            $err['img'][$index] = 'Vui lòng nhập đúng định dạng ảnh';
                        }
                    } else {
                        $err['img'][$index] = 'Vui lòng nhập ảnh';
                        $isValidated = false;
                    }
                }
            }
        }
        require_once('./views/homepage/new-post.php');
    }

    /**
     * Logout
     * 
     * @return void
     */
    public function logout() {
        unset($_SESSION['user']);
        header('location: index.php?controller=admin');
    }
}

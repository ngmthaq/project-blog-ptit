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
                        $_SESSION['user'] = $user_name;
                        header('location: index.php?controller=admin&action=manager');
                    }
                }
            }
        }
        require_once('./views/homepage/login.php');
    }

    /**
     * Kiểm tra đăng nhập
     * 
     * @return void
     */
    public function manager()
    {
    }
}

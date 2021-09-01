<?php

require_once('./models/Category.php');
require_once('./models/Post.php');
require_once('./models/User.php');
require_once('./models/PostImage.php');

class AdminController
{
    protected $category;
    protected $user;
    protected $post;
    protected $postImage;

    public function __construct()
    {
        $this->category = new Category();
        $this->post = new Post();
        $this->user = new User();
        $this->postImage = new PostImage();
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
        if (isset($_SESSION['user'])) {
            $name = $_SESSION['user']['name'];
            $posts = $this->post->all();
            require_once('./views/homepage/manager.php');
        } else {
            header('location: index.php?controller=admin');
        }
    }

    /**
     * Thêm bài viết
     * 
     * @return void
     */
    public function newPost()
    {
        if (isset($_SESSION['user'])) {
            if (isset($_POST['submit'])) {
                $post = $this->post->create($_POST, $_FILES['img']);
            }

            $categories = $this->category->all();
            require_once('./views/homepage/new-post.php');
        } else {
            header('location: index.php?controller=admin');
        }
    }

    /**
     * Logout
     * 
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['user']);
        header('location: index.php?controller=admin');
    }
}

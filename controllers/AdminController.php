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
            $err = [];
            if (isset($_POST['submit'])) {
                $err = $this->post->create($_POST, $_FILES['img']);
                if (count($err) == 0) {
                    header('location: index.php?controller=admin&action=manager');
                }
            }

            $categories = $this->category->all();
            require_once('./views/homepage/new-post.php');
        } else {
            header('location: index.php?controller=admin');
        }
    }

    /**
     * Sửa bài viết
     * 
     * @return void
     */
    public function edit()
    {
        if (isset($_SESSION['user'])) {
            $categories = $this->category->getCategoryAndAmountOfPost();
            $post = $this->post->show($_GET['post_id']);
            $category_id = $post['category_id'] ?? 0;
            $sixPosts = $this->post->getFirstSixPostInformation($category_id, $_GET['post_id']);
            $images = $this->postImage->show($_GET['post_id']);
            $whichPage = 'posts';
            $err = [];
            if (isset($_POST['submit'])) {
                $file = [];
                foreach ($images as $index => $image) {
                    if (isset($_FILES["nofile_$index"])) {
                        $file['name'][$index] = $image['img_name'];
                        $file['type'][$index] = 'image/png';
                        $file['tmp_name'][$index] = 'nofile';
                        $file['error'][$index] = MY_UPLOAD_FILE_NO_FILE;
                        $file['size'][$index] = 1;
                        $file['index'][$index] = $image['img_id'];
                    }
                    if (isset($_FILES["img_$index"])) {
                        $file['name'][$index] = $_FILES["img_$index"]['name'];
                        $file['type'][$index] = $_FILES["img_$index"]['type'];
                        $file['tmp_name'][$index] = $_FILES["img_$index"]['tmp_name'];
                        $file['error'][$index] = $_FILES["img_$index"]['error'];
                        $file['size'][$index] = $_FILES["img_$index"]['size'];
                        $file['index'][$index] = $image['img_id'];
                    }
                    if (isset($_FILES["change_file_$index"])) {
                        $file['name'][$index] = $_FILES["change_file_$index"]['name'];
                        $file['type'][$index] = $_FILES["change_file_$index"]['type'];
                        $file['tmp_name'][$index] = $_FILES["change_file_$index"]['tmp_name'];
                        $file['error'][$index] = $_FILES["change_file_$index"]['error'];
                        $file['size'][$index] = $_FILES["change_file_$index"]['size'];
                        $file['index'][$index] = $image['img_id'];
                    }
                }
                $err = $this->post->update($_GET['post_id'], $_POST, $file);
                if (count($err) == 0) {
                    header('location: index.php?controller=admin&action=manager');
                }
            }

            require_once('./views/homepage/edit.php');
        } else {
            header('location: index.php?controller=admin');
        }
    }

    /**
     * Xoá bài viết
     * 
     * @return void
     */
    public function delete()
    {
        $isDeleted = $this->post->destroy($_GET['post_id']);
        if ($isDeleted) {
            header('location: index.php?controller=admin&action=manager');
        } else {
            print_r("Xoá không thành công vui lòng kiểm tra lại, tự động chuyển trang sau 3 giây");
            header("refresh:3;url=index.php?controller=admin&action=manager");
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

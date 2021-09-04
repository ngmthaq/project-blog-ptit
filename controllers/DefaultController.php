<?php

require_once('./models/Category.php');
require_once('./models/Post.php');
require_once('./models/PostImage.php');

class DefaultController
{
    protected $category;
    protected $post;
    protected $postImage;

    public function __construct()
    {
        $this->category = new Category();
        $this->post = new Post();
        $this->postImage = new PostImage();
    }

    /**
     * Hiển thị trang chủ
     * 
     * @return void
     */
    public function index()
    {
        $categories = $this->category->getCategoryAndAmountOfPost();
        $posts = $this->post->getFirstSixPostInformation();
        $whichPage = 'home';
        require_once('./views/homepage/homepage.php');
    }

    /**
     * Hiển thị trang about us
     * 
     * @return void
     */
    public function aboutUs()
    {
        $categories = $this->category->getCategoryAndAmountOfPost();
        $posts = $this->post->getFirstSixPostInformation();
        $whichPage ='aboutUs';
        require_once('./views/homepage/about-us.php');
    }

    /**
     * Hiển thị trang contact
     * 
     * @return void
     */
    public function contact()
    {
        $categories = $this->category->getCategoryAndAmountOfPost();
        $posts = $this->post->getFirstSixPostInformation();
        $whichPage ='contact';
        require_once('./views/homepage/contact.php');
    }

    /**
     * Hiển thị trang posts
     * 
     * @return void
     */
    public function posts()
    {
        $categories = $this->category->getCategoryAndAmountOfPost();
        $firstPost = $this->post->getFirstPostInformation($_GET);
        $posts = $this->post->getNextSixPostInformation($_GET);
        $whichPage = 'posts';
        $category_id = $_GET['category'] ?? 0;
        require_once('./views/posts/posts.php');
    }

    /**
     * Hiển thị chi tiết bài post
     * 
     * @return void
     */
    public function post()
    {
        $categories = $this->category->getCategoryAndAmountOfPost();
        $post = $this->post->show($_GET['id']);
        $category_id = $post['category_id'] ?? 0;
        $sixPosts = $this->post->getFirstSixPostInformation($category_id, $_GET['id']);
        $images = $this->postImage->show($_GET['id']);
        $whichPage = 'posts';

        require_once('./views/posts/post.php');
    }

    /**
     * Ajax load more post
     * 
     * @return json
     */
    public function loadMorePosts()
    {
        $posts = $this->post->getNextSixPostInformation($_GET);
        $page = $_GET['page'] ?? 1;
        $data = [];
        $data['posts'] = $posts;
        $data['page'] = $page;
        $data = json_encode($data);
        return $data;
    }
}
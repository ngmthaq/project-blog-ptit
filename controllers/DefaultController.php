<?php

require_once('./models/Category.php');
require_once('./models/Post.php');

class DefaultController
{
    protected $category;
    protected $post;

    public function __construct()
    {
        $this->category = new Category();
        $this->post = new Post();
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
     * Ajax load more post
     * 
     * @return void
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
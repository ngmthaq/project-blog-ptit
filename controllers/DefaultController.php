<?php

require_once('./models/Category.php');
require_once('./models/Post.php');

class DefaultController
{
    protected $categories;
    protected $posts;

    public function __construct()
    {
        $this->categories = new Category();
        $this->posts = new Post();
    }

    /**
     * Hiển thị trang chủ
     * 
     * @return void
     */
    public function index()
    {
        $categories = $this->categories->getCategoryAndAmountOfPost();
        $posts = $this->posts->getFirstSixPostInformation();
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
        $categories = $this->categories->getCategoryAndAmountOfPost();
        $posts = $this->posts->getFirstSixPostInformation();
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
        $categories = $this->categories->getCategoryAndAmountOfPost();
        $posts = $this->posts->getFirstSixPostInformation();
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
        $categories = $this->categories->getCategoryAndAmountOfPost();
        $firstPost = $this->posts->getFirstPostInformation();
        $posts = $this->posts->getNextSixPostInformation($_GET);
        $whichPage ='posts';
        require_once('./views/posts/posts.php');
    }

    /**
     * Ajax load more post
     * 
     * @return void
     */
    public function loadMorePosts()
    {
        $posts = $this->posts->getNextSixPostInformation($_GET);
        $page = $_GET['page'] ?? 1;
        $data = [];
        $data['posts'] = $posts;
        $data['page'] = $page;
        $data = json_encode($data);
        return $data;
    }
}
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
        // echo "<pre>";
        // print_r($categories);
        // die();
        require_once('./views/homepage/homepage.php');
    }
}
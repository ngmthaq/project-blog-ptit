<?php

class DefaultController
{
    /**
     * Hiển thị trang chủ
     * 
     * @return void
     */
    public function index()
    {
        $whichPage = 'home';
        require_once('./views/homepage/homepage.php');
    }
}
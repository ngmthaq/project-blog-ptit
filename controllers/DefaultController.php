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
        require_once('./views/homepage/homepage.php');
    }
}
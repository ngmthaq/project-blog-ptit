<?php

require_once('./models/Post.php');

class PostImage extends Post
{
    protected $table = 'post_image';

    /**
     * Thêm ảnh
     * 
     * @param array $param
     * 
     * @return array
     */
    public function addImages($param)
    {
        
    }
}

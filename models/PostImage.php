<?php

require_once('./models/Post.php');

class PostImage extends Post
{
    protected $table = 'post_image';

    /**
     * Lấy tất cả ảnh của 1 post
     * 
     * @param int $id
     * 
     * @return array
     */
    public function show($id)
    {
        $sql = "SELECT id AS 'img_id', post_id, img_path, img_name
        FROM post_image WHERE post_id = $id";
        $images = $this->conn->query($sql);
        return $images->fetch_all(MYSQLI_ASSOC);
    }
}

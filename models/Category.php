<?php

require_once('./models/Model.php');

class Category extends Model
{
    protected $table = 'categories';

    public function getCategoryAndAmountOfPost()
    {
        $sql = "SELECT categories.name, categories.image, COUNT(posts.id) AS 'posts' 
        FROM categories 
        LEFT JOIN posts ON categories.id = posts.category_id
        GROUP BY categories.name, categories.image";

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

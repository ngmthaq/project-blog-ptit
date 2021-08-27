<?php

require_once('./models/Model.php');

class Post extends Model
{
    protected $table = 'posts';

    public function getFirstSixPostInformation()
    {
        $sql = "SELECT posts.*, categories.name AS 'category', users.name AS 'user' FROM `posts` 
        INNER JOIN categories ON posts.category_id = categories.id 
        INNER JOIN users ON posts.user_id = users.id
        ORDER BY date DESC
        LIMIT 6";

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

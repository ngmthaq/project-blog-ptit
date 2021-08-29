<?php

require_once('./models/Model.php');

class Post extends Model
{
    protected $table = 'posts';
    
    /**
     * Get first six posts
     * 
     * @return array
     */
    public function getFirstSixPostInformation($category = null)
    {
        $sql = "SELECT posts.*, categories.name AS 'category', users.name AS 'user' FROM `posts` 
        INNER JOIN categories ON posts.category_id = categories.id 
        INNER JOIN users ON posts.user_id = users.id
        ORDER BY date DESC
        LIMIT 6";

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get first post
     * 
     * @return array
     */
    public function getFirstPostInformation($param, $category = null)
    {
        $where = '';

        $category_id = $param['category'] ?? null;

        if ($category_id) {
            $where = " WHERE category_id = $category_id ";
        }

        $sql = "SELECT posts.*, categories.name AS 'category', users.name AS 'user' FROM `posts` 
        INNER JOIN categories ON posts.category_id = categories.id 
        INNER JOIN users ON posts.user_id = users.id
        $where
        ORDER BY date DESC
        LIMIT 1";

        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    /**
     * Get next six posts after first post
     * 
     * @param array $param
     * 
     * @return array
     */
    public function getNextSixPostInformation($param, $category = null)
    {
        $where = '';

        $category_id = $param['category'] ?? null;

        if ($category_id) {
            $where = " WHERE category_id = $category_id ";
        }

        $page = $param['page'] ?? 1;
        $offset = ($page - 1) * 6 + 1;
        $sql = "SELECT posts.*, categories.name AS 'category', users.name AS 'user' FROM `posts`
        INNER JOIN categories ON posts.category_id = categories.id 
        INNER JOIN users ON posts.user_id = users.id
        $where
        ORDER BY date DESC
        LIMIT 6 OFFSET $offset";

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

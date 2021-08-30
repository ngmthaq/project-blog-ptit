<?php

require_once('./models/Model.php');

class User extends Model
{
    protected $table = 'users';

    public function getUserInformation($param)
    {
        $username = $param['user_name'];
        $sql = "SELECT * FROM users WHERE users.user_name = '$username'";
        $result = $this->conn->query($sql);
        if ($result->num_rows <= 0) {
            return null;
        }
        return $result->fetch_assoc() ?? null;
    }
}

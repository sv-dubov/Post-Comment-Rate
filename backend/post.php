<?php

include_once('config/database.php');

class Post
{
    private $postTable = "posts";
    private $ratingTable = "ratings";
    private $con;

    function __construct()
    {
        $database = new Database();
        $this->con = $database->connect();
    }

    public function insertRecord($post, $visitore_name)
    {
        $sql = "INSERT INTO $this->postTable (post, visitore_name) VALUES(?, ?)";
        $stmt = $this->con->prepare($sql);

        if ($stmt === false) {
            echo mysqli_error($this->con);
        } else {
            $stmt->bind_param("ss", $post, $visitore_name);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function displayRecord()
    {
        $sql = "SELECT * FROM $this->postTable ORDER BY created_at DESC";
        $stmt = $this->con->prepare($sql);
        if ($stmt === false) {
            echo mysqli_error($this->con);
        } else {
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    return $data;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function totalRowCount()
    {
        $sql = "SELECT COUNT(*) FROM $this->postTable";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($num_rows);
        $stmt->fetch();
        return $num_rows;
    }

    public function totalPositiveRowCount()
    {
        $sql = "SELECT COUNT(p.id) FROM $this->postTable as p 
        LEFT JOIN (SELECT post_id, ROUND(AVG(rating)) as rating FROM $this->ratingTable GROUP BY post_id) as r ON p.id = r.post_id 
        WHERE r.rating BETWEEN 4 AND 5";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($num_rows);
        $stmt->fetch();
        return $num_rows;
    }

    public function totalNegativeRowCount()
    {
        $sql = "SELECT COUNT(p.id) FROM $this->postTable as p 
        LEFT JOIN (SELECT post_id, ROUND(AVG(rating)) as rating FROM $this->ratingTable GROUP BY post_id) as r ON p.id = r.post_id 
        WHERE r.rating BETWEEN 1 AND 2";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($num_rows);
        $stmt->fetch();
        return $num_rows;
    }
}

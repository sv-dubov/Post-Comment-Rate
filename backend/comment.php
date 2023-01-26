<?php

include_once('config/database.php');

class Comment
{
    private $commentTable = "comments";
    private $con;

    function __construct()
    {
        $database = new Database();
        $this->con = $database->connect();
    }

    public function insertComment($comment, $visitore_name, $post_id)
    {
        $sql = "INSERT INTO $this->commentTable (comment, visitore_name, post_id) VALUES(?, ?, ?)";
        $stmt = $this->con->prepare($sql);

        if ($stmt === false) {
            echo mysqli_error($this->con);
        } else {
            $stmt->bind_param("ssi", $comment, $visitore_name, $post_id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function displayRecord($id)
    {
        $sql = "SELECT * FROM $this->commentTable WHERE post_id = ? ORDER BY created_at DESC";
        $stmt = $this->con->prepare($sql);
        if ($stmt === false) {
            echo mysqli_error($this->con);
        } else {
            $stmt->bind_param("i", $id);
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

    public function totalRowCount($id)
    {
        $sql = "SELECT COUNT(*) FROM $this->commentTable WHERE post_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($num_rows);
        $stmt->fetch();
        return $num_rows;
    }
}

<?php

include_once('config/database.php');

class Rating
{
    private $ratingTable = "ratings";
    private $con;

    function __construct()
    {
        $database = new Database();
        $this->con = $database->connect();
    }

    public function insertRating($rating, $post_id)
    {
        $sql = "INSERT INTO $this->ratingTable (rating, post_id) VALUES(?, ?)";
        $stmt = $this->con->prepare($sql);

        if ($stmt === false) {
            echo mysqli_error($this->con);
        } else {
            $stmt->bind_param("ii", $rating, $post_id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function totalRowCount($id)
    {
        $sql = "SELECT COUNT(*) FROM $this->ratingTable WHERE post_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($num_rows);
        $stmt->fetch();
        return $num_rows;
    }
}

<?php

include_once('post.php');
include_once('comment.php');
include_once('rating.php');

$dbPostObj = new Post();
$dbCommentObj = new Comment();
$dbRatingObj = new Rating();

// Insert post
if (isset($_POST['action']) && $_POST['action'] == "insert") {
  $post = trim($_POST['post']);
  $visitore_name = trim($_POST['visitore_name']);
  if (!empty($post) && !empty($visitore_name))
    $dbPostObj->insertRecord($post, $visitore_name);
}

// Insert comment
if (isset($_POST['action']) && $_POST['action'] == "insert_comment") {
  $comment = trim($_POST['comment']);
  $visitore_name = trim($_POST['visitore_name']);
  $post_id = $_POST['post_id'];
  if (!empty($comment) && !empty($visitore_name))
    $dbCommentObj->insertComment($comment, $visitore_name, $post_id);
}

// Insert rating
if (isset($_POST['action']) && $_POST['action'] == "insert_rating") {
  session_start();
  $rating = $_POST['rating'];
  $post_id = $_POST['post_id'];
  if (isset($_SESSION['post_ids'])) {
    if (!empty($rating)) {
      if (in_array($post_id, $_SESSION['post_ids'])) {
        echo json_encode(array("message" => "Already voted"));
      } else {
        $dbRatingObj->insertRating($rating, $post_id);
        $_SESSION['post_ids'][] = (int)$post_id;
        echo json_encode(array("message" => "Rate added"));
      }
    }
  } else {
    $dbRatingObj->insertRating($rating, $post_id);
    $_SESSION['post_ids'][] = (int)$post_id;
    echo json_encode(array("message" => "Rate added"));
  }
}

if (isset($_POST['action']) && $_POST['action'] == "view") {
  $output = "";
  $posts = $dbPostObj->displayRecord();
  if ($dbPostObj->totalRowCount() > 0) {
    foreach ($posts as $post) {
      $output .= "<div class='card mb-3 w-100'>
        <div class='card-body'>
          <div class='d-flex justify-content-between'>
            <h6 class='card-subtitle mb-2 text-muted font-italic'>by " . $post['visitore_name'] . "</h6>
            <a id='addComment' class='btn btn-primary' data-id='" . $post['id'] . "' data-toggle='modal' data-target='#addModal'>Add Comment</a>
            </div>
            <p class='card-text'>" . $post['post'] . "</p>
            <div class='d-flex justify-content-between'>
            <div class='rating'>";
      for ($i = 5; $i >= 1; $i--) {
        $output .= "<input class='rate' type='radio' data-id='" . $post['id'] . "' id='star" . $i . "-" . $post['id'] . "' name='rating' value='" . $i . "'>
              <label for='star" . $i . "-" . $post['id'] . "'></label>";
      }
      $output .= "</div>
            <h6 class='card-subtitle mb-2 text-muted'>" . date('d.m.Y', strtotime($post['created_at'])) . "</h6>
            </div>          
          </div>
        </div>";

      $comments = $dbCommentObj->displayRecord($post['id']);

      if ($dbCommentObj->totalRowCount($post['id']) > 0) {
        if (isset($comments) && is_array($comments))
          foreach ($comments as $comment) {
            $output .= "<div class='card mb-3 w-75 float-right'>
          <div class='card-body'>
          <div class='d-flex justify-content-between'>
            <h6 class='card-subtitle mb-2 text-muted font-italic'>by " . $comment['visitore_name'] . "</h6>
            </div>
            <p class='card-text'>" . $comment['comment'] . "</p>
            <h6 class='card-subtitle mb-2 text-muted text-right'>" . date('d.m.Y', strtotime($comment['created_at'])) . "</h6>
          </div>
        </div>";
          }
      } else {
        $output .= "<div class='card mb-3 w-25 float-right'>
          <div class='card-body'>
            <h6 class='card-subtitle text-muted'>No comments yet</h6>          
          </div>
        </div>";
      }
    }
    echo $output;
  } else {
    $output .= "<div class='card mb-3 w-75'>
          <div class='card-body'>
            <h6 class='card-subtitle text-muted'>No posts yet</h6>          
          </div>
        </div>";
    echo $output;
  }
}

if (isset($_POST['action']) && $_POST['action'] == "count_all") {
  $output = "";
  $posts_all = $dbPostObj->totalRowCount();
  $output .= "<h5 class='card-title'>" . $posts_all . "</h5>
      <p class='card-text'>All Posts</p>";
  echo $output;
}

if (isset($_POST['action']) && $_POST['action'] == "count_positive") {
  $output = "";
  $posts_positive = $dbPostObj->totalPositiveRowCount();
  $output .= "<h5 class='card-title'>" . $posts_positive . "</h5>
      <p class='card-text'>Positive Posts</p>";
  echo $output;
}

if (isset($_POST['action']) && $_POST['action'] == "count_negative") {
  $output = "";
  $posts_negative = $dbPostObj->totalNegativeRowCount();
  $output .= "<h5 class='card-title'>" . $posts_negative . "</h5>
    <p class='card-text'>Negative Posts</p>";
  echo $output;
}

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Posts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <div class="card text-center" style="padding:15px;">
    <h3>Simple Posts with Comments and Rating System</h3>
  </div><br><br>

  <div class="container">
    <div class="row d-flex justify-content-center text-center align-items-center">
      <div class="card post-counter" style="width: 12rem;">
        <div class="card-body" id="count_negative">
        </div>
      </div>
      <div class="card post-counter" style="width: 12rem;">
        <div class="card-body" id="count_all">
        </div>
      </div>
      <div class="card post-counter" style="width: 12rem;">
        <div class="card-body" id="count_positive">
        </div>
      </div>
    </div>
  </div><br>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h4>All posts</h4>
      </div>
      <div class="col-lg-6">
        <button type="button" id="addPost" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal">
          <i class="fa fa-plus"></i> Add Post</button>
      </div>
    </div><br>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div id="postData">
        </div>
        <div id="commentData">
        </div>
      </div>
    </div>
  </div>

  <!-- Add Record Modal -->
  <div class="modal" id="addModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form id="formData">
            <input type="hidden" name="post_id" id="post_id">
            <div class="form-group">
              <label for="visitore_name">Name:</label>
              <input type="text" class="form-control" id="visitore_name" name="visitore_name" placeholder="Enter your name">
              <span class="error" id="error_name">Please, enter your name</span>
            </div>
            <div class="form-group">
              <label id="label_body" for="post">Post:</label>
              <textarea class="form-control" id="text_body" name="post" placeholder="Enter text"></textarea>
              <span class="error" id="error_body">Please, enter text</span>
            </div>
            <hr>
            <div class="form-group float-right">
              <button type="submit" class="btn btn-success add-post" id="addContent">Add Post</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="assets/js/script.js"></script>
</body>

</html>
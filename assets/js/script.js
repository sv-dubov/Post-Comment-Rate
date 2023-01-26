$(document).ready(function () {
    showAllPosts();
    countNegativePosts();
    countAllPosts();
    countPositivePosts();
});

$(document).on('click', '#addComment', function () {
    $('#formData')[0].reset();
    $('.modal-title').html('Add Comment');
    $('#label_body').text('Comment:');
    $('#label_body').attr('for', 'comment');
    $('#addContent').html('Add Comment');
    $('#text_body').attr('name', 'comment');
    $('#addContent').removeClass('add-post').addClass('add-comment');
    let post_id = $(this).attr('data-id');
    $('#post_id').val(post_id);
});

$(document).on('click', '#addPost', function () {
    $('#formData')[0].reset();
    $('.modal-title').html('Add Post');
    $('#label_body').text('Post:');
    $('#label_body').attr('for', 'post');
    $('#addContent').html('Add Post');
    $('#text_body').attr('name', 'post');
    $('#addContent').removeClass('add-comment').addClass('add-post');
});

//insert post/comment
$(document).on('click', '#addContent', function (e) {
    if ($('#formData')[0].checkValidity()) {
        e.preventDefault();
        if (validateFields()) {
            let action = 'insert';
            let message = 'Post added successfully';
            if ($('button').hasClass('add-comment')) {
                action = 'insert_comment';
                message = 'Comment added successfully';
            }
            $.ajax({
                url: 'backend/action.php',
                type: 'POST',
                data: $('#formData').serialize() + '&action=' + action,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: message,
                    });
                    $('#addModal').modal('hide');
                    $('#formData')[0].reset();
                    showAllPosts();
                    countAllPosts();
                }
            });
        }
    }
});

//insert rating
$(document).on('click', '.rate', function () {
    let post_id = $(this).attr('data-id');
    let rating = $("input[name=rating]:checked").val();
    let icon = 'success';
    let title = 'Your rate was added!';
    $.ajax({
        url: 'backend/action.php',
        type: 'POST',
        data: 'post_id=' + post_id + '&rating=' + rating + '&action=insert_rating',
        dataType: "JSON",
        success: function (response) {
            $("input[name=rating][data-id='" + post_id + "']").prop('disabled', true);
            if (response.message == 'Already voted') {
                icon = 'warning';
                title = 'You\'ve already voted for this post!';
            }
            Swal.fire({
                icon: icon,
                title: title,
            });
            countNegativePosts();
            countPositivePosts();
        }
    });
});

//view all posts
function showAllPosts() {
    $.ajax({
        url: 'backend/action.php',
        type: 'POST',
        data: {
            action: 'view'
        },
        success: function (response) {
            $('#postData').html(response);
        }
    });
}

//count all posts
function countAllPosts() {
    $.ajax({
        url: 'backend/action.php',
        type: 'POST',
        data: {
            action: 'count_all'
        },
        success: function (response) {
            $('#count_all').html(response);
        }
    });
}

//count positive posts
function countPositivePosts() {
    $.ajax({
        url: 'backend/action.php',
        type: 'POST',
        data: {
            action: 'count_positive'
        },
        success: function (response) {
            $('#count_positive').html(response);
        }
    });
}

//count negative posts
function countNegativePosts() {
    $.ajax({
        url: 'backend/action.php',
        type: 'POST',
        data: {
            action: 'count_negative'
        },
        success: function (response) {
            $('#count_negative').html(response);
        }
    });
}

//validate form fields
function validateFields() {
    let name = $("#visitore_name").val();
    let post = $("#text_body").val();

    if (name.trim() == "") {
        $('#error_name').show();
        $('#visitore_name').focus();
        $('#error_name').hide().slideDown().delay(3000).fadeOut();
        return false;
    } else if (post.trim() == "") {
        $("#error_body").show();
        $("#text_body").focus();
        $('#error_body').hide().slideDown().delay(3000).fadeOut();
        return false;
    }
    return true;
}
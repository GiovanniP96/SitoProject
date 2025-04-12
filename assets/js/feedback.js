$(document).ready(function() {
    // Load comments on page load
    loadComments();

    // Post new comment
    $('#commentForm').submit(function(e) {
        e.preventDefault();
        if ($('#commentText').val().trim() === '') return;
        
        $.ajax({
            url: 'ajax/post_comment.php',
            method: 'POST',
            data: { comment: $('#commentText').val() },
            beforeSend: function() {
                $('#commentForm button').prop('disabled', true)
                    .html('<span class="spinner-border spinner-border-sm"></span> Posting...');
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#commentText').val('');
                    loadComments();
                    showMessage('Your feedback has been posted successfully!', 'success');
                }else {
                    showMessage('Failed to post your feedback. Please try again.', 'danger');
                }
            },
            complete: function() {
                $('#commentForm button').prop('disabled', false).html('Post Comment');
            }
        });
    });

    // Toggle reply form
    $(document).on('click', '.reply-btn', function() {
        const commentId = $(this).data('comment-id');
        $(`#reply-form-${commentId}`).slideToggle();
    });

    // Submit reply
    $(document).on('click', '.submit-reply', function() {
        const parentId = $(this).data('parent-id');
        const replyText = $(this).siblings('.reply-text').val();
        
        if (replyText.trim() === '') return;

        $.ajax({
            url: 'ajax/post_reply.php',
            method: 'POST',
            data: { 
                comment: replyText,
                parent_id: parentId 
            },
            success: function(response) {
                if (response.status === 'success') {
                    loadComments();
                    showMessage('Your comment has been posted successfully!', 'success');
                }
            }
        });
    });
});

function loadComments() {
    $('#commentsContainer').html('<div class="text-center py-4"><div class="spinner-border text-primary"></div></div>');
    
    $.ajax({
        url: 'ajax/load_comments.php',
        method: 'GET',
        success: function(response) {
            $('#commentsContainer').hide().html(response).fadeIn(500);
        }
    });
}

// function showMessage(message, type) {
//     const alert = `
//         <div class="alert alert-${type} alert-dismissible fade show" role="alert">
//             ${message}
//         </div>
//     `;
//     $('.show_message').html(alert).fadeIn(500).delay(3000).fadeOut(500);
// }
function showMessage(message, type) {
    const alert = `
    <div class="alert alert-${type} alert-dismissible fade show custom-alert" role="alert">
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
`;
$('body').append(alert);  // Add the alert to the body

// Automatically hide the alert after 3 seconds
setTimeout(function() {
    $('.alert').alert('close');
}, 2000);
}

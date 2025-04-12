<?php
include '../includes/config.php';

function buildCommentTree($parent_id = null, $is_top_level = true) {
    global $conn;
    $html = '';
    $sql = "SELECT c.*, u.username , u.image FROM comments c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.parent_id " . ($parent_id ? "= $parent_id" : "IS NULL") . " 
            ORDER BY c.created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Only show comment count for top-level feedback posts
        if ($is_top_level) {
            $html .= '<h6 class="comment-count mb-0">'.$result->num_rows.' Feedback Posts</h6>';
            $html .= '<div class="divider divider-1 mt-0"></div>
                      <div class="divider divider-2 mt-0"></div>
                      <div class="divider divider-2 mt-0"></div>
                      <div class="divider divider-2 mt-0"></div>';
        }

        while ($row = $result->fetch_assoc()) {
            // Count replies for this comment
            $image ;
            if($row['image'] == ''){
                $image = "uploads/icon.png";
            }else{
                $image = $row['image'];
            }
            $reply_count = 0;
            if ($parent_id === null) {
                $count_sql = "SELECT COUNT(*) as reply_count FROM comments WHERE parent_id = ".$row['id'];
                $count_result = $conn->query($count_sql);
                $reply_count = $count_result->fetch_assoc()['reply_count'];
            }

            $html .= '
            <div class="comment-card card mb-3 mt-3 my_comment" id="comment-'.$row['id'].'">
                <div class="card-body">
                    <div class="d-flex justify-content-between mt-2">
                         <div class=" d-flex align-items-center">
                         <img class="img-fluid rounded-circle" src="'.$image.'" width="60px"> 
                         <h5 class="card-title" style="margin-left:12px;">'.$row['username'].'</h5>
                         </div>
                        <small class="text-muted">'.date('M j, Y g:i a', strtotime($row['created_at'])).'</small>
                    </div>
                    <p class="card-text mt-2">'.$row['comment'].'</p><hr>'
                    ;
            
            // Show reply count for top-level feedback posts
            if ($parent_id === null && $reply_count > 0) {
                $html .= '<small class="text-muted mb-2 count_reply">'.$reply_count.' '.($reply_count == 1 ? 'Reply' : 'Replies').'</small>';
            }
            
            $html .= '<a href="javascript:void(0)" class="text-dark reply-btn" data-comment-id="'.$row['id'].'">
                        '.($parent_id === null ? 'Comment' : 'Reply').'
                      </a>
                  
                      <div class="reply-form mt-3" id="reply-form-'.$row['id'].'" style="display:none">
                          <textarea class="form-control mb-2 reply-text" placeholder="Write your '.($parent_id === null ? 'comment' : 'reply').'..."></textarea>
                          <button class="submit-reply btn btn-primary" data-parent-id="'.$row['id'].'">Post '.($parent_id === null ? 'Comment' : 'Reply').'</button>
                      </div>
                      '.buildCommentTree($row['id'], false).'
                </div>
            </div>';
        }
    }
    return $html;
}

echo buildCommentTree();
?>









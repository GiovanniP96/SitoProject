<?php 
include 'includes/header.php';
include 'includes/auth_check.php'; // Protect this page
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3 class="card-title">Dacci un FeedBack</h3>
                    <form id="commentForm">
                        <div class="form-floating mb-3">
                            <label for="commentText">Nome</label>
                             <input type="text" value="<?php echo $_SESSION['username'] ?>" disabled class="form-control">
                        </div>
                        <div class="form-floating mb-3">
                            <label for="commentText">Il tuo FeedBack...</label>
                            <textarea class="form-control" placeholder="Inserisci il tuo FeedBack ..." style="height: 100px" id="commentText" ></textarea>
                        </div>
                        <div class="show_message">
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Commenta</button>
                    </form>
                </div>
            </div>

            <div id="commentsContainer" class="mt-4">
                <!-- Comments load here via AJAX -->
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- <script src="assets/js/feedback.js"></script> -->
<?php include 'includes/footer.php'; ?>
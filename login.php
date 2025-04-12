<?php include 'includes/header.php'; ?>
<style>
    #scene {
    display: none !important;
}

.hero-section .container {
    display: none !important;
}

.hero-section {
    padding-top: 0px !important;
    padding-bottom: 250px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: bottom center;
    margin-bottom: 0px !important;
}
</style>
<!-- login form  -->
<div class="container py-5" id="frm_login">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Login</button>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Non hai un account?? <a href="register.php">Registrati!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
   
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        // console.log('>>>>>>>>>>>', $('#username').val());
        // console.log('>>>>>>>>>>>', $('#password').val());
        $.ajax({
            url: 'ajax/login.php',
            method: 'POST',
            data: {
                username: $('#username').val(),
                password: $('#password').val()
            },
            success: function(response) {
                // console.log(response.status);
                if (response.status === 'success') {
                    window.location.href = 'feedback.php';
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>
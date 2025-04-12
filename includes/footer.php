


<!-- footer -->
<div class="row p-3" id="footer_txt">
    <div class="col-md-12 text-center">
       <h5> 2025 &copy; All Rights Reserved </h5>
    </div>

</div>
<!-- /footer -->
</section>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.querySelector(".navbar"); // Or "#navigation" if it's an ID

    // Check if the navbar exists
    if (navbar) {
        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                navbar.style.backgroundColor = 'White';
            } else {
                navbar.style.backgroundColor = 'transparent';
            }
        };
    } else {
        console.log("Navbar element not found.");
    }
});

</script>



<!-- jQuery -->
<!-- <script src="assets/plugins/jQuery/jquery.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- Bootstrap JS -->
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="assets/js/feedback.js"></script>
<!-- slick slider -->
<!-- <script src="assets/plugins/slick/slick.min.js"></script> -->
<!-- venobox -->
<!-- <script src="assets/plugins/Venobox/venobox.min.js"></script> -->
<!-- aos -->
<!-- <script src="assets/plugins/aos/aos.js"></script> -->
<!-- Main Script -->
<!-- <script src="assets/js/script.js"></script> -->





</body>
</html>
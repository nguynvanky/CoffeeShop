</body>
<?php
include_once("././signup.php");
include_once("././signin.php");

?>
<footer class="footer w-100 py-4 flex-shrink-0 px-3 mt-5">
    <div class="container py-4">
        <div class="row gy-4 gx-5">
            <div class="col-lg-4 col-md-6">
                <h5 class="h1 text-white logo text-uppercase" style="letter-spacing:10px;">COFFEE SHOP</h5>
                <p class="small text-light mb-0">&copy; Copyrights. All rights reserved. <a class="nav-link text-light" href="#">coffeeshop.com</a></p>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white mb-3">About</h5>
                <ul class="list-unstyled text-muted">
                    <li><a class="nav-link text-light" href="#">Home</a></li>
                    <li><a class="nav-link text-light" href="#">About</a></li>
                    <li><a class="nav-link text-light" href="#">Get started</a></li>
                    <li><a class="nav-link text-light" href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white mb-3">Contact</h5>
                <ul class="list-unstyled text-muted">
                    <li><a class="nav-link text-light" href="#" target="_blank">Facebook</a></li>
                    <li><a class="nav-link text-light" href="#" target="_blank">Github</a></li>
                    <li><a class="nav-link text-light" href="#">Linkedln</a></li>
                    <li><a class="nav-link text-light" href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-3">Newsletter</h5>
                <p class="small text-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                <form action="#">
                    <div class="input-group mb-3">
                        <input class="form-control shadow-none" type="text" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-secondary " style="background-color: var(--dark-purple-third);" id="button-addon2" type="button"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</footer>
<script src="./script/bootstrap.bundle.js"></script>
<script src="./script/jquery-3.6.1.js"></script>
<script src="./script/ready_state.js"></script>
<script src="./script/owl.carousel.js"></script>
<script src="./script/script.js"></script>
<!-- Start seamless-pagination custom code -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
<script>
    var containerSelector = '#seamless-replace';
    $(document).pjax(
        '.w-pagination-wrapper a',
        containerSelector, {
            container: containerSelector,
            fragment: containerSelector,
            scrollTo: false,
            timeout: 2500,
        }
    );
    // These 3 lines should reinitialize interactions
    $(document).on('pjax:end', function() {
        Webflow.require('ix2').init();
    });
</script>

</html>
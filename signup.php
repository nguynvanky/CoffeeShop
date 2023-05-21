<!-- Modal -->
<div class="modal fade" id="modalSignUp" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="register.php" method="post">
                    <label for="username" class="mt-3">User</label>
                    <input name="username" type="text" required class="form-control shadow-none">
                    <label for="password" class="mt-3">Password</label>
                    <input name="password" id="password" type="password" required class="form-control shadow-none">
                    <label for="confirmpassword" class="mt-3">Confirm password</label>
                    <span class="d-flex align-items-center">
                        <input name="confirmpassword" id="confirmpassword" type="password" required class="form-control shadow-none">
                        <i id="icon-message"></i>
                    </span>
                    <label for="fullname" class="mt-3">Full name</label>
                    <input name="fullname" type="text" required class="form-control shadow-none">
                    <label for="email" class="mt-3">Email</label>
                    <input name="email" type="email" required class="form-control shadow-none">
                    <label for="phonenumber" class="mt-3">Phone number</label>
                    <input name="phonenumber" type="text" required class="form-control shadow-none">
                    <div class="text-center mt-3">
                        <input id="btnSignUp" type="submit" class="bg-blue btn btn-primary" value="Sign up">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
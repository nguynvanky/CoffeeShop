<!-- Modal -->
<div class="modal fade" id="modalSignIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="login.php" method="post">
                    <label for="username" class="mt-3">Username</label>
                    <input name="username" type="text" required class="form-control shadow-none">
                    <label for="password" class="mt-3">Password</label>
                    <input name="password" type="password" required class="form-control shadow-none">
                    <div class="text-center mt-3">
                        <button type="submit" class="bg-blue btn btn-primary">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
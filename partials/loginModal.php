<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to your ThePlayerHub account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/ThePlayerHub/partials/_handleLogin.php" method="POST">
                    <div class="form-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Username"
                                aria-describedby="emailHelp" name="login-email" required>
                        </div>

                        <small id="emailHelp" class="form-text text-muted">Enter your valid username or e-mail</small>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Password" name="login-password" required>
                    </div>
                    <button type="submit" class="btn btn-success my-3 px-5 text-center">Login</button>
                    <p class="my-3">Forgot password! <a href="/ThePlayerHub/reset-password.php"
                            target="_alam">Clcik here</a></p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
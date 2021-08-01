<!-- Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signUpModalLabel">Create your ThePlyerHub account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/ThePlayerHub/partials/_handleSignup.php" method="POST">
                    <div class="form-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Full Name"
                                aria-describedby="emailHelp" required autocomplete="off" name="user_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="E-mail"
                                aria-describedby="emailHelp" required autocomplete="off" name="user_email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-phone"></i></div>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Contact Number"
                                aria-describedby="emailHelp" required autocomplete="off" name="user_contact">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-lock"></i></div>
                            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Password"
                                aria-describedby="emailHelp" name="user_password" required >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-lock"></i></div>
                            <input type="password" class="form-control" id="exampleInputEmail1"
                                placeholder="Repeat password" aria-describedby="emailHelp" name="user_cPassword" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success px-5 text-center">SignUp</button>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
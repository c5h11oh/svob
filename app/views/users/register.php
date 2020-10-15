<?php include_once APPROOT . '/views/inc/header.php' ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Register</h2>
            <form action="<?php echo URLROOT ?>/users/register" method="post">
                <div class="form-group">
                    <label for="name">Name: <sup>*</sup></label>
                    <input type="text" name="name" required minlength="1" class="form-control form-control-lg <?php echo empty($data['error']['name']) ? '':'is-invalid'; ?>" value=<?php echo $data['name']; ?>>
                    <span class="invalid-feedback"><?php
                        foreach($data['error']['name'] as $errMsg){
                            echo $errMsg . "\t";
                        }; 
                    ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo empty($data['error']['email']) ? '':'is-invalid'; ?>" value=<?php echo $data['email']; ?>>
                    <span class="invalid-feedback"><?php
                        foreach($data['error']['email'] as $errMsg){
                            echo $errMsg . "\t";
                        }; 
                    ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo empty($data['error']['password']) ? '':'is-invalid'; ?>" value=<?php echo $data['password']; ?>>
                    <span class="invalid-feedback"><?php 
                        foreach($data['error']['password'] as $errMsg){
                            echo $errMsg . "\t";
                        }; 
                    ?></span>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Password Again: <sup>*</sup></label>
                    <input type="password" name="password_confirm" class="form-control form-control-lg <?php echo empty($data['error']['password']) ? '':'is-invalid'; ?>" value=<?php echo $data['password_confirm']; ?>>
                    <span class="invalid-feedback"><?php 
                        foreach($data['error']['password'] as $errMsg){
                            echo $errMsg . "\t";
                        }; 
                    ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Login?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once APPROOT . '/views/inc/footer.php' ?>
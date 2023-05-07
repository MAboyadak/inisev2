
<?php
session_start();
require_once __DIR__.'/../conf/config.php';
require_once __DIR__.'/../conf/db.php';

include_once __DIR__.'/../partials/header.php';



if(isAuthenticated()){
    header('Location: /inisev2/pages/notice-board.php');
    exit;
}


?>
<section class="vh-100">
    <div class="d-flex align-items-center h-100">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-lg-8">

                    <?php if(isset($_SESSION['error'])) { ?>
                        <div class="bg-danger text-white p-2 my-2">
                            <?php echo $_SESSION['error'] ; ?>
                        </div>
                    <?php unset($_SESSION['error']); } ?>

                    <div class="card text-white p-4" style="border-radius: 15px; border-radius: 1rem; background-color:#306f5c">
                        <div class="card-body p-5">
                        <h2 class="text-uppercase text-center">Create an account</h2>
                        <p class="text-center"><a class="text-warning" href="/inisev2">Already User ? click here</a></p>

                        <form action="/inisev2/controllers/RegisterController.php" method="post">

                            <div class="form-outline mb-3">
                                <label for="name" class="">Name 
                                    <?php if(isset($_SESSION['errors']) && isset($_SESSION['errors']['name'])) {?>
                                        <span class="bg-danger text-white px-2 mx-4 fw-bold my-3 rounded">
                                            <?php echo $_SESSION['errors']['name']; ?>
                                    </span>
                                    <?php } ?>
                                </label> 
                                <input type="text" name="name" class="form-control " />
                            </div>

                            <div class="form-outline mb-3">
                                <label for="email" class="">Email 
                                    <?php if(isset($_SESSION['errors']) && isset($_SESSION['errors']['email'])) {?>
                                        <span class="bg-danger text-white px-2 mx-4 fw-bold my-3 rounded">
                                            <?php echo $_SESSION['errors']['email']; ?>
                                    </span>
                                    <?php } ?>
                                </label> 
                                <input type="email" name="email" class="form-control " />
                            </div>

                            <div class="form-outline mb-3">
                                <label for="password" class="">Password 
                                    <?php if(isset($_SESSION['errors']) && isset($_SESSION['errors']['password'])) {?>
                                        <span class="bg-danger text-white px-2 mx-4 fw-bold my-3 rounded">
                                            <?php echo $_SESSION['errors']['password']; ?>
                                    </span>
                                    <?php } ?>
                                </label> 
                                <input type="password" name="password" class="form-control " />
                            </div>

                            <div class="form-outline mb-3">
                                <label for="confirm_password" class="">Confirm Password 
                                    <?php if(isset($_SESSION['errors']) && isset($_SESSION['errors']['confirm_password'])) {?>
                                        <span class="bg-danger text-white px-2 mx-4 fw-bold my-3 rounded">
                                            <?php echo $_SESSION['errors']['confirm_password']; ?>
                                    </span>
                                    <?php } ?>
                                </label> 
                                <input type="password" name="confirm_password" class="form-control " />
                            </div>

                            <div class="d-flex justify-content-center">
                            <button type="submit"
                                class="btn btn-outline-light btn-lg mt-3">Register</button>
                            </div>

                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if(isset($_SESSION['errors'])) unset($_SESSION['errors']);?>

<?php include_once __DIR__.'/../partials/footer.php'; ?>

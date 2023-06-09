
<?php 
require_once __DIR__.'/../controllers/NoticeboardController.php';
include_once __DIR__.'/../partials/header.php';

?>

<section>
    <h2 class="text-center p-2 rounded bg-secondary text-white mt-4">Add Message</h2>
    <div class="row justify-content-center p-2 mt-0 rounded g-0" style="background-color: #f0f0f0;">
   
        <div class="col-md-8">
            <?php
                if(isset($_SESSION['success'])) { 
            ?>
                <div class="bg-success p-2 my-2 text-white">
                    <?php echo $_SESSION['success'] ; ?>
                </div>
            <?php unset($_SESSION['success']); } ?>

            <?php
                if(isset($_SESSION['error'])) { 
            ?>
                <div class="bg-danger text-white p-2 my-2">
                    <?php echo $_SESSION['error'] ; ?>
                </div>
            <?php unset($_SESSION['error']); } ?>


            <form action="/inisev2/controllers/NoticeboardController.php" method="POST">
                
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="row my-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subject" class="">Subject 
                                <?php if(isset($_SESSION['errors']) && isset($_SESSION['errors']['subject'])) {?>
                                    <span class="bg-danger text-white px-2 mx-4 fw-bold my-3 rounded">
                                        <?php echo $_SESSION['errors']['subject']; ?>
                                </span>
                                <?php } ?>
                            </label> 
                            <input type="text" id="subject" name="subject" class="form-control">
                        </div>
                    </div>
                </div>
                

                
                <div class="row my-3">

                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="message" class="">Message 
                                <?php if(isset($_SESSION['errors']) && isset($_SESSION['errors']['message'])) {?>
                                    <span class="bg-danger text-white px-2 mx-4 fw-bold my-3 rounded">
                                        <?php echo $_SESSION['errors']['message']; ?>
                                </span>
                                <?php } ?>
                            </label> 
                            <textarea type="text" id="message" name="message" rows="4" class="form-control"></textarea>
                        </div>

                    </div>
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-primary my-2 w-25">Submit</button>
                </div>

            </form>

        </div>

    </div>

</section>

<?php if(isset($_SESSION['errors'])) unset($_SESSION['errors']);?>

<?php include_once __DIR__.'/../partials/footer.php'; ?>

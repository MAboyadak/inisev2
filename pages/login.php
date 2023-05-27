<section>
  <div class="container py-5">

    <div class="row justify-content-center align-items-center">
      <div class="col-md-8 col-lg-6">

        <?php if(isset($_SESSION['error'])) { ?>
            <div class="bg-danger text-white p-2 my-2">
                <?php echo $_SESSION['error'] ; ?>
            </div>
        <?php unset($_SESSION['error']); } ?>

        <?php if(isset($_SESSION['success'])) { ?>
            <div class="bg-warning text-white p-2 my-2">
                <?php echo $_SESSION['success'] ; ?>
            </div>
        <?php unset($_SESSION['success']); } ?>

        <div class="card text-white" style="border-radius: 1rem; background-color:#306f5c">
          <div class="card-body p-5 text-center">

            <div class="mt-md-4 ">

              <form action="/inisev2/controllers/LoginController.php" method="POST">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-2">Please enter your login and password!</p>

                <div class="mb-4">
                  <input type="email" name="email" class="form-control form-control-lg" />
                  <label class="form-label">Email</label>
                </div>

                <div class="mb-4">
                  <input type="password" name="password" class="form-control form-control-lg" />
                  <label class="form-label">Password</label>
                </div>

                <button class="btn btn-outline-light btn-lg px-5 mb-3" type="submit">Login</button>
                <p class="text-center mt-3"><a class="text-warning" rel="" href="/inisev2/pages/register.php">New User ?</a></p>
              </form>

            </div>

          </div>
        </div>

      </div>
    </div>
    
  </div>
</section>


<?php 
ob_start(); 
$title = "Sign-in"; 
?>

    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <br>
                <br>
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Enter your Login ID and Password to sign in</p>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="./routes/web.php?url=auth-sign-in">
                    <div class="mb-3">
                      <input type="text" name="loginID" value="<?php if(isset($_GET['loginID'])){ echo $_GET['loginID']; } ?>" class="form-control form-control-lg" placeholder="Login ID" aria-label="Login ID">
                    </div>
                    <div class="mb-3">
                      <input type="text" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                                      
                    <?php session_start(); ?>
                    <?php include_once './components/logs/error-report.php'; ?>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>

                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Forgot Password?
                    <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Recover Password</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
                background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Track your orders! track your batches"</h4>
                <p class="text-white position-relative">Best platform for orders and stock management for Farmers and customers.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php $content = ob_get_clean(); require __DIR__ . '/components/layouts/layout-guest.php'; ?>

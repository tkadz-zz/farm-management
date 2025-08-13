
<?php 
ob_start(); 
$title = "Sign-in"; 
session_start()
?>

    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
           
            <div class="col-12 d-lg-flex h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
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

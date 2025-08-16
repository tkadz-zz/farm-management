<?php require_once './autoloader/autoloader.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
 

  <title>Farm Management - <?php echo isset($title) ? $title : 'Home'; ?></title>
    



  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/argon-dashboard.css" rel="stylesheet" />
  
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/80ca2f70d1.js" crossorigin="anonymous"></script>

  

</head>
<style>
 .profile-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #0d6efd;
    color: #fff;
    font-weight: bold;
    font-size: 1rem;
    cursor: pointer;
}
</style>

<body class="">
  
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="./">
            Farm Management
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link me-2" href="./">
                    <i class="fa fa-lines-leaning opacity-6 text-dark me-1"></i>
                    Learning
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="./track">
                    <i class="fa fa-location-crosshairs opacity-6 text-dark me-1"></i>
                    Track Batch
                  </a>
                </li>
                
                <?php if (!isset($_SESSION['user'])): ?>
                <li class="nav-item">
                  <a class="nav-link me-2" href="./sign-in">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Sign In
                  </a>
                </li>
                <?php endif; ?>
              </ul>
              <ul class="navbar-nav d-md-block">
                <li class="nav-item">
                  <?php if (isset($_SESSION['user_data'])): ?>
                    <!-- Profile Dropdown -->
                    <div class="-dropdown d-block">
                        <a class="profile-container d-flex align-items-center justify-content-center dropdown-toggle" 
                          href="#" 
                          role="button" 
                          id="profileDropdown" 
                          data-bs-toggle="dropdown" 
                          aria-expanded="false">
                            <span class="profile-circle">
                                <?= strtoupper($_SESSION['user_data']['name'][0]); ?><?= strtoupper($_SESSION['user_data']['surname'][0]); ?>
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="./dashboard"><span class="fa fa-chart-pie"></span> Dashboard</a></li>
                            <li><a class="dropdown-item" href="profile.php"><span class="fa fa-user-pen"></span> Profile</a></li>
                            <li><a class="dropdown-item" href="settings.php"><span class="fa fa-cog"></span> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="./sign-out"><span class="fa fa-sign-out-alt"></span> Sign Out</a></li>
                        </ul>
                    </div>


                    <?php endif; ?>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    

  <!-- Dynamic content section -->
        <?php echo $content; ?>


  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
</body>

</html>
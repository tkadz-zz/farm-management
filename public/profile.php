
<?php
ob_start(); 
$title = "Profile";
?>
    <div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="position-relative">
              <span class="w-100 border-radius-lg shadow-sm"> <span style="font-size: 40px;" class="fa fa-user"></span> </span>
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?= htmlspecialchars($userProfile['name'] ?? 'Unknown') ?> <?= htmlspecialchars($userProfile['surname'] ?? 'Unknown') ?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                <?= htmlspecialchars($userProfile['email'] ?? 'Unknown') ?>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                    <i class="ni ni-app"></i>
                    <span class="ms-2">Reminders</span>
                  </a>
                </li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8 p-2">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Edit Profile</p>
              </div>
            </div>
            
            <form>
              <div class="card-body">
                <p class="text-uppercase text-sm">User Information</p>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">LoginID</label>
                      <input class="form-control" type="text" value="<?=  htmlspecialchars($userProfile['loginID'] ?? '') ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Surname</label>
                      <input class="form-control" type="text" value="<?=  htmlspecialchars($userProfile['surname'] ?? '') ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">First name</label>
                      <input class="form-control" type="text" value="<?= htmlspecialchars($userProfile['name'] ?? '') ?>">
                    </div>
                  </div>
                  
                </div>
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">Contact Information</p>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Email address</label>
                      <input class="form-control" type="email" value="<?= htmlspecialchars($userProfile['email'] ?? '') ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Phone</label>
                      <input class="form-control" type="text" value="<?= htmlspecialchars($userProfile['phone'] ?? '') ?>">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Address</label>
                      <input class="form-control" type="text" value="<?= htmlspecialchars($userProfile['address'] ?? '') ?>">
                    </div>
                  </div>
                </div>
                <div class="pt-2">
                  <button type="submit" class="btn btn-primary btn-sm">Update Profile</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-4 p-2">
          <div class="card card-profile pt-4">
            <div class="card-img-top pt-4"></div>
            <div class="row justify-content-center">
              <div class="col-4 col-lg-4 order-lg-2">
                <div class="text-center">
                  <a href="javascript:;">
                    <span class="rounded-circle img-fluid border border-2 border-white"><span style="font-size: 80px;" class="fa fa-lock"></span></span>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
              PASSWORD
            </div>
            <div class="card-body pt-0">
              
              <div class="mt-4">
                <form>
                  <div class="form-row row p-4">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Current Password</label>
                        <input name="current_password" class="form-control" type="password" placeholder="Enter Current Password">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="example-text-input" class="form-control-label">New Password</label>
                        <input name="new_password" class="form-control" type="password" placeholder="Enter New Password">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Confirm New Password</label>
                        <input name="confirm_password" class="form-control" type="password" placeholder="Confirm New Password">
                      </div>
                    </div>

                    <div class="pt-2 text-center">
                      <button type="submit" class="btn btn-primary btn-sm">Change Password</button>
                    </div>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php $content = ob_get_clean(); require __DIR__ . '/../components/layouts/layout-auth.php'; ?>

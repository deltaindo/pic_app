<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Delta | <?= $tittle; ?> </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url('assets/vendors/feather/feather.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/ti-icons/css/themify-icons.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/typicons/typicons.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/simple-line-icons/css/simple-line-icons.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css'); ?>">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('assets/css/vertical-layout-light/style.css'); ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url('assets/images/logo-delta.png'); ?>" />
</head>

<body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <!-- <img src="../../images/logo.svg" alt="logo" /> -->
                </div>
                <div class="text-center">
                  <h4>Sign Up</h4>
                  <h6 class="fw-light">Personal Information</h6>
                </div>
                <form class="pt-3" method="post" action="<?= base_url('auth/register'); ?>">
                <?= $this->session->flashdata('message'); ?>
                <div class="form-group">
                    <input
                      type="text"
                      class="form-control form-control-lg"
                      id="exampleInputEmail1"
                      placeholder="nama"
                      name="username"
                      value="<?= set_value('username') ?>"
                    />
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>  
                <div class="form-group">
                    <input
                      type="email"
                      class="form-control form-control-lg"
                      id="exampleInputEmail1"
                      placeholder="email"
                      name="email"
                     value="<?= set_value('email') ?>"
                    />
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control form-control-lg"
                      id="exampleInputPassword1"
                      placeholder="Password"
                      name="password"
                    />
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control form-control-lg"
                      id="exampleInputPassword1"
                      placeholder="Confirm Password"
                      name="password2"
                    />
                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control form-control-lg"
                      id="exampleInputPassword1"
                      placeholder="Telepon"
                      name="telepon"
                    />
                    <?= form_error('telepon', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="mt-3 text-center">
        
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Daftar</button>
                  </div>

                  <div class="mt-3"></div>
                  <div class="mt-4 fw-light text-center">
                    Back to Login
                    <a href="<?= base_url('auth'); ?>" class="text-primary">Clcik</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
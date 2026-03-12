<?php
    SESSION_START();
    require_once "../config/dbcon.php";
    include "../config/adminplugin.php";
?>

<section class="gradient-form">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card">
          <div class="row g-0">

            <!-- Left: Login Form -->
            <div class="col-lg-6">
              <div class="card-body">

                <div class="text-center mb-4">
                  <img src="../image/logo.png" style="width: 90px;" alt="HCC Logo">
                  <h4 class="mt-2 mb-4 pb-2" style="font-family: 'Georgia', serif;">HOLY CROSS COLLEGES INC.</h4>
                  <p class="dashboard-text">Login to Admin Dashboard</p>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                <div class="alert-danger">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="../config/login.php">
                  <div class="form-outline mb-3">
                    <label class="form-label" for="form2Example11">Username</label>
                    <input type="text" name="username" id="form2Example11" class="form-control" placeholder="Username" required />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example22">Password</label>
                    <input type="password" name="password" id="form2Example22" class="form-control" placeholder="Password" required />
                  </div>

                  <div class="text-center">
                    <button class="btn btn-primary btn-block mb-3" type="submit">
                      <i class="fas fa-sign-in-alt"></i> Log in
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <!-- Right: Welcome Message -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center gradient-custom-2">
            <div class="w-100 text-center">
                <h3>Welcome to Identification and Information<br>Management System</h3>
                <div class="logo-pair justify-content-center">
                <img src="../image/logo.png" alt="HCC Logo">
                <img src="../image/mmdlogo.png" alt="MMD Logo">
                </div>
                <p>MultiMedia Department</p>
            </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

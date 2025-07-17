<style>
  .loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
  }

  .loading-spinner {
    text-align: center;
  }

  .loading-spinner i {
    font-size: 24px;
    margin-bottom: 10px;
  }
</style>
<div id="loading" class="loading-overlay" style="display: none;">
  <div class="loading-spinner">
    <i class="fas fa-spinner fa-spin"></i>
    Loading...
  </div>
</div>
<div class="page page-center">
  <div class="container container-normal py-4">
    <div class="row align-items-center g-4">
      <div class="col-lg">
        <div class="container-tight">
          <div class="text-center mb-4">
            <a href="<?= base_url('') ?>" class="navbar-brand navbar-brand-autodark"><img src="<?= base_url('public/template/img/favicon/jmart-removebg-preview.png') ?>" height="36" alt=""></a>
          </div>
          <div class="card card-md">
            <form id="form-reset" class="card card-md" method="POST" autocomplete="off">
              <div class="card-body">
                <?php
                if ($this->session->flashdata('error') != '') {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                  echo $this->session->flashdata('error');
                  echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                  echo '</div>';
                }
                ?>

                <?php
                if ($this->session->flashdata('success_register') != '') {
                  echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                  echo $this->session->flashdata('success_register');
                  echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                  echo '</div>';
                }
                ?>
                <h2 class="card-title text-center mb-4">Forgot password</h2>
                <p class="text-secondary mb-4">Masukkan Email Anda, Kami akan mengirimkan link reset password ke Email Anda.</p>
                <div class="mb-3">
                  <label class="form-label">Email address</label>
                  <input name="email_member" required type="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-footer">
                  <button type="submit" href="#" class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                      <path d="M3 7l9 6l9 -6"></path>
                    </svg>
                    Kirimkan Saya Link Reset Password
                  </button>
                </div>
              </div>
            </form>
          </div>
          <div class="text-center text-secondary mt-3">
            Ingat Sekarang? <a href="<?= base_url('login') ?>" tabindex="-1">Silahkan Login</a>
          </div>
        </div>
      </div>
      <div class="col-lg d-none d-lg-block">
        <img src="<?= base_url() ?>public/template/img/illustrations/undraw_forgot_password_re_hxwm.svg" height="300" class="d-block mx-auto" alt="">
      </div>
    </div>
  </div>
</div>
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
                            <h2 class="h2 text-center mb-4">Login Akun</h2>
                            <form id="form-login-kasir" method="POST" autocomplete="off">
                                <div class="mb-3">
                                    <label class="form-label">Username atau Phone</label>
                                    <input autofocus required name="username" id="username" type="text" class="form-control" placeholder="Username / Phone" autocomplete="off">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">
                                        Password
                                        <span class="form-label-description">
                                            <a href="<?= base_url('forgotten') ?>">Saya Lupa Password</a>
                                        </span>
                                    </label>
                                    <div class="input-group input-group-flat">
                                        <input required name="password" id="password-field" type="password" class="form-control" placeholder="Your password" autocomplete="off">
                                        <span class="input-group-text" style="cursor: pointer;">
                                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" id="show-password-toggle">
                                                <!-- Icon SVG -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center text-secondary mt-3">
                        Belum Punya Akun? <a href="<?= base_url('register') ?>" tabindex="-1">Daftar</a>
                    </div>
                </div>
            </div>
            <div class="col-lg d-none d-lg-block">
                <img src="<?= base_url() ?>public/template/img/illustrations/undraw_secure_login_pdn4.svg" height="300" class="d-block mx-auto" alt="">
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('username').addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            e.preventDefault();

            // Pemeriksaan apakah input username sudah diisi sebelumnya
            var usernameInput = document.getElementById('username');
            if (usernameInput.value.trim() !== '') {
                // Jika sudah diisi, alihkan fokus ke input password
                document.getElementById('password-field').focus();
            } else {
                // Jika belum diisi, lanjutkan dengan tab seperti biasa
                usernameInput.focus();
            }
        }
    });
</script>
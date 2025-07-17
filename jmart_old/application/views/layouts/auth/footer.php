<script src="<?= base_url() ?>public/template/js/tabler.min.js?1692870487" defer></script>
<script src="<?= base_url() ?>public/template/js/demo.min.js?1692870487" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // navigator.serviceWorker.register("<?= base_url('') ?>public/service-worker.js")
</script>
<script>
  var formRegister = $('#form-register');
  var formReset = $('#form-reset');
  var formLogin = $('#form-login');
  var formLoginKasir = $('#form-login-kasir');

  formLogin.on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?php echo base_url('login/proses'); ?>",
      type: formLogin.attr('method'),
      data: formLogin.serialize(),
      dataType: 'json',
      beforeSend: function() {
        $('#loading').show();
      },
      success: function(response) {
        if (response.status == "success") {
          Swal.fire({
            title: 'Success!',
            text: response.message,
            type: 'success',
            customClass: {
              confirmButton: 'btn btn-success'
            },
            buttonsStyling: false
          }).then((result) => {
            if (result.isConfirmed) {
              // Pengalihan ke halaman login
              window.location.href = '<?= base_url('home') ?>'; // Ganti dengan URL halaman login Anda
            }
          });
        } else if (response.status == "error") {
          Swal.fire({
            title: 'Error!',
            text: response.message,
            type: 'error',
            customClass: {
              confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
          });
        } else {
          Swal.fire({
            title: 'Info!',
            text: response.message,
            type: 'info',
            customClass: {
              confirmButton: 'btn btn-info'
            },
            buttonsStyling: false
          });
        }
      },
      complete: function() {
        // Sembunyikan indikator loading di sini
        $("#loading").hide();
      }
    });
  });

  formLoginKasir.on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?php echo base_url('login/proses_kasir'); ?>",
      type: formLoginKasir.attr('method'),
      data: formLoginKasir.serialize(),
      dataType: 'json',
      beforeSend: function() {
        $('#loading').show();
      },
      success: function(response) {
        if (response.status == "success") {
          Swal.fire({
            title: 'Success!',
            text: response.message,
            type: 'success',
            customClass: {
              confirmButton: 'btn btn-success'
            },
            buttonsStyling: false
          }).then((result) => {
            if (result.isConfirmed) {
              // Pengalihan ke halaman login
              window.location.href = '<?= base_url('home') ?>'; // Ganti dengan URL halaman login Anda
            }
          });
        } else if (response.status == "error") {
          Swal.fire({
            title: 'Error!',
            text: response.message,
            type: 'error',
            customClass: {
              confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
          });
        } else {
          Swal.fire({
            title: 'Info!',
            text: response.message,
            type: 'info',
            customClass: {
              confirmButton: 'btn btn-info'
            },
            buttonsStyling: false
          });
        }
      },
      complete: function() {
        // Sembunyikan indikator loading di sini
        $("#loading").hide();
      }
    });
  });

  formRegister.on('submit', function(e) {
    e.preventDefault(); // Mencegah tindakan bawaan submit
    $.ajax({
      url: "<?php echo base_url('register/proses2'); ?>",
      type: formRegister.attr('method'),
      data: formRegister.serialize(),
      dataType: 'json',
      beforeSend: function() {
        $('#loading').show();
      },
      success: function(response) {
        if (response.status == "success") {
          Swal.fire({
            title: 'Success!',
            text: response.message,
            type: 'success',
            customClass: {
              confirmButton: 'btn btn-success'
            },
            buttonsStyling: false
          }).then((result) => {
            if (result.isConfirmed) {
              // Pengalihan ke halaman login
              window.location.href = '<?= base_url('verifikasi/') ?>' + response.access_key;
            }
          });
        } else if (response.status == "error") {
          Swal.fire({
            title: 'Error!',
            text: response.message,
            type: 'error',
            customClass: {
              confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
          });
        } else {
          Swal.fire({
            title: 'Info!',
            text: response.message,
            type: 'info',
            customClass: {
              confirmButton: 'btn btn-info'
            },
            buttonsStyling: false
          });
        }
      },
      complete: function() {
        // Sembunyikan indikator loading di sini
        $("#loading").hide();
      }
    });
  });

  formReset.on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?php echo base_url('forgotten/reset'); ?>",
      type: formReset.attr('method'),
      data: formReset.serialize(),
      dataType: 'json',
      beforeSend: function() {
        $('#loading').show();
      },
      success: function(response) {
        if (response.status == "success") {
          Swal.fire({
            title: 'Success!',
            text: response.message,
            type: 'success',
            customClass: {
              confirmButton: 'btn btn-success'
            },
            buttonsStyling: false
          }).then((result) => {
            if (result.isConfirmed) {
              // Pengalihan ke halaman login
              window.location.href = '<?= base_url('login') ?>'; // Ganti dengan URL halaman login Anda
            }
          });
        } else if (response.status == "error") {
          Swal.fire({
            title: 'Error!',
            text: response.message,
            type: 'error',
            customClass: {
              confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
          });
        } else {
          Swal.fire({
            title: 'Info!',
            text: response.message,
            type: 'info',
            customClass: {
              confirmButton: 'btn btn-info'
            },
            buttonsStyling: false
          });
        }
      },
      complete: function() {
        // Sembunyikan indikator loading di sini
        $("#loading").hide();
      }
    });
  });

  var passwordField = $('#password-field');
  var showPasswordToggle = $('#show-password-toggle');

  showPasswordToggle.click(function(e) {
    e.preventDefault();
    if (passwordField.attr('type') === 'password') {
      passwordField.attr('type', 'text'); // Tampilkan kata sandi
    } else {
      passwordField.attr('type', 'password'); // Sembunyikan kata sandi
    }
  });
</script>
</body>

</html>

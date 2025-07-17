<script src="<?= base_url('') ?>public/template/vendor/libs/jquery/jquery.js"></script>
<script src="<?= base_url('') ?>public/template/vendor/libs/popper/popper.js"></script>
<script src="<?= base_url('') ?>public/template/vendor/js/bootstrap.js"></script>
<script src="<?= base_url('') ?>public/template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?= base_url('') ?>public/template/vendor/js/menu.js"></script>
<script src="<?= base_url('') ?>public/template/js/main.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="<?= base_url('') ?>public/template/vendor/libs/sweetalert2/sweetalert2.js" />
<script>
        // navigator.serviceWorker.register("<?= base_url('') ?>public/service-worker.js")
</script>
<script>
$(document).ready(function() {
  var totalJumlah = 0;
  var currentURL = "<?= current_url() ?>";
  $('.add_keranjang').click(function() {
    // Mengambil data yang perlu ditambahkan ke database
    var idProduk = $(this).data('idproduk');
    var data = {
      idProduk: idProduk
    };

    $.ajax({
      url: '<?= base_url('keranjang/add') ?>', // Ganti dengan URL endpoint Anda
      type: 'POST', // Metode HTTP yang digunakan (POST, GET, dll.)
      data: data, // Data yang dikirim ke server
      success: function(response) {
        if (response.success == true) {
                Swal.fire({
                 title: 'Success!',
                 text: response.msg,
                 type: 'success',
                 customClass: {
                   confirmButton: 'btn btn-success'
                 },
                 buttonsStyling: false
                });
        }else{
                Swal.fire({
                 title: 'Error!',
                 text: response.msg,
                 type: 'error',
                 customClass: {
                   confirmButton: 'btn btn-danger'
                 },
                 buttonsStyling: false
                });
        }
      },
      error: function(request, status, error) {
        alert(request.responseText);
        },
    });
  });

  $('#btn-checkout').click(function() {
    var selectedProducts = [];

    $('input[name="id_produk[]"]:checked').each(function() {
      selectedProducts.push($(this).val());
    });

    // Jika tidak ada checkbox yang dicentang
    if (selectedProducts.length === 0) {
      alert("Silakan pilih minimal satu produk sebelum checkout.");
      return;
    }

    var url = "<?= base_url('keranjang/proses') ?>?selectedProducts=" + selectedProducts.join(',');
    window.location.href = url;
  });

  $('input[name="id_produk[]"]').click(function() {
    var selectedCount = $('input[name="id_produk[]"]:checked').length;
    var id = $(this).data('id');
    var idBrg = $(this).data('id_brg');
    var harga = $(this).data('harga');
    var jlh = $("#qty_barang"+id).val();

    if ($(this).is(':checked')) {
      totalJumlah = totalJumlah + (harga * jlh);
    } else {
      totalJumlah = totalJumlah - (harga * jlh);
    }
    $('#selected-count').text(selectedCount + " Produk");
    var formattedTotalJumlah = number_format(totalJumlah, 0, ',', '.');
    $('#selected-rp').text("Rp. " + formattedTotalJumlah);
  });

   // Fungsi untuk format angka dengan pemisah ribuan dan desimal
  function number_format(number, decimals, dec_point, thousands_sep) {
    number = parseFloat(number);
    if (isNaN(number)) return '';
    if (decimals !== undefined && decimals !== null) {
      number = number.toFixed(decimals);
    }
    number = number.toString().replace('.', dec_point);
    if (thousands_sep && !Number.isNaN(thousands_sep)) {
      var parts = number.split(dec_point);
      parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
      number = parts.join(dec_point);
    }
    return number;
  }

  $('#updateForm').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    // Get the form data
    var formData = $(this).serialize();

    // Perform the AJAX request
    $.ajax({
      type: 'POST',
      url: '<?= base_url("akun/update") ?>',
      data: formData,
      success: function(response) {
        if (response.status == "success") {
          Swal.fire({
            title: 'Berhasil!',
            text: response.message,
            type: 'success',
            customClass: {
              confirmButton: 'btn btn-success'
            },
            buttonsStyling: false
          }).then(function() {
            // Setelah pengguna mengklik tombol "OK," muat ulang halaman
            location.reload();
          });
        }else{
          Swal.fire({
            title: 'Failed!',
            text: response.message,
            type: 'error',
            customClass: {
              confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })
        }
      },
       error: function(request, status, error) {
        alert(request.responseText);
        },
    });
  });

  $('#changePW').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    // Get the form data
    var formData = $(this).serialize();

    // Perform the AJAX request
    $.ajax({
      type: 'POST',
      url: '<?= base_url("akun/ganti_password") ?>',
      data: formData,
      success: function(response) {
        if (response.status == "success") {
          Swal.fire({
            title: 'Berhasil!',
            text: response.message,
            type: 'success',
            customClass: {
              confirmButton: 'btn btn-success'
            },
            buttonsStyling: false
          })
          $('#ganti_password').modal('hide');
        }else{
          Swal.fire({
            title: 'Failed!',
            text: response.message,
            type: 'error',
            customClass: {
              confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })
        }
      },
       error: function(request, status, error) {
        alert(request.responseText);
        },
    });
  });
});

</script>
</body>
</html>

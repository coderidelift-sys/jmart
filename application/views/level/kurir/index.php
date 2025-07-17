<?php $this->load->view('layouts/kurir/head'); ?>
<style>
  ul.timeline {
    list-style-type: none;
    position: relative;
    padding-left: 40px;
  }

  ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 2;
  }

  ul.timeline>li {
    margin: 20px 20px 20px 20px;
    padding-left: 10px;
  }

  ul.timeline>li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 2;
  }

  .title {
    font-weight: 700;
    margin-bottom: 0;
    color: #2C406E;
  }
</style>
<?php $this->load->view('layouts/kurir/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
  <div class="container">
    <div class="nav-bar__left">
      <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Home</h1>
    </div>
  </div>
</nav>

<section class="mt-3 mb-4">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mt-2">
        <div class="card">
          <a href="#" id="scan-trigger">
            <img style="height: 100px !important;" src="<?= base_url('public/template/img/illustrations/undraw_house_searching_re_stk8.svg') ?>" class="card-img-top" alt="Ilustrasi 1">
            <div class="card-body text-center">
              <h5 class="card-title">Scan Paket</h5>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-6 mt-2">
        <div class="card">
          <a href="<?= base_url('misi/list') ?>">
            <img style="height: 100px !important;" src="<?= base_url('public/template/img/illustrations/undraw_checklist__re_2w7v.svg') ?>" class="card-img-top" alt="Ilustrasi 2">
            <div class="card-body text-center">
              <h5 class="card-title">Daftar Misi <span class="text-danger fw-bold">[<?= $misi ?> Aktif]</span></h5>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="d-flex my-3">
      <h3 class="title">My Dashboard 🔥</h3>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header" style="display: block;">
            <div class="fw-bold text-primary fs-2 d-block">Rp. <?= number_format($total_7days) ?></div>
            <br>
            <div style="margin-top:-10px">Didapatkan pada 7 Hari Terakhir</div>
          </div>
          <div class="card-body">
            <div id="chart"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-6 col-lg-6">
        <div class="card mt-2">
          <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
              <!-- Icon Font Awesome (sebelah kiri) -->
              <i class="fa fa-check fa-3x me-3 text-success"></i>

              <!-- Konten (sebelah kanan) -->
              <div>
                <h5 class="card-title">Order Sukses</h5>
                <p style="margin-top:-10px" class="card-text fw-bold fs-3"><?= $success ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6 col-lg-6">
        <div class="card mt-2">
          <div class="card-body bg-primary text-white">
            <div class="d-flex justify-content-start align-items-center">
              <!-- Icon Font Awesome (sebelah kiri) -->
              <i class="fa fa-clock-o fa-3x me-3"></i>

              <!-- Konten (sebelah kanan) -->
              <div>
                <h5 class="card-title">Order Baru</h5>
                <p style="margin-top:-10px" class="card-text fw-bold fs-3"><?= $pending ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6 col-lg-6">
        <div class="card mt-2">
          <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
              <!-- Icon Font Awesome (sebelah kiri) -->
              <i class="fa fa-dot-circle-o fa-3x me-3 text-info"></i>

              <!-- Konten (sebelah kanan) -->
              <div>
                <h5 class="card-title">Dalam Misi</h5>
                <p style="margin-top:-10px" class="card-text fw-bold fs-3"><?= $misi ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6 col-lg-6">
        <div class="card mt-2">
          <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
              <!-- Icon Font Awesome (sebelah kiri) -->
              <i class="fa fa-briefcase fa-3x me-3 text-warning"></i>

              <!-- Konten (sebelah kanan) -->
              <div>
                <h5 class="card-title">Setoran</h5>
                <p style="margin-top:-10px" class="card-text fw-bold fs-3">Rp. <?= isset($setoran['total_pembayaran']) ? number_format($setoran['total_pembayaran']) : '0'; ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Video Capture</h5>
        <button id="closeModalButton2" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-1">
        <video id="videoElement" style="width: 100%; height: 100%;" autoplay playsinline muted></video>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalButton">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <br><br><br><br>
</div>

<?php $this->load->view('layouts/kurir/menu'); ?>
<?php $this->load->view('layouts/kurir/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('public/template/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  var last7Dates = <?php echo $last_7_dates; ?>;
  var totalSumPerDate = <?php echo $json_total_sum_per_date; ?>;
  var totalSums = [];

  // Loop melalui totalSumPerDate dan memisahkan data ke dalam array
  for (var date in totalSumPerDate) {
    if (totalSumPerDate.hasOwnProperty(date)) {
      totalSums.push(totalSumPerDate[date]);
    }
  }
  var options = {
    series: [{
      name: "Desktops",
      data: totalSums
    }],
    chart: {
      height: 350,
      type: 'line',
      zoom: {
        enabled: false
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'straight'
    },
    title: {
      text: 'Total Setoran 7 Hari Terakhir',
      align: 'left'
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
      },
    },
    xaxis: {
      categories: last7Dates,
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
</script>
<script>
  let videoStream; // Untuk menyimpan referensi aliran video
  let codeReader; // Variabel untuk ZXing code reader

  document.getElementById('scan-trigger').addEventListener('click', function() {
    const isConfirmed = window.confirm('Apakah Anda yakin ingin menscan paket?');

    if (!isConfirmed) {
      // Tampilkan konfirmasi
      $('#videoModal').modal('hide');
    } else {
      $('#videoModal').modal('show');
      // Access the user's camera
      navigator.mediaDevices
        .getUserMedia({
          video: {
            facingMode: 'environment'
          }
        }) // Mengatur preferensi kamera belakang
        .then(function(stream) {
          const videoElement = document.getElementById('videoElement');
          videoElement.srcObject = stream;
          videoElement.play();
          videoStream = stream; // Simpan referensi aliran video

          // Inisialisasi ZXing code reader
          codeReader = new ZXing.BrowserQRCodeReader();
          codeReader
            .decodeFromVideoDevice(null, videoElement, (result, err) => {
              if (result) {
                // Tampilkan isi barcode dalam alert
                var serial = result.text;

                $.ajax({
                  url: "<?php echo base_url('misi/validasi'); ?>",
                  type: "POST",
                  data: {
                    id: serial
                  },
                  dataType: "json",
									beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                  success: function(response) {
                    if (response.success == true) {
                      Swal.fire({
                        title: 'Success!',
                        text: response.msg,
                        icon: 'success',
                        confirmButtonText: 'Close'
                      });
                    } else {
                      Swal.fire({
                        title: 'Error!',
                        text: response.msg,
                        icon: 'error',
                        confirmButtonText: 'Close'
                      });
                    }
                  }
                });

                // Menutup modal
                $('#videoModal').modal('hide');

                // Mematikan kamera
                if (videoStream) {
                  const tracks = videoStream.getTracks();
                  tracks.forEach(track => track.stop());
                  videoStream = null;
                }

                // Menghentikan pemindaian barcode
                codeReader.reset();
                codeReader.stopContinuousDecode();
              } else if (err && !(err instanceof ZXing.NotFoundException)) {
                console.error('Error:', err);
              }
            });
        })
        .catch(function(error) {
          console.error('Camera access error:', error);
        });
    }
  });

  // Tambahkan event listener untuk tombol "Close" pada modal
  document.getElementById('closeModalButton').addEventListener('click', handleCloseModal);
  document.getElementById('closeModalButton2').addEventListener('click', handleCloseModal);

  function handleCloseModal() {
    // Hentikan aliran video dan kamera jika kamera aktif
    if (videoStream) {
      const tracks = videoStream.getTracks();
      tracks.forEach(track => track.stop());
      videoStream = null;
    }
    // Hentikan pembacaan kode barcode
    if (codeReader) {
      codeReader.reset();
      codeReader.stopContinuousDecode();
    }

    // Tambahkan aksi tambahan jika diperlukan
  }
</script>
</body>

</html>

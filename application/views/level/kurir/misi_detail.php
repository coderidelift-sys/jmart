<?php $this->load->view('layouts/kurir/head'); ?>
<style>
    .navbar__left {
        width: 4rem;
        z-index: 2;
    }

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

    .test_btn {
        background-color: #606c76;
        border-color: #ffffff;
        color: #fff;
        outline: 0;
    }
</style>
<?php $this->load->view('layouts/kurir/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
    <div class="container">
        <div class="navbar__left">
            <a href="<?= base_url('misi/list') ?>">
                <svg class="navbar__left__icon fw-bold text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;z-index: 2;">
                    <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
                </svg>
            </a>
        </div>

        <div class="nav-bar__center">
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Selesaikan Misi</h1>
        </div>
    </div>
</nav>

<section class="mt-3 mb-4">
    <div class="container">
        <div class="row">
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        ID Pesanan <br>
                        <div class="fw-bold">#<?= $pesanan['id_pesanan'] ?></div>
                    </div>
                    <button type="button" id="btnBatalkan" class="btn btn-sm btn-danger" style="border-radius: 5px; padding-right: 10px !important">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                            <path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path>
                        </svg>
                        Batalkan
                    </button>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header fw-bold">
                    Alamat Pengiriman
                </div>
                <div class="card-body pt-0">
                    <table style="border-collapse: collapse;" class="border-0 mt-3">
                        <tbody>
                            <tr>
                                <td width="80"><strong>Kontak</strong></td>
                                <td width="15">:</td>
                                <td class="fs-4">FFJKHKJ</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>:</td>
                                <td class="fs-4">usedfdfdfdksjdbksdr1@gmail.com</td>
                            </tr>
                            <tr>
                                <td><strong>Kontak</strong></td>
                                <td>:</td>
                                <td class="fs-4">05555555555</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td class="fs-4">
                                    Kelurahan Adiarsa Barat, Kecamatan Karawang Barat, Kabupaten Karawang, Jawa Barat, ID | 0 </td>
                            </tr>
                        </tbody>
                    </table>

                    <span class="badge bg-primary text-white p-2 text-left mt-3">
                        Pengirim : Kurir A
                    </span>
                    <span class="badge bg-success text-white p-2 text-left mt-3">
                        <i class="fa fa-phone"></i> Whatsapp
                    </span>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header fw-bold">
                    Riwayat Pengiriman
                </div>
                <div class="card-body p-0">
                    <ul class="timeline">
                        <?php foreach ($riwayat as $key => $value) : ?>
                            <li>
                                <a target="_blank" href="https://www.totoprayogo.com/#"><?= $value['status_tracking'] ?></a>
                                <a href="#" class="float-end mr-3"><?= date('d/M/Y H:i:s', strtotime($value['updated_at'])) ?></a>
                                <p><?= $value['nama_member'] ?> [<?= $value['level'] ?>]</p>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header fw-bold">
                    Bukti Pengiriman
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <a class="btn bg-purple text-white test_btn" id="start">On</a>
                        <a class="btn bg-purple text-white test_btn" id="reset">Off</a>
                        <a class="btn bg-primary text-white test_btn" id="capture">Capture</a>
                        <a class="btn bg-danger text-white test_btn" id="removeCapture">Hapus</a>
                    </div>
                    <div>
                        <video id="video" width="100%" height="auto" style="border: 1px solid gray" autoplay playsinline muted></video>
                        <img id="capturedImage" style="display: none;" src="" alt="Captured Image">
                    </div>
                </div>
            </div>
            <button id="selesaikanPesanan" class="btn btn-success btn-block w-100 mt-1">Selesaikan Pesanan</button>
        </div>
    </div>
</section>

<div class="row">
    <br><br><br><br>
</div>
<?php $this->load->view('layouts/kurir/menu'); ?>
<?php $this->load->view('layouts/kurir/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const video = document.getElementById('video');
    const startButton = document.getElementById('start');
    const resetButton = document.getElementById('reset');
    let stream; // Untuk menyimpan referensi aliran media (kamera)
    let cameraActive = false; // Variabel status kamera
    const captureButton = document.getElementById('capture');
    const capturedImage = document.getElementById('capturedImage');
    const removeButton = document.getElementById('removeCapture');

    // Fungsi untuk mengakses kamera
    function accessCamera() {
        navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: 'environment'
                }
            })
            .then(function(mediaStream) {
                video.srcObject = mediaStream;
                stream = mediaStream;
                cameraActive = true;

                // Mengubah ukuran elemen video saat kamera aktif menjadi 100%
                video.style.width = '100%';
                video.style.height = 'auto'; // Menjaga aspek rasio
            })
            .catch(function(error) {
                console.error('Kamera tidak dapat diakses:', error);
            });
    }

    function captureImage() {
        if (stream) {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Tampilkan gambar yang diambil pada elemen <img>
            capturedImage.src = canvas.toDataURL('image/jpeg');
            capturedImage.style.display = 'block';
        }
    }

    // Fungsi untuk mematikan kamera
    function turnOffCamera() {
        if (stream) {
            const tracks = stream.getTracks();
            tracks.forEach(track => track.stop());
            video.srcObject = null;
            cameraActive = false;
        }
    }

    function removeCapture() {
        capturedImage.src = ''; // Hapus gambar dari elemen <img>
        capturedImage.style.display = 'none'; // Sembunyikan elemen <img>
    }

    // Tangani klik tombol "Start"
    startButton.addEventListener('click', function() {
        if (!cameraActive) {
            accessCamera(); // Mengakses kamera jika belum aktif
        }
    });

    // Tangani klik tombol "Reset"
    resetButton.addEventListener('click', function() {
        if (cameraActive) {
            turnOffCamera();
        }
    });

    captureButton.addEventListener('click', function() {
        captureImage(); // Ambil dan tampilkan gambar dari kamera
    });

    // Tangani klik tombol "Hapus"
    removeButton.addEventListener('click', function() {
        removeCapture(); // Hapus gambar dari elemen <img>
    });
</script>
<script>
    $(document).ready(function() {
        $("#selesaikanPesanan").click(function() {
            // Ambil data pesanan yang akan diselesaikan (misalnya, ID pesanan)
            var orderId = <?= $pesanan['id_pesanan'] ?>;
            var imageData = capturedImage.src;

            var formData = new FormData();
            formData.append("userfile", imageData);
            formData.append("order_id", orderId);

            $.ajax({
                url: "<?= base_url('misi/finishing') ?>", // Gantilah URL dengan URL ke controller Anda
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
				beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                success: function(response) {
                    if (response.status == true) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.msg,
                            icon: 'success',
                            confirmButtonText: 'Close'
                        }).then((result) => {
                            // Cek jika pengguna menekan tombol "Tutup"
                            if (result.isConfirmed) {
                                // Muat ulang halaman saat tombol "Tutup" ditekan
                                window.location.href = '<?= base_url('home') ?>';
                            }
                        });;
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        }).then((result) => {
                            // Cek jika pengguna menekan tombol "Tutup"
                            if (result.isConfirmed) {
                                // Muat ulang halaman saat tombol "Tutup" ditekan
                                window.location.href = '<?= base_url('home') ?>';
                            }
                        });
                    }
                },
                error: function() {
                    // Penanganan kesalahan
                    alert("Terjadi kesalahan dalam pengunggahan gambar.");
                }
            });
        });

        $("#btnBatalkan").click(function() {
            // Menampilkan kotak dialog konfirmasi
            var confirmation = confirm("Apakah Anda yakin ingin membatalkan?");
            var orderId = <?= $pesanan['id_pesanan'] ?>;

            // Jika pengguna menekan "OK" (Yes), lanjutkan dengan pembaruan database
            if (confirmation) {
                // Mengirim permintaan AJAX
                $.ajax({
                    url: "<?= base_url('misi/canceled') ?>", // Ganti dengan URL sesuai kebutuhan Anda
                    type: "POST",
                    data: {
                        id: orderId
                    },
					beforeSend: function () {
    if (typeof showLoading === 'function') showLoading();
},
complete: function () {
    if (typeof hideLoading === 'function') hideLoading();
},

                    success: function(response) {
                        window.location.href = '<?= base_url('misi/list') ?>';
                    },
                    error: function() {
                        alert("Terjadi kesalahan. Data tidak dapat dibatalkan.");
                    }
                });
            }
        });
    });
</script>
</body>

</html>

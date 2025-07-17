<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css" integrity="sha512-FEQLazq9ecqLN5T6wWq26hCZf7kPqUbFC9vsHNbXMJtSZZWAcbJspT+/NEAQkBfFReZ8r9QlA9JHaAuo28MTJA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('fe22024f3d888f7e4ae0', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            var dataPesanan = data.pesanan;
            $.ajax({
                url: '<?= base_url('home/count_pending') ?>', // Sesuaikan dengan URL Controller Anda
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Ganti isi modal body dengan konten yang diberikan
                    var detailPesananHTML = '';
                    dataPesanan.forEach(function(pesanan) {
                        // Membuat elemen HTML untuk setiap pesanan
                        detailPesananHTML += `
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold">${pesanan.nama_barang} (Qty:${pesanan.jumlah_jual})</span>
                                <span class="text-muted">${pesanan.harga_saat_ini}</span>
                            </div>
                        `;
                    });

                    $('#exampleModal .modal-body').html(`
                        <div class="modal-body" style="background-color: #fff; border-color: #fff;">
                            <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal" style="color: #000; cursor: pointer;"></i></div>
                            <div class="px-4 py-2">
                                <h5 class="text-uppercase">
                                    <span class="fs-6 text-danger">${response.pendingOrders} Pesanan Pending</span> <br>
                                    ${data.user.nama_member}
                                </h5>
                                <h4 class="mt-5 theme-color mb-5">Terimakasih atas orderan Anda</h4>

                                <span class="theme-color">Payment Summary</span>
                                <div class="mb-3">
                                    <hr class="new1" style="border-top: 2px dashed #fff; margin: 0.4rem 0;">
                                </div>

                                ${detailPesananHTML}
                                <div class="d-flex justify-content-between mt-3">
                                    <span class="font-weight-bold">Subtotal</span>
                                    <span style="color: #004cb9;" class="font-weight-bold theme-color">${data.user.grand_total - data.user.ongkos_kirim}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <span class="font-weight-bold">Ongkos Kirim</span>
                                    <span style="color: #004cb9;" class="font-weight-bold theme-color">${data.user.ongkos_kirim}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <span class="font-weight-bold">Total</span>
                                    <span style="color: #004cb9;" class="font-weight-bold theme-color">${data.user.grand_total}</span>
                                </div>
                                <div class="text-center mt-5">
                                    <button data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                    <button onclick="location.href='<?= base_url('penjualan') ?>'" class="btn btn-primary">Proses Pesanan</button>
                                </div>
                            </div>
                        </div>
                    `);

                    // Tampilkan modal
                    $('#exampleModal').modal('show');

                },
                error: function(error) {
                    console.error('Gagal mengambil data jumlah pending.');
                }
            });
        });
    </script>
</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Show Modal</button>

    <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="background-color: #fff;border-color: #fff;"></div>
            </div>
        </div>
    </div>
</body>

</html>
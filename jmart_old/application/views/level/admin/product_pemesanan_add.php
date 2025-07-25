<?php $this->load->view('layouts/admin/head'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<style>
   .card .card-body p.introtext {
      margin: -20px -20px 20px;
      padding: 10px;
      border-bottom: 1px solid #dbdee0;
      color: #8a6d3b;
      background-color: #fcf8e3;
      border-color: #faebcc;
   }

   .page-link {
      position: relative;
      display: block;
      color: #626976;
      background-color: transparent;
      border: 0 solid #cbd5e1;
      transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
   }

   .bg-secondary {
      color: #ffffff !important;
      background: #626976 !important;
   }

   .dataTables_wrapper .row:first-child {
      padding-top: 12px;
      padding-bottom: 12px;
      background-color: #EFF3F8;
   }

   .dataTables_wrapper .row:last-child {
      border-bottom: 1px solid #e0e0e0;
      padding-top: 12px;
      padding-bottom: 12px;
      background-color: #EFF3F8;
   }

   .dataTables_wrapper .row {
      margin: 0 !important;
   }

   div.dataTables_wrapper div.dataTables_length label {
      font-weight: normal;
      text-align: left;
      white-space: nowrap;
   }

   div.dataTables_wrapper div.dataTables_filter input {
      margin-left: 0.5em;
      display: inline-block;
      width: auto;
   }

   .form-control-sm {
      width: 125px;
      height: 25px;
      line-height: 25px;
      -webkit-box-sizing: content-box;
      -moz-box-sizing: content-box;
      box-sizing: content-box;
      padding-right: 40px;
   }

   .form-select-sm {
      width: 125px;
      height: 25px;
      line-height: 25px;
      -webkit-box-sizing: content-box;
      -moz-box-sizing: content-box;
      box-sizing: content-box;
      padding-right: 40px;
   }

   .table-header {
      background-color: #307ECC;
      color: #FFF;
      font-size: 14px;
      line-height: 50px;
      padding-left: 12px;
      margin-bottom: 1px;
   }

   div.dataTables_wrapper div.dataTables_filter input {
      margin-bottom: 0 !important;
      margin: 0 8px;
   }

   div.dataTables_wrapper div.dataTables_length label {
      margin-bottom: 0 !important;
      margin: 0 8px;
   }

   div.dataTables_wrapper div.dataTables_info {
      margin-bottom: 0 !important;
      margin: 0 8px;
   }

   div.dataTables_wrapper div.dataTables_paginate {
      margin-bottom: 0 !important;
      margin: 0 8px;
   }

   .active>.page-link,
   .page-link.active {
      z-index: 3;
      color: #fff;
      background-color: #337ab7;
      border-color: #337ab7;
      cursor: pointer;
   }

   .table>tbody>tr:hover {
      background-color: #F5F5F5;
   }

   .card .table {
      box-shadow: none !important;
   }

   .card-body+.card-body {
      border-top: none !important;
   }

   #barang.choices-select {
      width: 100% !important;
   }

   .choices {
      width: 60%;
      background-color: white;
      border-radius: 0px
   }
</style>
<?php $this->load->view('layouts/admin/header'); ?>
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <h2 class="page-title">
               Buat Pemesanan Produk Baru
            </h2>
         </div>
         <div class="col-auto float-end">
            <div class="btn-group">
               <a href="<?= base_url('product/pemesanan') ?>" class="btn btn-secondary me-1" title="Kelola Tagihan">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                     <path d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z"></path>
                  </svg>
                  &nbsp;&nbsp;Kembali
               </a>
               <a href="#" id="tombolSimpan" class="btn btn-primary me-1" title="Kelola Tagihan">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                     <path d="M5 21h14a2 2 0 0 0 2-2V8l-5-5H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zM7 5h4v2h2V5h2v4H7V5zm0 8h10v6H7v-6z"></path>
                  </svg>
                  &nbsp;&nbsp;Simpan
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="page-body">
   <div class="container-xl">
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header bg-light">
                  <h3 class="card-title">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                        <path d="M5 7h2v10H5zm9 0h1v10h-1zm-4 0h3v10h-3zM8 7h1v10H8zm8 0h3v10h-3z"></path>
                        <path d="M4 5h4V3H4c-1.103 0-2 .897-2 2v4h2V5zm0 16h4v-2H4v-4H2v4c0 1.103.897 2 2 2zM20 3h-4v2h4v4h2V5c0-1.103-.897-2-2-2zm0 16h-4v2h4c1.103 0 2-.897 2-2v-4h-2v4z"></path>
                     </svg>
                     Pemesanan Produk
                  </h3>
               </div>
               <div class="card-body" style="padding-bottom:0px">
                  <p class="introtext">Please select these before adding any product.</p>
                  <div class="row g-3">
                     <div class="col-md-6">
                        <div class="mb-3 row">
                           <label class="col-4 col-form-label required">Nama Transaksi</label>
                           <div class="col-7">
                              <input name="nama_transaksi" type="text" class="form-control" placeholder="Nama Transaksi" id="nama_transaksi">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mb-3 row">
                           <label class="col-4 col-form-label required">Tanggal Pesan</label>
                           <div class="col-7">
                              <input id="tgl_pesan" type="datetime-local" class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row g-3">
                     <div class="col-md-6">
                        <div class="mb-3 row">
                           <label class="col-4 col-form-label required">Pesan Dari</label>
                           <div class="col-7">
                              <select class="form-select" id="select_supplier">
                                 <option value="">Pilih Supplier</option>
                                 <?php foreach ($supplier as $key => $sup) : ?>
                                    <option value="<?= $sup['id_supplier'] ?>"><?= $sup['nama_supplier'] ?></option>
                                 <?php endforeach ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mb-3 row">
                           <label class="col-4 col-form-label required text-nowrap">Tanggal Kirim</label>
                           <div class="col-7">
                              <input id="tgl_kirim" type="datetime-local" class="form-control">
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr style="padding-top: 0px;padding-bottom: 0px;margin-top:0px;margin-bottom:0px">
                  <div class="row pt-0">
                     <div class="col-12">
                        <div class="card border-0">
                           <div class="card-body pb-0 pl-0 pr-0">
                              <form id="ValidasiForm" type="POST" autocomplete="off" style="margin-bottom: 0.5rem !important;">
                                 <div class="row">
                                    <div class="col-md-8">
                                       <div class="d-flex">
                                          <select required name="barang" id="barang" class="form-control">
                                             <option value="" selected disabled>Scan / Input Barcode Disini</option>
                                          </select>
                                          <button type="submit" style="height: 45px; border-radius: 0px;display:none" class="btn btn-success">
                                             <i class="fas fa-plus text-white"></i>&nbsp;&nbsp;<span class="text-white font-weight-bold">Submit</span>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
									<p class="introtext">Tekan ENTER untuk menyimpan perkiraan harga/jumlah</p>
                           <div class="card-body pt-0" style="border-top: none !important;">
                              <div class="table-responsive" style="width: 100%">
                                 <table id="example2" class="table table-condensed table-hover nowrap" style="width:100% !important">
                                    <thead>
                                       <tr>
                                          <th width="7"> No </th>
                                          <th class="text-center"> # </th>
                                          <th> Product </th>
                                          <th> Stock </th>
                                          <th> Prakiraan Harga </th>
                                          <th> Jumlah </th>
                                          <th> Subtotal </th>
                                          <th onclick="hapusAllTemp()" class="text-center"> <i class="fa fa-trash text-danger" style="opacity:0.5; filter:alpha(opacity=50);cursor:pointer"></i> </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <td colspan="6" style="text-align:right !important;vertical-align: middle;"><strong>Total Biaya Pembelian</strong></td>
                                          <td style="text-align:left !important;vertical-align: middle;" colspan="2">
                                             <span id="total_harga"></span>
                                          </td>
                                       </tr>
                                    </tfoot>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         <div class="modal-status bg-success"></div>
         <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: rgba(0, 128, 0, 1);">
               <path d="M12 4C9.243 4 7 6.243 7 9h2c0-1.654 1.346-3 3-3s3 1.346 3 3c0 1.069-.454 1.465-1.481 2.255-.382.294-.813.626-1.226 1.038C10.981 13.604 10.995 14.897 11 15v2h2v-2.009c0-.024.023-.601.707-1.284.32-.32.682-.598 1.031-.867C15.798 12.024 17 11.1 17 9c0-2.757-2.243-5-5-5zm-1 14h2v2h-2z">
               </path>
            </svg>
            <h3>Konfirmasi Pemesanan??</h3>
            <div class="text-secondary">Apakah Anda yakin ingin menyimpan data ini?</div>
         </div>
         <div class="modal-footer">
            <div class="w-100">
               <div class="row">
                  <div class="col">
                     <a href="javascript::void" class="btn w-100" data-bs-dismiss="modal">
                        Batalkan
                     </a>
                  </div>
                  <div class="col">
                     <a href="javascript::void" id="btnKonfirmasiOK" class="btn btn-success w-100" data-bs-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" id="btn-delete-svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <circle cx="12" cy="12" r="9"></circle>
                           <path d="M9 12l2 2l4 -4"></path>
                        </svg>
                        Konfirmasi
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php $this->load->view('layouts/admin/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
   $(document).ready(function() {
      $('#example2').DataTable({
         "processing": true, // Menampilkan pesan "Processing..." selama data sedang dimuat.
         "serverSide": true, // Aktifkan mode server-side.
         ordering: false,
         "ajax": {
            "url": "<?= base_url('product/json_temp') ?>",
            "type": "POST",
            error: function(xhr, ajaxOptions, thrownError) {
               alert(xhr.status);
            },
         },
         "columns": [
            // Gantilah 'data' dengan nama atribut yang sesuai dari respons JSON Anda.
            {
               "data": null,
               "className": "text-center align-middle",
               "render": renderNumbering
            },
            {
               "data": "1",
               "className": "text-left align-middle"
            },
            {
               "data": "2",
               "className": "text-left align-middle"
            },
            {
               "data": "3",
               "className": "text-end align-middle fw-bold"
            },
            {
               "data": "4",
               render: function(data, type, row) {
                  // Buat elemen input dengan kelas "form-control text-end" dan tambahkan "disabled" sebagai atribut
                  var inputElement = $('<input>', {
                     'style': 'width:100% !important; border-radius:0px !important;',
                     'type': 'text',
                     'class': 'form-control text-end custom_input',
                     'value': data,
                     'min': '1',
                     'data-jumlah': data,
                     'autocomplete': 'off' // Tambahkan atribut autocomplete dengan nilai "off"
                  });

                  return inputElement[0].outerHTML;
               },
               "className": "text-center align-middle"
            },
            {
               "data": "5",
               "className": "text-end align-middle",
               render: function(data, type, row) {
                  return '<input style="width:100% !important; border-radius:0px !important" type="text" class="form-control text-end input_1" value="' + data + '" min="1" data-jumlah="' + data + '">';
               },
            },
            {
               "data": "6",
               "className": "text-center align-middle"
            },
            {
               "data": "7",
               "className": "text-center align-middle",
            },
            // Tambahkan kolom lain sesuai kebutuhan.
         ],
         "drawCallback": function(settings) {
            $.ajax({
               url: "<?php echo base_url('product/hitungTotal'); ?>",
               dataType: "json",
               success: function(data) {
                  var total = data.total;

                  $('#total_harga').text("Rp. " + total);
               },
               error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status);
               }
            });
         },
         "createdRow": function(row, data, dataIndex) {
            // alert(data);
            // Temukan elemen input dengan kelas "input_1" dalam baris
            var inputElement = $(row).find('.input_1');
            var customInputElement = $(row).find('.custom_input');

            customInputElement.on('keypress', function(event) {
               if (event.which === 13) {
                  var idPemesananan = data[0];
                  var harga_beli = customInputElement.val();

                  $.ajax({
                     type: 'POST',
                     url: '<?php echo base_url('product/update_temp2'); ?>',
                     data: {
                        id_pemesanan: idPemesananan,
                        harga_beli: harga_beli
                     },
                     dataType: 'json',
                     success: function(response) {
                        if (response.status === 'success') {
                           toastr.success(response.message, '', {
                              timeOut: 5000
                           });
                           $('#example2').DataTable().ajax.reload();
                        } else {
                           toastr.error(response.message, '', {
                              timeOut: 5000
                           });
                        }
                     },
                     error: function() {
                        alert('Terjadi kesalahan dalam permintaan AJAX');
                     }
                  });
               }
            });

            // Tambahkan event listener untuk menangkap tombol "Enter" pada input
            inputElement.on('keypress', function(event) {
               if (event.which === 13) {
                  var nilaiInput = inputElement.val();
                  var newData = {
                     id: data[0],
                     jumlah: nilaiInput
                  };
                  $.ajax({
                     type: 'POST',
                     url: '<?php echo base_url('product/update_temp'); ?>',
                     data: newData,
                     dataType: 'json',
                     success: function(response) {
                        if (response.status === 'success') {
                           toastr.success(response.message, '', {
                              timeOut: 5000
                           });
                           $('#example2').DataTable().ajax.reload();
                        } else {
                           toastr.error(response.message, '', {
                              timeOut: 5000
                           });
                        }
                     },
                     error: function() {
                        // Tampilkan pesan kesalahan jika terjadi kesalahan dalam permintaan AJAX
                        alert('Terjadi kesalahan dalam permintaan AJAX');
                     }
                  });
               }
            });
         },
      });

      $('#select_supplier').select2({
         theme: 'bootstrap-5'
      });
      $('#select_pembayaran').select2();
      $('#select_status').select2();

      const barangSelect = new Choices('#barang', {
         searchEnabled: true, // Aktifkan fitur pencarian
         searchPlaceholderValue: 'Minimum 3 Character...',
         allowHTML: true,
         callbackOnCreateTemplates: function(template) {
            return {
               item: function(classNames, data) {
                  return template(`
                    <div class="${classNames.item}" data-value="${data.value}" data-id="${data.id}">
                        ${data.label}
                    </div>
                `);
               },
            };
         },
      });


      // Temukan elemen input pencarian di dalam kotak pencarian Choices.js
      // const searchInput = document.querySelector('.choices__input--cloned');
      const searchInput = document.querySelector('.choices__input--cloned[placeholder="Minimum 3 Character..."]');

      // Tambahkan event listener untuk memantau perubahan nilai pada input pencarian
      searchInput.addEventListener('input', function(event) {
         // Ambil nilai yang dimasukkan oleh pengguna
         const inputValue = this.value;
         if (inputValue.length >= 3) {
            $.ajax({
               url: '<?php echo base_url('product/get_barang'); ?>',
               method: 'POST',
               data: {
                  q: inputValue
               },
               dataType: 'json',
               success: function(data) {
                  barangSelect.clearStore();
                  // Membuat array kosong untuk menyimpan opsi
                  var opsi = [];

                  // Melakukan iterasi pada data yang diterima dari AJAX
                  data.forEach(function(item) {
                     // Membuat objek opsi dengan nilai dan label dari data
                     var opsiItem = {
                        value: item.id_brg,
                        label: item.nama_barang
                     };

                     // Menambahkan objek opsi ke dalam array opsi
                     opsi.push(opsiItem);
                  });

                  barangSelect.setChoices(opsi, 'value', 'label');
               },
               error: function(error) {
                  console.error('Error:', error);
               }
            });
         } else {
            barangSelect.clearStore();
         }
      });
      let selectedValue = '';
      $('#barang').on('change', function(event) {
         barangSelect.clearStore();
         selectedValue = event.detail.value;

         setTimeout(function() {
            const choicesList = document.querySelector('#barang');
            if (choicesList) {
               choicesList.click();
            }
         }, 100);

         $('#ValidasiForm').submit();
      });

      $('#ValidasiForm').on('submit', function(event) {
         event.preventDefault();

         const nilaiBarang = selectedValue;

         if (nilaiBarang == "") {
            alert('Inputan tidak boleh kosong');
         } else {
            // Menggunakan AJAX untuk mengirim data ke server
            $.ajax({
               url: '<?= base_url('product/input_temp') ?>', // Ganti dengan URL yang sesuai
               method: 'POST',
               dataType: 'json',
               data: {
                  id: nilaiBarang
               },
               success: function(response) {
                  if (response.success == true) {
                     toastr.success(response.msg, '', {
                        timeOut: 5000
                     });
                     $('#example2').DataTable().ajax.reload();
                  } else {
                     toastr.error(response.msg, '', {
                        timeOut: 5000
                     });
                  }
               },
               error: function() {
                  alert('Terjadi kesalahan dalam mengirim data.');
               }
            });
         }
      });

      var linkElement = $('#tombolSimpan');
      linkElement.on('click', function(event) {
         event.preventDefault(); // Mencegah perilaku default dari tautan

         var nama = $("#nama_transaksi").val();
         var supplier = $("#select_supplier").val();
         var tgl_pesan = $("#tgl_pesan").val();
         var tgl_kirim = $("#tgl_kirim").val();

         if (supplier !== "" && tgl_pesan !== "") {
            // Menampilkan konfirmasi dalam modal Bootstrap
            $('#modalKonfirmasi').modal('show');

            // Menangani klik tombol "OK" dalam konfirmasi
            $('#btnKonfirmasiOK').on('click', function(event) {
               // Menutup modal konfirmasi
               $('#modalKonfirmasi').modal('hide');

               var data = {
                  nama: nama,
                  supplier: supplier,
                  tgl_pesan: tgl_pesan,
                  tgl_kirim: tgl_kirim,
               };

               $.ajax({
                  type: "POST", // Metode HTTP
                  url: "<?= base_url('product/simpan_pemesanan') ?>", // Ganti dengan URL Anda
                  data: data, // Data yang akan dikirimkan
                  success: function(response) {
                     if (response.success == true) {
                        toastr.success(response.msg, '', {
                           timeOut: 3000
                        });

                        setTimeout(function() {
                           window.location.href = "<?= base_url('product/pemesanan') ?>";
                        }, 2000);
                     } else {
                        toastr.error(response.msg, '', {
                           timeOut: 3000
                        });
                     }
                  },
                  error: function(error) {
                     toastr.error('Terjadi Kesalahan Saat Menyimpan Data', '', {
                        timeOut: 3000
                     });
                  }
               });
            });
         } else {
            if (supplier == "") {
               toastr.error('Data Supplier Tidak Boleh Kosong', '', {
                  timeOut: 3000
               });
            }

            if (tgl_pesan == "") {
               toastr.error('Tanggal Pesan Tidak Boleh Kosong', '', {
                  timeOut: 3000
               });
            }
         }
      });

   });
</script>
<script>
   function hapusData(idToDelete) {
      // Konfirmasi penghapusan
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
         // Menggunakan AJAX untuk menghapus data
         $.ajax({
            url: '<?php echo site_url('product/delete_temp'); ?>/' + idToDelete,
            type: 'GET',
            success: function(data) {
               $('#example2').DataTable().ajax.reload();
            },
            error: function() {
               alert('Gagal menghapus data.');
            }
         });
      }
   }

   function hapusAllTemp() {
      // Konfirmasi penghapusan
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
         // Menggunakan AJAX untuk menghapus data
         $.ajax({
            url: '<?php echo site_url('product/delete_all_temp'); ?>',
            type: 'GET',
            success: function(data) {
               $('#example2').DataTable().ajax.reload();
            },
            error: function() {
               alert('Gagal menghapus data.');
            }
         });
      }
   }

   function renderNumbering(data, type, row, meta) {
      // Ambil nomor urut dari indeks baris dan tambahkan 1
      var numbering = meta.row + 1;

      // Kembalikan nomor urut sebagai hasil render
      return numbering;
   }
</script>
</body>

</html>
<footer class="footer footer-transparent d-print-none">
   <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
         <div class="col-12 col-lg-auto mt-3 mt-lg-0">
            <ul class="list-inline list-inline-dots mb-0">
               <li class="list-inline-item">
                  Copyright &copy; <?= date('Y') ?>
                  <a href="javascript::void" class="link-secondary">Muhammad Rifki Kardawi</a>.
                  All rights reserved.
               </li>
               <li class="list-inline-item">
                  <a href="javascript::void" class="link-secondary" rel="noopener">
                     v1.0.0-beta20
                  </a>
               </li>
               <li class="list-inline-item">
                  Render Time: <?php echo $this->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end'); ?>
               </li>
            </ul>
         </div>
      </div>
   </div>
</footer>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            Apakah Anda yakin ingin logout?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <a href="<?= base_url('login/logout') ?>" class="btn btn-primary">Logout</a>
         </div>
      </div>
   </div>
</div>
</div>
</div>
<script src="<?= base_url('') ?>public/template/js/tabler.min.js?1692870487" defer></script>
<script src="<?= base_url('') ?>public/template/js/demo.min.js?1692870487" defer></script>
<script src="<?= base_url('') ?>public/template/libs/apexcharts/dist/apexcharts.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   document.getElementById('data-wilayah').addEventListener('click', function() {
      Swal.fire({
         icon: 'error',
         title: 'Oops...',
         text: 'Anda tidak memiliki akses untuk menu ini!',
      });
   });
</script>
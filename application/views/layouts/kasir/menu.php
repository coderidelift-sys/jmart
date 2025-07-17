<?php
$current_url = current_url();
?>

<header class="navbar-expand-md">
   <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar navbar-dark">
         <div class="container-xl">
            <ul class="navbar-nav">
               <li class="nav-item <?= ($this->uri->segment(1) == "home") ? 'active' : '';  ?>">
                  <a class="nav-link" href="<?= base_url('home') ?>">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                           <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                           <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Home
                     </span>
                  </a>
               </li>
               <li class="nav-item dropdown 
               <?= ($this->uri->segment(1) == "kategori") ? 'active' : '';  ?>
               <?= ($this->uri->segment(1) == "satuan") ? 'active' : '';  ?>
               <?= ($this->uri->segment(1) == "supplier") ? 'active' : '';  ?>
               ">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                           <path d="M12 12l8 -4.5" />
                           <path d="M12 12l0 9" />
                           <path d="M12 12l-8 -4.5" />
                           <path d="M16 5.25l-8 4.5" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Data Master
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item <?= ($this->uri->segment(1) == "kategori") ? 'active' : '';  ?>" href="<?= base_url('kategori') ?>">
                              Data Kategori
                           </a>
                           <a class="dropdown-item <?= ($this->uri->segment(1) == "satuan") ? 'active' : '';  ?>" href="<?= base_url('satuan') ?>">
                              Data Satuan
                           </a>
                           <a class="dropdown-item <?= ($this->uri->segment(1) == "supplier") ? 'active' : '';  ?>" href="<?= base_url('supplier') ?>">
                              Data Supplier
                           </a>
                           <a class="dropdown-item <?= ($this->uri->segment(1) == "staff") ? 'active' : '';  ?>" href="<?= base_url('staff') ?>">
                              Data Kasir
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="nav-item dropdown <?= ($this->uri->segment(1) == "product") ? 'active' : '';  ?>">
                  <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-details" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M13 5h8"></path>
                           <path d="M13 9h5"></path>
                           <path d="M13 15h8"></path>
                           <path d="M13 19h5"></path>
                           <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                           <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Product
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item 
                           <?= $current_url == base_url('product') ? "active" : "" ?>
                           <?= $current_url == base_url('product/tambah') ? "active" : "" ?>
                           <?= $current_url == base_url('product/edit/*') ? "active" : "" ?>
                           " href="<?= base_url('product') ?>">
                              Data Produk
                           </a>
                           <a class="dropdown-item <?= $current_url == base_url('product/import') ? "active" : "" ?>" href="<?= base_url('product/import') ?>">
                              Import Produk
                           </a>
                           <a class="dropdown-item 
                           <?= $current_url == base_url('product/pemesanan') ? "active" : "" ?>
                           <?= $current_url == base_url('product/pemesanan/add') ? "active" : "" ?>
                           " href="<?= base_url('product/pemesanan') ?>">
                              Pemesanan Produk
                           </a>
                           <a class="dropdown-item 
                           <?= $current_url == base_url('product/promosi') ? "active" : "" ?>
                           " href="<?= base_url('product/promosi') ?>">
                              Pengaturan Promosi
                           </a>
                           <a class="dropdown-item 
                           <?= $current_url == base_url('product/opname') ? "active" : "" ?>
                           <?= (($this->uri->segment(1) == "product") and  ($this->uri->segment(2) == "opname")) ? "active" : "";  ?>
                           " href="<?= base_url('product/opname') ?>">
                              Stock Opname
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="nav-item <?= $current_url == base_url('kasir') ? "active" : "" ?>">
                  <a class="nav-link" href="<?= base_url('kasir') ?>">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                           <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                           <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                           <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                           <path d="M5 12l14 0"></path>
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Kasir
                     </span>
                  </a>
               </li>
               <li class="nav-item <?= ($this->uri->segment(1) == "penjualan") ? 'active' : '';  ?>">
                  <a class="nav-link" href="<?= base_url('penjualan') ?>">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                           <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                           <path d="M17 17h-11v-14h-2"></path>
                           <path d="M6 5l14 1l-1 7h-13"></path>
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Penjualan
                     </span>
                  </a>
               </li>
               <li class="nav-item <?= ($this->uri->segment(1) == "anggota") ? 'active' : '';  ?>">
                  <a class=" nav-link" href="<?= base_url('anggota') ?>">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                           <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                           <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                           <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Anggota
                     </span>
                  </a>
               </li>
               <li class="nav-item dropdown <?= ($this->uri->segment(1) == "laporan") ? 'active' : '';  ?>">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                           <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                           <path d="M9 9l1 0"></path>
                           <path d="M9 13l6 0"></path>
                           <path d="M9 17l6 0"></path>
                        </svg></span>
                     <span class="nav-link-title">Laporan</span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropstart">
                        <a href="#" class="dropdown-item dropdown-toggle " data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">Pembelian</a>
                        <div class="dropdown-menu">
                           <a href="<?= base_url('laporan/pembelian_periode') ?>" class="dropdown-item">Pembelian By Periode</a>
                           <a href="<?= base_url('laporan/pembelian_supplier') ?>" class="dropdown-item ">Pembelian By Supplier</a>
                           <a href="<?= base_url('laporan/pembelian_barang') ?>" class="dropdown-item ">Pembelian By Barang</a>
                        </div>
                     </div>
                     <div class="dropstart">
                        <a href="#" class="dropdown-item dropdown-toggle " data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">Penjualan</a>
                        <div class="dropdown-menu">
                           <a href="<?= base_url('laporan/penjualan_periode') ?>" class="dropdown-item ">Penjualan By Periode</a>
                           <a href="<?= base_url('laporan/penjualan_pelanggan') ?>" class="dropdown-item ">Penjualan By Pelanggan</a>
                           <a href="<?= base_url('laporan/penjualan_barang') ?>" class="dropdown-item ">Penjualan By Barang</a>
                           <a href="<?= base_url('laporan/penjualan_kasir') ?>" class="dropdown-item ">Penjualan By Kasir</a>
                        </div>
                     </div>
                     <a href="<?= base_url('laporan/inventory') ?>" class="dropdown-item <?= (($this->uri->segment(1) == "laporan") and  ($this->uri->segment(2) == "inventory")) ? "active" : "";  ?>">Inventory</a>
                  </div>
               </li>
               <li class="nav-item dropdown <?= ($this->uri->segment(1) == "profile") ? 'active' : '';  ?><?= ($this->uri->segment(1) == "sandi") ? 'active' : '';  ?>">
                  <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-details" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M13 5h8"></path>
                           <path d="M13 9h5"></path>
                           <path d="M13 15h8"></path>
                           <path d="M13 19h5"></path>
                           <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                           <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Akun Saya
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item <?= ($this->uri->segment(1) == "profile") ? 'active' : '';  ?>" href="<?= base_url('profile') ?>">Detail Profile</a>
                           <a class="dropdown-item <?= ($this->uri->segment(1) == "sandi") ? 'active' : '';  ?>" href="<?= base_url('sandi') ?>">Kata Sandi</a>
                           <a class="dropdown-item" href="<?= base_url('login/logout') ?>">Logout</a>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
</header>
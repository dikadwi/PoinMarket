 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(to right,rgb(45, 27, 86),rgb(52, 20, 36));">
     <!-- Brand Logo -->
     <a href="/dashboard" class="brand-link">
         <img src="#" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Point Market</span>
     </a>
     <!-- Sidebar -->
     <div class="sidebar">
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="/img/admin.jpg" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block"><?= $username; ?></a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-5">

             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-header">MENU</li>
                 <!-- Menampilkan halaman yang ditambahkan ke sidemenu -->
                 <!-- <php foreach ($sidemenuPages as $page): ?>
                     <li class="nav-item">
                         <a href="<= $page['url']; ?>" class="nav-link">
                             <i class="nav-icon fas fa-file-alt"></i>
                             <p>
                                 <= $page['title']; ?>
                             </p>
                         </a>
                     </li>
                 <php endforeach; ?> -->
                 <?php foreach ($sideMenuPages as $page): ?>
                     <?php if ($page['status'] === 'active'): ?> <!-- Hanya tampilkan jika status active -->
                         <li class="nav-item">
                             <a class="nav-link" href="<?= esc($page['url']); ?>">
                                 <i class="nav-icon fas <?= esc($page['icon']); ?>"></i>
                                 <p> <?= esc($page['title']); ?></p>
                             </a>
                         </li>
                     <?php endif; ?>
                 <?php endforeach; ?>
                 <!--Menu  Admin-->
                 <?php if (in_groups(['superadmin', 'admin'])) : ?>
                     <li class="nav-item">
                         <a href="/User" class="nav-link">
                             <!-- <i class="nav-icon fas fa-users"></i> -->
                             <i class="nav-icon fas fa-user-cog"></i>
                             <p>
                                 Data User
                             </p>
                         </a>
                     </li>
                 <?php endif; ?>
                 <li class="nav-item">
                     <a href="/Mahasiswa" class="nav-link">
                         <i class="nav-icon fas fa-users"></i>
                         <p>
                             <!-- Mahasiswa -->
                             Data Mahasiswa
                         </p>
                     </a>
                 </li>
                 <!-- <php if (in_groups(['admin', 'validator'])) : ?> -->
                 <!-- <li class="nav-item">
                     <a href="/Jenis_Transaksi" class="nav-link">
                         <i class="nav-icon fas fa-edit"></i>
                         <p>
                             Data Item
                         </p>
                     </a>
                 </li> -->
                 <!-- <php endif; ?> -->
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-plus"></i>
                         <p> Data Add Point</p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none; padding-left: 20px;">
                         <li class="nav-item">
                             <a href="/Transaksi/reward" class="nav-link">
                                 <i class="nav-icon fas fa-gift"></i>
                                 <p>Data Reward</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="/Transaksi/misi_tambah" class="nav-link">
                                 <i class="nav-icon fas fa-bullseye"></i>
                                 <p>Data Misi</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-minus"></i>
                         <p> Data Deduct Point</p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none; padding-left: 20px;">
                         <li class="nav-item">
                             <a href="/Transaksi/pembelian" class="nav-link">
                                 <i class="nav-icon fas fa-shopping-cart"></i>
                                 <p>Data Pembelian</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="/Transaksi/punishment" class="nav-link">
                                 <i class="nav-icon fas fa-flag"></i>
                                 <p>Data Punishment</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="/Transaksi/konsultasi" class="nav-link">
                                 <i class="nav-icon fas fa-comments"></i>
                                 <p>Data Konsultasi</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <!-- <li class="nav-item">
                     <a href="/Transaksi/pembelian" class="nav-link">
                         <i class="nav-icon fas fa-shopping-cart"></i>
                         <p>
                             Data Pembelian
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/Transaksi/reward" class="nav-link">
                         <i class="nav-icon fas fa-gift"></i>
                         <p>
                             Data Reward
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/Transaksi/punishment" class="nav-link">
                         <i class="nav-icon fas fa-flag"></i>
                         <p>
                             Data Punishment
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/Transaksi/misi_tambah" class="nav-link">
                         <i class="nav-icon fas fa-bullseye"></i>
                         <p>
                             Data Misi
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/Transaksi/konsultasi" class="nav-link">
                         <i class="nav-icon fas fa-comments"></i>
                         <p>
                             Data Konsultasi
                         </p>
                     </a>
                 </li> -->
                 <li class="nav-item">
                     <a href="/Validasi" class="nav-link">
                         <i class="nav-icon fas fa-print"></i>
                         <p>
                            <!-- Admin : validasi Reward & Punishment (dari dosen) -->
                            <!-- Dosen : validasi Pembelian, Misi, Konsultasi (dari mahasiswa)-->
                             Validasi Pesanan
                         </p>
                     </a>
                 </li>
                 <?php if (in_groups(['superadmin', 'admin'])) : ?>
                     <!-- <li class="nav-item">
                         <a href="/Misi_tambah" class="nav-link">
                             <i class="nav-icon fas fa-file"></i>
                             <p>
                                 Item Misi
                             </p>
                         </a>
                     </li> -->
                     <!-- <li class="nav-item">
                         <a href="#/Konsultasi" class="nav-link">
                             <i class="nav-icon fas fa-edit"></i>
                             <p>
                                 Item Konsultasi
                             </p>
                         </a>
                     </li> -->                    
                     <li class="nav-item">
                         <a href="#/Validasi_item" class="nav-link">
                             <i class="nav-icon fas fa-print"></i>
                             <p>
                                <!-- Admin : Validasi item yang dicreate dosen -->
                                 Validasi Item
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="/Quis" class="nav-link">
                             <i class="nav-icon fas fa-edit"></i>
                             <p>
                                 Data Quis
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="/cms" class="nav-link">
                             <i class="nav-icon fas fa-chalkboard-teacher"></i>
                             <p>
                                 Content Management System
                             </p>
                         </a>
                     </li>
                 <?php endif ?>
                 <li class="nav-item">
                     <a href="/messages" class="nav-link">
                         <i class="nav-icon fas fa-envelope"></i>
                         <p>Pesan</p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
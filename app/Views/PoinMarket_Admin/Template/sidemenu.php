 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-6">
     <!-- Brand Logo -->
     <a href="/Admin/index" class="brand-link">
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
                 <a href="#" class="d-block">Admin</a>
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

                 <!--Menu  Admin-->
                 <?php if (in_groups('admin')) : ?>
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
                 <li class="nav-item">
                     <a href="/Transaksi" class="nav-link">
                         <!-- <i class="nav-icon fas fa-shopping-cart"></i> -->
                         <i class="nav-icon fas fa-money-check-alt"></i>
                         <p>
                             Data Transaksi
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/Misi_tambah" class="nav-link">
                         <i class="nav-icon fas fa-edit"></i>
                         <p>
                             Data Misi Tambahan
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/Validasi" class="nav-link">
                         <i class="nav-icon fas fa-print"></i>
                         <p>
                             Validasi
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
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-6">
     <!-- Brand Logo -->
     <a href="/Role_User" class="brand-link">
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

         <!-- Mengambil Session untuk melakukan filter isLoggedIn (Bisa diletakkan di Controller) -->
         <?php
            $session = session();
            $isLoggedIn = $session->get('isLoggedIn'); // Pastikan ini sesuai dengan data sesi Anda
            ?>
         <?php if ($isLoggedIn): ?>
             <!-- Sidebar Menu -->
             <nav class="mt-5">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                     <li class="nav-header">MENU</li>
                     <!--Menu  -->

                     <li class="nav-item">
                         <a href="/Role_User/my_pembelian" class="nav-link">
                             <i class="nav-icon fas fa-shopping-cart"></i>
                             <p>
                                 Data Pembelian
                                 <!-- Data Transaksi -->
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="/Role_User/my_reward" class="nav-link">
                             <i class="nav-icon fas fa-gift"></i>
                             <p>
                                 Data Reward
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="/Role_User/my_punishment" class="nav-link">
                             <i class="nav-icon fas fa-gavel"></i>
                             <p>
                                 Data Punishment
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="/Role_User/my_misi" class="nav-link">
                             <i class="nav-icon fas fa-bullseye"></i>
                             <p>
                                 Data Misi
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="/Role_User/my_konsultasi" class="nav-link">
                             <i class="nav-icon fas fa-comments"></i>
                             <p>
                                 Data Konsultasi
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="/Role_User/misi" class="nav-link">
                             <i class="nav-icon fas fa-rocket"></i>
                             <p>
                                 Misi Tambahan
                             </p>
                         </a>
                     </li>
                     <!-- <li class="nav-item">
                         <a href="#/Role_User/konsultasi" class="nav-link">
                             <i class="nav-icon fas fa-edit"></i>
                             <p>
                                 Konsultasi
                             </p>
                         </a>
                     </li> -->
                     <li class="nav-item">
                         <a href="/Role_User/quis" class="nav-link">
                             <i class="nav-icon fas fa-lightbulb"></i>
                             <p>
                                 Quis
                             </p>
                         </a>
                     </li>
                 </ul>
             </nav>
         <?php endif; ?>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
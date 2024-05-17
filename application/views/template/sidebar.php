<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#client" aria-expanded="false" aria-controls="client">
        <i class="menu-icon mdi mdi-account"></i>
        <span class="menu-title">Link Pendaftaran</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="client">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">

            <a class="nav-link" href="<?= base_url('dashboard'); ?>">Tambah Link</a>
          </li>





          <li class="nav-item d-none">
            <a class="nav-link" href="tambah_produk.html">Tambah Produk</a>
          </li>
          <li class="nav-item d-none">
            <a class="nav-link" href="rincian.html">rincian</a>
          </li>
          <li class="nav-item d-none">
            <a class="nav-link" href="edit_produk.html">edit</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#jadwal" aria-expanded="false" aria-controls="jadwal">
        <i class="menu-icon mdi mdi-calendar-check"></i>
        <span class="menu-title">Jadwal</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="jadwal">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">

            <a class="nav-link" href="<?= base_url('jadwal'); ?>">Jadwal Training</a>
          </li>





          <li class="nav-item d-none">
            <a class="nav-link" href="tambah_produk.html">Tambah Produk</a>
          </li>
          <li class="nav-item d-none">
            <a class="nav-link" href="rincian.html">rincian</a>
          </li>
          <li class="nav-item d-none">
            <a class="nav-link" href="edit_produk.html">edit</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#master" aria-expanded="false" aria-controls="master">
        <i class="menu-icon mdi mdi-database-check"></i>
        <span class="menu-title">Data Master</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="master">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/daftar_sertifikat'); ?>">
              Data Sertifikat
            </a>
            <a class="nav-link" href="<?= base_url('dashboard/kelas_pembina'); ?>">
              Kelas Pembinaan
            </a>
            <a class="nav-link" href="<?= base_url('dashboard/jenis_alat'); ?>">
              Jenis Alat
            </a>
          </li>





          <li class="nav-item d-none">
            <a class="nav-link" href="tambah_produk.html">Tambah Produk</a>
          </li>
          <li class="nav-item d-none">
            <a class="nav-link" href="rincian.html">rincian</a>
          </li>
          <li class="nav-item d-none">
            <a class="nav-link" href="edit_produk.html">edit</a>
          </li>
        </ul>
      </div>
    </li>















    <li class="nav-item nav-category">User</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="menu-icon mdi mdi-account-circle-outline"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/profil'); ?>">
              Profil Saya
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
              Keluar
            </a>
          </li>
        </ul>
      </div>
    </li>




  </ul>
</nav>
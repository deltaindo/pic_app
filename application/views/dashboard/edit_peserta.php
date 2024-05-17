<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-tittle"><?= $tittle; ?></h4>
                 
                  <form action="<?= base_url('dashboard/edit_peserta/'.$p['id']); ?>" method="post" enctype="multipart/form-data">    
        <ul class="list-group mt-3">
            <input type="hidden" value="<?= $p['id'];  ?>" name="id"> 
            <li class="list-group-item mt-3">
                <div class="row">
                <div class="col-6">
                        <label for="surat" class="form-label">Nik</label>
                        <input type="text" class="form-control form-control-sm" name="nik" value="<?= $p['nik']; ?>">
                    </div>
                    <div class="col-6">
                        <label for="surat" class="form-label">Nama</label>
                        <input type="text" class="form-control form-control-sm" name="nama" value="<?= $p['nama']; ?>">
                    </div>
                    <div class="col-6">
                        <label for="surat" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control form-control-sm" name="ttl" value="<?= $p['ttl']; ?>">
                    </div>
                    <div class="col-6">
                        <label for="surat" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control form-control-sm" name="tgl_lahir" value="<?= $p['tgl_lahir']; ?>">
                    </div>
                    <div class="col-6">
                        <label for="surat" class="form-label">Golongan Darah</label>
                        <input type="text" class="form-control form-control-sm" name="golongan_darah" value="<?= $p['golongan_darah']; ?>">
                    </div>
                    <div class="col-6">
                        <label for="surat" class="form-label">Pendidikan</label>
                        <input type="text" class="form-control form-control-sm" name="pendidikan" value="<?= $p['pendidikan']; ?>">
                    </div>
                    <div class="col-6">
                        <label for="surat" class="form-label">Sekolah</label>
                        <input type="text" class="form-control form-control-sm" name="sekolah" value="<?= $p['sekolah']; ?>">
                    </div>
                    <div class="col-6">
                        <label for="surat" class="form-label">No Ijazah</label>
                        <input type="text" class="form-control form-control-sm" name="no_ijazah" value="<?= $p['no_ijazah']; ?>">
                    </div>
                    <div class="col-6">
                        <label for="surat" class="form-label">Alamat Rumah</label>
                        <input type="text" class="form-control form-control-sm" name="alamat" value="<?= $p['alamat']; ?>">
                    </div>
                    <div class="col-6">
                        <label for="surat" class="form-label">Email</label>
                        <input type="text" class="form-control form-control-sm" name="email" value="<?= $p['email']; ?>">
                    </div>
                    <div class="col-6">
                        <label for="surat" class="form-label">No Wa</label>
                        <input type="text" class="form-control form-control-sm" name="no_wa" value="<?= $p['no_wa']; ?>">
                    </div>
                   
                </div> 
            </li>    
        </ul>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
                <a href="<?= base_url('dashboard'); ?>"><button class="btn btn-primary mt-3">Kembali</button></a>
                
                
                </div>
                
              </div>
              
            </div>
            
          </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div
              class="d-sm-flex justify-content-center justify-content-sm-between"
            >
              <span
                class="text-muted text-center text-sm-left d-block d-sm-inline-block"
                >Premium
                <a href="https://www.bootstrapdash.com/" target="_blank"
                  >Bootstrap admin template</a
                >
                from BootstrapDash.</span
              >
              <span
                class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"
                >Copyright © 2021. All rights reserved.</span
              >
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
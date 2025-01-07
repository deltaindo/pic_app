<div class="main-panel">
        <div class="content-wrapper">
          <form action="<?= base_url('dashboard/insertSertifikat'); ?>" method="post" enctype="multipart/form-data">  
          <div class="row">
            
            
            <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-tittle"><?= $tittle; ?></h4> 
                      <ul class="list-group mt-3">
                      
                          <li class="list-group-item mt-3">
                              <div class="row">
                              <div class="col-6">
                                <select class="form-select" aria-label="Default select example" name="idn" id="idn">
                                    <option selected>Pilih Training</option>
                                    <?php foreach ($idn as $i) : ?>
                                    <option value="<?= $i['sertifikat_indonesia'] ?>" data-id="<?= $i['id'] ?>"><?= $i['sertifikat_indonesia'] ?></option>
                                    <?php endforeach; ?>
                          
                                  </select>
                                  </div>
                                  <div class="col-6">
                                      <select class="form-select" aria-label="Default select example" name="ing" id="ing">
                                       
                              
                                      </select>
                                  </div>
                                  <div class="col-6">
                                      <label for="surat" class="form-label">Pelaksanaan</label>
                                      <input type="text" class="form-control form-control-sm" name="pelaksanaan" placeholder="Pada Tanggal 02 S.D 04 September 2023">
                                  </div>
                                  <div class="col-6">
                                      <label for="surat" class="form-label">Pelaksanaan B.Inggris</label>
                                      <input type="text" class="form-control form-control-sm" name="pelaksanaan_inggris">
                                  </div>
                                  <div class="col-6">
                                      <label for="surat" class="form-label">Tanggal Terbit Sertifikat</label>
                                      <input type="text" class="form-control form-control-sm" name="terbit">
                                  </div>
                                  <div class="col-6">
                                      <label for="surat" class="form-label">Tanggal Terbit Sertifikat inggris</label>
                                      <input type="text" class="form-control form-control-sm" name="terbit_inggirs">
                                  </div>
                                  
                              
                              </div> 
                          </li>    
                      </ul>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-tittle"><?= $tittle; ?></h4> 
                      <ul class="list-group mt-3">
                          
                          <li class="list-group-item mt-3">
                          <?php foreach($sertifikat as $s) : ?>
                              <div class="row">
                              <input type="hidden" class="form-control form-control-sm" name="id[]" value="<?= $s['id'] ?>">
                              <div class="col-4">
                                      <label for="surat" class="form-label">Nama</label>
                                      <input type="text" class="form-control form-control-sm" name="nama[]" value="<?= $s['nama'] ?>">
                                  </div>
                                  <div class="col-4">
                                      <label for="surat" class="form-label">No. Sertifikat</label>
                                      <input type="text" class="form-control form-control-sm no_sertifikat" name="no_sertifikat[]" >
                                  </div>
                                  <div class="col-4">
                                      <label for="surat" class="form-label">sertifikat</label>
                                      <input type="text" class="form-control form-control-sm sertifikat" name="sertifikat[]" >
                                  </div>    
                              </div> 
                              <?php endforeach; ?>
                          </li>    
                      </ul>
                      <button type="button" id="urutkanAngkaBtn" class="btn btn-primary mt-3">Urutkan Angka</button>
                      <button type="submit" class="btn btn-primary mt-4" onclick="confirm('Apakah Semua Data Sudah Sesuai 😳')">Kirim</button>
                  </div>
                
                </div>
                
              </div>
              
          </div>
          
          </form>  
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div
              class="d-sm-flex justify-content-center justify-content-sm-between"
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
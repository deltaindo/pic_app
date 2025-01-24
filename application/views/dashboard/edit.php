<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-tittle"><?= $tittle; ?></h4>
                 
                <form action="<?= base_url('dashboard/editPendaftaran'); ?>" method="post">    
                <ul class="list-group mt-3">
                 <?php foreach($produk as $p) : ?> 
                    <input type="hidden" value="<?= $p['id'];  ?>" name="id[]"> 
                  <li class="list-group-item mt-3">
                       
                        <div class="row">
                            <div class="col-12">
                            <label for="exampleInputPassword1" class="form-label">Form</label>
                            <input type="text" class="form-control" name="form[]" id="exampleInputPassword1" value="<?= $p['form'] ?>">
                            </div>
                            <div class="col-6 mt-5">
                                <label for="tanggal">Pilih Tanggal:</label>
                                <input type="text" id="tanggal">
                            </div>
                            <div class="col-6 mt-5">
                                <textarea class="form-control" placeholder="Tanggal yang Dipilih" id="tanggalDipilih" style="height: 100px;" name="tanggal[]"></textarea>
                            </div>
                            <div class="col-12">
                            <label for="exampleInputPassword1" class="form-label">link Grup Whatsapp</label>
                            <input type="text" class="form-control" name="grup[]" id="exampleInputPassword1" value="<?= $p['link_grup'] ?>">
                            </div>
                            
                           
                        </div> 
                    </li>    
                   <?php endforeach; ?>  
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
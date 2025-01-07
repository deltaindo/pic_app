
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
                <!-- Message -->
                <?= $this->session->flashdata('message'); ?>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    
                    <form class="forms-sample" method="post" action="<?= base_url('dashboard/updateProfil'); ?>" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $profil['id'] ?>" name="id">  
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nama</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputUsername1"
                          value="<?= $profil['nama'] ?>"
                          name="nama"
                         
                        />
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputUsername1"
                          value="<?= $profil['email'] ?>"
                          name="email"
                         
                        />
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nomor Telepon</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputEmail1"
                          value="<?= $profil['phone_number'] ?>"
                          name="tlp"
                         
                        />
                      </div>
                    
                      <div class="form-group mt-2">
                        <label for="exampleInputConfirmPassword1"
                          >Password</label
                        >
                        <input
                          type="password"
                          class="form-control"
                          id="exampleInputConfirmPassword1"
                          placeholder="Your Password"
                          name="password"
                          
                          
                        />
                      </div>
                      
                      <!-- <div class="form-group">
                        <label for="foto">Pas Foto</label>
                        <input
                          type="file"
                          class="form-control form-control-sm"
                          id="foto"
                          name="foto"
                          placeholder="Link"
                         
                        />
                      </div>
                      <img
                        src="<?= base_url('assets/images/dosen/'); ?>"
                        class="img-thumbnail"
                        alt="..."
                        style="width: 200px; height: 200px"
                      />
                      <div
                        class="form-check form-check-flat form-check-primary"
                      > -->
                        <!-- <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" />
                          Remember me
                        </label> -->
                      
                      <button type="submit" class="btn btn-primary me-2">
                        Submit
                      </button>
                      <a href="<?= base_url('dashboard'); ?>" class="btn btn-primary">Kembali</a> 
                    </form>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <!-- content-wrapper ends -->
      

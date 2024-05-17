<div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div
                    class="d-sm-flex align-items-center justify-content-between border-bottom"
                  >
                    
                    <div>
                      <div class="btn-wrapper">
                        
                        <a href="#" class="btn btn-otline-dark"
                          ><i class="icon-printer"></i> Print</a
                        >
                        <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#exampleModal"
                          ><i class="icon-download"></i>Import</a
                        >
                      </div>
                    </div>
                  </div>
                  <div class="tab-content tab-content-basic">
                    <div
                      class="tab-pane fade show active"
                      id="overview"
                      role="tabpanel"
                      aria-labelledby="overview"
                    >
                     
                      
                    </div>

                    
        <!-- Tabel Kategori -->
        <?= $this->session->flashdata('message'); ?>
        <div class="row tabel-produk mt-2">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Daftar Form Pendaftaran</h4>
                
                  <form action="<?= base_url('dashboard/editForm'); ?>" method="post">
                  <a href="#" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah +</a>
                 
                  <button class="btn btn-outline-primary" type="submit">Edit Data</button>
                  <a href="#" class="btn btn-danger text-white" id="hapus-pembina" data-url="<?= base_url('dashboard/hapus_pembina') ?>"  >Hapus</a>
                 
                   <div class="table-responsive">
                    <table class="table table-striped" id="example">
                      <thead>
                        <tr>
                          <th>
                          <input
                                  type="checkbox"
                                  id="check-all"

                                  class="form-check-input check"
                                  aria-checked="false" /><i
                                  class="input-helper"
                                ></i
                              >
                            </th>
                           
                          <th>Bidang</th>
                          <!-- <th>Status Pelatihan</th> -->
                          <th>Personil</th>
                         
                          <th>Jenis Alat</th>
                          
                          <th>Action</th>
                          
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; ?>
                        <?php foreach($bidang as $p) : ?>
                        <tr>
                          <td> 
                            <input
                                  type="checkbox"
                                  id="check"
                                  name="id[]"
                                  value="<?= $p['id_tb_kelompok_pembinaan']; ?>"
                                  class="form-check-input check"
                                  aria-checked="false" /><i
                                  class="input-helper"
                                ></i
                              >
                            </td>
                     
                          <td><?= $p['bidang'] ?></td>
                          <td><?= $p['jenis_personil'] ?></td>
                          <td><?= $p['kelompok_pembinaan'] ?></td>
                          <td>
                            <!-- dropup -->
                            <div class="dropup">
                              <span class="ti-settings" data-bs-toggle="dropdown" aria-expanded="false"></span>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-danger" href="<?= base_url('dashboard/nonaktif/Nonaktif/'.$p['id_tb_kelompok_pembinaan']); ?>">Nonaktifkan</a></li>
                                <li><a class="dropdown-item text-success" href="<?= base_url('dashboard/nonaktif/Aktif/'.$p['id_tb_kelompok_pembinaan']); ?>">Aktif</a></li>
                              </ul>
                            </div>  
                          
                        
                          </td>
                          
                        </tr>    
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </form>
        </div>
        
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('dashboard/tambah_kelompok'); ?>">
        <label for="" class="text-primary fs-6 mb-1">
            Bidang
          </label>
          <select class="form-select form-select-sm" aria-label="Default select example" name="bidang">
          <option selected>Pilih Training</option> 
          
          <?php foreach($bidangg as $t) : ?> 
            <option value="<?= $t['id'] ?>"><?= $t['bidang'] ?></option>
            <?php endforeach; ?>
           
          </select>
          <br>
          <label for="" class="text-primary fs-6 mb-1">
            Personil
          </label>
          <select class="form-select form-select-sm" aria-label="Default select example" name="personil">
          <option selected>Jenis Personil</option> 
          <?php foreach($personil as $t) : ?> 
            <option value="<?= $t['id'] ?>"><?= $t['jenis_personil'] ?></option>
            <?php endforeach; ?>
          </select>
          <br>
          <label for="" class="text-primary fs-6 mb-1">
            Kelompok Pembinaan
          </label>
          <select class="form-select form-select-sm" aria-label="Default select example" name="pembinaan">
          <option selected>Kelompok Pembinaan</option> 
          <?php foreach($pembinaan as $t) : ?> 
            <option value="<?= $t['id'] ?>"><?= $t['kelompok_pembinaan'] ?></option>
            <?php endforeach; ?>
          </select>
          <br>
        
          
                
      
      
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>
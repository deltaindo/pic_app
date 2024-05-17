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
                  <a href="#" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Buat Link</a>
                 
                  <button class="btn btn-outline-primary" type="submit">Edit Data</button>
                  <a href="#" class="btn btn-danger text-white" id="hapus-form" data-url="<?= base_url('dashboard/hapus') ?>"  >Hapus</a>
                 
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
                           
                          <th>Training</th>
                          <th>Personil</th>
                          <th>Kelas Pembina</th>
                          <th>Jenis Alat</th>
                       
                          <th>PIC</th>
                          <th>Tanggal Pembuatan</th>
                          <th>Tanggal Pelaksanaan</th>
                          <th>Program</th>
                          
                          <th>Status</th>
                         
                          <th>Action</th>
                          
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; ?>
                        <?php foreach($form as $p) : ?>
                        <tr>
                          <td> 
                            <input
                                  type="checkbox"
                                  id="check"
                                  name="id[]"
                                  value="<?= $p['id']; ?>"
                                  class="form-check-input check"
                                  aria-checked="false" /><i
                                  class="input-helper"
                                ></i
                              >
                            </td>
                     
                          <td><a href="<?= base_url('dashboard/pendaftaran/'.$p['id'].'/'.$p['program']); ?>"  style="text-decoration: none;" class="text-uppercase"><?= $p['form'] ?></a></td>
                          <td><?= $p['personil'] ?></td>
                          <td><?= $p['pembina'] ?></td>
                          <td><?= $p['jenis_alat'] ?></td>
                          <td><?= $p['nama'] ?></td>
                          <td><?= $p['tanggal_pembuatan'] ?></td>
                          <td><?= $p['tanggal_pelaksanaan'] ?></td>
                         <td><?= ($p['program'] == 1) ? 'Inhouse' : 'Reguler' ?></td>
                          <td><span class="badge <?= ($p['status'] == 'Aktif') ? 'bg-success' : 'bg-danger' ?>"><?= $p['status'] ?></span></td>
                         
                          <td>
                            <!-- dropup -->
                            <div class="dropup">
                              <span class="ti-settings" data-bs-toggle="dropdown" aria-expanded="false"></span>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-danger" href="<?= base_url('dashboard/nonaktif/Nonaktif/'.$p['id']); ?>">Nonaktifkan</a></li>
                                <li><a class="dropdown-item text-success" href="<?= base_url('dashboard/nonaktif/Aktif/'.$p['id']); ?>">Aktif</a></li>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Link Pendaftaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('dashboard/buatLink'); ?>">
        <label for="" class="text-primary fs-6 mb-1">
            Training
          </label>
          <select class="form-select form-select-sm" aria-label="Default select example" name="form">
          <option selected>Pilih Training</option> 
           <?php foreach($training as $t) : ?> 
            <option value="<?= $t['Training'] ?>"><?= $t['Training'] ?></option>
            <?php endforeach; ?>
          </select>
          <br>
          <label for="" class="text-primary fs-6 mb-1">
            Kelas
          </label>
          <select class="form-select form-select-sm" aria-label="Default select example" name="kelas">
          <option selected>Pilih Kelas</option> 
           <?php foreach($kelas as $t) : ?> 
            <option value="<?= $t['id'] ?>"><?= $t['kelas'] ?></option>
            <?php endforeach; ?>
          </select>
          <br>
          <label for="" class="text-primary fs-6 mb-1">
            Tanggal Training
          </label>
          <div class="mb-3">
            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tgl_pelaksanaan">
          </div>
          <label for="" class="text-primary fs-6 mb-1">
            Program
          </label>
          <select class="form-select form-select-sm" aria-label="Default select example" name="program">
            <option selected>Inhouse / Reguler</option>
            <option value="1">Inhouse</option>
            <option value="2">Reguler</option>
          </select>
          <br>
          
                
      
      
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Buat</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
                <h4 class="card-title">Jadwal Training Delta Indonesia</h4>
                
                  <form action="<?= base_url('dashboard/editForm'); ?>" method="post">
                 
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
                          <th>Tanggal Pelaksanaan</th>
                          <th>Jumlah Peserta</th>
                          <th>Pic</th>
                          <th>Status</th>  
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; ?>
                        <?php foreach($training as $p) : ?>
                        <tr>
                          <td> 
                            <input
                                  type="checkbox"
                                  id="check"
                                  name="id[]"
                                  value="<?= $p['id_form']; ?>"
                                  class="form-check-input check"
                                  aria-checked="false" /><i
                                  class="input-helper"
                                ></i
                              >
                            </td>
                            <td><a href="<?= base_url('jadwal/pendaftaran/'.$p['id_form'].'/'.$p['id_user']); ?>" style="text-decoration: none;"><?= $p['form'] ?></a></td>
                            <td><?= $p['tanggal_pelaksanaan'] ?></td>
                            <td><?= $p['peserta'] ?></td>
                            <td><?= $p['pic'] ?></td>
                            <td>
                                <span class="badge <?= ($p['peserta'] > 10) ? 'badge-success' : 'badge-warning' ?>">
                                    <?= ($p['peserta'] > 10) ? 'Running' : 'Pending' ?>
                                </span>
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

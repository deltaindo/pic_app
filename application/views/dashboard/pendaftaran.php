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
                           
                          <th>Form</th>
                          <!-- <th>Status Pelatihan</th> -->
                          <th>Tanggal Pelaksanaan</th>
                          <th>Tanggal Selesai</th>
                          <th>Program</th>
                          <th>Status</th>
                          <th>Link</th>
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
                          <!-- <td class="text-center"><span class="badge bg-warning mdi mdi-menu-down" data-bs-toggle="dropdown" aria-expanded="false"> Berjalan</span>
                          <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-danger" href="<?= base_url('dashboard/nonaktif/Nonaktif/'.$p['id']); ?>">Berjalan</a></li>
                                <li><a class="dropdown-item text-success" href="<?= base_url('dashboard/nonaktif/Aktif/'.$p['id']); ?>">Selesai</a></li>
                              </ul>
                        </td> -->
                          <td class="text-center"><?= $p['tanggal_pelaksanaan'] ?></td>
                          <td class="text-center"><?= $p['tanggal_selesai'] ?></td>
                          
                         <td class="text-center"><?= ($p['program'] == 1) ? 'Inhouse' : 'Reguler' ?></td>
                          <td class="text-center"><span class="badge <?= ($p['status'] == 'Aktif') ? 'bg-success' : 'bg-danger' ?>"><?= $p['status'] ?></span></td>
                          <td data-link="<?= $p['link'] ?>"><?= $p['link'] ?> <span class="mdi mdi-content-copy text-danger" style="cursor: pointer;"></span></td>

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
            Bidang
          </label>
          <select class="form-select form-select-sm" id="bidang" data-url="<?= base_url('dashboard/getBidang'); ?>" aria-label="Default select example" name="bidang">
          <option selected>Pilih Bidang</option> 
           <?php foreach($bidang as $t) : ?> 
            <option value="<?= $t['bidang'] ?>"><?= $t['bidang'] ?></option>
            <?php endforeach; ?>
          </select>
        <br>
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
            <option id-val="<?= $t['id'] ?>" value="<?= $t['kelas'] ?>"><?= $t['kelas'] ?></option>
            <?php endforeach; ?>
          </select>
          <br>
          <div class="row">
            <div class="col-6">
              <label for="" class="text-primary fs-6 mb-1">
              Tanggal Mulai Training
              </label>
              <div class="mb-3">
              <?php
                $minDate = date('Y-m-d', strtotime('+5 days'));
                ?>
                <input type="date" class="form-control" name="tanggal" min="<?= $minDate ?>">
                
              </div>
            </div>
            <div class="col-6">
                <label for="" class="text-primary fs-6 mb-1">
                  Tanggal Selesai
                </label>
                <div class="mb-3">
                  <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tanggal_selesai">
                </div>
            </div>
           </div>
          
           <label for="" class="text-primary fs-6 mb-1">
            Program
          </label>
          <select
            class="form-select form-select-sm"
            aria-label="Default select example"
            name="program"
            id="program"
            >
            <option selected>Inhouse / Reguler / Mitra PJK3</option>
            <option value="1">Inhouse</option>
            <option value="2">Reguler</option>
            <option value="3">Mitra PJK3</option>
          </select>
          <br>
          <div id="inhouse-form" style="display: none;">
            <label for="company_name" class="text-primary fs-6 mb-1">Nama Perusahaan</label>
            <input
              type="text"
              class="form-control"
              id="company_name"
              name="company_name"
              placeholder="Enter company name"
            />
          </div>

          <div id="reguler-form" style="display: none;">
            <label for="client_name" class="text-primary fs-6 mb-1">Jika bukan dari Delta, masukkan nama klien</label>
            <input
              type="text"
              class="form-control"
              id="client_name"
              name="client_name"
              placeholder="Enter client name"
            />
          </div>

          <div id="pjk3-form" style="display: none;">
            <label for="client_name" class="text-primary fs-6 mb-1">Nama Klien</label>
            <input
              type="text"
              class="form-control"
              id="client_name"
              name="client_name"
              placeholder="Enter client name"
            />
            <br>
            <label for="pjk3_type" class="text-primary fs-6 mb-1">PJK3 Apa</label>
            <input
              type="text"
              class="form-control"
              id="pjk3_type"
              name="pjk3_type"
              placeholder="Enter PJK3 type"
            />
          </div>

          <!-- Additional form that appears when "Klien" is selected -->
          <div id="klien-form" style="display: none; margin-top: 10px;">
            <label for="klien_name" class="text-primary fs-6 mb-1">Nama Klien</label>
            <input
              type="text"
              class="form-control"
              id="klien_name"
              name="klien_name"
              placeholder="Masukkan nama klien"
            />
          </div>

          <br>
          
          <script>
          
          const programSelect = document.getElementById('program');
          const inhouseForm = document.getElementById('inhouse-form');
          const regulerForm = document.getElementById('reguler-form');
          const pjk3Form = document.getElementById('pjk3-form');
          const regulerclient = document.querySelector('regulerclient');
          const klienForm = document.getElementById('klien-form');

          programSelect.addEventListener('change', function () {
            // Hide all forms initially
            inhouseForm.style.display = 'none';
            regulerForm.style.display = 'none';
            pjk3Form.style.display = 'none';
            klienForm.style.display = 'none';


            // Show the relevant form based on the selected option
            if (this.value === '1') {
              inhouseForm.style.display = 'block';
            } else if (this.value === '2') {
              regulerForm.style.display = 'block';
            } else if (this.value === '3') {
              pjk3Form.style.display = 'block';
            }
            
          });
          
          regulerclient.addEventListener('change', function () {
            // Show or hide the Klien form based on the selection
            if (this.value === 'client') {
              klienForm.style.display = 'block';
            } else {
              klienForm.style.display = 'none';
            }
          });
          </script>

          <br>
          <label for="" class="text-primary fs-6 mb-1">
            Link Grup Whatsapp
          </label>
          <div class="mb-3">
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="link">
          </div>

          <label for="" class="text-primary fs-6 mb-1">
            Tempat Pelaksanaan
          </label>
          <div class="mb-3">
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tempat_pelaksanaan">
          </div>
      
      
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Buat</button>
        </form>
      </div>
    </div>
  </div>
</div>
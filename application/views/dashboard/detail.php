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
                        
                        <a href="<?= base_url('dashboard/download_excel/'.$this->uri->segment('3')); ?>" class="btn btn-otline-dark"
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
                <h4 class="card-title">Daftar <?= $tittle ?></h4>
                
                <form action="<?= base_url('dashboard/editPeserta'); ?>" method="post">
                <button class="mdi mdi-file-document-edit btn btn-outline-primary" type="submit">Upload Dokumen</button>
                 
                  <a href="#" class="mdi mdi-delete btn btn-danger text-white" id="hapus-data" data-url="<?= base_url('dashboard/hapusData') ?>"  >Hapus</a>
                  <button type="button" class="mdi mdi-message btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#pesan">
                    Kirim Pesan
                  </button>
                  <button type="button" class="btn btn-success text-white" id="sertifikat" data-url="<?= base_url('dashboard/cetak'); ?>" data-call="<?= base_url('dashboard/callBack'); ?>">
                    Buat Sertifikat
                  </button>
                  <button type="button" class="mdi mdi-certificate btn btn-warning text-white" id="ulasan" data-url="<?= base_url('dashboard/ulasan'); ?>">
                    Kirim Ulasan & Sertifikat
                  </button>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#link">
                    Launch demo modal
                  </button>

                   <div class="table-responsive">
                   <table id="example" class="table table-hover display nowrap" style="width:100%; overflow-x:auto;">
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
                          <th>KTP</th>
                          <th>Nama</th>
                          <th>Tempat</th>
                          <th>Tanggal Lahir</th>
                          <th>Instansi</th>
                          <th>Kontak Perusahaan</th>
                          <th>Alamat Perusahaan</th>
                          <th>Golongan Darah</th>
                          <th>Pendidikan Terakhir</th>
                          <th>Asal Sekolah</th>
                          <th>No Ijazah</th>
                          <th>Tanggal Ijazah</th>
                          <th>Alamat Domisili</th>
                          <th>Email</th>
                          <th>Sektor</th>
                          <th>Jabatan</th>
                          <th>Surat <br>Pernyataan Peserta</th>
                          <th>Ijazah</th>
                          <th>KTP</th>
                          <th>Surat Keterangan<br class="mt-2">Bekerja dari Perusahaan</th>
                          <th>Pas Foto</th>
                          <th>CV</th>
                          <th class="<?= ($this->session->userdata('id_program') == 2 ? 'd-none' : '') ?>">Bukti Transfer</th>
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
                          <td><?= $p['nik']; ?></td>
                          <td><?= $p['nama']; ?></td>
                          <td><?= $p['ttl']; ?></td>
                          <td><?= $p['tgl_lahir'] ?></td>
                          <td class="text-uppercase"><?= $p['instansi']; ?></td>
                          <td><?= $p['tlp_kantor']; ?></td>
                          <td><?= $p['alamat_perusahaan']; ?></td>
                          <td class="text-center"><?= $p['golongan_darah']; ?></td>
                          <td class="text-center"><?= $p['pendidikan']; ?></td>
                          <td><?= $p['sekolah']; ?></td>
                          <td class="text-center"><?= $p['no_ijazah']; ?></td>
                          <td class="text-center"><?= $p['tgl_ijazah']; ?></td>
                          <td><?= $p['alamat']; ?></td>
                          <td><?= $p['email']; ?></td>
                          
                          <td><?= $p['sektor']; ?></td>
                          <td><?= $p['jabatan']; ?></td>
                         
                         
                          <td>
                              <?php if (!empty($p['surat'])): ?>
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['surat']); ?>" target="_blank">Lihat Dokumen</a>&nbsp;&nbsp;
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['surat']); ?>" download><span class="mdi mdi-download fs-5 text-danger"></span></a>
                                  <a href="<?= base_url('dashboard/hapusDokumen/'.$p['surat'].'/'.$p['id'].'/surat'); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');"><span class="mdi mdi-trash-can fs-5 text-danger"></span></a>
                              <?php endif; ?>
                          </td>
                          <td>
                              <?php if (!empty($p['ijazah'])): ?>
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['ijazah']); ?>" target="_blank">Lihat Dokumen</a>&nbsp;&nbsp;
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['ijazah']); ?>" download><span class="mdi mdi-download fs-5 text-danger"></span></a>
                                  <a href="<?= base_url('dashboard/hapusDokumen/'.$p['ijazah'].'/'.$p['id'].'/ijazah'); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');"><span class="mdi mdi-trash-can fs-5 text-danger"></span></a>
                              <?php endif; ?>
                          </td>
                          <td>
                              <?php if (!empty($p['ktp'])): ?>
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['ktp']); ?>" target="_blank">Lihat Dokumen</a>&nbsp;&nbsp;
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['ktp']); ?>" download><span class="mdi mdi-download fs-5 text-danger"></span></a>
                                  <a href="<?= base_url('dashboard/hapusDokumen/'.$p['ktp'].'/'.$p['id'].'/ktp'); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');"><span class="mdi mdi-trash-can fs-5 text-danger"></span></a>
                              <?php endif; ?>
                          </td>
                          <td>
                              <?php if (!empty($p['sk'])): ?>
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['sk']); ?>" target="_blank">Lihat Dokumen</a>&nbsp;&nbsp;
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['sk']); ?>" download><span class="mdi mdi-download fs-5 text-danger"></span></a>
                                  <a href="<?= base_url('dashboard/hapusDokumen/'.$p['sk'].'/'.$p['id'].'/sk'); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');"><span class="mdi mdi-trash-can fs-5 text-danger"></span></a>
                              <?php endif; ?>
                          </td>
                          <td>
                              <?php if (!empty($p['foto'])): ?>
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['foto']); ?>" target="_blank">Lihat Dokumen</a>&nbsp;&nbsp;
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['foto']); ?>" download><span class="mdi mdi-download fs-5 text-danger"></span></a>
                                  <a href="<?= base_url('dashboard/hapusDokumen/'.$p['foto'].'/'.$p['id'].'/foto'); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');"><span class="mdi mdi-trash-can fs-5 text-danger"></span></a>
                              <?php endif; ?>
                          </td>
                          <td>
                              <?php if (!empty($p['cv'])): ?>
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['cv']); ?>" target="_blank">Lihat Dokumen</a>&nbsp;&nbsp;
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['cv']); ?>" download><span class="mdi mdi-download fs-5 text-danger"></span></a>
                                  <a href="<?= base_url('dashboard/hapusDokumen/'.$p['cv'].'/'.$p['id'].'/cv'); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');"><span class="mdi mdi-trash-can fs-5 text-danger"></span></a>
                              <?php endif; ?>
                          </td>
                          <td class="<?= ($this->session->userdata('id_program') == 2 ? 'd-none' : '') ?>">
                              <?php if (!empty($p['bukti'])): ?>
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['bukti']); ?>" target="_blank">Lihat Dokumen</a>&nbsp;&nbsp;
                                  <a href="<?= base_url('pendaftaran/images/dokumen/'.$p['bukti']); ?>" download><span class="mdi mdi-download fs-5 text-danger"></span></a>
                                  <a href="<?= base_url('dashboard/hapusDokumen/'.$p['bukti'].'/'.$p['id'].'/bukti'); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');"><span class="mdi mdi-trash-can fs-5 text-danger"></span></a>
                              <?php endif; ?>
                          </td>


                          <td>
                            <!-- dropup -->
                            <div class="dropend" style="position: relative; z-index: 1001;">
                              <span class="ti-settings" style="cursor: pointer;" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                              <ul class="dropdown-menu" style="z-index: 1002;">
                                <li><a class="dropdown-item text-success" href="<?= base_url('dashboard/zip/'.$p['id']); ?>">Download (zip)</a></li>
                                <li><a class="dropdown-item text-danger" href="<?= base_url('dashboard/edit_peserta/'.$p['id']); ?>">Edit</a></li>
                                <li><a class="dropdown-item text-primary" href="<?= base_url('dashboard/sertifikat/'.$p['id']); ?>">Sertifikat</a></li>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('dashboard/importPeserta/'.$this->uri->segment('3').'/'.$this->uri->segment('4')); ?>" method="post" enctype="multipart/form-data">
        <input type="file" class="form-control form-control-sm" name="excel_file">                    
        <button type="submit" class="btn btn-primary">Save changes</button>  
      </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- modal -->
<div class="modal fade" id="pesan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Pesan Anda</h4>
      </div>
      <div class="modal-body">
       <form action="<?= base_url('dashboard/pesan'); ?>" method="post">
          <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="notif" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Comments</label>
          </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="kirimPesan" data-url="<?= base_url('dashboard/pesan'); ?>">Kirim</button>
      </div>
    </div>
  </div>
</div>

<!-- modal kirim sertifikat -->
<div class="modal fade" id="link" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Genrate Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Instruktur</label>
        <input type="text" class="form-control" id="instruktur" aria-describedby="emailHelp">                   
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Form Id</label>
        <input type="text" class="form-control" id="id" value="<?= $this->uri->segment(3); ?>" aria-describedby="emailHelp">                   
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Link</label>
        <input type="text" class="form-control" id="linkResult" aria-describedby="emailHelp">                   
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="genrate">Genrate Link</button>
      </div>
    </div>
  </div>
</div>

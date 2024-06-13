<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="d-sm-flex align-items-center justify-content-between border-bottom">
          </div>
          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"></div>
            <?= $this->session->flashdata('message'); ?>
            <div class="row tabel-produk mt-2">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">
                      Jadwal Training Delta Indonesia
                    </h4>
                    <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Tambah +
                    </button>
                    <form action="<?= base_url('dashboard/editForm'); ?>" method="post">
                      <div class="table-responsive">
                        <table class="table table-striped" id="example">
                          <thead>
                            <tr>
                              <th>
                                <input type="checkbox" id="check-all" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                              </th>
                              <th>
                                No
                              </th>
                              <th>
                                Sertifikat Indonesia
                              </th>
                              <th>
                                Sertifikat Inggris
                              </th>
                              <th>
                                Action
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($sertifikat as $p) : ?>
                              <tr>
                                <td>
                                  <input type="checkbox" id="check" name="id[]" value="<?= $p['id']; ?>" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                                </td>
                                <td><?= $i++ ?></td>
                                <td><?= $p['sertifikat_indonesia'] ?></td>
                                <td><?= $p['sertifikat_ing'] ?></td>
                                <td>
                                  <a href="<?= base_url('/dashboard/edit_daftar_sertifikat/' . $p["id_ing"]); ?>" class="btn btn-lg btn-success">
                                    Edit
                                  </a>
                                  <button class="btn btn-lg btn-danger" type="button" onclick="deleteSertifikatIng(<?= $p['id_ing']; ?>)">
                                    Hapus
                                  </button>
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
          <h5 class="modal-title" id="exampleModalLabel">
            Tambah Judul Sertifikat
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('dashboard/tambah_ser'); ?>" method="post">
            <div class="mb-3">
              <label for="judul_indonesia" class="form-label">
                Judul Indonesia
              </label>
              <input type="text" class="form-control" id="judul_indonesia" aria-describedby="judul_indonesia" name="ser_id" placeholder="Masukan Judul Sertifikat Indonesia">
            </div>
            <div class="mb-3">
              <label for="judul_inggirs" class="form-label">
                Judul Inggirs
              </label>
              <input type="text" class="form-control" id="judul_inggirs" aria-describedby="judul_inggirs" name="ser_ing" placeholder="Masukan Judul Sertifikat Inggris">
            </div>
            <button type="submit" class="btn btn-primary">
              Save
            </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
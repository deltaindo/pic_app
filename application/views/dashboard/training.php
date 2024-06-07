<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom"></div>
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"></div>
                        <!-- Tabel Kategori -->
                        <?= $this->session->flashdata('message'); ?>
                        <div class="row tabel-produk mt-2">
                            <div class="col-lg-8 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            Daftar Training
                                        </h4>
                                        <form id="bulk-delete-form" action="<?= base_url('dashboard/hapus_bulk_daftar_training'); ?>" method="post">
                                            <a href="#" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#training">
                                                Buat Baru
                                            </a>
                                            <button class="btn btn-danger text-white" type="button" onclick="deleteBulkDaftarTraining()">
                                                Hapus
                                            </button>
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" id="check-all" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                                                            </th>
                                                            <th>
                                                                Nama Training
                                                            </th>
                                                            <th>
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($training as $train) : ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" id="check" name="id[]" value="<?= $train['id']; ?>" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                                                                </td>
                                                                <td>
                                                                    <?= $train['Training'] ?>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('/dashboard/edit_training/' . $train["id"]); ?>" class="btn btn-lg btn-outline-primary">
                                                                        Edit
                                                                    </a>
                                                                    <button class="btn btn-lg btn-danger" type="button" onclick="deleteTraining(<?= $train['id']; ?>)">
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
    <!-- Modal -->
    <div class="modal fade" id="training" tabindex="-1" aria-labelledby="trainingLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trainingLabel">
                        Tambah training
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('dashboard/training_simpan'); ?>">
                        <label for="nama_training" class="text-primary fs-6 mb-1">
                            Nama training
                        </label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="nama_training" aria-describedby="nama_training" name="nama_training" autofocus>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Buat
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
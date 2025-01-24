<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom"></div>
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"></div>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="row tabel-produk mt-2">
                            <div class="col-lg-8 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            Daftar Kelas
                                        </h4>
                                        <form id="bulk-delete-form" action="<?= base_url('dashboard/hapus_bulk_data_kelas'); ?>" method="post">
                                            <a href="#" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#kelas">
                                                Buat Baru
                                            </a>
                                            <button class="btn btn-danger text-white" type="button" onclick="deleteBulkDataKelas()">
                                                Hapus
                                            </button>
                                            <a href="<?= base_url('report/report_kelas_excel'); ?>" class="btn btn-success text-white" type="button">
                                                Export Excel
                                            </a>
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" id="check-all" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                                                            </th>
                                                            <th>
                                                                Nama Kelas
                                                            </th>
                                                            <th>
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($kelas as $kls) : ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" id="check" name="id[]" value="<?= $kls['id']; ?>" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                                                                </td>
                                                                <td>
                                                                    <?= $kls['kelas'] ?>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('/dashboard/edit_kelas/' . $kls["id"]); ?>" class="btn btn-lg btn-outline-primary">
                                                                        Edit
                                                                    </a>
                                                                    <button class="btn btn-lg btn-danger" type="button" onclick="deleteKelas(<?= $kls['id']; ?>)">
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
    <div class="modal fade" id="kelas" tabindex="-1" aria-labelledby="kelasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kelasLabel">
                        Tambah Kelas
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('dashboard/kelas_simpan'); ?>">
                        <label for="nama_kelas" class="text-primary fs-6 mb-1">
                            Nama Kelas
                        </label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="nama_kelas" aria-describedby="nama_kelas" name="nama_kelas" placeholder="Masukkan Nama Kelas" autofocus>
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
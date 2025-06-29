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
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            Daftar Alat Kelompok Pembinaan
                                        </h4>
                                        <form id="bulk-delete-form" action="<?= base_url('dashboard/hapus_bulk_alat_kelompok_pembinaan'); ?>" method="post">
                                            <a href="<?= base_url('dashboard/tambah_alat_kelompok_pembinaan'); ?>" class="btn btn-primary text-white">
                                                Buat Baru
                                            </a>
                                            <button class="btn btn-danger text-white" type="button" onclick="deleteBulkAlatKelompokPembinaan()">
                                                Hapus
                                            </button>
                                            <a href="<?= base_url('report/alat_kelompok_pembinaan_excel'); ?>" class="btn btn-success text-white" type="button">
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
                                                                Nama Kelompok Pembinaan
                                                            </th>
                                                            <th>
                                                                Jenis Alat
                                                            </th>
                                                            <th>
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($alat_kelompok as $alat) : ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" id="check" name="id[]" value="<?= $alat['id']; ?>" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                                                                </td>
                                                                <td>
                                                                    <?= $alat['jenis_alat'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $alat['kelompok_pembinaan'] ?>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('/dashboard/alat_kelompok_pembinaan_edit/' . $alat["id"]); ?>" class="btn btn-lg btn-outline-primary">
                                                                        Edit
                                                                    </a>
                                                                    <button class="btn btn-lg btn-danger" type="button" onclick="deleteKelompokAlatPembinaan(<?= $alat['id']; ?>)">
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
    <div class="modal fade" id="jenisAlat" tabindex="-1" aria-labelledby="jenisAlatLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jenisAlatLabel">
                        Tambah Kelas Pembina
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <label for="class_name" class="text-primary fs-6 mb-1">
                            Nama Kelas
                        </label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="class_name" aria-describedby="class_name" name="nama_kelas" autofocus>
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
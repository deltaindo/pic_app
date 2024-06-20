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
                            <div class="col-lg-10 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            Daftar Kelompok Pembinaan
                                        </h4>
                                        <form id="bulk-delete-form" action="<?= base_url('dashboard/hapus_bulk_kelompok_pembinaan'); ?>" method="post">
                                            <a href="#" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#kelompokPembinaan">
                                                Buat Baru
                                            </a>
                                            <button class="btn btn-danger text-white" type="button" onclick="deleteBulkMasterKelompokPembinaan()">
                                                Hapus
                                            </button>
                                            <a href="<?= base_url('report/master_kelompok_pembinaan_excel'); ?>" class="btn btn-success text-white" type="button">
                                                Export Excel
                                            </a>
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" id="check-all" class="form-check-input check" aria-checked="false" />
                                                                <i class="input-helper"></i>
                                                            </th>
                                                            <th>
                                                                Nama Kelompok Pembinaan
                                                            </th>
                                                            <th>
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($kelompok_pembinaan as $pembinaan) : ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" id="check" name="id[]" value="<?= $pembinaan['id']; ?>" class="form-check-input check" aria-checked="false" />
                                                                    <i class="input-helper"></i>
                                                                </td>
                                                                <td>
                                                                    <?= $pembinaan['kelompok_pembinaan'] ?>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('/dashboard/edit_master_kelompok_pembinaan/' . $pembinaan["id"]); ?>" class="btn btn-lg btn-outline-primary">
                                                                        Edit
                                                                    </a>
                                                                    <button class="btn btn-lg btn-danger" type="button" onclick="deleteMasterKelompokPembinaan(<?= $pembinaan['id']; ?>)">
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
    <div class="modal fade" id="kelompokPembinaan" tabindex="-1" aria-labelledby="kelompokPembinaanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kelompokPembinaanLabel">
                        Tambah Kelompok Pembinaan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('dashboard/kelompok_pembinaan_simpan'); ?>">
                        <label for="kelompok_pembinaan" class="text-primary fs-6 mb-1">
                            Nama Kelompok Pembinaan
                        </label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="kelompok_pembinaan" aria-describedby="kelompok_pembinaan" name="kelompok_pembinaan" placeholder="Masukan Nama Kelompok Pembinaan" autofocus>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Buat
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
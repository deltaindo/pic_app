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
                                            Daftar Bidang Jenis Personil
                                        </h4>
                                        <form id="bulk-delete-form" action="<?= base_url('dashboard/hapus_bulk_bidang_personil'); ?>" method="post">
                                            <a href="<?= base_url('dashboard/tambah_bidang_personil'); ?>" class="btn btn-primary text-white">
                                                Buat Baru
                                            </a>
                                            <button class="btn btn-danger text-white" type="button" onclick="deleteBulkBidangPersonil()">
                                                Hapus
                                            </button>
                                            <a href="<?= base_url('report/bidang_personil_excel'); ?>" class="btn btn-success text-white" type="button">
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
                                                                Nama Bidang
                                                            </th>
                                                            <th>
                                                                Jenis Personil
                                                            </th>
                                                            <th>
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($bidang_personil as $personil) : ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" id="check" name="id[]" value="<?= $personil['id']; ?>" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                                                                </td>
                                                                <td>
                                                                    <?= $personil['bidang'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $personil['jenis_personil'] ?>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('dashboard/edit_bidang_personil/') . $personil['id']; ?>" class="btn btn-lg btn-outline-primary">
                                                                        Edit
                                                                    </a>
                                                                    <button class="btn btn-lg btn-danger" type="button" onclick="deleteBidangPersonil(<?= $personil['id']; ?>)">
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
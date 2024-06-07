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
                                            Daftar Kelompok Pembinaan
                                        </h4>
                                        <form id="bulk-delete-form" action="" method="post">
                                            <a href="#" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#jenisAlat">
                                                Buat Baru
                                            </a>
                                            <button class="btn btn-danger text-white" type="button" onclick="">
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
                                                                Nama Kelompok Pembinaan
                                                            </th>
                                                            <th>
                                                                Nama Bidang
                                                            </th>
                                                            <th>
                                                                Jenis Personil
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($kelompok_pembinaan as $pembinaan) : ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" id="check" name="id[]" value="" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                                                                </td>
                                                                <td>
                                                                    <?= $pembinaan['kelompok_pembinaan'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $pembinaan['bidang'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $pembinaan['jenis_personil'] ?>
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
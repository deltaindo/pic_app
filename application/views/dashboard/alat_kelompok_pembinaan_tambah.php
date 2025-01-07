<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="tab-content tab-content-basic">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="row tabel-produk mt-2">
                            <div class="col-lg-8 grid-margin stretch-card">
                                <div class="card">
                                    <form method="post" action="<?= base_url('dashboard/simpan_alat_kelompok_pembinaan'); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                Tambah Alat Kelompok Pembinaan
                                            </h4>

                                            <label for="kelompok_pembinaan" class="text-primary fs-6 mb-1">
                                                Nama Kelompok Pembinaan
                                            </label>
                                            <div class="mb-3">
                                                <select class="form-control" name="kelompok_pembinaan">
                                                    <option selected>Pilih Kelompok Pembinaan...</option>
                                                    <?php foreach ($kelompok_pembinaan as $pembinaan) : ?>
                                                        <option value="<?= $pembinaan['id'] ?>"><?= $pembinaan['kelompok_pembinaan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <label for="jenis_alat" class="text-primary fs-6 mb-1">
                                                Jenis Alat
                                            </label>
                                            <div class="mb-3">
                                                <select class="form-control" name="jenis_alat">
                                                    <option selected>Pilih Jenis Alat...</option>
                                                    <?php foreach ($jenis_alat as $alat) : ?>
                                                        <option value="<?= $alat['id'] ?>"><?= $alat['jenis_alat'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('dashboard/alat_kelompok_pembinaan'); ?>" class="btn btn-outline-secondary text-black">
                                                Kembali
                                            </a>
                                            <button type="submit" class="btn btn-primary text-white">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
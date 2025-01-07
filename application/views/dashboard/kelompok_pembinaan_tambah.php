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
                                    <form method="post" action="<?= base_url('dashboard/simpan_kelompok_pembinaan'); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                Tambah Kelompok Pembinaan
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

                                            <label for="nama_bidang" class="text-primary fs-6 mb-1">
                                                Nama Bidang
                                            </label>
                                            <div class="mb-3">
                                                <select class="form-control" name="nama_bidang">
                                                    <option selected>Pilih Nama Bidang...</option>
                                                    <?php foreach ($bidangs as $bidang) : ?>
                                                        <option value="<?= $bidang['id'] ?>"><?= $bidang['bidang'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <label for="jenis_personil" class="text-primary fs-6 mb-1">
                                                Nama Jenis Personil
                                            </label>
                                            <div class="mb-3">
                                                <select class="form-control" name="jenis_personil">
                                                    <option selected>Pilih Jenis Personil...</option>
                                                    <?php foreach ($jenis_personil as $personil) : ?>
                                                        <option value="<?= $personil['id'] ?>"><?= $personil['jenis_personil'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('dashboard/kelompok_pembinaan'); ?>" class="btn btn-outline-secondary text-black">
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
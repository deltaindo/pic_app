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
                                    <form method="post" action="<?= base_url('dashboard/simpan_bidang_personil'); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                Tambah Bidang Personil
                                            </h4>

                                            <label for="bidang_personil" class="text-primary fs-6 mb-1">
                                                Nama Bidang Personil
                                            </label>
                                            <div class="mb-3">
                                                <select class="form-control" name="bidang_personil">
                                                    <option selected>Pilih Bidang Personil...</option>
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
                                                    <option selected>Pilih Nama Bidang...</option>
                                                    <?php foreach ($jenis_personil as $personil) : ?>
                                                        <option value="<?= $personil['id'] ?>"><?= $personil['jenis_personil'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('dashboard/bidang_personil'); ?>" class="btn btn-outline-secondary text-black">
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
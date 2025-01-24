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
                                    <form method="post" action="<?= base_url('dashboard/update_bidang_jenis_personil/' . $bidang_personil[0]['id']); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                Edit Bidang Jenis Personil
                                            </h4>

                                            <label for="nama_bidang" class="text-primary fs-6 mb-1">
                                                Nama Bidang
                                            </label>
                                            <div class="mb-3">
                                                <select class="form-control" name="nama_bidang">
                                                    <option selected>Pilih Nama Bidang...</option>
                                                    <?php foreach ($bidangs as $bidang) : ?>
                                                        <option value="<?= $bidang['id'] ?>" <?= $bidang['id'] == $bidang_personil[0]['id_bidang'] ? 'selected' : '' ?>>
                                                            <?= $bidang['bidang'] ?>
                                                        </option>
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
                                                        <option value="<?= $personil['id'] ?>" <?= $personil['id'] == $bidang_personil[0]['id_jenis_personil'] ? 'selected' : '' ?>>
                                                            <?= $personil['jenis_personil'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('dashboard/bidang_personil'); ?>" class="btn btn-outline-secondary text-black">
                                                Kembali
                                            </a>
                                            <button type="submit" class="btn btn-primary text-white">
                                                Edit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
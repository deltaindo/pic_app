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
                                    <form method="post" action="<?= base_url('dashboard/simpan_kelas_training'); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                Tambah Kelas Training
                                            </h4>

                                            <label for="nama_training" class="text-primary fs-6 mb-1">
                                                Nama Training
                                            </label>
                                            <div class="mb-3">
                                                <select class="form-control" name="nama_training">
                                                    <option selected>Pilih Nama Training...</option>
                                                    <?php foreach ($trainings as $training) : ?>
                                                        <option value="<?= $training['id'] ?>"><?= $training['Training'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <label for="nama_kelas" class="text-primary fs-6 mb-1">
                                                Nama Kelas
                                            </label>
                                            <div class="mb-3">
                                                <select class="form-control" name="nama_kelas">
                                                    <option selected>Pilih Nama Kelas...</option>
                                                    <?php foreach ($semuakelas as $kelas) : ?>
                                                        <option value="<?= $kelas['id'] ?>"><?= $kelas['kelas'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <label for="tanggal_awal" class="text-primary fs-6 mb-1">
                                                Tanggal Awal
                                            </label>
                                            <div class="mb-3">
                                                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal">
                                            </div>
                                            <label for="tanggal_akhir" class="text-primary fs-6 mb-1">
                                                Tanggal Akhir
                                            </label>
                                            <div class="mb-3">
                                                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                                            </div>

                                            <label for="nama_training" class="text-primary fs-6 mb-1">
                                                Jenis Training
                                            </label>
                                            <div class="mb-3">
                                                <select class="form-control" name="jenis_training">
                                                    <option selected>Pilih Jenis Training...</option>
                                                    <option value="Classical Training">Classical Training</option>
                                                    <option value="Blended Training">Blended Training</option>
                                                    <option value="Online Training">Online Training</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('dashboard/kelas_training'); ?>" class="btn btn-outline-secondary text-black">
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
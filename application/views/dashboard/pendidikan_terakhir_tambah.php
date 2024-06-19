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
                                    <form method="post" action="<?= base_url('dashboard/simpan_pendidikan_terakhir'); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                Tambah Kelas Pendidikan Terakhir
                                            </h4>

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

                                            <label for="nama_pendidikan" class="text-primary fs-6 mb-1">
                                                Pendidikan Terakhir
                                            </label>
                                            <div class="mb-3">
                                                <select class="form-control" name="nama_pendidikan">
                                                    <option selected>Pilih Pendidikan Terakhir...</option>
                                                    <?php foreach ($semuapendidikan as $pendidikan) : ?>
                                                        <option value="<?= $pendidikan['id'] ?>"><?= $pendidikan['pendidikan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('dashboard/kelas_pendidikan_terakhir'); ?>" class="btn btn-outline-secondary text-black">
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
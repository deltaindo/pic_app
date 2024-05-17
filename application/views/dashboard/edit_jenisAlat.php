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
                                    <form method="post" action="<?= base_url('dashboard/update_jenis_alat/' . $jenis_alat[0]['id']); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">Edit Jenis Alat</h4>
                                            <label for="jenis_alat" class="text-primary fs-6 mb-1">
                                                Jenis Alat
                                            </label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="jenis_alat" placeholder="Inputkan Jenis Alat" value="<?= $jenis_alat[0]['jenis_alat'] ?>" autofocus>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('dashboard/jenis_alat'); ?>" class="btn btn-outline-secondary text-black">
                                                Kembali
                                            </a>
                                            <button type="submit" class="btn btn-primary text-white">
                                                Buat
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
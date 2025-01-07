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
                                    <form method="post" action="<?= base_url('dashboard/update_sertifikat_indonesia/' . $sertifikat_indonesia[0]['id']); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">Edit Sertifikat Indonesia</h4>
                                            <label for="nama_sertifikat_indonesia" class="text-primary fs-6 mb-1">
                                                Nama Sertifikat Indonesia
                                            </label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="nama_sertifikat_indonesia" name="nama_sertifikat_indonesia" value="<?= $sertifikat_indonesia[0]['sertifikat_indonesia'] ?>" placeholder="Inputkan Sertifikat Indonesia" autofocus>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('dashboard/sertifikat_indonesia'); ?>" class="btn btn-outline-secondary text-black">
                                                Kembali
                                            </a>
                                            <button type="submit" class="btn btn-primary text-white">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
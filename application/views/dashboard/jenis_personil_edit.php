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
                                    <form method="post" action="<?= base_url('dashboard/updateJenisPersonil/' . $personil[0]['id']) ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">Edit Jenis Personil</h4>
                                            <label for="nama_jenis_personil" class="text-primary fs-6 mb-1">
                                                Nama Jenis Personil
                                            </label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="nama_jenis_personil" value="<?= $personil[0]['jenis_personil'] ?>" placeholder="Inputkan Nama Jenis Personil" value="" autofocus>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('dashboard/jenis_personil'); ?>" class="btn btn-outline-secondary text-black">
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
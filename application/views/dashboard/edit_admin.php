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
                                    <form method="post" action="<?= base_url('dashboard/update_admin/' . $admin[0]['id']); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">Edit Admin</h4>
                                            <label for="admin_name" class="text-primary fs-6 mb-1">
                                                Nama
                                            </label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="admin_name" value="<?= $admin[0]['nama'] ?>" placeholder="Inputkan Admin Name" autofocus>
                                            </div>
                                            <label for="email_admin" class="text-primary fs-6 mb-1">
                                                Email
                                            </label>
                                            <div class="mb-3">
                                                <input type="email" class="form-control" id="email_admin" aria-describedby="email_admin" name="email_admin" value="<?= $admin[0]['email'] ?>" placeholder="Input Email Admin" autocomplete="off">
                                            </div>
                                            <label for="mobilephone_admin" class="text-primary fs-6 mb-1">
                                                Mobilephone
                                            </label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="mobilephone_admin" aria-describedby="mobilephone_admin" value="<?= $admin[0]['phone_number'] ?>" name="mobilephone_admin" placeholder="Input Mobilephone Admin" autocomplete="off">
                                            </div>
                                            <label for="password_admin" class="text-primary fs-6 mb-1">
                                                Password
                                            </label>
                                            <div class="mb-3">
                                                <input type="password" class="form-control" id="password_admin" aria-describedby="password_admin" name="password_admin" placeholder="Input Password Admin" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('dashboard/list_admin'); ?>" class="btn btn-outline-secondary text-black">
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
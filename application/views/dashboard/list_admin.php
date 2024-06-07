<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    </div>
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"></div>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="row tabel-produk mt-2">
                            <div class="col-lg-10 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            Daftar List Admin
                                        </h4>
                                        <form id="bulk-delete-form" action="<?= base_url('dashboard/delete_bulk_data_admin'); ?>" method="post">
                                            <a href="#" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#addAdmin">
                                                Buat Baru
                                            </a>
                                            <button class="btn btn-danger text-white" type="button" onclick="deleteBulkDataAdmin()">
                                                Hapus
                                            </button>

                                            <div class="table-responsive">
                                                <table class="table table-striped" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" id="check-all" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                                                            </th>
                                                            <th>
                                                                Name
                                                            </th>
                                                            <th>
                                                                Email
                                                            </th>
                                                            <th>
                                                                Mobilephone
                                                            </th>
                                                            <th>
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($admins as $admin) : ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" id="check" name="id[]" value="<?= $admin['id'] ?>" class="form-check-input check" aria-checked="false" /><i class="input-helper"></i>
                                                                </td>
                                                                <td>
                                                                    <?= $admin['nama'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $admin['email'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $admin['phone_number'] ?>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('/dashboard/edit_admin/' . $admin["id"]); ?>" class="btn btn-lg btn-outline-primary">
                                                                        Edit
                                                                    </a>
                                                                    <button class="btn btn-lg btn-danger" type="button" onclick="deleteAdmin(<?= $admin['id']; ?>)">
                                                                        Hapus
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- Modal -->
    <div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="addAdminLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminLabel">
                        Tambah Admin
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?= base_url('dashboard/admin_simpan'); ?>">
                    <div class="modal-body">
                        <label for="nama_admin" class="text-primary fs-6 mb-1">
                            Name
                        </label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name_admin" aria-describedby="name_admin" name="name_admin" autocomplete="off">
                        </div>
                        <label for="email_admin" class="text-primary fs-6 mb-1">
                            Email
                        </label>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email_admin" aria-describedby="email_admin" name="email_admin" autocomplete="off">
                        </div>
                        <label for="mobilephone_admin" class="text-primary fs-6 mb-1">
                            Mobilephone
                        </label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="mobilephone_admin" aria-describedby="mobilephone_admin" name="mobilephone_admin" autocomplete="off">
                        </div>
                        <label for="password_admin" class="text-primary fs-6 mb-1">
                            Password
                        </label>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password_admin" aria-describedby="password_admin" name="password_admin" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Buat
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>
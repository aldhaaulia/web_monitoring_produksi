<?php

$this->load->view('Backend/Parts/header');
$this->load->view('Backend/Parts/navbar_main');
$this->load->view('Backend/Parts/sidebar');

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    </ol>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">List User</h5>
                        </div>
                        <div class="card-body">

                            <button data-toggle="modal" data-target="#addUserModel" id="add_user" data-item="" type="button" class="btn btn-primary mb-4">Add User</button>

                            <div class="table-responsive">
                                <table class="table" id="tbl_dashboard" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No.</th>
                                            <th style="text-align: center;">Nama</th>
                                            <th style="text-align: center;">Role</th>
                                            <th style="text-align: center;">Email</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($user as $data) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $no; ?>.</td>
                                                <td style="text-align: center;"><?php echo $data['nama'] ?></td>
                                                <td style="text-align: center;"><?php echo $data['role'] ?></td>
                                                <td style="text-align: center;"><?php echo $data['email'] ?></td>
                                                <td style="text-align: center;">
                                                    <button data-toggle="modal" data-target="#resPassModal" id="resPassword" data-item="<?= $data['id'] ?>" type="button" class="btn btn-success">Reset Password</button>
                                                    <button data-toggle="modal" data-target="#deleteModal" id="deleteUser" data-item="<?= $data['id'] ?>" type="button" class="btn btn-warning">Hapus User</button>
                                                </td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Reset Password Modal-->
<div class="modal fade" id="resPassModal" tabindex="-1" role="dialog" aria-labelledby="resPassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resPassModalLabel">Reset Password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="frm_respass" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="res_id_akun" name="id_akun" value="" />
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input class="form-control" id="new_password" type="password" name="new_password" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id="res_save_pass" class="btn btn-primary" type="button" data-dismiss="modal">Simpan Password</button>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal-->
<div class="modal fade" id="addUserModel" tabindex="-1" role="dialog" aria-labelledby="addUserModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModelLabel">Add New User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="frm_user" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama User</label>
                            <input class="form-control" id="nama_user" type="text" name="nama_user" />
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" id="role" name="role">
                                <option hidden>Pilih Role</option>;
                                <?php foreach ($role as $row) : ?>
                                    <option value="<?= $row['id_role'] ?>"><?= $row['nama'] ?></option>;
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" id="email_user" type="email" name="email_user" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" id="password_user" type="password" name="password_user" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id="save_user" class="btn btn-primary" type="button" data-dismiss="modal">Save User</button>
            </div>
        </div>
    </div>
</div>

<!-- delete User Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Warning</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="frm_del" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="del_id_akun" name="id_akun" value="" />
                    </form>
                    <h4>Are you sure want to delete this account ?</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button id="delete_user" class="btn btn-primary" type="button" data-dismiss="modal">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('Backend/Parts/footer'); ?>

<script>
    $(document).ready(function() {
        $(document).on("click", "#resPassword", function() {
            var id_akun = $(this).data('item');
            // console.log(id_akun);
            $('#res_id_akun').val(id_akun);
        });

        $(document).on("click", "#deleteUser", function() {
            var id_akun = $(this).data('item');
            // console.log(id_akun);
            $('#del_id_akun').val(id_akun);
        });
    });

    $('#res_save_pass').click(function() {
        var link_Save = '<?= base_url() . 'user/resetpassword' ?>';

        var form = $('#frm_respass');
        var data = form.serializeArray();
        console.log(data);
        var formHtml = form[0];
        var NewData = new FormData(formHtml);

        $.ajax({
            url: link_Save,
            type: "POST",
            data: NewData,
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false
        }).done(function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.msg,
                });
                $('#res_id_akun').val('');
                $('#new_password').val('');
                // location.reload();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: response.msg,
                });
            }
        });
    });

    $('#save_user').click(function() {
        var link_Save = '<?= base_url() . 'user/saveuser' ?>';

        var form = $('#frm_user');
        var data = form.serializeArray();
        console.log(data);
        var formHtml = form[0];
        var NewData = new FormData(formHtml);

        var nama = $('#nama_user').val();
        var role = $('#role').val();
        var email = $('#email_user').val();
        var password = $('#password_user').val();

        var is_valid = false;

        if (nama != '' && role != '' && email != '' && password != '') {
            is_valid = true;
        } else {
            is_valid = false;
        }

        if (is_valid) {
            $.ajax({
                url: link_Save,
                type: "POST",
                data: NewData,
                dataType: "JSON",
                contentType: false,
                cache: false,
                processData: false
            }).done(function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.msg,
                    });
                    $('#nama_user').val('');
                    $('#role').val('');
                    $('#email_user').val('');
                    $('#password_user').val('');
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.msg,
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Pastikan Form Terisi',
            });
        }

    });

    $('#delete_user').click(function() {
        var link_Save = '<?= base_url() . 'user/delete' ?>';

        var form = $('#frm_del');
        var data = form.serializeArray();
        console.log(data);
        var formHtml = form[0];
        var NewData = new FormData(formHtml);

        $.ajax({
            url: link_Save,
            type: "POST",
            data: NewData,
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false
        }).done(function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.msg,
                });
                $('#res_id_akun').val('');
                $('#new_password').val('');
                location.reload();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: response.msg,
                });
            }
        });
    });
</script>
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
                    <h1 class="m-0">Project</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Project</li>
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
                            <h5 class="card-title">Detail Project</h5>
                        </div>
                        <div class="card-body">
                            <form class="form" method="post" id="frm_project">

                                <div class="form-group row">
                                    <label for="project_id" class="col-sm-2 col-form-label">Project ID</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="project_id" name="project_id" placeholder="Project ID" value="<?= $project['kd_proj'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="project_date" class="col-sm-2 col-form-label">Project Due Date</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="project_date" name="project_date" placeholder="Project Due Date" value="<?= date("d-m-Y", strtotime($project['date_project'])) ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_cust" class="col-sm-2 col-form-label">Nama Customer</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="nama_cust" placeholder="Ketik untuk cari Customer Name" value="<?= $project['nama_cust'] ?>" readonly>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Detail Barang</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="tbl_detail" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No.</th>
                                            <th style="text-align: center;">Project ID</th>
                                            <th style="text-align: center;">Jenis Barang</th>
                                            <th style="text-align: center;">Nama Barang</th>
                                            <th style="text-align: center;">Ukuran</th>
                                            <th style="text-align: center;">Warna</th>
                                            <th style="text-align: center;">Keterangan</th>
                                            <th style="text-align: center;">Status Pengerjaan</th>
                                            <th style="text-align: center;">Status Pengecekan</th>
                                            <th style="text-align: center;">Dokumentasi</th>
                                            <th style="text-align: center;">Last Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($project_dtl as $row) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $no; ?>.</td>
                                                <td style="text-align: center;"><?= $row['kd_proj'] ?></td>
                                                <td style="text-align: center;"><?= $row['jenis_barang'] ?></td>
                                                <td style="text-align: center;"><?= $row['nama_barang'] ?></td>
                                                <td style="text-align: center;"><?= $row['ukuran'] ?></td>
                                                <td style="text-align: center;"><?= $row['warna'] ?></td>
                                                <td style="text-align: center;"><?= $row['keterangan'] ?></td>
                                                <td style="text-align: center;"><?= $row['status_produksi'] ?></td>
                                                <td style="text-align: center;"><?= $row['stat'] ?></td>
                                                <td style="text-align: center;"><?= $row['doc'] ?></td>
                                                <td style="text-align: center;"><?= date("d-m-Y", strtotime($row['last_update'])) ?></td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <!-- <button type="button" class="btn btn-primary" id="btn_print">Cetak Laporan</button> -->
                                <form action="<?php echo site_url('dashboard/cetakProject') ?>" class="form" method="post" id="frm_cetak">
                                    <input type="hidden" class="form-control" id="id_proj" name="id_proj" placeholder="id_proj" value="<?= $project['id_project'] ?>">

                                    <input id="cetak_project" class="btn btn-primary" type="submit" name="btn" value="Cetak Surat Jalan" />
                                </form>
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

<!-- Modal Preview Berkas -->
<div class="modal fade" id="berkasModal" tabindex="-1" role="dialog" aria-labelledby="berkasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="berkasModalLabel">Dokumentasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align : center">
                <img id="viewIMG" src="<?= base_url('assets/backend/uploads/'); ?>" width="100%" height="500">>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('Backend/Parts/footer'); ?>

<script>
    $(document).ready(function() {
        $(document).on("click", "#imgView", function() {
            var file_photo = $(this).data('item');
            // console.log(id_akun);
            $('#viewIMG').attr('src', '<?= base_url('assets/backend/uploads/'); ?>' + file_photo)
        });
    });
</script>
<?php

$this->load->view('Backend/Parts/header');
$this->load->view('Backend/Parts/navbar_main');
$this->load->view('Backend/Parts/sidebar');
 
?>

    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Report</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="tbl_report" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No.</th>
											<th style="text-align: center;">Customer Name</th>
											<th style="text-align: center;">Project Id</th>
											<th style="text-align: center;">Customer Id </th>
											<th style="text-align: center;">Project Date</th>
											<th style="text-align: center;">Deadline</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($project as $row) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $no; ?>.</td>
                                                <td style="text-align: center;"><?= $row['nama_cust'] ?></td>
                                                <td style="text-align: center;"><?= $row['kd_proj'] ?></td>
                                                <td style="text-align: center;"><?= $row['kd_cust'] ?></td>
                                                <td style="text-align: center;"><?= date("d-m-Y", strtotime($row['date_project'])) ?></td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

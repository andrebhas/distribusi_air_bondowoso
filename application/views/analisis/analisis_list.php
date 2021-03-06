<?php 
    $ci =& get_instance();
    $ci->load->model('Survey_model');
    $ci->load->model('Users_model');
    $ci->load->model('Subkriteria_model');
?>

<script src="<?php echo base_url('assets/js/plugins/tables/datatables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/tables/datatables/extensions/responsive.min.js') ?>"></script>

<div class="content ">

     <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Tabel Alternatif</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body table-responsive"> 

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Nama Desa</th>
                        <th>Lokasi Kekeringan</th>
                        <th>S1</th>
                        <th>S2</th>
                        <th>S3</th>
                        <th>S4</th>
                        <th>S5</th>
                        <th>S6</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $start = 0;
                foreach ($survey_detail_data as $survey_detail)
                {
            ?>
                    <tr>
                        <td><?php echo $survey_detail->nama_desa?></td>
                        <td><?php echo $survey_detail->lokasi_kekeringan ?></td>
                        <td><?php echo $survey_detail->k1 ?></td>
                        <td><?php echo $survey_detail->k2 ?></td>
                        <td><?php echo $survey_detail->k3 ?></td>
                        <td><?php echo $survey_detail->k4 ?></td>
                        <td><?php echo $survey_detail->k5 ?></td>
                        <td><?php echo $survey_detail->k6 ?></td>
                    </tr>
            <?php
                }
            ?>
                    <tr class="bg-warning">
                        <td colspan="2" class="text-center"> MIN </td>
                        <td><?= $nilai_min->s1 ?></td>
                        <td><?= $nilai_min->s2 ?></td>
                        <td><?= $nilai_min->s3 ?></td>
                        <td><?= $nilai_min->s4 ?></td>
                        <td><?= $nilai_min->s5 ?></td>
                        <td><?= $nilai_min->s6 ?></td>
                    </tr>
                    <tr class="bg-success">
                        <td colspan="2" class="text-center">MAX</td>
                        <td><?= $nilai_max->s1 ?></td>
                        <td><?= $nilai_max->s2 ?></td>
                        <td><?= $nilai_max->s3 ?></td>
                        <td><?= $nilai_max->s4 ?></td>
                        <td><?= $nilai_max->s5 ?></td>
                        <td><?= $nilai_max->s6 ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>   
 


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Tabel Normalisasi</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body table-responsive"> 

            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Nama Desa</th>
                        <th>Lokasi Kekeringan</th>
                        <th>S1</th>
                        <th>S2</th>
                        <th>S3</th>
                        <th>S4</th>
                        <th>S5</th>
                        <th>S6</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $start = 0;
                foreach ($normalisasi as $nsi)
                {
            ?>
                    <tr>
                        <td><?php echo $nsi->nama_desa?></td>
                        <td><?php echo $nsi->lokasi_kekeringan ?></td>
                        <td><?php echo number_format((double)$nsi->s1, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$nsi->s2, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$nsi->s3, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$nsi->s4, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$nsi->s5, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$nsi->s6, 4, '.', ''); ?></td>
                    </tr>
            <?php
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">Prioritas </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body table-responsive">     
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Nama Desa</th>
                        <th>Lokasi Kekeringan</th>
                        <th>S1</th>
                        <th>S2</th>
                        <th>S3</th>
                        <th>S4</th>
                        <th>S5</th>
                        <th>S6</th>
                        <th>Total</th>
                        <th>Prioritas</th>
                        <th>Tanggal Droping Air</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $start2 = 0;
                $i= 0;
                foreach ($hasil_analisis as $ha)
                {
            ?>
                    <tr>
                        <td><?php echo $ha->nama_desa?></td>
                        <td><?php echo $ha->lokasi_kekeringan ?></td>
                        <td><?php echo number_format((double)$ha->s1, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$ha->s2, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$ha->s3, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$ha->s4, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$ha->s5, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$ha->s6, 4, '.', ''); ?></td>
                        <td><?php echo number_format((double)$ha->total, 4, '.', ''); ?></td>
                        <td><?php echo ++$start2 ?></td>
                        <td width="130"> <?php echo $tgl_drop[$i]; $i++ ?> </td>
                    </tr>
            <?php
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>



</div>
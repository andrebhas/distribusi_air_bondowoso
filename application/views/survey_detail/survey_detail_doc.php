<?php 
    $ci =& get_instance();
?>

<!doctype html>
<html>
    <head>
        <title>Developer Tool | Andre Bhaskoro</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Survey_detail List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Survey</th>
		<th>Id User</th>
		<th>Nama Desa</th>
		<th>Lokasi Kekeringan</th>
		<th>K1</th>
		<th>K2</th>
		<th>K3</th>
		<th>K4</th>
		<th>K5</th>
		<th>K6</th>
		
            </tr><?php
            foreach ($survey_detail_data as $survey_detail)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $survey_detail->id_survey ?></td>
		      <td><?php echo $survey_detail->id_user ?></td>
		      <td><?php echo $survey_detail->nama_desa ?></td>
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
        </table>
    </body>
</html>
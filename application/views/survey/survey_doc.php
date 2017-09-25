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
        <h2>Survey List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Provinsi</th>
		<th>Kab Kota</th>
		<th>Kecamatan</th>
		<th>Tahun</th>
		<th>Status</th>
		
            </tr><?php
            foreach ($survey_data as $survey)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $survey->id_provinsi ?></td>
		      <td><?php echo $survey->kab_kota ?></td>
		      <td><?php echo $survey->kecamatan ?></td>
		      <td><?php echo $survey->tahun ?></td>
		      <td><?php echo $survey->status ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
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
        <h2>Kriteria List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Kriteria</th>
		<th>Bobot Kriteria</th>
		<th>Bobot Kriteria Persen</th>
		
            </tr><?php
            foreach ($kriteria_data as $kriteria)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kriteria->nama_kriteria ?></td>
		      <td><?php echo $kriteria->bobot_kriteria ?></td>
		      <td><?php echo $kriteria->bobot_kriteria_persen ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
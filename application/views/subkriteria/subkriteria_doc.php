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
        <h2>Subkriteria List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Kriteria</th>
		<th>Nama Subkriteria</th>
		<th>Bobot Subkriteria Persen</th>
		<th>Bobot Subkriteria</th>
		<th>W</th>
		
            </tr><?php
            foreach ($subkriteria_data as $subkriteria)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $subkriteria->id_kriteria ?></td>
		      <td><?php echo $subkriteria->nama_subkriteria ?></td>
		      <td><?php echo $subkriteria->bobot_subkriteria_persen ?></td>
		      <td><?php echo $subkriteria->bobot_subkriteria ?></td>
		      <td><?php echo $subkriteria->w ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
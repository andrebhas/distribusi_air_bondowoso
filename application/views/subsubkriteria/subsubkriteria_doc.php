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
        <h2>Subsubkriteria List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Subkriteria</th>
		<th>Deskripsi</th>
		<th>Nilai</th>
		
            </tr><?php
            foreach ($subsubkriteria_data as $subsubkriteria)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $subsubkriteria->id_subkriteria ?></td>
		      <td><?php echo $subsubkriteria->deskripsi ?></td>
		      <td><?php echo $subsubkriteria->nilai ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
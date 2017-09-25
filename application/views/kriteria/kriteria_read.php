<?php 
    $ci =& get_instance();
?>

<div class="content">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Kriteria Detail</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 
        
            <table class="table">
				<tr>
                    <td>Nama Kriteria</td><td><?php echo $nama_kriteria; ?></td>
                </tr>
				<tr>
                    <td>Bobot Kriteria</td><td><?php echo $bobot_kriteria; ?></td>
                </tr>
				<tr>
                    <td>Bobot Kriteria Persen</td><td><?php echo $bobot_kriteria_persen; ?></td>
                </tr>
				<tr>
                    <td><a href="<?php echo site_url('kriteria') ?>" class="btn btn-primary">Back</a></td><td></td>
                </tr>
			</table>
       
       </div>

    </div>
</div>
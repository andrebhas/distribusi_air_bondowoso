<?php 
    $ci =& get_instance();
?>

<div class="content">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Subkriteria Detail</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 
        
            <table class="table">
				<tr>
                    <td>Kriteria</td><td><?php echo $kriteria->nama_kriteria; ?></td>
                </tr>
				<tr>
                    <td>Nama Subkriteria</td><td><?php echo $nama_subkriteria; ?></td>
                </tr>
				<tr>
                    <td>Bobot Subkriteria Persen</td><td><?php echo $bobot_subkriteria_persen; ?></td>
                </tr>
				<tr>
                    <td>Bobot Subkriteria</td><td><?php echo $bobot_subkriteria; ?></td>
                </tr>
				<tr>
                    <td>W</td><td><?php echo $w; ?></td>
                </tr>
				<tr>
                    <td><a href="<?php echo site_url('subkriteria/detail/'.$kriteria->id_kriteria) ?>" class="btn btn-primary">Back</a></td><td></td>
                </tr>
			</table>
       
       </div>

    </div>
</div>
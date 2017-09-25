<?php 
    $ci =& get_instance();
?>

<div class="content">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Survey_detail Detail</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 
        
            <table class="table">
				<tr>
                    <td>Id Survey</td><td><?php echo $id_survey; ?></td>
                </tr>
				<tr>
                    <td>Id User</td><td><?php echo $id_user; ?></td>
                </tr>
				<tr>
                    <td>Nama Desa</td><td><?php echo $nama_desa; ?></td>
                </tr>
				<tr>
                    <td>Lokasi Kekeringan</td><td><?php echo $lokasi_kekeringan; ?></td>
                </tr>
				<tr>
                    <td>K1</td><td><?php echo $k1; ?></td>
                </tr>
				<tr>
                    <td>K2</td><td><?php echo $k2; ?></td>
                </tr>
				<tr>
                    <td>K3</td><td><?php echo $k3; ?></td>
                </tr>
				<tr>
                    <td>K4</td><td><?php echo $k4; ?></td>
                </tr>
				<tr>
                    <td>K5</td><td><?php echo $k5; ?></td>
                </tr>
				<tr>
                    <td>K6</td><td><?php echo $k6; ?></td>
                </tr>
				<tr>
                    <td><a href="<?php echo site_url('survey_detail') ?>" class="btn btn-primary">Back</a></td><td></td>
                </tr>
			</table>
       
       </div>

    </div>
</div>
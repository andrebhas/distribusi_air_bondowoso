<?php 
    $ci =& get_instance();
?>

<div class="content">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Subsubkriteria Detail</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 
        
            <table class="table">
				<tr>
                    <td>Id Subkriteria</td><td><?php echo $id_subkriteria; ?></td>
                </tr>
				<tr>
                    <td>Deskripsi</td><td><?php echo $deskripsi; ?></td>
                </tr>
				<tr>
                    <td>Nilai</td><td><?php echo $nilai; ?></td>
                </tr>
				<tr>
                    <td><a href="<?php echo site_url('subsubkriteria') ?>" class="btn btn-primary">Back</a></td><td></td>
                </tr>
			</table>
       
       </div>

    </div>
</div>
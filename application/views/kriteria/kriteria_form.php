<?php 
    $ci =& get_instance();;
?>

<div class="content">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Form <?php echo $button ?> Kriteria</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 

            <form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
                    <label for="varchar">Nama Kriteria <?php echo form_error('nama_kriteria') ?></label>
                    <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" placeholder="Nama Kriteria" value="<?php echo $nama_kriteria; ?>" />
                </div>
				<div class="form-group">
                    <label for="int">Bobot %<?php echo form_error('bobot_kriteria_persen') ?></label>
                    <input type="text" class="form-control" name="bobot_kriteria_persen" id="bobot_kriteria_persen" value="<?php echo $bobot_kriteria_persen; ?>" />
                </div>
                <div class="form-group">
                    <label for="double">Bobot Desimal <?php echo form_error('bobot_kriteria') ?></label>
                    <input readonly="read only" type="text" class="form-control" name="bobot_kriteria" id="bobot_kriteria" value="<?php echo $bobot_kriteria; ?>" />
                </div>
				<input type="hidden" name="id_kriteria" value="<?php echo $id_kriteria; ?>" /> 
				<button type="submit" class="btn btn-success"><?php echo $button ?></button> 
				<a href="<?php echo site_url('kriteria') ?>" class="btn btn-default">Cancel</a>
			</form>
        
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#bobot_kriteria_persen').change(function() {
        var persen = $(this).val();
        var desimal = persen/100;
        $('#bobot_kriteria').val(desimal);
    });
</script>
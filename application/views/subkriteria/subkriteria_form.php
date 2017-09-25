<?php 
    $ci =& get_instance();;
?>

<div class="content">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Form <?php echo $button ?> Subkriteria</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 

            <form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
                    <label for="int">Kriteria <?php echo form_error('id_kriteria') ?></label>
                    <select readonly="readonly" class="form-control" name="id_kriteria" id="id_kriteria" >
                        <option value="<?php echo $id_kriteria; ?>" selected> <?= $kriteria->nama_kriteria ?></option>
                    </select>
                </div>
				<div class="form-group">
                    <label for="varchar">Nama Subkriteria <?php echo form_error('nama_subkriteria') ?></label>
                    <input type="text" class="form-control" name="nama_subkriteria" id="nama_subkriteria" placeholder="Nama Subkriteria" value="<?php echo $nama_subkriteria; ?>" />
                </div>
				<div class="form-group">
                    <label for="int">Bobot % <?php echo form_error('bobot_subkriteria_persen') ?></label>
                    <input type="text" class="form-control" name="bobot_subkriteria_persen" id="bobot_subkriteria_persen" value="<?php echo $bobot_subkriteria_persen; ?>" />
                </div>
				<div class="form-group">
                    <label for="double">Bobot Desimal <?php echo form_error('bobot_subkriteria') ?></label>
                    <input readonly="readonly" type="text" class="form-control" name="bobot_subkriteria" id="bobot_subkriteria" value="<?php echo $bobot_subkriteria; ?>" />
                </div>
				<div class="form-group">
                    <label for="double">Weight = <?php echo form_error('w') ?> Bobot Desimal Kriteria x Bobot Desimal Subriteria = ( <?= $kriteria->bobot_kriteria ?>) x ( <span id="bobot_sub_d"></span> )</label>
                    <input readonly="readonly" type="text" class="form-control" name="w" id="w" value="<?php echo $w; ?>" />
                </div>
				<input type="hidden" name="id_subkriteria" value="<?php echo $id_subkriteria; ?>" /> 
				<button type="submit" class="btn btn-success"><?php echo $button ?></button> 
				<a href="<?php echo site_url('subkriteria/detail/'.$kriteria->id_kriteria) ?>" class="btn btn-default">Cancel</a>
			</form>
        
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#bobot_subkriteria_persen').change(function() {
        var persen = $(this).val();
        var desimal = persen/100;
        var kriteria = <?= $kriteria->bobot_kriteria ?>;
        var weight = desimal * kriteria;
        $('#bobot_subkriteria').val(desimal);
        $('#bobot_sub_d').text(desimal);
        $('#w').val(weight);
    });
</script>
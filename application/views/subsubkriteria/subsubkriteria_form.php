<?php 
    $ci =& get_instance();;
?>

<div class="content">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Form <?php echo $button ?> Subsubkriteria</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 

            <form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
                    <label for="int">Subkriteria<?php echo form_error('id_subkriteria') ?></label>
                    <select readonly="readonly" class="form-control" name="id_subkriteria" id="id_subkriteria" selected>
                        <option value="<?php echo $subkriteria->id_subkriteria; ?>"><?= $subkriteria->nama_subkriteria ?></option>
                    </select>
                </div>
				<div class="form-group">
                    <label for="varchar">Deskripsi<?php echo form_error('deskripsi') ?></label>
                    <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="<?php echo $deskripsi; ?>" />
                </div>
				<div class="form-group">
                    <label for="int">Nilai <?php echo form_error('nilai') ?></label>
                    <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Nilai" value="<?php echo $nilai; ?>" />
                </div>
				<input type="hidden" name="id_subsubkriteria" value="<?php echo $id_subsubkriteria; ?>" /> 
				<button type="submit" class="btn btn-success"><?php echo $button ?></button> 
				<a href="<?php echo site_url('subsubkriteria/detail/'.$subkriteria->id_subkriteria) ?>" class="btn btn-default">Cancel</a>
			</form>
        
        </div>
    </div>
</div>
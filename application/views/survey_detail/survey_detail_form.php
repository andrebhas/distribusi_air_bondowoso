<?php 
    $ci =& get_instance();
    $ci->load->model('Subsubkriteria_model');
    $jarak_tempuh = $ci->Subsubkriteria_model->get_by_id_sub(1);
    $curah_hujan = $ci->Subsubkriteria_model->get_by_id_sub(2);
    $elevasi_air = $ci->Subsubkriteria_model->get_by_id_sub(3);
    $tekstur_tanah = $ci->Subsubkriteria_model->get_by_id_sub(4);
    $jumlah_penduduk = $ci->Subsubkriteria_model->get_by_id_sub(5);
    $kebutuhan_air = $ci->Subsubkriteria_model->get_by_id_sub(6);

?>

<div class="content">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Form Data Survey</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 

            <form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
                    <label for="int">Pilih Desa <?php echo form_error('nama_desa') ?></label>
                    <select class="form-control" name="nama_desa" id="nama_desa">
                    <?php if ($desa): ?>
                        <?php foreach ($desa as $ds): ?>
                            <option value="<?= $ds->name ?>" <?php if ($ds->id == $nama_desa): ?>selected <?php endif ?>> <?= $ds->name ?></option>
                        <?php endforeach ?>
                        <?php $disable = '' ?>
                    <?php else: ?>
                        <?php $disable = 'disabled = "disabled"' ?>
                        <option value="" <?= $disable ?> selected > Semua Desa Sudah Di Survey</option>
                    <?php endif ?>
                        
                    </select>
                </div>
				<div class="form-group">
                    <label >Lokasi Kekeringan <?php echo form_error('lokasi_kekeringan') ?></label>
                    <input type="text" class="form-control" name="lokasi_kekeringan" id="lokasi_kekeringan" placeholder="Lokasi Kekeringan" value="<?php echo $lokasi_kekeringan; ?>" <?= $disable ?>/>
                </div>


				<div class="form-group">
                    <label for="int">Jarak Tempuh Ke Sumber Air <?php echo form_error('k1') ?></label>
                    <select  class="form-control" name="k1" id="k1" <?= $disable ?>/> >
                        <option value="">Pilih . . .</option>
                        <?php foreach ($jarak_tempuh as $value): ?>
                            <option value="<?= $value->nilai?>"><?= $value->deskripsi?></option>
                        <?php endforeach ?>
                    </select> 
                </div>

				<div class="form-group">
                    <label for="int">Distribusi Curah Hujan Tahunan  <?php echo form_error('k2') ?></label>
                    <select  class="form-control" name="k2" id="k2" <?= $disable ?>/> >
                        <option value="">Pilih . . .</option>
                        <?php foreach ($curah_hujan as $value): ?>
                            <option value="<?= $value->nilai?>"><?= $value->deskripsi?></option>
                        <?php endforeach ?>
                    </select> 
                </div>

				<div class="form-group">
                    <label for="int">Elevasi Air <?php echo form_error('k3') ?></label>
                    <select  class="form-control" name="k3" id="k3"  <?= $disable ?>/> >
                        <option value="">Pilih . . .</option>
                        <?php foreach ($elevasi_air as $value): ?>
                            <option value="<?= $value->nilai?>"><?= $value->deskripsi?></option>
                        <?php endforeach ?>
                    </select> 
                </div>

				<div class="form-group">
                    <label for="int">Tekstur Tanah <?php echo form_error('k4') ?></label>
                    <select  class="form-control" name="k4" id="k4"  <?= $disable ?>/> >
                        <option value="">Pilih . . .</option>
                        <?php foreach ($tekstur_tanah as $value): ?>
                            <option value="<?= $value->nilai?>"><?= $value->deskripsi?></option>
                        <?php endforeach ?>
                    </select> 
                </div>

				<div class="form-group">
                    <label for="int">Jumlah Penduduk <?php echo form_error('k5') ?></label>
                    <select  class="form-control" name="k5" id="k5" <?= $disable ?>/> >
                        <option value="">Pilih . . .</option>
                        <?php foreach ($jumlah_penduduk as $value): ?>
                            <option value="<?= $value->nilai?>"><?= $value->deskripsi?></option>
                        <?php endforeach ?>
                    </select> 
                </div>
				<div class="form-group">
                    <label for="int">Jumlah Kebutuhan Air<?php echo form_error('k6') ?></label>
                     <select  class="form-control" name="k6" id="k6" <?= $disable ?>/> >
                        <option value="">Pilih . . .</option>
                        <?php foreach ($kebutuhan_air as $value): ?>
                            <option value="<?= $value->nilai?>"><?= $value->deskripsi?></option>
                        <?php endforeach ?>
                    </select> 
                </div>
				<input type="hidden" name="id_survey_detail" value="<?php echo $id_survey_detail; ?>" /> 
                <input type="hidden" class="form-control" name="id_survey" id="id_survey" placeholder="Id Survey" value="<?php echo $id_survey; ?>" />
				<button type="submit" class="btn btn-success" <?= $disable ?> ><?php echo $button ?></button> 
				<a href="<?php echo site_url('survey_detail') ?>" class="btn btn-default">Cancel</a>
			</form>
        
        </div>
    </div>
</div>
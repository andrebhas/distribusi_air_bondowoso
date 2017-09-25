<?php 
    $CI =& get_instance();
    $CI->load->model('Survey_model');
?>

<div class="content">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Form <?php echo $button ?> Survey</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body"> 

            <form action="<?php echo $action; ?>" method="post">

				<div class="form-group">
                    <label for="char">Provinsi <?php echo form_error('id_provinsi') ?></label>
                    <select class="form-control" name="id_provinsi" id="id_provinsi" >
                        <option value="">Pilih . . .</option>
                        <?php foreach ($provinsi as $p): ?>
                            <option value="<?= $p->id ?>"
                                <?php if ($id_provinsi == $p->id) {
                                    echo " selected";
                                } ?>
                                > 
                                <?= $p->name ?> 
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

				<div class="form-group">
                    <label for="varchar">Kabupaten / Kota <?php echo form_error('kab_kota') ?></label>
                    <select class="form-control" name="kab_kota" id="kab_kota">
                        <?php if ($kab_kota): ?>
                            <option value="<?= $kab_kota ?>" selcted ><?php $kab = $CI->Survey_model->get_nama_kab($kab_kota); echo $kab->name; ?></option>
                        <?php else: ?>
                            <option value="" >Pilih . . .</option>
                        <?php endif ?>
                    </select>
                </div>

				<div class="form-group">
                    <label for="varchar">Kecamatan <?php echo form_error('kecamatan') ?></label>
                    <select class="form-control" name="kecamatan" id="kecamatan" >
                        <?php if ($kecamatan): ?>
                            <option value="<?= $kecamatan ?>" selcted ><?php $kec = $CI->Survey_model->get_nama_kec($kecamatan); echo $kec->name; ?></option>
                        <?php else: ?>
                            <option value=""> Pilih . . .</option>
                        <?php endif ?>
                    </select>
                </div>
				<div class="form-group">
                    <label for="int">Tahun <?php echo form_error('tahun') ?></label>
                    <select class="form-control" name="tahun" id="tahun">
                        <?php if ($tahun): ?>
                            <option value="<?= $tahun ?>" selected ><?= $tahun ?></option>
                        <?php else: ?>
                            <option value="">Pilih . . .</option>
                        <?php endif ?>
                        <?php 
                            $get_year = date('Y');
                            for ($i=$get_year; $i >= 1945 ; $i--) { 
                        ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php
                            }
                         ?>
                    </select>
                </div>
				<input type="hidden" name="id_survey" value="<?php echo $id_survey; ?>" /> 
				<button type="submit" class="btn btn-success"><?php echo $button ?></button> 
				<a href="<?php echo site_url('survey') ?>" class="btn btn-default">Cancel</a>
			</form>
        
        </div>
    </div>
</div>

<script type="text/javascript">
      jQuery(document).ready(function() {

        $('#id_provinsi').change(function() {
          var id_prov = $(this).val();
          $.ajax({
            url: "<?php echo base_url() ?>/survey/get_kabupaten/"+id_prov,
            type: "POST",
            dataType: "json",
            data: {},
            success: function(data) {
              var len =  data.length;
              $('#kab_kota option').remove();
              for(var i=0;i<len;i++ ){
                  console.log(data[i]);
                  var opt = $('<option />');
                  opt.val(data[i].id);
                  opt.text(data[i].name);
                  $('#kab_kota').append(opt);
              }
            }
          })
        });

        $('#kab_kota').change(function() {
          var kab = $(this).val();
          $.ajax({
            url: "<?php echo base_url() ?>/survey/get_kecamatan/"+kab,
            type: "POST",
            dataType: "json",
            data: {},
            success: function(data) {
              var len =  data.length;
              $('#kecamatan option').remove();
              for(var i=0;i<len;i++ ){
                  console.log(data[i]);
                  var opt = $('<option />');
                  opt.val(data[i].id);
                  opt.text(data[i].name);
                  $('#kecamatan').append(opt);
              }
            }
          })
        });


      });
    </script>
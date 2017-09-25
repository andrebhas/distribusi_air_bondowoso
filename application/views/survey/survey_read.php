<?php 
    $CI =& get_instance();
    $CI->load->model('Survey_model');
?>   

<div class="content">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Survey Detail</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">    

            <table class="table">
				<tr>
                    <td>Provinsi</td><td><?php $provinsi = $CI->Survey_model->get_nama_prov($id_provinsi); echo $provinsi->name;  ?></td>
                </tr>
				<tr>
                    <td>Kabipaten / Kota</td><td><?php $kab = $CI->Survey_model->get_nama_kab($kab_kota); echo $kab->name;  ?></td>
                </tr>
				<tr>
                    <td>Kecamatan</td><td><?php $kec = $CI->Survey_model->get_nama_kec($kecamatan); echo $kec->name;  ?></td>
                </tr>
				<tr>
                    <td>Tahun</td><td><?php echo $tahun; ?></td>
                </tr>
				<tr>
                    <td>Status</td><td><?php echo $status; ?></td>
                </tr>
				<tr>
                    <td><a href="<?php echo site_url('survey') ?>" class="btn btn-primary">Back</a></td><td></td>
                </tr>
			</table>
       
       </div>

    </div>
</div>
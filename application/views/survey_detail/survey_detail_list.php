<?php 
    $ci =& get_instance();
    $ci->load->model('Survey_model');
    $ci->load->model('Users_model');
    $ci->load->model('Subkriteria_model');
?>

<script src="<?php echo base_url('assets/js/plugins/tables/datatables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/tables/datatables/extensions/responsive.min.js') ?>"></script>

<div class="content">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Survey_detail List</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 
            <div class="row">
                <div class="col-md-5 text-left">
                    <?php echo anchor(site_url('survey_detail/create'), '<i class="fa fa-plus-square"></i> Tambah', 'class="btn btn-default btn-xs" data-popup="tooltip-custom" title="tambah data"'); ?>
					<?php echo anchor(site_url('survey_detail/excel'), '<i class="fa fa-file-excel-o"></i>', 'class="btn btn-success btn-xs" data-popup="tooltip-custom" title="export ms.excel"'); ?>
					<?php echo anchor(site_url('survey_detail/word'), '<i class="fa fa-file-word-o"></i>', 'class="btn btn-primary btn-xs"  data-popup="tooltip-custom" title="export ms.word"'); ?>
				</div>
                <div class="col-md-7 text-center">
                    <div style="margin-top: 4px"  id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
            </div>          
            <br>
            <table class="table datatable-responsive table-sm table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="50px">No</th>
						<th>Id Survey</th>
						<th>Nama</th>
						<th>Nama Desa</th>
						<th>Lokasi Kekeringan</th>
						<th>S1</th>
						<th>S2</th>
						<th>S3</th>
						<th>S4</th>
						<th>S5</th>
						<th>S6</th>
						<th>Action</th>
                    </tr>
                </thead>
				<tbody>
            <?php
                $start = 0;
                foreach ($survey_detail_data as $survey_detail)
                {
            ?>
                    <tr>
						<td><?php echo ++$start ?></td>
						<td><?php echo $survey_detail->id_survey ?></td>
						<td><?php echo $ci->Users_model->get_by_id($survey_detail->id_user)->nama  ?></td>
						<td><?php echo $survey_detail->nama_desa?></td>
						<td><?php echo $survey_detail->lokasi_kekeringan ?></td>
						<td><?php echo $survey_detail->k1 ?></td>
						<td><?php echo $survey_detail->k2 ?></td>
						<td><?php echo $survey_detail->k3 ?></td>
						<td><?php echo $survey_detail->k4 ?></td>
						<td><?php echo $survey_detail->k5 ?></td>
						<td><?php echo $survey_detail->k6 ?></td>
						<td style="text-align:center" width="200px">
						<?php 
							echo anchor(site_url('survey_detail/read/'.$survey_detail->id_survey_detail),'Detail'); 
							echo ' | '; 
							echo anchor(site_url('survey_detail/update/'.$survey_detail->id_survey_detail),'Update'); 
							echo ' | '; 
							echo anchor(site_url('survey_detail/delete/'.$survey_detail->id_survey_detail),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
						?>
						</td>
					</tr>
            <?php
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>


<script type="text/javascript">
$(function() {

    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        responsive: true,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 5 ]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Cari :</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'Cari' : 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });


    // Basic responsive configuration
    $('.datatable-responsive').DataTable();


    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Ketik ...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: "-1"
    });
    
});
</script>
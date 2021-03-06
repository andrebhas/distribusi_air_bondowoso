<?php 
    $ci =& get_instance();
    $ci->load->model('Kriteria_model');
?>

<script src="<?php echo base_url('assets/js/plugins/tables/datatables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/tables/datatables/extensions/responsive.min.js') ?>"></script>

<div class="content">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">Subkriteria <?php if ($kriteria): ?>
                <?= $kriteria->nama_kriteria ?>
            <?php else: ?>
                List 
            <?php endif ?></h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 
            <div class="row">
            <?php if ($kriteria): ?>
                <div class="col-md-5 text-left">
                    <?php echo anchor(site_url('subkriteria/create/'.$kriteria->id_kriteria), '<i class="fa fa-plus-square"></i> Tambah', 'class="btn btn-default btn-xs" data-popup="tooltip-custom" title="tambah data"'); ?>
                    <?php //echo anchor(site_url('subkriteria/excel'), '<i class="fa fa-file-excel-o"></i>', 'class="btn btn-success btn-xs" data-popup="tooltip-custom" title="export ms.excel"'); ?>
                    <?php //echo anchor(site_url('subkriteria/word'), '<i class="fa fa-file-word-o"></i>', 'class="btn btn-primary btn-xs"  data-popup="tooltip-custom" title="export ms.word"'); ?>
                </div>
                <div class="col-md-7 text-center">
                    <div style="margin-top: 4px"  id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-7 text-center">
                    <div style="margin-top: 4px"  id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
            <?php endif ?>
                
            </div>          
            <br>
            
            <table class="table datatable-responsive table-sm table-striped" id="mytable">
            <p class="text-info"> W = Bobot Kriteria x Bobot Subkriteria </p>
                <thead>
                    <tr>
                        <th width="50px">No</th>
						<th>Kriteria</th>
                        <th>Bobot Kriteria</th>
						<th>Nama Subkriteria</th>
						<th>Bobot Subkriteria %</th>
						<th>Bobot Subkriteria</th>
						<th>W</th>
						<th>Sub Sub Kriteria</th>
                    </tr>
                </thead>
				<tbody>
            <?php
                $start = 0;
                foreach ($subkriteria_data as $subkriteria)
                {
            ?>
                    <tr>
						<td><?php echo ++$start ?></td>
						<td><?php echo $ci->Kriteria_model->get_by_id($subkriteria->id_kriteria)->nama_kriteria ?></td>
                        <td><?php echo $ci->Kriteria_model->get_by_id($subkriteria->id_kriteria)->bobot_kriteria ?></td>
						<td><?php echo $subkriteria->nama_subkriteria ?></td>
						<td><?php echo $subkriteria->bobot_subkriteria_persen ?> %</td>
						<td><?php echo $subkriteria->bobot_subkriteria ?></td>
						<td><?php echo $subkriteria->w ?></td>
						<td style="text-align:center" width="200px">
						<?php 
                            if ($kriteria) {
                                echo anchor(site_url('subkriteria/read/'.$subkriteria->id_subkriteria),'Detail'); 
                                echo ' | '; 
                                echo anchor(site_url('subkriteria/update/'.$subkriteria->id_subkriteria),'Update'); 
                                echo ' | '; 
                                echo anchor(site_url('subkriteria/delete/'.$subkriteria->id_subkriteria),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                            } else {
                                echo anchor(site_url('subsubkriteria/detail/'.$subkriteria->id_subkriteria),'Detail','class="btn btn-xs btn-primary"');
                            }
							
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
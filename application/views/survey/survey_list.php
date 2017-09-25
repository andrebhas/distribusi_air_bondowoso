<?php 
    $CI =& get_instance();
    $CI->load->model('Survey_model');
?>

<script src="<?php echo base_url('assets/js/plugins/tables/datatables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/tables/datatables/extensions/responsive.min.js') ?>"></script>

<div class="content">

<?php if ($this->ion_auth->is_admin()): ?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">Survey List</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body"> 
            <div class="row">
            <?php if ($mtd == 'list'): ?>
                <div class="col-md-5 text-left">
                    <?php echo anchor(site_url('survey/create'), '<i class="fa fa-plus-square"></i> Tambah', 'class="btn btn-default btn-xs" data-popup="tooltip-custom" title="tambah data"'); ?>
                    <?php echo anchor(site_url('survey/excel'), '<i class="fa fa-file-excel-o"></i>', 'class="btn btn-success btn-xs" data-popup="tooltip-custom" title="export ms.excel"'); ?>
                    <?php echo anchor(site_url('survey/word'), '<i class="fa fa-file-word-o"></i>', 'class="btn btn-primary btn-xs"  data-popup="tooltip-custom" title="export ms.word"'); ?>
                </div>
                <div class="col-md-7 text-center">
                    <div style="margin-top: 4px"  id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
            <?php endif ?>
                
            </div>          
            <br>
            <table class="table datatable-responsive table-sm table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="50px">No</th>
                        <th  width="50px">Tahun</th>
                        <th>Provinsi</th>
                        <th>Kabupaten / Kota</th>
                        <th>Kecamatan</th>       
                        <?php if ($mtd=='list'): ?>
                            <th>Status</th>
                            <th>Action</th>
                        <?php else: ?>
                            <th>Analisis</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
            <?php
                $start = 0;
                if ($mtd=='list') {
                    $survey_data = $survey_data;
                } else {
                    $survey_data = $survey_selesai;
                }
                foreach ($survey_data as $survey)
                {
            ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo $survey->tahun ?></td>
                        <td><?php $provinsi = $CI->Survey_model->get_nama_prov($survey->id_provinsi); echo $provinsi->name;  ?></td>
                        <td><?php $kab = $CI->Survey_model->get_nama_kab($survey->id_kab_kota); echo $kab->name;  ?></td>
                        <td><?php $kec = $CI->Survey_model->get_nama_kec($survey->id_kecamatan); echo $kec->name;  ?></td>
                        
                        <?php if ($mtd == 'list'): ?>
                            <td>
                                <button class="btn btn-xs btn-<?php if ($survey->status == 'proses'){ echo 'primary';} else{ echo 'success';}?>" data-toggle="modal" data-target="#statusModal" data-whatever="<?= $survey->id_survey ?>" >
                                    <?php echo $survey->status ?> 
                                </button>
                            </td>
                            <td style="text-align:center" width="200px">
                            <?php 
                                echo anchor(site_url('survey/read/'.$survey->id_survey),'Detail'); 
                                echo ' | '; 
                                echo anchor(site_url('survey/update/'.$survey->id_survey),'Update'); 
                                echo ' | '; 
                                echo anchor(site_url('survey/delete/'.$survey->id_survey),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                            ?>
                            </td>
                        <?php else: ?>
                            <td> <a href="<?php echo base_url('analisis/hasil/'.$survey->id_survey) ?>" class="btn btn-sm btn-info"><i class="fa fa-search"></i> Analisis</i></a> </td>
                        <?php endif ?>
                        
                    </tr>
            <?php
                }
            ?>
                </tbody>
            </table>
        </div>

    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Status Survey</h4>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url("survey/update_status/") ?>" method="post" id="status">
              <select class="form-control" id="pilih" name="status">
                <option value="selesai">Selesai</option>
                <option value="proses">Proses</option>
              </select>
              <br>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
        $('#statusModal').on('show.bs.modal', function (event) {
            $("#id_survey").remove();
            var button = $(event.relatedTarget);
            var recipient = button.data('whatever');
            var modal = $(this)
            $('#status').append('<input type="hidden" name="id_survey" value="'+recipient+'" id="id_survey" >');
        });

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
<?php endif ?>


<?php $surveyor = 2; if ($this->ion_auth->in_group($surveyor)): ?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">Survey Tersedia</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            <?php foreach ($survey_proses as $sp): ?>
                <div class="alert alert-primary alert-styled-left alert-arrow-left alert-component">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                    <h6 class="alert-heading text-semibold">Survey Data Kekeringan</h6>
                    KECAMATAN <?= $CI->Survey_model->get_nama_kec($sp->id_kecamatan)->name ?> <?= $CI->Survey_model->get_nama_kab($sp->id_kab_kota)->name ?> PROVINSI <?= $CI->Survey_model->get_nama_prov($sp->id_provinsi)->name ?> TAHUN <?= $sp->tahun ?>
                    <br>
                    <br>
                    <a href="<?= base_url('survey_detail/create/'.$sp->id_survey) ?>"><button type="button" class="btn btn-info btn-labeled btn-rounded btn-xs"><b><i class="icon-reading"></i></b> Mulai Survey</button></a>
                </div>
            <?php endforeach ?>

        </div>
    </div>

<?php endif ?>

</div>
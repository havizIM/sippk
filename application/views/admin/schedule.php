<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Schedule</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Schedule</li>
        </ol>
    </div>
</div>


<div class="row">
  <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filter Schedule </h4>

                <div class="row">
                    <div class="col-md-6">
                      <select name="cari_client" id="cari_client" class="form-control"></select>
                    </div>
                    <div class="col-md-3">
                      <select name="cari_bulan" id="cari_bulan" class="form-control">
                        <option value="">-- Pilih Bulan --</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <select name="cari_tahun" id="cari_tahun" class="form-control"></select>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-md-6 col-lg-3">
        <div class="card card-body">
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col p-r-0 align-self-center">
                    <h2 class="font-light m-b-0" id="count_proccess">0</h2>
                    <h6 class="text-muted">Proccess</h6></div>
                <!-- Column -->
                <div class="col text-right align-self-center">
                    <div id="percent_proccess" class="css-bar m-b-0 css-bar-warning css-bar-100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-3">
        <div class="card card-body">
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col p-r-0 align-self-center">
                    <h2 class="font-light m-b-0" id="count_confirmed">0</h2>
                    <h6 class="text-muted">Confirmed</h6></div>
                <!-- Column -->
                <div class="col text-right align-self-center">
                    <div id="percent_confirmed" class="css-bar m-b-0 css-bar-success css-bar-100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-3">
        <div class="card card-body">
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col p-r-0 align-self-center">
                    <h2 class="font-light m-b-0" id="count_complete">0</h2>
                    <h6 class="text-muted">Complete</h6></div>
                <!-- Column -->
                <div class="col text-right ">
                    <div id="percent_complete" class="css-bar m-b-0 css-bar-info css-bar-100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-3">
        <div class="card card-body">
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col p-r-0 align-self-center">
                    <h2 class="font-light m-b-0" id="count_cancel">0</h2>
                    <h6 class="text-muted">Cancel</h6></div>
                <!-- Column -->
                <div class="col text-right align-self-center">
                    <div id="percent_cancel" class="css-bar m-b-0 css-bar-danger css-bar-100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Data Schedule </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="t_schedule">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Plan Date</th>
                                <th>Plan Tonage</th>
                                <th>Status</th>
                                <th>Confirmed Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content bradius">
                    <div class="modal-header stlye">
                        <button type="button" class="close style2" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title text-white">Set Confirmed Date</h4>
                    </div>
                    <form id="form_confirm">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">ID Schedule</label>
                                <input type="text" class="form-control" readonly id="id_schedule" name="id_schedule">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Confirmed Date</label>
                                <input type="date" class="form-control" id="confirmed_date" name="confirmed_date">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit_edit" class="btn btn-success waves-effect waves-light">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<script>

  var renderUI = (function(){
    return {
      renderClient: function(data){
        var HTML = `<option value="">-- Pilih Client --</option>`;

        $.each(data, function(k, v){
            HTML += `<option value="${v.id_client}">${v.nama_perusahaan}</option>`;
        })

        $('#cari_client').html(HTML);
      },
      renderYear: function(data){
        var HTML = `<option value="">-- Pilih Tahun --</option>`;

        $.each(data, function(k, v){
            HTML += `<option value="${v}">${v}</option>`;
        })

        $('#cari_tahun').html(HTML);
      }
    }
  })();

  var setupSchedule = (function(UI){
      var TABLE = $('#t_schedule').DataTable({
            // columnDefs: [{
            //     targets: [],
            //     searchable: true
            // }],
            searching: false,
            pageLength: 100,
            lengthChange: false,
            autoWidth: true,
            responsive: true,
            processing: true,
            ajax: {
                url: '<?= base_url('api/schedule/show/'); ?>'+auth.token,
                dataSrc: function(response){
                    var total_schedule  = response.data.length;

                    var count_proccess  = 0;
                    var count_confirmed = 0;
                    var count_complete  = 0;
                    var count_cancel    = 0;

                    $.each(response.data, function(k, v){
                        if(v.status_schedule === 'Proccess'){
                            count_proccess++;
                        }

                        if(v.status_schedule === 'Confirmed'){
                            count_confirmed++;
                        }

                        if(v.status_schedule === 'Complete'){
                            count_complete++;
                        }

                        if(v.status_schedule === 'Cancel by Admin' || v.status_schedule === 'Cancel by Client'){
                            count_cancel++;
                        }
                    });

                    var percent_proccess = parseInt(count_proccess) / parseInt(total_schedule) * 100 || 0;
                    var percent_confirmed = parseInt(count_confirmed) / parseInt(total_schedule) * 100 || 0;
                    var percent_complete = parseInt(count_complete) / parseInt(total_schedule) * 100 || 0;
                    var percent_cancel = parseInt(count_cancel) / parseInt(total_schedule) * 100 || 0;

                    $('#count_proccess').text(count_proccess);
                    $('#count_confirmed').text(count_confirmed);
                    $('#count_complete').text(count_complete);
                    $('#count_cancel').text(count_cancel);

                    $('#percent_proccess').attr('data-label', percent_proccess.toFixed()+'%');
                    $('#percent_confirmed').attr('data-label',  percent_confirmed.toFixed()+'%');
                    $('#percent_complete').attr('data-label',  percent_complete.toFixed()+'%');
                    $('#percent_cancel').attr('data-label',  percent_cancel.toFixed()+'%');

                    return response.data;
                }
            },
            columns: [
                {"data": 'id_schedule'},
                {"data": null, 'render': function(data, type, row){
                        return `<a href="#/client/${row.client.id_client}">${row.client.nama_perusahaan}</a>`;
                    }
                },
                {"data": 'plan_date'},
                {"data": 'plan_tonage'},
                {"data": null, 'render': function(data, type, row){
                        if(row.status_schedule === 'Proccess'){
                            return `<div class="label label-table label-warning">${row.status_schedule}</div>`
                        } else if(row.status_schedule === 'Confirmed'){
                            return `<div class="label label-table label-info">${row.status_schedule}</div>`
                        } else if(row.status_schedule === 'Complete'){
                            return `<div class="label label-table label-success">${row.status_schedule}</div>`
                        } else {
                           return `<div class="label label-table label-danger">Cancel</div>`
                        } 
                    }
                },
                {"data": null, 'render': function(data, type, row){
                        if(row.confirmed_date === '0000-00-00'){
                            return 'Waiting for confirmed date';
                        } else {
                            return row.confirmed_date;
                        }
                    }
                },
                {"data": null, 'render': function(data, type, row){
                        if(row.status_schedule === 'Proccess'){
                            return `<div class="btn-group">
                                      <button data-id="${row.id_schedule}" data-date="${row.plan_date}" class="btn btn-sm btn-success edit-schedule">Set Date</button>
                                      <button data-id="${row.id_schedule}" class="btn btn-sm btn-danger cancel-schedule">Cancel</button>
                                  </div>`
                            
                        } else if(row.status_schedule === 'Confirmed'){
                            return `<div class="btn-group">
                                        <button data-id="${row.id_schedule}" class="btn btn-sm btn-danger cancel-schedule">Cancel</button>
                                    </div>`
                        } else if(row.status_schedule === 'Cancel by Admin' || row.status_schedule === 'Cancel by Client'){
                            return row.status_schedule
                        } else {
                            return '-';
                        }
                    }
                }
                
            ],
            order: [[2, 'desc']]
        });

        var getClient = function(){
          $.ajax({
            url: `<?= base_url('api/client/show/') ?>${auth.token}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(response){
              if(response.status !== 200){

              } else {
                if(response.data.length < 1){

                } else {
                  UI.renderClient(response.data);
                }
              }
            },
            error: function(err){

            }
          })
        }

        var getYears = function(){
          var currentYear = new Date().getFullYear(), years = [];
          var startYear = startYear || 2005;

          while ( startYear <= currentYear ) {
              years.push(startYear++);
          }   
          
          UI.renderYear(years);
        }

        var filterData = function(id_client = '', bulan = '', tahun = ''){
          var LINK = `<?= base_url('api/schedule/show/') ?>${auth.token}?id_client=${id_client}&bulan=${bulan}&tahun=${tahun}`;

          TABLE.ajax.url(LINK).load();
        }

        var changeEvent = function(){
          $('#cari_client, #cari_bulan, #cari_tahun').on('change', function(){
            var id_client = $('#cari_client').val();
            var bulan     = $('#cari_bulan').val();
            var tahun     = $('#cari_tahun').val();

            filterData(id_client, bulan, tahun);
          })
        }

        var openModal = function(){
            $(document).on('click', '.edit-schedule', function(){
                var id      = $(this).data('id');
                var date    = $(this).data('date');

                $('#id_schedule').val(id);
                $('#confirmed_date').val(date);

                $('#modal_edit').modal('show');
            });
        }

        var submitConfirm = function(){
            $('#form_confirm').validate({
                rules: {
                    id_schedule: "required",
                    confirmed_date: "required"
                },
                messages: {
                    id_schedule: "This field is required",
                    confirmed_date: "This field is required"
                },
                errorClass: 'is-invalid',
                errorPlacement: function(error, element){
                    $(element).next().append(error);
                },
                submitHandler: function(form){
                    $.ajax({
                        url: `<?= base_url('api/schedule/edit/') ?>${auth.token}`,
                        type: 'POST',
                        data: $(form).serialize(),
                        dataType: 'JSON',
                        beforeSend: function(){
                            $('#submit_edit').addClass('disabled').html('<i class="fa fa-spin fa-spinner"></i>')
                        },
                        success: function(response){
                            $('#submit_edit').removeClass('disabled').html('Submit');
                            if(response.status === 200){
                                makeNotif('success', 'Success', response.message, 'bottom-right');
                                $('#modal_edit').modal('hide');
                                TABLE.ajax.reload();
                            } else {
                                makeNotif('warning', 'Warning', response.message, 'bottom-right');
                            }
                        },
                        error: function(err){
                            $('#submit_edit').removeClass('disabled').html('Submit');
                            makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-right');
                        }
                    });
                }
            })
        }
        
        var cancelSchedule = function(){
            $('#t_schedule').on('click', '.cancel-schedule', function(){
                var id = $(this).attr('data-id');
                swal({
                    title: "Are you sure?",
                    text: "This data will canceled permanently",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }, function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            url: `<?= base_url('api/schedule/cancel/') ?>${auth.token}?id_schedule=${id}`,
                            type: 'GET',
                            dataType: 'JSON',
                            success: function(response){
                                swal.close();
                                if(response.status === 200){
                                    makeNotif('success', 'Success', response.message, 'bottom-right')
                                    TABLE.ajax.reload();
                                } else {
                                    makeNotif('error', 'Failed', response.message, 'bottom-right')
                                }
                            },
                            error: function(){
                                swal.close();
                                makeNotif('error', 'Failed', 'Cannot access server', 'bottom-right')
                            }
                        })
                    }
                });
            });
        }

        return {
          init: function(){
            TABLE;
            getClient();
            getYears();
            changeEvent();
            openModal();
            submitConfirm();
            cancelSchedule();
          }
        }
  })(renderUI);

  $(document).ready(function(){
      setupSchedule.init();
  })

</script>
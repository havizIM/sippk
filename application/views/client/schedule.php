<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Schedule</h3>
        <ol class="breadcrumb"><li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active">Schedule</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <a href="#/add_schedule" class="btn btn-info btn-md"><i class="fa fa-plus"></i> Add Schedule</a>
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
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Schedule </h4>
                <div class="table-responsive">
                    <table class="table" id="t_schedule">
                        <thead>
                            <tr>
                                <th>ID</th>
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
                        <h4 class="modal-title text-white">Edit Schedule</h4>
                    </div>
                    <form id="form_edit">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">ID Schedule</label>
                                <input type="text" class="form-control" readonly id="id_schedule" name="id_schedule">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Plan Date</label>
                                <input type="date" class="form-control" id="plan_date" name="plan_date">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Plan Tonage</label>
                                <input type="number"  class="form-control" id="plan_tonage" name="plan_tonage">
                                <div class="invalid-feedback"></div>
                            </div>
                            
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit_edit" class="btn btn-success waves-effect waves-light">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->
    </div>

<script>
    var setupPage = (function(){
        var TABLE = $('#t_schedule').DataTable({
            columnDefs: [{
                targets: [],
                searchable: true
            }],
            autoWidth: true,
            responsive: true,
            processing: true,
            ajax: {
                url: '<?= base_url('ext/schedule/show/'); ?>'+auth.token,
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

                    var percent_proccess = parseInt(count_proccess) / parseInt(total_schedule) * 100;
                    var percent_confirmed = parseInt(count_confirmed) / parseInt(total_schedule) * 100;
                    var percent_complete = parseInt(count_complete) / parseInt(total_schedule) * 100;
                    var percent_cancel = parseInt(count_cancel) / parseInt(total_schedule) * 100;

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
                            if(row.confirmed_date === '0000-00-00'){
                                return `<div class="btn-group">
                                        <button data-id="${row.id_schedule}" data-date="${row.plan_date}" data-tonage="${row.plan_tonage}" class="btn btn-sm btn-success edit-schedule">Edit</button>
                                        <button class="btn btn-sm btn-danger delete-schedule" data-id="${row.id_schedule}">Delete</button>
                                    </div>`
                            } else {
                                return `<div class="btn-group">
                                            <button data-id="${row.id_schedule}" class="btn btn-sm btn-info confirm-schedule">Confirm</button>
                                            <button data-id="${row.id_schedule}" class="btn btn-sm btn-warning cancel-schedule">Cancel</button>
                                        </div>`
                            }
                        } else if(row.status_schedule === 'Cancel by Admin' || row.status_schedule === 'Cancel by Client'){
                            return row.status_schedule
                        }  else {
                            return '-';
                        }
                    }
                }
                
            ],
            order: [[0, 'desc']]
        });

        var deleteSchedule = function(){
            $('#t_schedule').on('click', '.delete-schedule', function(){
                var id = $(this).attr('data-id');
                swal({
                    title: "Are you sure?",
                    text: "This data will deleted permanently",
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
                            url: `<?= base_url('ext/schedule/delete/') ?>${auth.token}?id_schedule=${id}`,
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

        var confirmSchedule = function(){
            $('#t_schedule').on('click', '.confirm-schedule', function(){
                var id = $(this).attr('data-id');
                swal({
                    title: "Are you sure?",
                    text: "This data will confirmed",
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
                            url: `<?= base_url('ext/schedule/confirm/') ?>${auth.token}?id_schedule=${id}`,
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
                            url: `<?= base_url('ext/schedule/cancel/') ?>${auth.token}?id_schedule=${id}`,
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

        var openModal = function(){
            $(document).on('click', '.edit-schedule', function(){
                var id      = $(this).data('id');
                var date    = $(this).data('date');
                var tonage  = $(this).data('tonage');

                $('#id_schedule').val(id);
                $('#plan_date').val(date);
                $('#plan_tonage').val(tonage);

                $('#modal_edit').modal('show');
            });
        }

        var submitEdit = function(){
            $('#form_edit').validate({
                rules: {
                    id_schedule: "required",
                    plan_date: "required",
                    plan_tonage: "required"
                },
                messages: {
                    id_schedule: "This field is required",
                    plan_date: "This field is required",
                    plan_tonage: "This field is required"
                },
                errorClass: 'is-invalid',
                errorPlacement: function(error, element){
                    $(element).next().append(error);
                },
                submitHandler: function(form){
                    $.ajax({
                        url: `<?= base_url('ext/schedule/edit/') ?>${auth.token}`,
                        type: 'POST',
                        data: $(form).serialize(),
                        dataType: 'JSON',
                        beforeSend: function(){
                            $('#submit_edit').addClass('disabled').html('<i class="fa fa-spin fa-spinner"></i>')
                        },
                        success: function(response){
                            $('#submit_edit').removeClass('disabled').html('Save changes');
                            if(response.status === 200){
                                makeNotif('success', 'Success', response.message, 'bottom-right');
                                $('#modal_edit').modal('hide');
                                TABLE.ajax.reload();
                            } else {
                                makeNotif('warning', 'Warning', response.message, 'bottom-right');
                            }
                        },
                        error: function(err){
                            $('#submit_edit').removeClass('disabled').html('Save changes');
                            makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-right');
                        }
                    });
                }
            })
        }

        return {
            init: function(){
                TABLE;
                openModal();
                submitEdit();
                deleteSchedule();
                confirmSchedule();
                cancelSchedule();
            }
        }
    })();

    $(document).ready(function(){
        setupPage.init();
    })
</script>
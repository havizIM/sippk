<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Add Schedule</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#/schedule">Schedule</a></li>
            <li class="breadcrumb-item active">Add Schedule</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <a href="#/schedule" class="btn btn-danger btn-md"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">
                        Form Add Schedule
                    </h4>

                    <form id="form_schedule">
                        <table class="table" id="t_form">
                            <thead>
                                <tr>
                                    <th>Plan Date</th>
                                    <th>Plan Tonage</th>
                                    <th><button class="btn btn-sm btn-info" type="button" id="add_row"><i class="fa fa-plus"></i></button></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row-0">
                                    <td>
                                        <input type="date" name="plan_date[]" id="plan-0" class="form-control" />
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td>
                                        <input type="number" name="plan_tonage[]" id="tonage-0" class="form-control"  />
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-md btn-success" id="submit_add"> Submit</button>
                            </center>
                        </div>
                    </form>
                    
            </div>
        </div>
    </div>
</div>

<script>
    var setupAddSchedule = (function(){
        var count = 1;
        var submit = false;

        var addRow = function(){
            $('#add_row').on('click', function(){
                count = count + 1;

                var html = `<tr id="row-${count}">
                                <td>
                                    <input type="date" name="plan_date[]" id="plan-${count}" class="form-control"  />
                                    <div class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type="number" name="plan_tonage[]" id="tonage-${count}" class="form-control"  />
                                    <div class="invalid-feedback"></div>
                                </td>
                                <td><button id="${count}" type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fa fa-minus"></i></button></td>
                            </tr>`; 

                $('#t_form tbody').append(html);
            })
        }

        var removeRow = function(){
            $(document).on('click', '.remove', function(){
                var button_id = $(this).attr("id");
                $('#row-'+button_id+'').remove();
            });
        }

        var submitForm = function(){
            var submit = true;

            $('#form_schedule').on('submit', function(e){
                e.preventDefault();

                $(this).find('input[type="date"], input[type="number"]').each(function(){
                    if($(this).val() === ''){
                        $(this).addClass('is-invalid');
                        $(this).next().text('This field is required');
                        submit = false;
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).next().text('This field is required');
                        submit = true;
                    }
                });

                $('#form_schedule').find('input[type="date"], input[type="number"]').each(function(){
                    $(this).on('focus', function(){
                        $(this).removeClass('is-invalid');
                    });
                });

                if(submit){
                    $.ajax({
                        url: `<?= base_url('ext/schedule/add/') ?>${auth.token}`,
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'JSON',
                        beforeSend: function(){
                            $('#submit_add').addClass('disabled').html('<i class="fa fa-spin fa-spinner"></i>')
                        },
                        success: function(response){
                            if(response.status === 200){
                                makeNotif('success', 'Success', response.message, 'bottom-right');
                                location.hash = '#/schedule';
                            } else {
                                $('#submit_add').removeClass('disabled').html('Submit');
                                makeNotif('error', 'Error', response.message, 'bottom-right');
                            }
                        },
                        error: function(err){
                            $('#submit_add').removeClass('disabled').html('Submit');
                            makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-right');
                        }
                    })
                }
            });

        }

        return {
            init: function(){
                console.log('App is running...')
                addRow();
                removeRow();
                submitForm();
            }
        }
    })();

    $(document).ready(function(){
        setupAddSchedule.init();
    })
</script>
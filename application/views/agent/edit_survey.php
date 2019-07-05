<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Edit Survey</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#/survey">Survey</a></li>
            <li class="breadcrumb-item active">Edit Survey</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <a href="#/survey" class="btn btn-danger btn-md"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Form Survey</h4>
            </div>
            <div class="card-body">
                <form id="form_edit" enctype="multipart/form-data">
                        <div class="row p-t-20">
                            <div class="col-md-6">

                               <div class="form-group">
                                    <label for="no_si" class="form-control-label">NO SI</label>
                                    <select name="no_si" id="no_si" class="form-control"></select>
                                    <div class="form-control-feedback" id="invalid_no_si"></div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-control-label" for="actual_date">Actual Date</label>
                                    <input type="date" id="actual_date" name="actual_date" class="form-control">
                                    <div class="form-control-feedback" id="invalid_actual_date"></div>
                                </div>
                                
                            </div>

                             <div class="col-md-6">
                              
                                <div class="form-group">
                                    <label class="form-control-label" for="total_loaded">Total Loaded</label>
                                    <input type="number" id="total_loaded" name="total_loaded" class="form-control">
                                    <div class="form-control-feedback" id="invalid_total_loaded"></div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="form-control-label" for="actual_time">Actual Time</label>
                                    <input type="time" id="actual_time" min="00:00" max="24:00" name="actual_time" class="form-control">
                                    <div class="form-control-feedback" id="invalid_actual_time"></div>
                                </div>
                                
                            </div>
                        </div>

                       

                        <div class="row">
                        <div class="col-md-12">
                               <div class="form-group">
                                    <label class="form-control-label" for="document">Draf Survey <small><i>.pdf / .docx / .png</i></small></label>
                                    <input type="file" class="form-control" name="document" id="document">
                                    <div class="form-control-feedback" id="invalid_document"></div>
                                </div>
                            </div>
                        </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-md btn-success" id="submit_edit"> <i class="fa fa-check"></i> Submit</button>
                        <a href="#/survey" class="btn btn-md btn-inverse">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    var DOM = {
        form: '#form_edit',
        selectbox: '#no_si',
        submit: '#submit_edit',
    }

    var renderUI = (function(){
        return {
            renderInstruction: function(data){
                var HTML = '';

                if(data.length !== 0){
                    $.each(data, function(k,v){
                        HTML += `
                            <option value="${v.no_si || v.instruction.no_si}">${v.no_si || v.instruction.no_si}</option>
                        `;
                    })
                }

                $(DOM.selectbox).append(HTML);
            },
            setValue: function(data){
                console.log(data);
                if(data.length !== 0){
                    $.each(data, function(k,v){
                        $('#no_si').val(v.instruction.no_si);
                        $('#total_loaded').val(v.total_loaded);
                        $('#actual_date').val(v.actual_date);
                        $('#actual_time').val(v.actual_time);
                    })
                }
            }
        }
    })()

    var setupEditSurvey = (function(UI){
        var ID = location.hash.substr(14);
        
        var getData = function(){
           
            $.ajax({
                url: `<?= base_url('api/survey/show/') ?>${auth.token}?id_survey=${ID}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    UI.renderInstruction(response.data);
                    UI.setValue(response.data);
                },
                error: function(err){

                }
            })
        }

        var getInstruction = function(){
            $.ajax({
                url: `<?= base_url('api/survey/lookup_si/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    UI.renderInstruction(response.data);
                    getData();
                },
                error: function(err){

                }
            })
        }
        
        var validateForm = function(){
            $(DOM.form).validate({
                rules: {
                    no_si: "required",
                    total_loaded: "required",
                    actual_date: "required",
                    actual_time: "required",
                },
                messages: {
                    no_si: "This field is required",
                    total_loaded: "This field is required",
                    actual_date: "This field is required",
                    actual_time: "This field is required",
                },
                errorClass: 'form-control-danger',
                validClass: 'form-control-success',
                success: function(error, element){
                    $(element).parent('div').removeClass('has-danger');
                },
                errorPlacement: function(error, element){
                    var name = $(element).attr("id");

                    $(element).parent('div').addClass('has-danger');
                    $('#invalid_'+name).text(error.text());
                },
                submitHandler: function(form){
                    $.ajax({
                        url: `<?= base_url('api/survey/edit/') ?>${auth.token}?id_survey=${ID}`,
                        type: 'POST',
                        dataType: 'JSON',
                        data: new FormData(form),
                        contentType: false,
                        processData: false,
                        
                        beforeSend: function(){
                            $(DOM.submit).addClass('disabled').html(`<i class="fa fa-spinner fa-spin"></i>`)
                        },
                        success: function(response){
                            if(response.status === 200){
                            makeNotif('success', 'Success', response.message, 'bottom-right')
                            location.hash = '#/survey';
                            } else {
                            makeNotif('error', 'Failed', response.message, 'bottom-right')
                            $(DOM.submit).removeClass('disabled').html(`<i class="fa fa-check" ></i> Submit`)
                            }

                        },
                        error: function(err){
                            makeNotif('error', 'Failed', 'Tidak dapat mengakases server', 'bottom-right')
                            $(DOM.submit).removeClass('disabled').html(`<i class="fa fa-check" ></i> Submit`)
                        }
                })
                }
            })
        }

        return {
            init: function(){
                validateForm();
                getInstruction();
            }
        }
    })(renderUI) 

    $(document).ready(function(){
        setupEditSurvey.init();
    })

</script>
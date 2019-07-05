<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Add Survey</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#/survey">Survey</a></li>
            <li class="breadcrumb-item active">Add Survey</li>
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
                <form id="form_add" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-md btn-success" id="submit_add"> <i class="fa fa-check"></i> Submit</button>
                        <a href="#/survey" class="btn btn-md btn-inverse">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    var DOM = {
        form: '#form_add',
        selectbox: '#no_si',
        submit: '#submit_add',
    }

    var renderUI = (function(){
        return {
            renderInstruction: function(data){
                var HTML = '<option value="">-- Pilih Instruction --</option>';

                $.each(data, function(k,v){
                    
                        HTML += `
                            <option value="${v.no_si}">${v.no_si}</option>
                        `;
                    
                })

                $(DOM.selectbox).html(HTML);
            },
            renderNoData: function(){
                var HTML = '<option value="">-- No Schedule Date --</option>';

                $(DOM.selectbox).html(HTML);
            }
        }
    })()

    var setupAddInstruction = (function(UI){

        var getInstruction = function(){
            $.ajax({
                url: `<?= base_url('api/survey/lookup_si/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.data.length === 0){
                        UI.renderNoData();
                    } else {
                        UI.renderInstruction(response.data);
                        console.log(response.data)
                    }
                },
                error: function(err){

                }
            })
        }
        
        var validateForm = function(){
            $(DOM.form).validate({
                rules: {
                    no_si: "required",
                    no_si: "required",
                    actual_date: "required",
                    actual_time: "required",
                    total_loaded: "required",
                    document: "required",
                   
                },
                messages: {
                    no_si: "This field is required",
                    owner_barge: "This field is required",
                    owner_barge_address: "This field is required",
                    consignee: "This field is required",
                    consignee_address: "This field is required",
                    commodity: "This field is required",
                    document: "This field is required",
                    qty: "This field is required",
                    port_loading: "This field is required",
                    port_discharge: "This field is required",
                    doc_required: "This field is required",
                    tug_boat: "This field is required",
                    barge_name: "This field is required"
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
                        url: `<?= base_url('api/survey/add/') ?>${auth.token}`,
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
                            console.log(err)
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
        setupAddInstruction.init();
    })

</script>
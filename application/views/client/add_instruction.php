<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Add Instruction</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#/instruction">Instruction</a></li>
            <li class="breadcrumb-item active">Add Instruction</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <a href="#/instruction" class="btn btn-danger btn-md"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Form Shipping Instruction</h4>
            </div>
            <div class="card-body">
                <form id="form_add">
                    <div class="form-body">
                        <h3 class="card-title">Barge And Consignee</h3>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="owner_barge">Owner Barge</label>
                                    <input type="text" id="owner_barge" name="owner_barge" class="form-control">
                                    <div class="form-control-feedback" id="invalid_owner_barge"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="owner_barge_address">Owner Barge Address</label>
                                    <textarea type="text" id="owner_barge_address" name="owner_barge_address" class="form-control"></textarea>
                                    <div class="form-control-feedback" id="invalid_owner_barge_address"></div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="consignee">Consignee</label>
                                    <input type="text" id="consignee" name="consignee" class="form-control">
                                    <div class="form-control-feedback" id="invalid_consignee"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="consignee_address">Consignee Address</label>
                                    <textarea type="text" id="consignee_address" name="consignee_address" class="form-control"></textarea>
                                    <div class="form-control-feedback" id="invalid_consignee_address"></div>
                                </div>
                                
                            </div>
                            <!--/span-->
                        </div>

                        <h3 class="box-title m-t-40">Detail</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_schedule" class="form-control-label">Loading Date</label>
                                    <select name="id_schedule" id="id_schedule" class="form-control"></select>
                                    <div class="form-control-feedback" id="invalid_id_schedule"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="commodity">Commodity</label>
                                    <input type="text" id="commodity" name="commodity" class="form-control">
                                    <div class="form-control-feedback" id="invalid_commodity"></div>
                                </div>
                                 <div class="form-group">
                                    <label class="form-control-label" for="qty">Quantity</label>
                                    <input type="number" id="qty" name="qty" class="form-control">
                                    <div class="form-control-feedback" id="invalid_qty"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="doc_required">Document Required</label>
                                    <textarea id="doc_required" name="doc_required" class="form-control"></textarea>
                                    <div class="form-control-feedback" id="invalid_doc_required"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="port_loading">Port Loading</label>
                                    <input type="text" id="port_loading" name="port_loading" class="form-control" value="SDJ Jetty" readonly>
                                    <div class="form-control-feedback" id="invalid_port_loading"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="port_discharge">Port Discharge</label>
                                    <input type="text" id="port_discharge" name="port_discharge" class="form-control">
                                    <div class="form-control-feedback" id="invalid_port_discharge"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="tug_boat">Tug Boat</label>
                                    <input type="text" id="tug_boat" name="tug_boat" class="form-control">
                                    <div class="form-control-feedback" id="invalid_tug_boat"></div>
                                </div>
                                 <div class="form-group">
                                    <label class="form-control-label" for="barge_name">Barge Name</label>
                                    <input type="text" id="barge_name" name="barge_name" class="form-control">
                                    <div class="form-control-feedback" id="invalid_barge_name"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Signature</label>
                                <div id="signArea" >
                                    <canvas class="mysignature" id="mysignature" width="600" height="150" style="border: 1px solid #ddd;"></canvas>
                                </div>
                                <input type="hidden" name="signature" id="signature">
                            </div>
                            <div class="col-md-6 text-center">
                                <div id="set_sign">
                                    <button type="button" id="clear_sign" class="btn btn-md btn-warning">Clear</button>
                                    <button type="button" id="save_sign" class="btn btn-md btn-success">Sign</button>
                                </div>
                                <div id="set_submit" style="display: none">
                                    <button type="button" id="hide_set_sign" class="btn btn-md btn-danger">Cancel</button>
                                    <button type="submit" class="btn btn-md btn-success" id="submit_add"> <i class="fa fa-check"></i> Submit</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    var DOM = {
        form: '#form_add',
        selectbox: '#id_schedule',
        submit: '#submit_add',
    }

    var renderUI = (function(){
        return {
            renderSchedule: function(data){
                var HTML = '<option value="">-- Pilih Schedule --</option>';

                $.each(data, function(k,v){
                    if(v.status_schedule === 'Confirmed'){
                        HTML += `
                            <option value="${v.id_schedule}">${v.confirmed_date}</option>
                        `;
                    }
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

        var getSchedule = function(){
            $.ajax({
                url: `<?= base_url('ext/instruction/lookup_schedule/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.data.length === 0){
                        UI.renderNoData();
                    } else {
                        UI.renderSchedule(response.data);
                    }
                },
                error: function(err){

                }
            })
        }

        var setSignature = function(){

            var canvas = document.getElementById("mysignature");
            var signaturePad = new SignaturePad(canvas);

            $("#save_sign").on('click', function(){
                if(signaturePad.isEmpty()){
                    makeNotif('error', 'Failed', 'Please sign SI', 'bottom-right')
                } else {
                    var data = signaturePad.toDataURL('image/png');
                    var img_data = data.replace(/^data:image\/(png|jpg);base64,/, "");
                    $('#signature').val(img_data);

                    $('#set_sign').hide();
                    $('#set_submit').show();
                }
            })

            $("#hide_set_sign").on('click', function(){
                $('#set_sign').show();
                $('#set_submit').hide();
            })

            $("#clear_sign").on('click', function(){
                signaturePad.clear();
            })
        }
        
        var validateForm = function(){
            $(DOM.form).validate({
                rules: {
                    id_schedule: "required",
                    owner_barge: "required",
                    owner_barge_address: "required",
                    consignee: "required",
                    consignee_address: "required",
                    commodity: "required",
                    qty: "required",
                    port_loading: "required",
                    port_discharge: "required",
                    doc_required: "required",
                    tug_boat: "required",
                    barge_name: "required"
                },
                messages: {
                    id_schedule: "This field is required",
                    owner_barge: "This field is required",
                    owner_barge_address: "This field is required",
                    consignee: "This field is required",
                    consignee_address: "This field is required",
                    commodity: "This field is required",
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
                            url: `<?= base_url('ext/instruction/add/') ?>${auth.token}`,
                            type: 'POST',
                            dataType: 'JSON',
                            data: $(form).serialize(),
                            beforeSend: function(){
                                $(DOM.submit).addClass('disabled').html(`<i class="fa fa-spinner fa-spin"></i>`)
                            },
                            success: function(response){
                                if(response.status === 200){
                                makeNotif('success', 'Success', response.message, 'bottom-right')
                                location.hash = '#/instruction';
                                } else {
                                makeNotif('error', 'Failed', response.message, 'bottom-right')
                                $(DOM.submit).removeClass('disabled').html(`<i class="fa fa-check" ></in> Submit`)
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
                setSignature();
                validateForm();
                getSchedule();
            }
        }
    })(renderUI) 

    $(document).ready(function(){
        setupAddInstruction.init();
    })

</script>
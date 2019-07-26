<div class="row page-titles">
    <div class="col-md-12 col-12 align-self-center">
        <h3 class="text-themecolor">Detail Instruction</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#/instruction">Instruction</a></li>
            <li class="breadcrumb-item active">Detail Instruction</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card" id="action_instruction"></div>
        <div class="card" id="detail_instruction"></div>
    </div>
</div>

<script>

    var DOM = {
        container: '#detail_instruction',
        action: '#action_instruction'
    };

    var renderUI = (function(){
        return {
            renderDetail: function(data){
                var HTML = '';

                HTML += `
                    <div class="card-body" id="printArea">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left text-center" style="width: 25%">
                                    <img src="<?= base_url('doc/logo_perusahaan/') ?>${data.client.logo_perusahaan}"  style="width: 50%; vertical-align: middle;" />
                                    <h6 class="m-t-10"><b>No. ${data.no_si}</b></h6>
                                </div>
                                <div class="pull-right text-right">
                                    <h3>${data.client.nama_perusahaan}</h3>
                                    <h6>${data.client.alamat_perusahaan}</h6>
                                    <h6>Telp. ${data.client.telepon} Fax. ${data.client.fax}</h6>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <center>
                                    <h5><b>SHIPPING INSTRUCTION</b></h5>
                                </center>

                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <td style="width: 35%">SHIPPER</td>
                                        <td style="width: 65%">
                                            ${data.client.nama_perusahaan}
                                            <br/>
                                            ${data.client.alamat_perusahaan}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>OWNER BARGE</td>
                                        <td>
                                            ${data.owner_barge}
                                            <br/>
                                            ${data.owner_barge_address.replace(/(\r\n|\n|\r)/gm, '<br>')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CONSIGNEE</td>
                                        <td>
                                            ${data.consignee}
                                            <br/>
                                            ${data.consignee_address.replace(/(\r\n|\n|\r)/gm, '<br>')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>COMMODITY</td>
                                        <td>${data.commodity}</td>
                                    </tr>
                                    <tr>
                                        <td>QUANTITY</td>
                                        <td>${data.qty} MT</td>
                                    </tr>
                                    <tr>
                                        <td>PORT LOADING</td>
                                        <td>${data.port_loading}</td>
                                    </tr>
                                    <tr>
                                        <td>PORT DISCHARGE</td>
                                        <td>${data.port_discharge}</td>
                                    </tr>
                                    <tr>
                                        <td>DOC REQUIRED</td>
                                        <td>${data.doc_required.replace(/(\r\n|\n|\r)/gm, '<br>')}</td>
                                    </tr>
                                    <tr>
                                        <td>TUG BOAT</td>
                                        <td>${data.tug_boat}</td>
                                    </tr>
                                    <tr>
                                        <td>BARGE NAME</td>
                                        <td>${data.barge_name}</td>
                                    </tr>
                                    <tr>
                                        <td>LOADING DATE</td>
                                        <td>${data.schedule.confirmed_date}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="pull-right text-right">
                                    <p style="margin-right: 80px">Jakarta, ${data.create_at}</p>
                                    <p style="margin-right: 80px">Mengetahui,</p>
                                    <img src="<?= base_url('doc/signature/') ?>${data.signature}" style="width: 50%" />
                                    <p style="margin-right: 80px"><b>( ${data.client.nama_pic} )</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // console.log(data)

                $(DOM.container).html(HTML)
            },
            
            renderNoData: function(){

            },
            
            renderAction: function(data){
                var HTML = '';

                HTML += `
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"> 
                                     <button id="print" class="btn btn-md btn-info"><i class="fa fa-print"></i> Print</button>
                             </div>
                            <div class="col-md-6">
                               
                            </div>
                        </div>
                    </div>
                `;

                $(DOM.action).html(HTML)
            }
        }
    })();

    var setupDetailSchedule = (function(UI){
        var ID = location.hash.substr(14);

        var getData = function(){
            $.ajax({
                url: `<?= base_url('api/instruction/show/'); ?>${auth.token}?no_si=${ID}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                        if(response.data.length !== 1){
                            UI.renderNoData();
                        } else {
                            $.each(response.data, function(k, v){
                                UI.renderDetail(v);
                                UI.renderAction(v);
                            })
                        }
                    } else {
                        UI.renderNoData();
                    }
                },
                error: function(err){
                    location.hash = '#/instruction'
                }
            }) 
        }

        var actionPrint = function(){
            $(document).on('click', '#print', function(){
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $('#printArea').printArea(options);
            });
        }

        return {
            init: function(){
                getData();
                actionPrint();
            }
        }
    })(renderUI);

    $(document).ready(function(){
        setupDetailSchedule.init();
    })
</script>
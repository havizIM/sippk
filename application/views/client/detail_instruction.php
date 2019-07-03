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
        <div class="card" id="detail_instruction">
            
        </div>
    </div>
</div>

<script>

    var DOM = {
        container: '#detail_instruction'
    };

    var renderUI = (function(){
        return {
            renderDetail: function(data){
                var HTML = '';

                HTML += `
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left text-center" style="width: 25%">
                                    <img src="<?= base_url('doc/logo_perusahaan/') ?>${data.client.logo_perusahaan}"  style="width: 60%; height: 100%; vertical-align: middle;" />
                                    <h6 class="m-t-10"><b>No. ${data.no_si}</b></h6>
                                </div>
                                <div class="pull-right text-right">
                                    <h1>${data.client.nama_perusahaan}</h1>
                                    <h3>${data.client.alamat_perusahaan}</h3>
                                    <h5>Telp. ${data.client.telepon} Fax. ${data.client.fax}</h5>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <hr><br/>
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
                                            ${data.owner_barge_address}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CONSIGNEE</td>
                                        <td>
                                            ${data.consignee}
                                            <br/>
                                            ${data.consignee_address}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>COMMODITY</td>
                                        <td>${data.commodity}</td>
                                    </tr>
                                    <tr>
                                        <td>QUANTITY</td>
                                        <td>${data.qty}</td>
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
                                        <td>${data.doc_required}</td>
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
                                    <h5>Jakarta, 10 Oktober 2019</h5>
                                    <h5>Mengetahui,</h5>
                                    <br><br><br><br>
                                    <h5><b>( Haviz Indra Maulana )</b></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // console.log(data)

                $(DOM.container).html(HTML)
            },
            renderNoData: function(){

            }
        }
    })();

    var setupDetailSchedule = (function(UI){
        var ID = location.hash.substr(14);

        var getData = function(){
            $.ajax({
                url: `<?= base_url('ext/instruction/show/'); ?>${auth.token}?no_si=${ID}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                        if(response.data.length !== 1){
                            UI.renderNoData();
                        } else {
                            $.each(response.data, function(k, v){
                                UI.renderDetail(v);
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

        return {
            init: function(){
                getData();
            }
        }
    })(renderUI);

    $(document).ready(function(){
        setupDetailSchedule.init();
    })
</script>
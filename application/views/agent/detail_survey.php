<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Detail Survey</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#/survey"><i class="fa fa-users"></i> Survey</a></li>
            <li class="breadcrumb-item active">Detail Survey</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">

    </div>
</div>
 
<div class="row" id="content_profile">
  
</div>

<script>

    var renderUI = (function(){
        
        return {
            renderProfile: function(data){
                var html = '';

                var selisih = data.total_loaded - data.instruction.qty;

                var persentase = (selisih / data.total_loaded) * 100;

                html += `<div class="col-md-6"> `;

                    if(data.schedule.status !== 'Complete'){
                    html += `
                            <div class="card">
                                <div class="card-header">
                                    <div class="row text-center justify-content-md-center">
                                        <div class="btn-group text-center" role="group">
                                            <a href="#/edit_survey/${data.id_survey}" class="btn btn-md btn-success"><i class="mdi mdi-pencil"></i> Edit</a>
                                            <button type="button" class="btn btn-md btn-danger" id="delete_survey" data-id="${data.id_survey}"><i class="mdi mdi-close"></i> Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                    }

                    html += `<div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Data Perusahaan</h4>
                                </div>
                                <div class="card-body">
                                    <center class="m-t-30"> <img src="<?= base_url() ?>doc/logo_perusahaan/${data.client.logo_perusahaan}" width="100%">
                                        <h4 class="card-title m-t-10">${data.client.nama_perusahaan}</h4>
                                        <h6 class="card-subtitle"></h6>
                                    </center>
                                </div>
                                <div><hr></div>
                                <div class="card-body">
                                    <small class="text-muted">Alamat </small>
                                    <h6>${data.client.alamat_perusahaan}</h6>
                                    
                                    <small class="text-muted p-t-20 db">Kode Pos</small>
                                    <h6>${data.client.kode_pos}</h6>

                                    <small class="text-muted p-t-20 db">Nama PIC</small>
                                    <h6>${data.client.nama_pic}</h6>
                                    
                                    <small class="text-muted p-t-20 db">Telepon</small>
                                    <h6>${data.client.telepon}</h6>

                                    <small class="text-muted p-t-20 db">Fax</small>
                                    <h6>${data.client.fax}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Instruction</h4>
                            </div>
                            <div class="card-body">

                                    <small class="text-muted">Nomor SI</small>
                                    <h6>${data.instruction.no_si}</h6>
                                    
                                    <small class="text-muted p-t-20 db">Confirmed Date</small>
                                    <h6>${data.schedule.confirmed_date}</h6>

                                    <small class="text-muted p-t-20 db">Status</small>
                                    <h6><span class="badge badge-pill badge-${data.schedule.status === 'Complete' ? 'success' : 'primary'}">${data.schedule.status}</span></h6>

                                    <small class="text-muted p-t-20 db">Schedule</small>
                                    <h6>${data.actual_date} - ${data.actual_time}</h6> 

                            </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="d-flex flex-row">
                                            <div class="p-10 bg-info"><h3 class="text-white box m-b-0"><i class="ti-harddrives"></i></h3></div>
                                            <div class="align-self-center m-l-20">
                                                <h3 class="m-b-0 text-info">Commodity</h3>
                                                <h5 class="text-muted m-b-0">${data.instruction.commodity}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="round round-lg align-self-center round-info"><i class="ti-server"></i></div>
                                                <div class="m-l-10 align-self-center">
                                                    <h3 class="m-b-0 font-light">${data.instruction.qty}</h3>
                                                    <h5 class="text-muted m-b-0">Quantity</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class="round round-lg align-self-center round-info"><i class="ti-bar-chart"></i></div>
                                                <div class="m-l-10 align-self-center">
                                                    <h3 class="m-b-0 font-light">${data.total_loaded}</h3>
                                                    <h5 class="text-muted m-b-0">Total Loaded</h5></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Balance</h4>
                                            <div class="text-right"> <span class="text-muted">${persentase.toFixed()}%</span>
                                                <h1 class="font-light"><sup><i class="${selisih > 0 ? 'ti-arrow-up text-success' : 'ti-arrow-down text-danger'}"></i></sup> ${selisih}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                     
                    </div>
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Document</h4>
                            </div>
                            <div class="card-body">
                                 <embed src="<?= base_url() ?>doc/document/${data.document}" style="width: 100%; height: 500px;">       
                            </div>
                        </div>
                    </div>`;

                $('#content_profile').html(html);
            },
            renderNoData: function(){
                console.log('No Data');
            }
        }

    })()

    var loadData = (function(UI){

        var ID_CLIENT = location.hash.substr(9);

        var dataProfile = function(){
            $.ajax({
                url: `<?= base_url('api/survey/show/'); ?>${auth.token}?id_survey=${ID_CLIENT}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                        if(response.data.length !== 1){
                            UI.renderNoData();
                        } else {
                            $.each(response.data, function(k, v){
                                UI.renderProfile(v);
                            })
                        }
                    } else {
                        UI.renderNoData();
                    }
                },
                error: function(err){
                    location.hash = '#/survey'
                }
            }) 
        }

        var deleteSurvey = function(){
            $(document).on('click', '#delete_survey', function(){
                var id_survey = $(this).attr('data-id');

                swal({
                    title: "Apakah anda yakin?",
                    text: "Data survey ini akan terhapus secara permanen.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }, function (isConfirm) {
                    if(isConfirm){
                    $.ajax({
                        url: `<?= base_url('api/survey/delete/') ?>${auth.token}?id_survey=${id_survey}`,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(response){
                        if(response.status === 200){
                            swal.close();
                            makeNotif('success', response.description, response.message, 'bottom-left');
                            location.hash = '#/survey';
                        } else {
                            makeNotif('error', response.description, response.message, 'bottom-left');
                        }
                        },
                        error: function(){
                        makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-left');
                        }
                    })
                    }
                });
            });
        }

       
        return {
            init : function(){
                dataProfile();
                deleteSurvey();
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
    })

</script>
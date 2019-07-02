<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Detail Client</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#/client"><i class="fa fa-users"></i> Client</a></li>
            <li class="breadcrumb-item active">Detail Client</li>
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

                html += `
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">`;

                if(data.status === 'Nonaktif'){
                html += `<div class="row text-center justify-content-md-center">
                            <div class="btn-group text-center" role="group">
                                <a href="#/edit_client/${data.id_client}" class="btn btn-md btn-success"><i class="mdi mdi-pencil"></i> Edit</a>
                                <button type="button" class="btn btn-md btn-primary" id="aktivasi_client" data-id="${data.id_client}"><i class="mdi mdi-check"></i>Aktifkan</button>
                                <button type="button" class="btn btn-md btn-danger" id="delete_client" data-id="${data.id_client}"><i class="mdi mdi-close"></i> Hapus</button>
                            </div>
                        </div>`
                } else {
                html += `<div class="row text-center justify-content-md-center">
                            <div class="btn-group text-center" role="group">
                                <button type="button" class="btn btn-md btn-primary" id="nonaktif_client" data-id="${data.id_client}"><i class="mdi mdi-close"></i> Nonaktifkan</button>
                            </div>
                        </div>`
                }

                html += ` </div>
                        </div>
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Data Perusahaan</h4>
                            </div>
                            <div class="card-body">
                                <center class="m-t-30"> <img src="<?= base_url() ?>doc/logo_perusahaan/${data.logo_perusahaan}" width="100%">
                                    <h4 class="card-title m-t-10">${data.nama_perusahaan}</h4>
                                    <h6 class="card-subtitle">${data.penanggung_jawab}</h6>
                                </center>
                            </div>
                            <div><hr></div>
                            <div class="card-body">
                                <small class="text-muted">Alamat </small>
                                <h6>${data.alamat_perusahaan}</h6>
                                
                                <small class="text-muted p-t-20 db">Kode Pos</small>
                                <h6>${data.kode_pos}</h6>

                                <small class="text-muted p-t-20 db">Email</small>
                                <h6>${data.email_perusahaan}</h6>
                                
                                <small class="text-muted p-t-20 db">Telepon</small>
                                <h6>${data.telepon}</h6>

                                <small class="text-muted p-t-20 db">Fax</small>
                                <h6>${data.fax}</h6>

                                <small class="text-muted p-t-20 db">Website</small>
                                <h6><a href="${data.website}" target="__blank">${data.website}</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Data PIC</h4>
                            </div>
                        <div class="card-body">
                                <small class="text-muted">Nama</small>
                                <h6>${data.nama_pic}</h6>
                                
                                <small class="text-muted p-t-20 db">Email</small>
                                <h6>${data.email_pic}</h6>

                                <small class="text-muted p-t-20 db">Telepon</small>
                                <h6>${data.telepon_pic}</h6>
                        </div>
                        </div>

                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Informasi Lainnya</h4>
                            </div>
                        <div class="card-body">
                                <small class="text-muted">Username</small>
                                <h6>${data.username}</h6>

                                <small class="text-muted p-t-20 db">Tanggal Registrasi</small>
                                <h6>${data.tgl_registrasi}</h6>
                                
                                <small class="text-muted p-t-20 db">Expired Date</small>
                                <h6>${data.expired_date}</h6>
                                

                                <small class="text-muted p-t-20 db">Status</small>
                                <h6><span class="badge badge-pill badge-${data.status === 'Aktif' ? 'primary' : 'danger'}">${data.status}</span></h6>
                        </div>
                        </div>

                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">MOU</h4>
                            </div>
                            <div class="card-body">
                                 <embed src="<?= base_url() ?>doc/mou/${data.mou}" style="width: 100%; height: 500px;">       
                            </div>
                        </div>
                    </div>
                `;

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
                url: `<?= base_url('api/client/show/'); ?>${auth.token}?id_client=${ID_CLIENT}`,
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
                    location.hash = '#/client'
                }
            }) 
        }

        var deleteClient = function(){
            $(document).on('click', '#delete_client', function(){
                var id_client = $(this).attr('data-id');

                swal({
                    title: "Apakah anda yakin?",
                    text: "Data client ini akan terhapus secara permanen.",
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
                        url: `<?= base_url('api/client/delete/') ?>${auth.token}?id_client=${id_client}`,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(response){
                        if(response.status === 200){
                            swal.close();
                            makeNotif('success', response.description, response.message, 'bottom-left');
                            location.hash = '#/client';
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

        var aktivasiClient = function(){
            $(document).on('click', '#aktivasi_client', function(){
                var id_client = $(this).attr('data-id');

                swal({
                    title: "Apakah anda yakin?",
                    text: "Data client ini akan aktif dan akan dapat mengakses sistem.",
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
                        url: `<?= base_url('api/client/aktif/') ?>${auth.token}?id_client=${id_client}`,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(response){
                        if(response.status === 200){
                            swal.close();
                            makeNotif('success', response.description, response.message, 'bottom-left');
                            location.hash = '#/client';
                        } else {
                            makeNotif('error', response.description, response.message, 'bottom-left');
                        }
                        },
                        error: function(err){
                        makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-left');
                        console.log(err);
                        }
                    })
                    }
                });
            });
        }

        var nonaktifClient = function(){
            $(document).on('click', '#nonaktif_client', function(){
                var id_client = $(this).attr('data-id');

                swal({
                    title: "Apakah anda yakin?",
                    text: "Data client ini akan nonaktif dan tidak dapat mengakses sistem kembali.",
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
                        url: `<?= base_url('api/client/nonaktif/') ?>${auth.token}?id_client=${id_client}`,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(response){
                        if(response.status === 200){
                            swal.close();
                            makeNotif('success', response.description, response.message, 'bottom-left');
                            location.hash = '#/client';
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
                deleteClient();
                aktivasiClient();
                nonaktifClient();
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
    })

</script>
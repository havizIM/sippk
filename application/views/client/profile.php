<style>
.form-control.color[readonly] {
    opacity: initial;
    color: #2f3d4a;
}

.row.m-l-0 {
    margin-left:0;
    margin-right:0;
}
</style>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Profile</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active">profile</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info">$58,356</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary">$48,356</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                            <div class="">
                                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card"> <img class="card-img" src="../assets/images/background/socialbg.jpg" alt="Card image">
                            <div class="card-img-overlay card-inverse social-profile d-flex ">
                                <div class="align-self-center" style="margin:auto;"> <img id="logo_perusahaan_img" class="img-circle" width="100">
                                    <h4 class="card-title" id="nama_perusahaan" style="margin-top:10px;"></h4>
                                    <h6 class="card-subtitle" id="username"></h6>
                                    <p class="text-white" id="status"></p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body"> <small class="text-muted">ID Client </small>
                                <h6 id="id_client"></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6 id="telepon"></h6> <small class="text-muted p-t-30 db">fax</small>
                                <h6 id="fax"></h6> <small class="text-muted p-t-30 db">Registration Date</small>
                                <h6 id="tgl_registrasi"></h6><small class="text-muted p-t-30 db">Expired Date</small>
                                <h6 id="expired_date"></h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Company</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">PIC</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">MOU</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!--second tab-->
                                <div class="tab-pane active" id="profile" role="tabpanel" style="height: 720px;">
                                    <div class="card-body">
                                       <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-md-12">Penanggung Jawab</label>
                                                <div class="col-md-12">
                                                    <input type="text" id="penanggung_jawab" class="form-control color form-control-line" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">NPWP</label>
                                                <div class="col-md-12">
                                                    <input type="text" id="npwp" class="form-control color form-control-line" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Website</label>
                                                <div class="col-md-12">
                                                    <input type="text" id="text_website" class="form-control color form-control-line" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Email Perusahaan</label>
                                                <div class="col-md-12">
                                                    <input type="text" id="email_perusahaan" class="form-control color form-control-line" readonly>
                                                </div>
                                            </div>
                                          
                                            <div class="form-group">
                                                <label class="col-md-12">Alamat Perusahaan</label>
                                                <div class="col-md-12">
                                                    <textarea rows="3" id="alamat_perusahaan" class="form-control color form-control-line" readonly></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-12">Kode Pos</label>
                                                <div class="col-md-12">
                                                    <div>
                                                        <input type="text" id="kode_pos" class="form-control color form-control-line" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Update Profile</button>
                                                </div>
                                            </div>
                                         
                                        </form>
                                        <hr>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab2" role="tabpanel">
                                    <div class="card-body">
                                       <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-md-12">Nama PIC</label>
                                                <div class="col-md-12">
                                                    <input type="text" id="nama_pic" class="form-control color form-control-line" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Telepon PIC</label>
                                                <div class="col-md-12">
                                                    <input type="text" id="telepon_pic" class="form-control color form-control-line" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Email PIC</label>
                                                <div class="col-md-12">
                                                    <input type="text" id="email_pic" class="form-control color form-control-line" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Update Profile</button>
                                                </div>
                                            </div>
                                         
                                        </form>
                                        <hr>
                                    </div>
                                    </div>

                                <div class="tab-pane" id="tab3" role="tabpanel">
                                    <div class="card-body">
                                       <!-- <div class="card card-outline-info"> -->
                                                <div class="card-body">
                                                    <embed id="mou" style="width: 100%; height: 700px;">       
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
<script>
 var makeNotif = function(icon, heading, text, position){
        $.toast({
            heading: heading,
            text: text,
            position: position,
            loaderBg:'#ff6849',
            icon: icon,
            hideAfter: 3500,
            stack: 1
        });
    }

    var setupMain = (function(){


        var getProfile = function(){
            $.ajax({
                url: `<?= base_url().'ext/auth/profile_client/' ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    $.each(response.data, function(k, v){
                        // ACCOUNT\\
                        $('#nama_perusahaan').text(v.nama_perusahaan);
                        $('#telepon').text(v.telepon);
                        $('#id_client').text(v.id_client);
                        $('#username').text(v.username);
                        $('#tgl_registrasi').text(v.tgl_registrasi);
                        $('#expired_date').text(v.expired_date);
                        $('#status').text(v.status);
                        
                        // COMPANY\\
                        $('#penanggung_jawab').val(v.penanggung_jawab);
                        $('#npwp').val(v.npwp);
                        $('#website').attr('href', `${v.website}`);
                        $('#text_website').val(v.website);
                        $('#email_perusahaan').val(v.email_perusahaan);
                        $('#mou').attr('src', `<?= base_url().'doc/mou/' ?>${v.mou}`);
                        $('#logo_perusahaan_img').attr('src', `<?= base_url().'doc/logo_perusahaan/' ?>${v.logo_perusahaan}`);
                        $('#logo_perusahaan').attr('href', `<?= base_url().'doc/logo_perusahaan/' ?>${v.logo_perusahaan}`);
                        $('#alamat_perusahaan').val(v.alamat_perusahaan);
                        $('#kode_pos').val(v.kode_pos);
                        // $('#telepon').val(v.telepon);
                        $('#fax').text(v.fax);
                        
                        // PIC\\
                        $('#nama_pic').val(v.nama_pic);
                        $('#telepon_pic').val(v.telepon_pic);
                        $('#email_pic').val(v.email_pic);
                    });
                },

                error: function(){
                makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                },
            });
        }

        return {
            init: function(){
                getProfile();
            }
        }
        
    })();

    

    $(document).ready(function(){
        setupMain.init();
    });
</script>
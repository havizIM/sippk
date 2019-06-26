
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/logo/logo1.png">
    <title>SIPPK | Client</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
   
    <!-- <link href="<?= base_url() ?>assets/plugins/css-chart/css-chart.css" rel="stylesheet"> -->
    <!--This page css - Morris CSS -->
    <link href="<?= base_url() ?>assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="<?= base_url() ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/eksternal/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url() ?>assets/eksternal/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script>
    var session = localStorage.getItem('ext_sippk');
      var auth = JSON.parse(session);

      if(!auth){
        window.location.replace(`<?= base_url('auth/ext_login') ?>`)
      } 
</script>
<style>
    /* .flex-20 {
        flex: 0 0 20%;
    } */
</style>
</head>

<body class="fix-header fix-sidebar card-no-border logo-center">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">

                         <b>
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <img src="<?= base_url() ?>assets/logo/logo.png" alt="homepage" class="light-logo" />
                        </b>

                        <span>
                         <!-- Light Logo text -->    
                         <img src="<?= base_url() ?>assets/logo/titan-small2.png" class="light-logo" alt="homepage" style="position: relative; top:50%;" /></span> </a>

                    </ul>

                    
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-settings"></i></a>
                        <div class="dropdown-menu dropdown-menu-right scale-up">
                            <ul class="dropdown-user">
                                <li><a href="javascript:void(0)" id="change_pass"><i class="ti-settings"></i> Account Setting</a></li>
                                <li role="separator" class="divider"></li>
                                <li style="cursor:pointer;"><a id="logout_client"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url() ?>assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu scale-up">
                                <ul class="mega-dropdown-menu row">
                                    <li class="col-lg-4 flex-20 m-b-30">
                                        <h4 class="m-b-20">ACCOUNT</h4>
                                        <!-- CAROUSEL -->
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <div class="container text-center m-b-20"><a target="__blank" id="logo_perusahaan"><img class="d-block img-fluid" id="logo_perusahaan_img" alt="First slide" style="width: 100%;"></a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End CAROUSEL -->
                                        <div class="card-body" style="border: 1px solid rgba(0,0,0,.125); box-shadow: 0 0 27px rgba(0,0,0,.2), 0 2px 9px -2px rgba(0,0,0,.2);"> 
                                            <small class="text-muted">ID Client </small>
                                            <h6 id="id_client"></h6> 

                                            <small class="text-muted p-t-10 db">Username</small>
                                            <h6 id="username"></h6> 

                                            <small class="text-muted p-t-10 db">Regristration Date</small>
                                            <h6 id="tgl_registrasi"></h6> 

                                            <small class="text-muted p-t-10 db">Expired Date</small>
                                            <h6 id="expired_date"></h6>

                                            <small class="text-muted p-t-10 db">Status</small>
                                            <h6 id="status"></h6> 
                                        </div>
                                    </li>
                                    <li class="col-lg-4 flex-20 m-b-30">
                                        <h4 class="m-b-20">COMPANY</h4>
                                        <!-- Accordian -->
                                        <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                            
                                            <div class="card-body" style="border: 1px solid rgba(0,0,0,.125); box-shadow: 0 0 27px rgba(0,0,0,.2), 0 2px 9px -2px rgba(0,0,0,.2);"> 
                                                <small class="text-muted">Nama Perusahaan </small>
                                                <h6 id="nama_perusahaan"></h6> 

                                                <small class="text-muted p-t-10 db">Penanggung Jawab</small>
                                                <h6 id="penanggung_jawab"></h6>


                                                <small class="text-muted p-t-10 db">Alamat Perusahaan</small>
                                                <h6 id="alamat_perusahaan"></h6> 

                                                <small class="text-muted p-t-10 db">NPWP</small>
                                                <h6 id="npwp"></h6>

                                                <small class="text-muted p-t-10 db">Kode Pos</small>
                                                <h6 id="kode_pos"></h6> 

                                                <small class="text-muted p-t-10 db">Mou</small>
                                                <a target="__blank" id="mou"><h6>Download</h6></a>

                                                <small class="text-muted p-t-10 db">Logo Perusahaan</small>
                                                

                                                <small class="text-muted p-t-10 db">Telepon</small>
                                                <h6 id="telepon"></h6> 

                                                <small class="text-muted p-t-10 db">Fax</small>
                                                <h6 id="fax"></h6>

                                                <small class="text-muted p-t-10 db">Email Perusahaan</small>
                                                <h6 id="email_perusahaan"></h6> 

                                                <small class="text-muted p-t-10 db">Website</small>
                                                <a target="__blank" id="website"><h6 id="text_website"></h6></a>  
                                                
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-lg-4 flex-20  m-b-30">
                                        <h4 class="m-b-20">PIC</h4>

                                       <div class="card-body" style="border: 1px solid rgba(0,0,0,.125); box-shadow: 0 0 27px rgba(0,0,0,.2), 0 2px 9px -2px rgba(0,0,0,.2);">

                                                <small class="text-muted p-t-10 db">Nama PIC</small>
                                                <h6 id="nama_pic"></h6> 

                                                <small class="text-muted p-t-10 db">Email</small>
                                                <h6 id="email_pic"></h6>

                                                <small class="text-muted p-t-10 db">Telepon</small>
                                                <h6 id="telepon_pic"></h6>
                                       </div>

                                </ul>
                            </div>
                      </li>
                                <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                       
                        
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PERSONAL</li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Apps</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="app-calendar.html">Calendar</a></li>
                                <li>
                                    <a class="has-arrow" href="#" aria-expanded="false">Inbox</a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="app-email.html">Mailbox</a></li>
                                        <li><a href="app-email-detail.html">Mailbox Detail</a></li>
                                        <li><a href="app-compose.html">Compose Mail</a></li>
                                    </ul>
                                </li>
                                <li><a href="app-chat.html">Chat app</a></li>
                                <li><a href="app-ticket.html">Support Ticket</a></li>
                                <li><a href="app-contact.html">Contact / Employee</a></li>
                                <li><a href="app-contact2.html">Contact Grid</a></li>
                                <li><a href="app-contact-detail.html">Contact Detail</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
                
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?= base_url() ?>assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?= base_url() ?>assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?= base_url() ?>assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?= base_url() ?>assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?= base_url() ?>assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?= base_url() ?>assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?= base_url() ?>assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?= base_url() ?>assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

        <!-- sample modal content -->
        <div class="modal fade" id="modal_pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Change Password</h4>
                    </div>
                    <form id="form_pass">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Old Password:</label>
                                <input type="password" class="form-control" id="password_lama" name="password_lama">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">New Password:</label>
                                <input type="password"  class="form-control" id="password_baru" name="password_baru">
                            </div>
                            <div class="form-group">
                            <div>
                                <div>
                                    <div class="checkbox checkbox-primary p-t-0">
                                        <input id="checkbox-signup" class="show_pass" type="checkbox">
                                        <label for="checkbox-signup"> Show Password </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit_pass" class="btn btn-danger waves-effect waves-light">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url() ?>assets/eksternal/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url() ?>assets/eksternal/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url() ?>assets/eksternal/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?= base_url() ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--stickey kit -->
    <script src="<?= base_url() ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url() ?>assets/eksternal/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <!-- <script src="<?= base_url() ?>assets/plugins/chartist-js/dist/chartist.min.js"></script> -->
    <!-- <script src="<?= base_url() ?>assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script> -->
    <!--c3 JavaScript -->
    <!-- <script src="<?= base_url() ?>assets/plugins/d3/d3.min.js"></script> -->
    <!-- <script src="<?= base_url() ?>assets/plugins/c3-master/c3.min.js"></script> -->
    <!-- Vector map JavaScript -->
    <script src="<?= base_url() ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
    <!-- <script src="<?= base_url() ?>assets/eksternal/js/dashboard2.js"></script> -->
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- NOTIF -->
    <script src="<?= base_url() ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/toast-master/js/jquery.toast.js"></script>
</body>

</html>

<script>
    $(document).ready(function(){
        function makeNotif(icon, heading, text, position){
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

        //GET VARIABLE\\
        $.ajax({
            url: `<?= base_url().'api/auth/profile_client/' ?>${auth.token}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(response){
                $.each(response.data, function(k, v){
                    //ACCOUNT\\
                    $('#telepon').text(v.telepon);
                    $('#id_client').text(v.id_client);
                    $('#username').text(v.username);
                    $('#tgl_registrasi').text(v.tgl_registrasi);
                    $('#expired_date').text(v.expired_date);
                    $('#status').text(v.status);
                    
                    //COMPANY\\
                    $('#nama_perusahaan').text(v.nama_perusahaan);
                    $('#penanggung_jawab').text(v.penanggung_jawab);
                    $('#npwp').text(v.npwp);
                    $('#website').attr('href', `${v.website}`);
                    $('#text_website').text(v.website);
                    $('#mou').attr('href', `<?= base_url().'doc/mou/' ?>${v.mou}`);
                    $('#logo_perusahaan_img').attr('src', `<?= base_url().'doc/logo_perusahaan/' ?>${v.logo_perusahaan}`);
                    $('#logo_perusahaan').attr('href', `<?= base_url().'doc/logo_perusahaan/' ?>${v.logo_perusahaan}`);
                    $('#alamat_perusahaan').text(v.alamat_perusahaan);
                    $('#kode_pos').text(v.kode_pos);
                    $('#telepon').text(v.telepon);
                    $('#email_perusahaan').text(v.email_perusahaan);
                    $('#fax').text(v.fax);
                    
                    //PIC\\
                    $('#nama_pic').text(v.nama_pic);
                    $('#telepon_pic').text(v.telepon_pic);
                    $('#email_pic').text(v.email_pic);
                });
            },

            error: function(){
               makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
             },
        });
        
       

        //CHANGE PASSWORD PART\\

        //Modal Change Pass
        $('#change_pass').on('click', function(){
            $('#form_pass')[0].reset();
            $('#modal_pass').modal('show');
        });

        // Show Password
        $('.show_pass').click(function(){
          if($(this).is(':checked')){
            $('#password_baru').attr('type','text');
            $('#password_lama').attr('type','text');
          }else{
            $('#password_baru').attr('type','password');
            $('#password_lama').attr('type','password');
          };
        });

        //Form Pass Valid Ajax
        $('#form_pass').on('submit', function(e){
            e.preventDefault();

            var passwrod_lama = $('#password_lama').val();
            var password_baru = $('#password_baru').val();

            if(password_lama === '' || password_baru === ''){
                makeNotif('warning', 'Warning', 'All field is required', 'top-right');
            } else {
                $.ajax({
              url: `<?= base_url('api/auth/password_client/') ?>${auth.token}`,
              type: 'POST',
              dataType: 'JSON',
              data: $(this).serialize(),
              beforeSend: function(){
                $('#submit_pass').addClass('disabled').html('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>')
              },
              success: function(response){
                if(response.status === 200){
                  makeNotif('success', 'Success', response.message, 'bottom-right')
                  $('#modal_pass').modal('hide')
                } else {
                  makeNotif('error', 'Failed', response.message, 'bottom-right')
                }
                $('#submit_pass').removeClass('disabled').html('Save Change');
              },
              error: function(){
                makeNotif('error', 'Failed', 'Cannot access server', 'bottom-right')
                $('#submit_pass').removeClass('disabled').html('Save Change')
              }
            })
            }
        });
        //CHANGE PASSWORD PART\\

        $('#logout_client').on('click', function(){
          swal({
            title: "Are you sure?",
            text: "You will need to login again.",
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
                    url: `<?= base_url('api/auth/logout_client/') ?>${auth.token}`,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response){
                      if(response.status === 200){
                        localStorage.clear();
                        window.location.replace(`<?= base_url('auth/ext_login') ?>`);
                      } else {
                        makeNotif('error', 'Failed', response.message, 'bottom-right')
                      }
                    },
                    error: function(){
                      makeNotif('error', 'Failed', 'Cannot access server', 'bottom-right')
                    }
                  })
              }
          });
        });

    });
</script>

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
    <title>TITANGroup | Client</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
   
    <link href="<?= base_url() ?>assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="<?= base_url() ?>assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="<?= base_url() ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/eksternal/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url() ?>assets/eksternal/css/colors/blue.css" id="theme" rel="stylesheet">

     <!-- Calendar -->
     <link href="<?= base_url() ?>assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.bootstrap4.min.css"/>
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

    .lg-pos {
        display: inline-grid;
        margin-top: 0px;
        margin-bottom: 5px;
    }

    .text-white h6 {
        color:#fff;
    }

    .dropdown-menu.bg-ig {
        background: linear-gradient(180deg,#009efb,#5f2bff)!important;
    }
    
    .modal-header.stlye {
        background: #1e88e5;
        /* color: #fff; */
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
    }
    
    .modal-content.bradius{
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .close.style2 {
        color: #fff;
        text-shadow: 1px 2px 2px #000;
        opacity: .8;
    }

    #signArea{
        width:100%;
        height: 150px;
    }
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
                <div class="navbar-header">
                    <a class="navbar-brand" href="#/dashboard">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?= base_url() ?>assets/logo/logo.png" alt="homepage" class="dark-logo">
                            <!-- Light Logo icon -->
                            <img src="<?= base_url() ?>assets/logo/logo.png" alt="homepage" class="light-logo" style="width: 35px; height: 35px;">
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="<?= base_url() ?>assets/logo/titan-small2.png" alt="homepage" class="dark-logo">
                         <!-- Light Logo text -->    
                         <img src="<?= base_url() ?>assets/logo/titan-small2.png" class="light-logo" alt="homepage"></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        
                        <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                            <div class="dropdown-menu scale-up-left">
                                <ul class="mega-dropdown-menu row">
                                    <li class="col-lg-3 col-xlg-2 m-b-30">
                                        <h4 class="m-b-20">Gallery</h4>
                                        <!-- CAROUSEL -->
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <div class="container"> <img class="d-block img-fluid" src="<?= base_url() ?>assets/images/titan_1.jpg" alt="First slide" style="width: 100%"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="<?= base_url() ?>assets/images/titan_2.jpg" alt="Second slide" style="width: 100%"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="<?= base_url() ?>assets/images/titan_3.jpg" alt="Third slide" style="width: 100%"></div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                        </div>
                                        <!-- End CAROUSEL -->
                                    </li>
                                    <li class="col-lg-3 m-b-30">
                                        <h4 class="m-b-20">Vision Dan Mission</h4>
                                        <!-- Accordian -->
                                        <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingOne">
                                                    <h5 class="mb-0">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                  Vision
                                                </a>
                                              </h5> </div>
                                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="card-body">To be recognized as the company of choice in the region for its integrated competencies on coal energy resources and infrastructure services in Indonesia.</div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingTwo">
                                                    <h5 class="mb-0">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                  Mission
                                                </a>
                                              </h5> </div>
                                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                    <div class="card-body">To perform end-to-end integrated coal energy infrastructure service activity, from mining, systematic hauling & quality refining, port management, marketing, to shipment, to ensure customer satisfaction and the prosperity of our corporate stakeholders while contributing to the local & national economies.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-lg-3  m-b-30">
                                        <h4 class="m-b-20">Contact Us</h4>
                                        <!-- Contact -->
                                        <form>
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <div class="text-muted">
                                                    Graha Anabatic, Jl. Scientia Boulevard Kav. U2, Summarecon Serpong, Tangerang, Banten 15811 – Indonesia
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <div class="text-muted">+62 (21) 80636888</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <div class="text-muted">info@titaninfra.com</div>
                                            </div>
                                        </form>
                                    </li>
                                    <li class="col-lg-3 col-xlg-4 m-b-30">
                                        <h4 class="m-b-20">On System Activity</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Create a loading plan</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Create a shipping instruction</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> See a survey</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="profile-pic logo_perusahaan" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img class="logo_perusahaan"></div>
                                            <div class="u-text">
                                                <p class="nama_perusahaan"></p>
                                                <p class="text-muted username"></p><a href="#/profile" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li style="cursor:pointer;"><a id="change_pass"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a id="logout_client"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        

        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PERSONAL</li>
                        <li>
                            <a class="has-arrow" href="#/dashboard" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="#/schedule" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Schedule </span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="#/instruction" aria-expanded="false"><i class="fa fa-file-text"></i><span class="hide-menu">Instruction </span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="#/survey" aria-expanded="false"><i class="fa fa-envelope"></i><span class="hide-menu">Survey </span></a>
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

                <div id="content">
                    <!-- LOAD ALL CONTENT -->
                </div>
                
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
                
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul class="m-t-20 chatonline" id="chat_list">
                                
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
                <div class="modal-content bradius">
                    <div class="modal-header stlye">
                        <button type="button" class="close style2" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title text-white">Change Password</h4>
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
    <script src="<?= base_url() ?>assets/eksternal/js/jquery.PrintArea.js" type="text/JavaScript"></script>
    
    <!-- <script src="<?= base_url() ?>assets/eksternal/js/dashboard2.js"></script> -->
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- NOTIF -->
    <script src="<?= base_url() ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/toast-master/js/jquery.toast.js"></script>

    
    <script src="<?= base_url() ?>assets/plugins/wizard/jquery.validate.min.js"></script>

    <script src="<?= base_url() ?>assets/plugins/moment/moment.js"></script>
    <script src='<?= base_url() ?>assets/plugins/calendar/dist/fullcalendar.min.js'></script>
    <script src="<?= base_url() ?>assets/plugins/calendar/dist/jquery.fullcalendar.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js" integrity="sha256-5ZC+204OMIMsO0Z7If/CTSNRdqSh1G+2XmfZCjbQCP8=" crossorigin="anonymous"></script>

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

        var LINK; 

        var setClientinfo = function(){
            $('.logo_user').attr('src', `<?= base_url('doc/logo_perusahaan/default_logo.jpg') ?>`);
            $('.logo_perusahaan').attr('src', `<?= base_url('doc/logo_perusahaan/') ?>${auth.logo_perusahaan}`);
            $('.nama_perusahaan').text(auth.nama_perusahaan);
            $('.username').text(auth.username);
        }

        var loadContent = function(LINK){
            $.get(`<?= base_url().'main/'?>${LINK}`,function(response){

                $('#content').html(response);
            });
        }

        var hashLoad = function(LINK){

            if(!location.hash){
                location.hash = '#/dashboard';
            } else {
                LINK = location.hash.substr(2);
                loadContent(LINK);
            }

            $(window).on('hashchange', function(){
                LINK = location.hash.substr(2);
                loadContent(LINK);
            });
        }

        var triggerModal = function(){
            $('#change_pass').on('click', function(){
                $('#form_pass')[0].reset();
                $('#modal_pass').modal('show');
            });
        }

        var showPass = function(){
            $('.show_pass').click(function(){
                if($(this).is(':checked')){
                    $('#password_baru').attr('type','text');
                    $('#password_lama').attr('type','text');
                }else{
                    $('#password_baru').attr('type','password');
                    $('#password_lama').attr('type','password');
                };
            });
        }

        var submitForm = function(){
            $('#form_pass').on('submit', function(e){
                e.preventDefault();

                var passwrod_lama = $('#password_lama').val();
                var password_baru = $('#password_baru').val();

                if(password_lama === '' || password_baru === ''){
                    makeNotif('warning', 'Warning', 'All field is required', 'top-right');
                } else {
                    $.ajax({
                url: `<?= base_url('ext/auth/password_client/') ?>${auth.token}`,
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
        }

        var logoutClient = function(){
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
                            url: `<?= base_url('ext/auth/logout_client/') ?>${auth.token}`,
                            type: 'GET',
                            dataType: 'JSON',
                            success: function(response){
                            if(response.status === 200){
                                localStorage.removeItem('ext_sippk');
                                window.location.replace(`<?= base_url('') ?>`);
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
        }

        var getAdmin = () => {
            $.ajax({
                url: `<?= base_url('ext/admin/show/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    var html = '<li><b>Chat via WhatsApp</b></li>';
                    console.log(response.data)
                    $.each(response.data, function(k, v){
                        html += `
                            <li>
                                <a href="https://api.whatsapp.com/send?phone=${v.phone}" target="_blank">
                                    <img src="<?= base_url() ?>doc/user/${v.foto} ?>" onerror="this.onerror=null;this.src='<?= base_url('doc/user/default_user.png') ?>';" alt="user-img" class="img-circle">
                                    <span>${v.nama_user}
                                        <small class="text-${v.level === 'Admin' ? 'success' : 'danger'}">${v.level}</small>
                                    </span>
                                </a>
                            </li>
                        `
                    })

                    $('#chat_list').html(html)
                },
                error: function(){
                    
                }
            })
        }

        return {
            init: function(){
                setClientinfo();
                hashLoad();
                triggerModal();
                showPass();
                submitForm();
                logoutClient();
                getAdmin()
            }
        }
        
    })();

    

    $(document).ready(function(){
        setupMain.init();
    });
</script>
</body>

</html>



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
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/logo/logo1.png">
    <title>SIPPK | Accounting</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?= base_url() ?>assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/internal/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url() ?>assets/internal/css/colors/default-dark.css" id="theme" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.bootstrap4.min.css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    style
<![endif]-->

    <style media="screen">
      .user-profile .profile-text {
          padding: 0px 0px;
          position: relative;
        }

        .user-profile .profile-img {
          margin: auto;
        }

        .scroll-sidebar {
         background-image: linear-gradient(to bottom, #272c33, #272c33,#272c33e0,#272c33e6, #272c33e3, #272c33)!important;
        }

        .position img {
          width: 120%;
          height: 23px;
          margin-right: 0px;
          position: relative;
          right: 30px;
        }

        .topbar .top-navbar .navbar-nav > .nav-item > .nav-link {
          text-shadow: -3px 2px 5px #02396a;
          opacity: .8;
        }

        .sidebar-nav.trans {
          background: transparent;
        }

        .card-no-border .left-sidebar {
          background-image: url("<?= base_url() ?>assets/images/background/sidebar.png");
          background-size: cover;
        }
    </style>

    <script type="text/javascript">
      var session = localStorage.getItem('sippk');
      var auth = JSON.parse(session);

      if(!auth){
        window.location.replace(`<?= base_url('auth') ?>`)
      } else {
        if(auth.level !== 'accounting'){
          window.location.replace(`<?= base_url() ?>${auth.level}`);
        }
      }
      
    </script>
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <div id="main-wrapper">
        <header class="topbar" style="background:linear-gradient(-135deg,#00ff78,#2bffa0, #078dff,#0069ff)!important;">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?= base_url() ?>assets/logo/logo.png" alt="homepage" class="dark-logo" style="width: 50px; height: 50px; display:none;" />
                            <!-- Light Logo icon -->
                            <img src="<?= base_url() ?>assets/logo/logo.png" alt="homepage" class="light-logo"  style="width: 50px; height: 50px; display:none;" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="position">
                         <!-- dark Logo text -->
                         <img src="<?= base_url() ?>assets/logo/titan-small2.png" alt="homepage" class="dark-logo showon"/>
                         <!-- Light Logo text -->
                         <img src="<?= base_url() ?>assets/logo/titan-small2.png" class="light-logo" alt="homepage" /></span> </a>
                </div>

                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-white waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-white waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>

                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url() ?>assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?= base_url() ?>assets/images/users/1.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4 id="session_nama"></h4>
                                                <p class="text-muted" id="session_level"></p><a class="btn btn-rounded btn-danger btn-sm"><i class="fa fa-image"></i> Change Picture</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a id="session_id"><i class="ti-wallet"></i></a></li>
                                    <li><a id="session_username"><i class="ti-user"></i></a></li>
                                    <li><a id="session_tgl"><i class="ti-calendar"></i></a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="javascript:void(0)" id="change_pass"><i class="fa fa-lock"></i> Change Password</a></li>
                                    <li><a href="javascript:void(0)" id="logout"><i class="fa fa-power-off"></i> Logout</a></li>
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
                <!-- User profile -->
                <div class="user-profile" style="background: linear-gradient(180deg,#44e2e175,#1f252d)!important;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?= base_url() ?>assets/images/users/1.jpg" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a class="dropdown link u-dropdown" id="session_nav"></a></div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav trans">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">MAIN MENU</li>
                        <li>
                            <a href="#/dashboard" aria-expanded="false"><i class="fa fa-home" style="margin-right:3px;"></i><span class="hide-menu">Dashboard</span></a>
                        </li> 
                         <li>
                            <a href="#/client" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Client</span></a>
                        </li>
                         <li>
                            <a href="#/instruction" aria-expanded="false"><i class="fa fa-file-text"></i><span class="hide-menu">Instruction</span></a>
                        </li>
                         <li>
                            <a href="#/survey" aria-expanded="false"><i class="fa fa-envelope"></i><span class="hide-menu">Survey</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
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
            <div class="container-fluid" id="content">

            </div>

            <div class="modal fade bs-example-modal-sm" id="modal_pass" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <form id="form_pass" class="form-material">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Change Password</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="">Old Password</label>
                            <input type="password" name="password_lama" id="password_lama" class="form-control form-control-line">
                          </div>
                          <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" name="password_baru" id="password_baru" class="form-control form-control-line">
                          </div>
                          <div class="form-group">
                            <label for="">Retype Password</label>
                            <input type="password" name="password_retype" id="password_retype" class="form-control form-control-line">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" name="button">Cancel</button>
                          <button type="submit" class="btn btn-sm btn-success" id="submit_pass" name="button">Save Change</button>
                        </div>
                      </form>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>



            <footer class="footer">
                © 2017 Material Pro Admin by wrappixel.com
            </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
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
    <script src="<?= base_url() ?>assets/internal/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url() ?>assets/internal/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url() ?>assets/internal/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?= base_url() ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>

    <script src="<?= base_url() ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/toast-master/js/jquery.toast.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url() ?>assets/internal/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="<?= base_url() ?>assets/plugins/chart.js/chart.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/wizard/jquery.validate.min.js"></script>
    <script src="<?= base_url() ?>assets/eksternal/js/jquery.PrintArea.js" type="text/JavaScript"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">
      function load_content(link){
        $.get(`<?= base_url().'accounting/'?>${link}`,function(response){

          $('#content').html(response);
        });
      }

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

      $(document).ready(function(){
        var link;

        $('#session_nav').text(auth.nama_user);
        $('#session_nama').text(auth.nama_user);
        $('#session_level').text(auth.level);
        $('#session_id').append(` ${auth.id_user}`);
        $('#session_username').append(` ${auth.username}`);
        $('#session_tgl').append(` ${auth.tgl_registrasi}`);

        if(!location.hash){
          location.hash = '#/dashboard';
        } else {
          link = location.hash.substr(2);
          load_content(link);
        }

        $(window).on('hashchange', function(){
          link = location.hash.substr(2);
          load_content(link);
        });

        $('#change_pass').on('click', function(){
          $('#form_pass')[0].reset();
          $('#modal_pass').modal('show');
        })

        $('#logout').on('click', function(){
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
                    url: `<?= base_url('api/auth/logout_user/') ?>${auth.token}`,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response){
                      if(response.status === 200){
                        localStorage.clear();
                        window.location.replace(`<?= base_url('auth') ?>`);
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

        $('#form_pass').on('submit', function(e){
          e.preventDefault()
          var password_lama = $('#password_lama').val();
          var password_baru = $('#password_baru').val();
          var password_retype = $('#password_retype').val();

          if(password_lama === '' || password_baru === ''){
            makeNotif('warning', 'Failed', 'Field is required', 'bottom-right')
          } else if(password_baru !== password_retype){
            makeNotif('warning', 'Failed', 'Password not match', 'bottom-right')
          } else {
            $.ajax({
              url: `<?= base_url('api/auth/password_user/') ?>${auth.token}`,
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

         $('.sidebartoggler').on('click', function(){
          $('.dark-logo').toggle('show');
        });

      });
    </script>
</body>

</html>

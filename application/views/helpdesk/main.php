<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIPPK | Helpdesk</title>

    <!-- Bootstrap -->
   <link href="<?= base_url().'assets/vendors/bootstrap/dist/css/bootstrap.min.css' ?>" rel="stylesheet">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   <!-- Font Awesome -->
   <link href="<?= base_url().'assets/vendors/font-awesome/css/font-awesome.min.css' ?>" rel="stylesheet">
   <!-- NProgress -->
   <link href="<?= base_url().'assets/vendors/nprogress/nprogress.css' ?>" rel="stylesheet">
   <!-- Datatables -->
   <link href="<?= base_url().'assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css' ?>" rel="stylesheet">

   <!-- Custom Theme Style -->
   <link href="<?= base_url().'assets/build/css/custom.min.css' ?>" rel="stylesheet">
   <!-- jQuery -->
   <script src="<?= base_url().'assets/vendors/jquery/dist/jquery.min.js' ?>"></script>
   <script type="text/javascript">
   function cek_auth(){
     var session = localStorage.getItem('sippk');
     var auth = JSON.parse(session);

     if (!session) {
       window.location.replace('<?= base_url().'auth' ?>')
     }else{
         if (auth.level !== 'helpdesk') {
           window.location.replace('<?= base_url().'' ?>'+auth.level+'/')
         }
       }
     };
   cek_auth();
   </script>

   <style media="screen">
   .swal2-popup{
      font-size: 1.3rem !important;
   }
   </style>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#/dashboard" class="site_title"><img src="<?= base_url().'assets/image/logo1.png' ?>" alt="image" style="width:50px; border-radius: 5px;"> <span style="font-size:17px; margin-left:10px;">HELPDESK</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?= base_url().'assets/image/user2.png' ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2 class="nama"></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron-right"></span></a>
                  </li>
                  <li><a><i class="fa fa-users"></i> User <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#/user">Data User</a></li>
                      <li><a href="#/log_user">Log User</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small btn-group">
              <button type="button" name="button" class="btn btn-success btn-md" id="btn_gpass" title="Change Password" style="width:50%;"> <i class="fas fa-exchange-alt"></i> </button>
              <button type="button" name="button" class="btn btn-danger btn-md" id="btn_logout" title="Logout" style="width:50%;"> <i class="fas fa-power-off"></i> </button>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>


        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?= base_url().'assets/image/user2.png' ?>" alt="" style="width:40px; height: 40px;">Info
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right ">
                    <li><a href="#"> Profile</a> </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" id="content">
          
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <span>Made with <i class="fa fa-heart"></i> by Hana Ayumi</span>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- Modal Change Password -->
    <div class="modal fade bs-example-modal-sm" id="modal_cpass" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel2">Change Password</h4>
          </div>
          <form id="form_gpass">
            <div class="modal-body">
              <div class="form-group">
                <label for="password_lama">Old Password</label>
                <input type="password" class="form-control" id="password_lama" name="password_lama">
              </div>
              <div class="form-group">
                <label for="password_lama">New Password</label>
                <input type="password" class="form-control" id="password_baru" name="password_baru">
              </div>
              <div class="form-group">
                <label>Retype Password</label>
                <input type="password" class="form-control" id="rtp_pass">
              </div>
              <div class="form-group">
                <input type="checkbox" class="form-control show_pass" value="" style="width:18px; height:18px; float:right;">
                <label style="float:right; margin-right:10px;">Show Password</label>
              </div><br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-bold btn-pure btn-danger" data-dismiss="modal" style="font-weight:bold;">Close</button>
              <button type="submit" class="btn btn-bold btn-pure btn-success float-right" id="btn_savepass" style="font-weight:bold;">Save Change</button>
            </div>
          </form>
        </div>
      </div>
    </div>



    <!-- Bootstrap -->
    <script src="<?= base_url().'assets/vendors/bootstrap/dist/js/bootstrap.min.js' ?>"></script>
    <!-- fastClick -->
    <script src="<?= base_url().'assets/vendors/fastclick/lib/fastclick.js' ?>"></script>
    <!-- NProgress -->
    <script src="<?= base_url().'assets/vendors/nprogress/nprogress.js' ?>"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?= base_url().'assets/build/js/custom.min.js' ?>"></script>
    <script src="<?= base_url().'assets/vendors/sweetalert2/sweetalert2.js' ?>"></script>
    <!-- Datatables -->
    <script src="<?= base_url().'assets/vendors/datatables.net/js/jquery.dataTables.min.js' ?>"></script>
    <script src="<?= base_url().'assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js' ?>"></script>

    <script type="text/javascript">

    // Load Content
    function load_content(link) {
      $.get(`<?= base_url().'helpdesk/'?>${link}`,function(response){

        $('#content').html(response);
      });
    };

      $(document).ready(function() {

        const Toast = Swal.mixin({
                        toast: true,
                        position:'bottom-end',
                        showConfirmButton: false,
                        timer: 2500
                      });

        var session = localStorage.getItem('sippk');
        var auth = JSON.parse(session);
        var token = auth.token
        var link_cpass = '<?= base_url().'api/auth/password_user/' ?>'+token
        var link_logout= '<?= base_url().'api/auth/logout_user/' ?>'+token;

        $('.nama').text(auth.nama_user);

        // Ajax Logout
        $('#btn_logout').on('click',function(){

          Swal.fire({
            title: 'Are you sure to logout ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes logout !'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: link_logout,
                type: 'GET',
                dataType: 'JSON',
                // data: {},
                // beforeSend:function(){},
                success:function(response){
                  if (response.status === 200) {
                    localStorage.clear();
                    window.location.replace('<?= base_url().'auth' ?>')
                  }else {
                    Toast.fire({
                      type: 'warning',
                      title: response.message
                    })
                  }
                },
                error:function(){
                  Swal.fire({
                   type: 'warning',
                   title: 'Unable to access the server ...',
                   showConfirmButton: false,
                   timer: 2000
                  })
                }
              });
            }
          })
        })

        // Ajax Change Pass
        $('#form_gpass').on('submit',function(e){
          e.preventDefault();

          var pass_lama = $('#password_lama').val();
          var pass_baru = $('#password_baru').val();
          var rtp_pass = $('#rtp_pass').val();

          // alert(pass_baru)

          if (pass_lama === '' || pass_baru === '' || rtp_pass === '') {
            Toast.fire({
              type: 'warning',
              title: 'Password cannot be empty ...',
            })
          }else if (rtp_pass !== pass_baru) {
            Toast.fire({
              type: 'warning',
              title: 'Password does not match ...',
            })
          }else{
            $.ajax({
              url: link_cpass,
              type: 'POST',
              dataType: 'JSON',
              data: {
                password_lama : pass_lama,
                password_baru : pass_baru
              },
              beforeSend:function(){
                $('#btn_savepass').addClass('disabled').attr('disabled','disabled').html('<span>Save Change <i class="fas fa-spinner fa-spin"></i></span>')

              },
              success:function(response){

                if (response.status === 200) {
                  Toast.fire({
                    type: 'success',
                    title: response.message,
                  })
                  $('#modal_cpass').modal('hide');
                }else {
                  Toast.fire({
                    type: 'warning',
                    title: response.message,
                  })
                  $('#btn_savepass').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Save Change</span>')
                }
              },
              error:function(){
                Swal.fire({
                 type: 'warning',
                 title: 'Unable to access the server ...',
                 showConfirmButton: false,
                 timer: 2000
                })
              }
            });
          }
        })

        var link;

        // Load with URL
        if (location.hash) {
          link = location.hash.substr(2);
          load_content(link);
        }else {
          location.hash ='#/dashboard';
        }

        // load with navigasi
        $(window).on('hashchange',function(){
          link = location.hash.substr(2);
          load_content(link);
        });

        // Modal Gpass
        $('#btn_gpass').on('click',function(){
          $('#modal_cpass').modal('show');
          $('#form_gpass')[0].reset();;
        })

        // Show Password
        $('.show_pass').click(function(){
          if($(this).is(':checked')){
            $('#password_baru,#password_lama,#rtp_pass').attr('type','text');
          }else{
            $('#password_baru,#password_lama,#rtp_pass').attr('type','password');
          };
        });
      });
    </script>
  </body>
</html>

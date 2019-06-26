
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
    <title>SIPPK - Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Notify -->
    <link href="<?= base_url() ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/internal/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url() ?>assets/internal/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script>
 var session = localStorage.getItem('sippk');
      var auth = JSON.parse(session);

      if(auth){
        window.location.replace(`<?= base_url() ?>${auth.level}/`)
      }
</script>
<style>
  .bg-login{
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    height: 100%;
    width: 100%;
    padding: 10% 0;
    position: fixed;
    background-image:url(<?= base_url() ?>assets/logo/port.jpg);
  }

  .card.transparent {
    background-color: rgba(255, 255, 255, 0.82) !important;
    webkit-box-shadow: 0 24px 38px 3px rgba(0,0,0,.14), 0 9px 46px 8px rgba(0,0,0,.12), 0 11px 15px -7px rgba(0,0,0,.2);
    box-shadow: 0 24px 38px 3px rgba(0,0,0,.14), 0 9px 46px 8px rgba(0,0,0,.12), 0 11px 15px -7px rgba(0,0,0,.2);
  }
</style>
</head>

<body>
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
    <section id="wrapper">
      <div class="bg-login"></div>   
        <div class="login-register" style="background:rgba(0, 0, 0, 0.3)">     
          <div class="login-box card transparent">
            <div class="card-body">

                <form class="form-horizontal form-material" id="form_login">
                  <a href="javascript:void(0)" class="text-center db"><img src="<?= base_url() ?>assets/logo/logo.png" alt="Home" /><br/><h4>PT. Servo Lintas Raya</h4></a>
                    <h3 class="box-title m-b-20">Log In</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text"  placeholder="Username" id="username" name="username"> 
                       </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password"  placeholder="Password" id="password" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                          <input id="checkbox-signup" class="show_pass" type="checkbox">
                          <label for="checkbox-signup"> Show Password </label>
                        </div>
                      </div>
                    </div>
                   
                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block waves-effect waves-light" type="submit" id="submit_login">Log In</button>
                      </div>
                    </div>
                    
                    <div class="form-group m-b-0">
                      <div class="col-sm-12 text-center" style="font-size: 20px;">
                        Sistem Informasi Penjadwalan Pemuatan Kapal
                      </div>
                    </div>
                </form>
                
            </div>
          </div>
        </div>
        
    </section>
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
    <script src="<?= base_url() ?>assets/plugins/toast-master/js/jquery.toast.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url() ?>assets/internal/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
<script>
  
  $(document).ready(function() {
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

        $('#form_login').on('submit',function(e){
          e.preventDefault();

          var username = $('#username').val();
          var password = $('#password').val();

          if (username === '' || password === '') {
            makeNotif('warning', 'Warning', 'All field is required', 'top-right');
          }else {
            $.ajax({
              url: '<?= base_url().'api/auth/login_user/' ?>',
              type: 'POST',
              dataType: 'JSON',
              data: $('#form_login').serialize(),
              beforeSend:function(){
                $('#submit_login').addClass('disabled').html('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>')
              },
              success:function(response){
                if (response.status === 200) {
                  var link = '<?= base_url().'' ?>'+response.data.level+'/';
                  localStorage.setItem("sippk",JSON.stringify(response.data));
                  window.location.replace(link)
                }else {
                  makeNotif('error', 'Failed', response.message, 'top-right');
                  $('#submit_login').removeClass('disabled').html('Log In')
                }


              },
              error:function(){
                makeNotif('error', 'Failed', 'Tidak dapat mengakses server', 'bottom-left');
                $('#submit_login').removeClass('disabled').html('Log In')
              }
            });

          }
        })




        // Show Password
        $('.show_pass').click(function(){
          if($(this).is(':checked')){
            $('#password').attr('type','text');
          }else{
            $('#password').attr('type','password');
          };
        });
      });
</script>
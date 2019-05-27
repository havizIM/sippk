
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="<?= base_url() ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/eksternal/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url() ?>assets/eksternal/css/colors/default-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <script type="text/javascript">
      var session = localStorage.getItem('ext_sippk');
      var auth = JSON.parse(session);

      if(auth){
        window.location.replace(`<?= base_url() ?>main/`)
      }
    </script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- <div class="preloader">
        <h1>Loading....</h1>
    </div> -->
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar"  style="background-image:url(<?= base_url() ?>assets/logo/wp1.jpg);">
  <div class="login-box card">
    <div class="card-body">
      <form class="form-horizontal form-material" id="form_login">
        <a href="javascript:void(0)" class="text-center db"><img src="<?= base_url() ?>assets/logo/logo.png" alt="Home" /><br/><h4>PT. Servo Lintas Raya</h4></a>

        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input autofocus class="form-control" type="text" id="username" name="username" placeholder="Username">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" id="password" name="password" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="checkbox-signup" class="show_pass" type="checkbox">
              <label for="checkbox-signup"> Show Password </label>
            </div>
            <a class="text-dark pull-right" id="forgot_password" style="cursor: pointer;"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>
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

      <form id="form_forgot_pass" class="form-horizontal form-material" style="display:none">
         <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input class="form-control" type="email" id="email_perusahaan" name="email_perusahaan" placeholder="Email Perusahaan">
          </div>
        </div>

        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <button class="btn btn-info float-right" type="submit" id="btn_forgot_pass" name="btn_forgot_pass">Send</button>
            <button class="btn btn-danger float-right m-r-10" type="button" id="btn_cancel" name="btn_cancel">Cancel</button>
          </div>
        </div>
      </form>
      <div id="error"></div>
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
    <script src="<?= base_url() ?>assets/eksternal/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url() ?>assets/eksternal/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url() ?>assets/eksternal/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?= base_url() ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/toast-master/js/jquery.toast.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url() ?>assets/eksternal/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script type="text/javascript">

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
            makeNotif('warning', 'Warning', 'All field is required', 'bottom-right');
          }else {
            $.ajax({
              url: '<?= base_url().'api/auth/login_client/' ?>',
              type: 'POST',
              dataType: 'JSON',
              data: $('#form_login').serialize(),
              beforeSend:function(){
                $('#submit_login').addClass('disabled').html('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>')
              },
              success:function(response){
                if (response.status === 200) {
                  var link = `<?= base_url().'' ?>main/`;
                  localStorage.setItem("ext_sippk",JSON.stringify(response.data));
                  window.location.replace(link)
                }else {
                  makeNotif('error', 'Failed', response.message, 'bottom-left');
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

        $('#forgot_password').on('click', function(){
          $('#form_forgot_pass').show('slow', function(){
            $('#email_perusahaan').focus()
          });
        });

        $('#btn_cancel').on('click', function(){
          $('#form_forgot_pass').hide('slow');
        });

        $('#form_forgot_pass').on('submit', function(e){
          e.preventDefault();

          var email_perusahaan = $('#email_perusahaan').val();

          if (email_perusahaan === '') {
            makeNotif('warning', 'Warning', 'All field is required', 'bottom-right');
          } else {
            $.ajax({
              url: '<?= base_url().'api/auth/lupa_password/' ?>',
              type: 'POST',
              dataType: 'JSON',
              data: $('#form_forgot_pass').serialize(),
              beforeSend:function(){
                $('#btn_forgot_pass').addClass('disabled').html('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>')
              },
              success:function(response){
                if (response.status === 200) {
                  makeNotif('success', 'Succes', response.message, 'bottom-right');
                }else {
                  makeNotif('error', 'Failed', response.message, 'bottom-right');
                  $('#btn_forgot_pass').removeClass('disabled').html('Log In')
                }
              },
              error:function(err){
                // makeNotif('error', 'Failed', 'Tidak dapat mengakses server', 'bottom-right');
                // $('#btn_forgot_pass').removeClass('disabled').html('Log In')
              }
            });
          }
        });
        
        // Show Password
        $('show_pass').click(function(){
          if($(this).is(':checked')){
            $('#password').attr('type','text');
          }else{
            $('#password').attr('type','password');
          };
        });
      });
    </script>
</body>

</html>

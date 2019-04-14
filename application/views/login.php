<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIPPK | Login</title>

    <!-- Bootstrap -->
    <link href="<?= base_url().'assets/vendors/bootstrap/dist/css/bootstrap.min.css' ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Animate.css -->
    <link href="<?= base_url().'assets/vendors/animate.css/animate.min.css' ?>" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?= base_url().'assets/vendors/switchery/dist/switchery.min.css' ?>" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= base_url().'assets/build/css/custom.min.css' ?>" rel="stylesheet">

    <script src="<?= base_url().'assets/vendors/jquery/dist/jquery.min.js' ?>"></script>
    <script type="text/javascript">
      function cek_auth(){
        var session = localStorage.getItem('sippk');
        var auth = JSON.parse(session);

        if (session) {
          window.location.replace('<?= base_url().'' ?>'+auth.level+'/')
        };
      };

      cek_auth();
    </script>

    <style media="screen">
      .swal2-popup{
         font-size: 1.3rem !important;
      }
    </style>
  </head>
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <img src="<?= base_url().'assets/image/logo.png' ?>" alt="image">
            <form id="form_login">
              <div class="logo">
                <h2>PT. Servo Lintas Raya</h2>
              </div>
              <div>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" >
              </div>
              <div class="form-group">
                <input type="password" class="form-control " id="password" name="password" placeholder="Password" >
              </div>
              <div class="row form-group">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-info btn-md" id="btn_login" name="button" style="width:100%;">Login <i class="fas fa-sign-in-alt"></i> </button>
                </div>
                <div class="col-md-6" style="float:right;">
                  <label>Show Password</label>
                  <input type="checkbox" class="flat show_pass" value="" style="width:18px; height:18px; ">
                </div>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <h1 style="font-size:17px;">Sistem Informasi Penjadwalan Pemuatan Kapal</h1>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    <script src="<?= base_url().'assets/vendors/sweetalert2/sweetalert2.js' ?>"></script>
    <script type="text/javascript">
      $(document).ready(function() {

        const Toast = Swal.mixin({
                        toast: true,
                        position:'bottom-end',
                        showConfirmButton: false,
                        timer: 2000
                      });

        $('#form_login').on('submit',function(e){
          e.preventDefault();

          var username = $('#username').val();
          var password = $('#password').val();

          if (username === '' || password === '') {
            Toast.fire({
              type: 'warning',
              title: 'Username / Password Cannot be empty',
            })
          }else {
            $.ajax({
              url: '<?= base_url().'api/auth/login_user/' ?>',
              type: 'POST',
              dataType: 'JSON',
              data: $('#form_login').serialize(),
              beforeSend:function(){
                $('#btn_login').addClass('disabled').attr('disabled','disabled').html('<span>Login <i class="fas fa-spinner fa-spin" style="font-size:20px;"></i></span>')
              },
              success:function(response){
                if (response.status === 200) {
                  var link = '<?= base_url().'' ?>'+response.data.level

                  localStorage.setItem("sippk",JSON.stringify(response.data));
                  window.location.replace(link)
                }else {
                  Toast.fire({
                    type: 'error',
                    title: response.message,
                  })
                }

                $('#btn_login').removeClass('disabled').removeAttr('disabled','disabled').html('<span>Login <i class="fas fa-sign-in-alt"></i></span>')
              },
              error:function(){
                alert('Gagal Mengakses Server ... ')
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
  </body>
</html>

<div class="">
   <div class="page-title">
     <div class="title_left">
       <h3>Add User</h3>
     </div>
     <div class="title_right">
       <div class="pull-right">
         <div class="input-group">
           <a href="#/user" class="btn btn-danger btn-md "> <i class="fas fa-arrow-left"></i> Cancel</a>
         </div>
       </div>
     </div>
   </div>
   <div class="clearfix"></div>
   <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12">
       <div class="x_panel">
         <!-- <div class="x_title">
           <h2>Add User</h2>
           <ul class="nav navbar-right panel_toolbox">
             <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
             </li>
             <li><a class="close-link"><i class="fa fa-close"></i></a>
             </li>
           </ul>
           <div class="clearfix"></div>
         </div> -->
         <div class="x_content">
          <form id="form_adduser" data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Name *  </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12" id="nama_user" name="nama_user">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Username *  </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text"class="form-control col-md-7 col-xs-12" id="username" name="username">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Level *</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" id="level" name="level">
                  <option value="">--Select Level--</option>
                  <option value="Admin">Admin</option>
                  <option value="Accounting">Accounting</option>
                  <option value="Director">Director</option>
                </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-12 text-center">
	               <button class="btn btn-danger" type="reset">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </div>

<script type="text/javascript">
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
    var link_add = '<?= base_url().'api/user/add/' ?>'+token

    // Ajax Add User
    $('#form_adduser').on('submit',function(e){
      e.preventDefault();

      var nama = $('#nama_user').val();
      var username = $('#username').val();
      var level = $('#level').val();


      if (nama ==='' || username ==='' || level ==='') {
        Toast.fire({
          type: 'warning',
          title: 'Data cannot be empty ...',
        })
      }else {
        $.ajax({
          url: link_add,
          type: 'POST',
          dataType: 'JSON',
          data: $('#form_adduser').serialize(),
          beforeSend:function(){},
          success:function(response){
            if (response.status === 200) {
              Swal.fire({
                type: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 2000
              })
            }else {
              Toast.fire({
                type: 'error',
                title: response.message,
              })
            }
            location.hash='#/user'
            table.ajax.reload();
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

  });
</script>

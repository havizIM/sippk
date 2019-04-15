
<div class="">
   <div class="page-title">
     <div class="title_left">
       <h3>Data User</h3>
     </div>
     <div class="title_right">
       <div class="pull-right">
         <div class="input-group">
           <a href="#/add_user" class="btn btn-info btn-md "> <i class="fas fa-plus"></i> Add User</a>
         </div>
       </div>
     </div>
   </div>
   <div class="clearfix"></div>
   <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12">
       <div class="x_panel">
         <div class="x_title">
           <h2>Detail User</h2>
           <ul class="nav navbar-right panel_toolbox">
             <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
             </li>
             <li><a class="close-link"><i class="fa fa-close"></i></a>
             </li>
           </ul>
           <div class="clearfix"></div>
         </div>
         <div class="x_content">
           <div class="table-responsive" >
             <table class="table table-hover dataTable" id="detail_user" >
               <thead>
                 <tr>
                   <th>ID User</th>
                   <th>Name</th>
                   <th>Username</th>
                   <th>Password</th>
                   <th>Level</th>
                   <th>Register date</th>
                   <th>Status</th>
                   <th></th>
                 </tr>
               </thead>
               <tbody>

               </tbody>
             </table>
           </div>
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
    var token = auth.token;
    var link_show = '<?= base_url().'api/user/show/'?>'+token;
    // alert(token)

    var table = $('#detail_user').DataTable({
      columnDefs :[{
        targets:[0,2,3,4,5,6,7],
        searchable:false
      },{
        targets:[2,3,7],
        orderable:false
      }],
      responsive:true,
      processing:true,
      ajax:link_show,
      columns:[
        {"data":"id_user"},
        {"data":"nama_user"},
        {"data":"username"},
        {"data":"password"},
        {"data":"level"},
        {"data":"tgl_registrasi"},
        {"data":"status"},
        {"data":null,"render":function(data,type,row){

            return `<a href="#/edit_user/${row.id_user}" class="btn btn-sm btn-success" >Edit</a><button type="button" data-id="${row.id_user}" id="btn_delete" class="btn btn-sm btn-danger" name="button">Hapus</button>`

        }},
      ],
      order:[[5,'desc']]
    });

    // Ajax Delete user
    $(document).on('click','#btn_delete',function(){

      var id_user = $(this).attr('data-id');


      Swal.fire({
        title: 'Are you sure...',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        width: 400

      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: `<?= base_url().'api/user/delete/' ?>${token}?id_user=${id_user}`,
            type: 'GET',
            dataType: 'JSON',
            // beforeSend:function(){},
            success:function(response){
              Swal.fire({
                type: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              })
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
      });
    });
  });
</script>





<br><br>

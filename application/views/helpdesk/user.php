<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">User</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
      <div class="d-flex m-t-10 justify-content-end">
          <div class="d-flex m-r-20 m-l-10 hidden-md-down">
              <button type="button" name="button" id="add_user" class="btn btn-info btn-md">Tambah</button>
          </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="t_user">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Phone</th>
                      <th>Password</th>
                      <th>Level</th>
                      <th>Register Date</th>
                      <th>Status</th>
                      <th>Aksi</th>
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

<div id="modal_add" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="form_add" class="form-material">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" id="add_username" class="form-control form-control-line">
              </div>
              <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" name="nama_user" id="add_nama_user" class="form-control form-control-line">
              </div>
              <div class="form-group">
                <label for="">Telepon</label>
                <input type="text" name="phone" id="add_phone" class="form-control form-control-line" placeholder="Contoh: 6281355754092">
              </div>
              <div class="form-group">
                <label for="">Level</label>
                <select class="form-control form-control-line" name="level" id="add_level">
                  <option value="">-- Choose Level --</option>
                  <option value="Admin">Admin</option>
                  <option value="Agent">Agent</option>
                  <option value="Accounting">Accounting</option>
                  <option value="Manager">Manager</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Batal</button>
                <button type="submit" id="submit_add" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
    </div>
</div>

<div id="modal_edit" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="form_edit" class="form-material">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" id="edit_username" class="form-control form-control-line">
              </div>
              <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" name="nama_user" id="edit_nama_user" class="form-control form-control-line">
              </div>
              <div class="form-group">
                <label for="">Telepon</label>
                <input type="text" name="phone" id="edit_phone" class="form-control form-control-line" placeholder="Contoh: 6281355754092">
              </div>
              <div class="form-group">
                <label for="">Status</label>
                <select class="form-control form-control-line" name="status" id="edit_status">
                  <option value="">-- Choose Status --</option>
                  <option value="Aktif">Aktif</option>
                  <option value="Nonaktif">Nonaktif</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_user" id="edit_id">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Batal</button>
                <button type="submit" id="submit_edit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var t_user = $('#t_user').DataTable({
      columnDefs: [{
        targets: [0, 2, 3, 4, 5],
        searchable: false
      },{
        targets: [6],
        orderable: false
      }],
      autoWidth: false,
      language: {
        search: 'Search Name: _INPUT_',
      },
      responsive: true,
      processing: true,
      ajax: '<?= base_url('api/user/show/'); ?>'+auth.token,
      columns: [
        {"data": 'id_user'},
        {"data": 'nama_user'},
        {"data": 'username'},
        {"data": 'phone'},
        {"data": 'password'},
        {"data": 'level'},
        {"data": 'tgl_registrasi'},
        {"data": 'status'},
        {"data": null, 'render': function(data, type, row){
            return `<div class="btn-group" role="group"><button type="button" class="btn btn-sm btn-success" id="edit_user" data-id="${row.id_user}"><i class="mdi mdi-pencil"></i></button> <button type="button" class="btn btn-sm btn-danger" id="delete_user" data-id="${row.id_user}"><i class="mdi mdi-close"></i></button></div>`
          }
        },
      ],
      order: [[4, 'desc']]
    });


    $('#add_user').on('click', function(){
      $('#modal_add').modal('show');
      $('#form_add')[0].reset();
    });


    $('#form_add').on('submit', function(e){
      e.preventDefault();

      var username = $('#add_username').val();
      var nama_user = $('#add_nama_user').val();
      var level = $('#add_level').val();
      var phone = $('#add_phone').val();

      if(username === '' || nama_user === '' || level === '' || phone === ''){
        makeNotif('warning', 'Warning', 'Silahkan lengkapi form', 'bottom-left');
      } else {
        $.ajax({
          url: `<?= base_url('api/user/add/') ?>`+auth.token,
          type: 'POST',
          dataType: 'JSON',
          data: $(this).serialize(),
          beforeSend: function(){
            $('#submit_add').addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i>');
          },
          success: function(response){
            if(response.status === 200){
              t_user.ajax.reload();
              makeNotif('success', response.description, response.message, 'bottom-left');
              $('#modal_add').modal('hide');
            } else {
              makeNotif('error', response.description, response.message, 'bottom-left');
            }

            $('#submit_add').removeClass('disabled').html('Simpan');
          },
          error: function(){
            makeNotif('error', 'Failed', 'Tidak dapat mengakses server', 'bottom-left');
          }
        })
      }
    });

    $(document).on('click', '#delete_user', function(){
      var id_user = $(this).attr('data-id');

      swal({
          title: "Apakah anda yakin?",
          text: "Data user ini akan terhapus secara permanen.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
          closeOnConfirm: false,
          closeOnCancel: true
      }, function (isConfirm) {
        if(isConfirm){
          $.ajax({
            url: `<?= base_url('api/user/delete/') ?>${auth.token}?id_user=${id_user}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(response){
              if(response.status === 200){
                t_user.ajax.reload();
                makeNotif('success', response.description, response.message, 'bottom-left');
                swal.close();
              } else {
                makeNotif('error', response.description, response.message, 'bottom-left');
              }
            },
            error: function(){
              makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-left');
            }
          })
        }
      });
    });

    $(document).on('click', '#edit_user', function(){
      var id_user = $(this).attr('data-id');

      $.ajax({
        url: `<?= base_url('api/user/show/') ?>${auth.token}?id_user=${id_user}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(response){
          $.each(response.data, function(k,v){
            $('#edit_id').val(v.id_user);
            $('#edit_nama_user').val(v.nama_user);
            $('#edit_status').val(v.status);
            $('#edit_username').val(v.username);
            $('#edit_phone').val(v.phone);
          });

          $('#modal_edit').modal('show');
        },
        error: function(){
          makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-left');
        }
      })
    });

    $('#form_edit').on('submit', function(e){
      e.preventDefault();

      var id_user   = $('#edit_id').val();
      var nama_user = $('#edit_nama_user').val();
      var username  = $('#edit_username').val();
      var status    = $('#edit_status').val();
      var phone     = $('#edit_phone').val();

      if(id_user === '' || nama_user === '' || username === '' || status === '' || phone === ''){
        makeNotif('warning', 'Warning', 'Silahkan lengkapi form', 'bottom-left');
      } else {
        $.ajax({
          url: `<?= base_url('api/user/edit/') ?>${auth.token}?id_user=${id_user}`,
          type: 'POST',
          dataType: 'JSON',
          data: $(this).serialize(),
          beforeSend: function(){
            $('#submit_edit').addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i>');
          },
          success: function(response){
            if(response.status === 200){
              t_user.ajax.reload();
              makeNotif('success', response.description, response.message, 'bottom-left');
              $('#modal_edit').modal('hide');
            } else {
              makeNotif('error', response.description, response.message, 'bottom-left');
            }

            $('#submit_edit').removeClass('disabled').html('Simpan');
          },
          error: function(){
            makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-left');
          }
        })
      }
    });
});
</script>

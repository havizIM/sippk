<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Client</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Client</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
      <div class="d-flex m-t-10 justify-content-end">
        <div class="d-flex m-r-20 m-l-10 hidden-md-down">
            <a href="#/add_client" class="btn btn-info btn-md">Add Client</a>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-outline-info">
            <div class="card-header">
              <h4 class="m-b-0 text-white">Data Client</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="t_client">
                    <thead>
                      <tr>
                        <th>ID Client</th>
                        <th>Nama Perusahaan</th>
                        <th>Penanggung Jawab</th>
                        <th>Alamat</th>
                        <th>Kode Pos</th>
                        <th>Telepon</th>
                        <th>Fax</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>NPWP</th>
                        <th>PIC</th>
                        <th>Email PIC</th>
                        <th>Telepon PIC</th>
                        <th>Expired Date</th>
                        <th>Status</th>
                        <th>Tgl Registrasi</th>
                        <th>Logo</th>
                        <th>MOU</th>
                        <th>Website</th>
                        <th>Action</th>
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


<script type="text/javascript">
  $(document).ready(function(){
    var t_client = $('#t_client').DataTable({
      columnDefs: [{
        targets: [],
        searchable: true
      }],
      autoWidth: true,
      responsive: true,
      processing: true,
      ajax: '<?= base_url('api/client/show/'); ?>'+auth.token,
      columns: [
        {"data": 'id_client'},
        {"data": 'nama_perusahaan'},
        {"data": 'penanggung_jawab'},
        {"data": 'alamat_perusahaan'},
        {"data": 'kode_pos'},
        {"data": 'telepon'},
        {"data": 'fax'},
        {"data": 'email_perusahaan'},
        {"data": 'username'},
        {"data": 'npwp'},
        {"data": 'nama_pic'},
        {"data": 'email_pic'},
        {"data": 'telepon_pic'},
        {"data": 'expired_date'},
        {"data": 'status'},
        {"data": 'tgl_registrasi'},
        {"data": null, 'render': function(data, type, row){
            return `<img src="<?= base_url('doc/logo_perusahaan/') ?>${row.logo_perusahaan}" style="width: 150px; height: 100px" />`
          }
        },
        {"data": null, 'render': function(data, type, row){
            return `<a href="<?= base_url('doc/mou/') ?>${row.mou}" target="__blank">Download</a>`
          }
        },
        {"data": null, 'render': function(data, type, row){
            return `<a href="${row.website}" target="__blank">${row.website}</a>`
          }
        },
        {"data": null, 'render': function(data, type, row){
            if(row.status === 'Nonaktif'){
              return `<div class="btn-group" role="group">
                        <a href="#/edit_client/${row.id_client}" class="btn btn-sm btn-success"><i class="mdi mdi-pencil"></i></a>
                        <button type="button" class="btn btn-sm btn-primary" id="aktivasi_client" data-id="${row.id_client}">Aktifkan</button>
                        <button type="button" class="btn btn-sm btn-danger" id="delete_client" data-id="${row.id_client}"><i class="mdi mdi-close"></i></button>
                      </div>`
            } else {
              return `<div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-primary" id="nonaktif_client" data-id="${row.id_client}">Nonaktifkan</button>
                      </div>`
            }
          }
        },
      ],
      order: [[0, 'desc']]
    });

    $(document).on('click', '#delete_client', function(){
      var id_client = $(this).attr('data-id');

      swal({
          title: "Apakah anda yakin?",
          text: "Data client ini akan terhapus secara permanen.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
          closeOnConfirm: false,
          closeOnCancel: true,
          showLoaderOnConfirm: true
      }, function (isConfirm) {
        if(isConfirm){
          $.ajax({
            url: `<?= base_url('api/client/delete/') ?>${auth.token}?id_client=${id_client}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(response){
              if(response.status === 200){
                t_client.ajax.reload();
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

    $(document).on('click', '#aktivasi_client', function(){
      var id_client = $(this).attr('data-id');

      swal({
          title: "Apakah anda yakin?",
          text: "Data client ini akan aktif dan akan dapat mengakses sistem.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
          closeOnConfirm: false,
          closeOnCancel: true,
          showLoaderOnConfirm: true
      }, function (isConfirm) {
        if(isConfirm){
          $.ajax({
            url: `<?= base_url('api/client/aktif/') ?>${auth.token}?id_client=${id_client}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(response){
              if(response.status === 200){
                t_client.ajax.reload();
                makeNotif('success', response.description, response.message, 'bottom-left');
                swal.close();
              } else {
                makeNotif('error', response.description, response.message, 'bottom-left');
              }
            },
            error: function(err){
              makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-left');
              console.log(err);
            }
          })
        }
      });
    });

    $(document).on('click', '#nonaktif_client', function(){
      var id_client = $(this).attr('data-id');

      swal({
          title: "Apakah anda yakin?",
          text: "Data client ini akan nonaktif dan tidak dapat mengakses sistem kembali.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
          closeOnConfirm: false,
          closeOnCancel: true,
          showLoaderOnConfirm: true
      }, function (isConfirm) {
        if(isConfirm){
          $.ajax({
            url: `<?= base_url('api/client/nonaktif/') ?>${auth.token}?id_client=${id_client}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(response){
              if(response.status === 200){
                t_client.ajax.reload();
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

  });
</script>

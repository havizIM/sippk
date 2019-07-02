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
                        <th>Nama Perusahaan</th>
                        <th>ID Client</th>
                        <th>Penanggung Jawab</th>
                        <th>Email</th>
                        <th>Expired Date</th>
                        <th>Status</th>
                        <th>Tgl Registrasi</th>
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
        {"data": 'nama_perusahaan'},
        {"data": null, 'render': function(data, type, row){
            return `<a href="#/client/${row.id_client}">${row.id_client}</a>`
          }
        },
        {"data": 'penanggung_jawab'},
        {"data": 'email_perusahaan'},
        {"data": 'expired_date'},
        {"data": null, 'render': function(data, type, row){
          if(row.status === 'Aktif'){
            return `<span class="badge badge-pill badge-primary">${row.status}</span>`
          } else {
            return `<span class="badge badge-pill badge-danger">${row.status}</span>`;
          }
            
          }
        },
        {"data": 'tgl_registrasi'},
      ],
      order: [[0, 'desc']]
    });

    

  });
</script>

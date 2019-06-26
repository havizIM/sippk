<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Client</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Client</li>
        </ol>
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
      ],
      order: [[0, 'desc']]
    });

  });
</script>

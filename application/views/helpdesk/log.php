<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Log</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Log</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">

    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="t_log">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>ID Log</th>
                        <th>ID User</th>
                        <th>User</th>
                        <th>ID Ref</th>
                        <th>Refrensi</th>
                        <th>Keterangan</th>
                        <th>Kategori</th>
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
    var t_log = $('#t_log').DataTable({
      columnDefs: [{
        targets: [0, 1, 2, 3, 4],
        searchable: true
      }],
      autoWidth: true,
      responsive: true,
      processing: true,
      ajax: '<?= base_url('api/log/show/'); ?>'+auth.token,
      columns: [
        // {"data": null, 'render': function(data, type, row){
        //     return moment(row.tgl_log, 'YYYY-MM-DD hh:mm:ss').format('LLL')
        //   }
        // },
        {"data": 'tgl_log'},
        {"data": 'id_log'},
        {"data": 'id_user'},
        {"data": 'nama_user'},
        {"data": 'id_ref'},
        {"data": 'refrensi'},
        {"data": 'keterangan'},
        {"data": 'kategori'}
      ],
      order: [[0, 'desc']]
    });
  });
</script>

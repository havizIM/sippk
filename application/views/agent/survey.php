<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Survey</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Survey</li>
        </ol>
    </div>

    <div class="col-md-7 col-4 align-self-center">
      <div class="d-flex m-t-10 justify-content-end">
        <div class="d-flex m-r-20 m-l-10 hidden-md-down">
            <a href="#/add_survey" class="btn btn-info btn-md">Add Survey</a>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-outline-info">
            <div class="card-header">
              <h4 class="m-b-0 text-white">Data Survey</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="t_survey">
                    <thead>
                      <tr>
                        <th>ID Survey</th>
                        <th>Nama Perusahaan</th>
                        <th>No SI</th>
                        <th>Commodity</th>
                        <th>Quantity</th>
                        <th>Total  Loaded</th>
                       
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
    var t_survey = $('#t_survey').DataTable({
      columnDefs: [{
        targets: [],
        searchable: true
      }],
      autoWidth: true,
      responsive: true,
      processing: true,
      ajax: '<?= base_url('api/survey/show/'); ?>'+auth.token,
      columns: [
       {"data": null, 'render': function(data, type, row){
                return `<a href="#/survey/${row.id_survey}">${row.id_survey}</a>`;
            }
        },
        {"data": null, 'render': function(data, type, row){
                return `<a href="#/client/${row.client.id_client}">${row.client.nama_perusahaan}</a>`;
            }
        },
        {"data": 'instruction.no_si'},
        {"data": 'instruction.commodity'},
        {"data": 'instruction.qty'},
        {"data": 'total_loaded'},

      ],
      order: [[0, 'desc']]
    });

  });
</script>

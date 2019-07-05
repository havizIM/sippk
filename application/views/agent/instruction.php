<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Instruction</h3>
        <ol class="breadcrumb"><li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active">Instruction</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <a href="#/add_instruction" class="btn btn-info btn-md"><i class="fa fa-plus"></i> Add Instruction</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Shipping Instruction </h4>
                <div class="table-responsive">
                    <table class="table" id="t_instruction">
                        <thead>
                            <tr>
                                <th>SI No</th>
                                <th>Date</th>
                                <th>Commodity</th>
                                <th>Qty</th>
                                <th>Tug Boat</th>
                                <th>Barge Name</th>
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

<script>

    var setupInstruction = (function(){
        var TABLE = $('#t_instruction').DataTable({
            columnDefs: [{
                targets: [],
                searchable: true
            }],
            autoWidth: true,
            responsive: true,
            processing: true,
            ajax: {
                url: '<?= base_url('api/instruction/show/'); ?>'+auth.token,
                dataSrc: function(response){
                    console.log(response);
                    return response.data;
                }
            },
            columns: [
                {"data": null, 'render': function(data, type, row){
                        return `<a href="#/instruction/${row.no_si}">${row.no_si}</a>`
                    }
                },
                {"data": 'schedule.confirmed_date'},
                {"data": 'commodity'},
                {"data": 'qty'},
                {"data": 'tug_boat'},
                {"data": 'barge_name'},
                
            ],
            order: [[0, 'desc']]
        });

        return {
            init: function(){
                TABLE;
            }
        }


    })();

    $(document).ready(function(){
        setupInstruction.init();
    })
</script>
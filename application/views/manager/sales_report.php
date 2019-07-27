
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Sales Report</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Sales Report</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filter Sales Report</h4>

                <form id="lap_schedule">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <select name="bulan" id="bulan" class="form-control form-control-sm">
                                    <option value="">-- Pilih Bulan --</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <div class="form-control-feedback" id="invalid_bulan"></div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select name="tahun" id="tahun" class="form-control form-control-sm"></select>
                                <div class="form-control-feedback" id="invalid_tahun"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" id="submit_report" class="btn btn-info btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="content_schedule_report">

    </div>
</div>

<script>

var renderUI = (function(){
    return {
      renderYear: function(data){
        var HTML = `<option value="">-- Pilih Tahun --</option>`;

        $.each(data, function(k, v){
            HTML += `<option value="${v}">${v}</option>`;
        })

        $('#tahun').html(HTML);
      },
      renderNoData: function(){

        $('#content_schedule_report').html('<h3>No Data...</h3>')
      },
      renderData: function(data){

        var html        = '';
        var no          = 1;
        var list_bulan  = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var bulan       = $('#bulan').val();
        var tahun       = $('#tahun').val();

        html += `
            <div class="card">
                <div class="card-header text-left">
                    <button id="print_schedule" class="btn btn-success"><i class="fa fa-print"></i> Print</button>
                    <hr/>
                </div>
                <div class="card-body" id="print_area">

                    <table width="100%">
                        <tr>
                            <td width="13%">
                                <center><img src="<?= base_url('assets/logo/logo.png') ?>" style="height: 70px"></center>
                            </td>
                            <td style="padding-top: 5px">
                                <h4>PT. Servo Lintas Raya</h4>
                                <h5>Graha Anabatic, Jl. Scientia Boulevard Kav. U2, Summarecon Serpong, Curug Sangereng, Kec. Klp. Dua, Tangerang, Banten 15811</h5>
                                <h6>Telp. 021-80636888 Fax. 021-80636888</h6>
                            </td>
                        </tr>
                    </table>
                    <hr/>

                    <br/>
                    
                    <p style="font-size: 12px">Sales Report per - ${list_bulan[bulan - 1]} ${tahun}</p>

                    <table class="table table-bordered" style="font-size: 12px">
                        <tr class="t-head" style="background-color: navy; color: white;">
                            <th>Client</th>
                            <th>Plan Tonnage</th>
                            <th>Revised Tonnage</th>
                            <th>Total Barge</th>
                            <th>Actual Tonnage</th>
                            <th>Status Barging</th>
                        </tr>
                `;

            var plan_tonnage = 0;
            var revised_tonnage = 0;
            var total_barge = 0;
            var actual_tonnage = 0;
            var actual_barge = 0;

            $.each(data, function(k,v){
                a1 = isNaN(parseInt(v.total_plan)) ? 0 : parseInt(v.total_plan);
                a2 = isNaN(parseInt(v.total_revised)) ? 0 : parseInt(v.total_revised);
                a3 = isNaN(parseInt(v.count_schedule)) ? 0 : parseInt(v.count_schedule);
                a4 = isNaN(parseInt(v.actual_total)) ? 0 : parseInt(v.actual_total);
                a5 = isNaN(parseInt(v.count_survey)) ? 0 : parseInt(v.count_survey);

                plan_tonnage += a1;
                revised_tonnage += a2;
                total_barge += a3;
                actual_tonnage += a4;
                actual_barge += a5;

                    html += `
                        <tr>
                            <td>${v.username}</td>
                            <td>${parseInt(a1).toLocaleString(['ban', 'id'])}</td>
                            <td>${parseInt(a2).toLocaleString(['ban', 'id'])}</td>
                            <td>${parseInt(a3).toLocaleString(['ban', 'id'])}</td>
                            <td>${parseInt(a4).toLocaleString(['ban', 'id'])}</td>
                            <td>${parseInt(a5).toLocaleString(['ban', 'id'])} Complete Barging</td>
                        </tr>
                    `;
            })

                    html += `
                        <tr class="t-foot" style="background-color: grey; color: white;">
                            <th>TOTAL SALES PLAN</th>
                            <th>${plan_tonnage.toLocaleString(['ban', 'id'])}</th>
                            <th>${revised_tonnage.toLocaleString(['ban', 'id'])}</th>
                            <th>${total_barge.toLocaleString(['ban', 'id'])}</th>
                            <th>${actual_tonnage.toLocaleString(['ban', 'id'])}</th>
                            <th>${actual_barge.toLocaleString(['ban', 'id'])} Complete Barging</th>
                        </tr>
                    `;

                    html += `
                        <tr class="t-foot" style="background-color: #26c6da; color: white;">
                            <td colspan="3">BALANCE</td>
                            <td colspan="3"><center><strong>${parseInt(revised_tonnage - actual_tonnage).toLocaleString(['ban', 'id'])}</strong></center></td>
                        </tr>
                    `;


        html += `
                    </table>
                </div> 
            </div>
        `;

        $('#content_schedule_report').html(html)
      }
    }
  })();

  var setupReportSchedule = (function(UI){
        var getYears = function(){
          var currentYear = new Date().getFullYear(), years = [];
          var startYear = startYear || 2010;

          while ( startYear <= currentYear ) {
              years.push(startYear++);
          }   
          
          UI.renderYear(years);
        }

        var submitLaporan = function(){
            $('#lap_schedule').validate({
                rules: {
                    bulan: "required",
                    tahun: "required"
                   
                },
                messages: {
                    bulan: "This field is required",
                    tahun: "This field is required"
                },
                errorClass: 'form-control-danger',
                validClass: 'form-control-success',
                success: function(error, element){
                    $(element).parent('div').removeClass('has-danger');
                },
                errorPlacement: function(error, element){
                    var name = $(element).attr("id");

                    $(element).parent('div').addClass('has-danger');
                    $('#invalid_'+name).text(error.text());
                },
                submitHandler: function(form){
                    var bulan = $(form).find('#bulan').val()
                    var tahun = $(form).find('#tahun').val()

                    $.ajax({
                        url: `<?= base_url('api/schedule/report_sales/') ?>${auth.token}?bulan=${bulan}&tahun=${tahun}`,
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function(){
                            $('#submit_report').addClass('disabled').html(`<i class="fa fa-spinner fa-spin"></i>`)
                        },
                        success: function(response){
                            if(response.data.length < 1){
                                UI.renderNoData();
                            } else {
                                UI.renderData(response.data);
                            }
                            
                            $('#submit_report').removeClass('disabled').html(`<i class="fa fa-check" ></i> Submit`)

                        },
                        error: function(err){
                            makeNotif('error', 'Failed', 'Tidak dapat mengakases server', 'bottom-right')
                            $('#submit_report').removeClass('disabled').html(`<i class="fa fa-check" ></i> Submit`)
                            console.log(err)
                        }
                })
                }
            })
        }

        var printSchedule = function(){
            $(document).on('click', '#print_schedule', function(){
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };

                $('#print_area').printArea(options);
            })
        }

        return {
          init: function(){
            getYears();
            submitLaporan();
            printSchedule();
          }
        }
  })(renderUI);

  $(document).ready(function(){
      setupReportSchedule.init();
  })
</script>
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Schedule Report</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Schedule Report</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filter Schedule Report</h4>

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
        console.log(data);
        var html        = '';
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
                    
                    <p style="font-size: 12px">Schedule Report per - ${list_bulan[bulan - 1]} ${tahun}</p>

                    <table class="table table-bordered" style="font-size: 12px">
                        <tr class="t-head" style="background-color: navy; color: white;">
                            <th>Client</th>
                            <th>Barging</th>
                            <th>Plan Tonnage</th>
                            <th>Date</th>
                        </tr>
                `;

            $.each(data, function(k,v){
                    if(v.schedule.length !== 0){
                        html += `
                            <tr>
                                <td rowspan="${v.schedule.length}">${v.username}</td>
                                <td>${v.schedule[0].barging}</td>
                                <td>${parseInt(v.schedule[0].plan_tonage).toLocaleString(['ban', 'id'])}</td>
                                <td>${v.schedule[0].confirmed_date}</td>
                            </tr>
                        `;

                        for(var i = 1 ; i < v.schedule.length; i++){
                            html += `
                                <tr>
                                    <td>${v.schedule[i].barging}</td>
                                    <td>${parseInt(v.schedule[i].plan_tonage).toLocaleString(['ban', 'id'])}</td>
                                    <td>${v.schedule[i].confirmed_date}</td>
                                </tr>
                            `;
                        }

                        html += `
                            <tr style="background-color: grey; color: white;">
                                <th colspan="2" class="text-center">Total Tonnage</th>
                                <td colspan="2" class="text-center"><strong>${parseInt(v.total_tonage).toLocaleString(['ban', 'id'])}</strong></td>
                            </tr>
                        `;
                    }
            })


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
                        url: `<?= base_url('api/schedule/report_schedule/') ?>${auth.token}?bulan=${bulan}&tahun=${tahun}`,
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
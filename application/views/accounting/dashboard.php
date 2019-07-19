<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><i class="fa fa-home"></i> Dashboard</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">

    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-info"><i class="ti-wallet"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-light"id="count_client"><i class="fa fa-spin fa-spinner"></i></h3>
                        <h5 class="text-muted m-b-0">Client</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-cellphone-link"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht" id="count_schedule"><i class="fa fa-spin fa-spinner"></i></h3>
                        <h5 class="text-muted m-b-0">Schedule</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-cart-outline"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht" id="count_instruction"><i class="fa fa-spin fa-spinner"></i></h3>
                        <h5 class="text-muted m-b-0">Instruction</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-danger"><i class="mdi mdi-bullseye"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht" id="count_survey"><i class="fa fa-spin fa-spinner"></i></h3>
                        <h5 class="text-muted m-b-0">Survey</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<div class="row">
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Client Chart</h3>
                        <canvas id="clientChart" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Barging Chart</h3>
                        <canvas id="bargeChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tonnage Chart</h3>
                <canvas id="tonageChart" height="335"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Barging Calendar</h3>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<script>
    var DOM = {
        client: '#count_client',
        schedule: '#count_schedule',
        instruction: '#count_instruction',
        survey: '#count_survey',
        calendar: '#calendar'
    }

    var setupDashboard = (() => {

        var CALENDAR = $(DOM.calendar).fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: moment().format("YYYY-MM-DD"),
            editable: false,
            eventLimit: true,
            droppable: false,
            events: {
                url: `<?= base_url('api/schedule/show/'); ?>${auth.token}`,
                error: function(){
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
                },
                success: function(response){
                    var events_array = [];

                    $.each(response.data, function(k, v){
                        if(v.status_schedule === 'Confirmed' || v.status_schedule === 'Complete'){
                             var obj = {
                                title: v.client.username,
                                start: v.confirmed_date,
                                className: v.status_schedule === 'Confirmed' ? 'bg-success' : 'bg-info'
                            };
                            events_array.push(obj); 
                        } 
                    });

               
                    return events_array;
                }
            },
            // loading: function(bool){
            //   alert('Loading....');
            // }
        });

        var CLIENT_CHART = new Chart(document.getElementById('clientChart').getContext('2d'),{
            type : 'doughnut',
            data : {
            labels : [],
            datasets: [{
                data : [],
                backgroundColor: [
                    "blue",
                    "red"
                ]
            }],
            },

            options : {
            legend : {
                display : true,
            },
            responsive : true,
            tooltips: {
                enabled: true,
            }
            }
        });

        var SALES_CHART = new Chart(document.getElementById('tonageChart').getContext('2d'),{
            type: 'line',
            data: {
            labels:[
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec',
            ],
            datasets:[{
                label: 'Plan Tonnage',
                data: [],
                borderColor: "rgba(0, 176, 228, 0.75)",
                backgroundColor: "transparent",
                pointBorderColor: "rgba(0, 176, 228, 0)",
                pointBackgroundColor: "rgba(0, 176, 228, 0.9)",
                pointBorderWidth: 1,
            },{
                label: 'Revised Tonnage',
                data: [],
                borderColor: "rgba(255, 178, 43, 0.75)",
                backgroundColor: "transparent",
                pointBorderColor: "rgba(255, 178, 43, 0)",
                pointBackgroundColor: "rgba(255, 178, 43, 0.9)",
                pointBorderWidth: 1,
            },{
                label: 'Actual Tonnage',
                data: [],
                borderColor: "rgba(252, 75, 108, 0.75)",
                backgroundColor: "transparent",
                pointBorderColor: "rgba(252, 75, 108, 0)",
                pointBackgroundColor: "rgba(252, 75, 108, 0.9)",
                pointBorderWidth: 1,
            }],
            },
            options:{
            responsive : true,
            legend : {
                display : true,
            },
            },
        });

        var BARGING_CHART = new Chart(document.getElementById('bargeChart').getContext('2d'),{
            type: 'radar',
            data: {
            labels:[
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec',
            ],
            datasets:[{
                label: 'Plan Barging',
                data: [],
                borderColor: "rgba(0, 176, 228, 0.75)",
                backgroundColor: "transparent",
                pointBorderColor: "rgba(0, 176, 228, 0)",
                pointBackgroundColor: "rgba(0, 176, 228, 0.9)",
                pointBorderWidth: 1,
            },{
                label: 'Actual Barging',
                data: [],
                borderColor: "rgba(252, 75, 108, 0.75)",
                backgroundColor: "transparent",
                pointBorderColor: "rgba(252, 75, 108, 0)",
                pointBackgroundColor: "rgba(252, 75, 108, 0.9)",
                pointBorderWidth: 1,
            }],
            },
            options:{
            responsive : true,
            legend : {
                display : true,
            },
            },
        });

        var randomColor = () => {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        
        var getPlan = () => {
            $.ajax({
                url : `<?= base_url('api/schedule/show/'); ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    var { data } = res

                    $(DOM.schedule).text(parseInt(data.length).toLocaleString(['ban', 'id']))
                },
                error: function(err){
                    $(DOM.schedule).html('<i style="color: red;">Error Access</i>')
                }
            })
        }

        var getInstruction = () => {
            $.ajax({
                url : `<?= base_url('api/instruction/show/'); ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    var { data } = res
                    $(DOM.instruction).text(parseInt(data.length).toLocaleString(['ban', 'id']))
                },
                error: function(err){
                    $(DOM.instruction).html('<i style="color: red;">Error Access</i>')
                }
            })
        }

        var getSurvey = () => {
            $.ajax({
                url : `<?= base_url('api/survey/show/'); ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    var { data } = res

                    $(DOM.survey).text(parseInt(data.length).toLocaleString(['ban', 'id']))
                },
                error: function(err){
                    $(DOM.survey).html('<i style="color: red;">Error Access</i>')
                }
            })
        }

        var getClient = () => {
            $.ajax({
                url : `<?= base_url('api/client/show/'); ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    var { data } = res

                    var active_client       = data.filter(client => client.status === 'Aktif').length;
                    var nonactive_client    = data.filter(client => client.status === 'Nonaktif').length;

                    if(active_client !== 0){
                        CLIENT_CHART.data.labels.push('Aktif');
                        CLIENT_CHART.data.datasets[0].data.push(active_client)
                    }

                    if(nonactive_client !== 0){
                        CLIENT_CHART.data.labels.push('Nonaktif');
                        CLIENT_CHART.data.datasets[0].data.push(nonactive_client)
                    }

                    $(DOM.client).text(parseInt(data.length).toLocaleString(['ban', 'id']))
                    CLIENT_CHART.update();
                },
                error: function(err){
                    $(DOM.client).html('<i style="color: red;">Error Access</i>')
                }
            })
        }

        var getSales = () => {
            $.ajax({
                url : `<?= base_url('api/schedule/statistic/'); ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    var { data } = res;

                    SALES_CHART.data.datasets[0].data = data.schedule.total;
                    SALES_CHART.data.datasets[1].data = data.instruction.total;
                    SALES_CHART.data.datasets[2].data = data.survey.total;

                    BARGING_CHART.data.datasets[0].data = data.schedule.count;
                    BARGING_CHART.data.datasets[1].data = data.survey.count;

                    SALES_CHART.update();
                    BARGING_CHART.update();
                },
                error: function(err){
                    $(DOM.client).html('<i style="color: red;">Error Access</i>')
                }
            })
        }

        

        return {
            init: () => {
                CALENDAR;
                CLIENT_CHART;
                BARGING_CHART
                getPlan();
                getSales();
                getInstruction();
                getSurvey();
                getClient();
            }
        }
    })();

    $(document).ready(function(){
        setupDashboard.init();
    })
</script>

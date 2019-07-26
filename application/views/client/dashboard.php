<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>

    <div class="col-md-6 col-2 align-self-center">

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-info"><i class="ti-wallet"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-light" id="total_plan"><i class="fa fa-spin fa-spinner"></i></h3>
                                <h5 class="text-muted m-b-0">Total Plan</h5></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-cellphone-link"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-lgiht" id="total_confirmed"><i class="fa fa-spin fa-spinner"></i></h3>
                                <h5 class="text-muted m-b-0">Total Confirmed</h5></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-cart-outline"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-lgiht" id="total_instruction"><i class="fa fa-spin fa-spinner"></i></h3>
                                <h5 class="text-muted m-b-0">Total Instruction</h5></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-danger"><i class="mdi mdi-bullseye"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-lgiht" id="total_survey"><i class="fa fa-spin fa-spinner"></i></h3>
                                <h5 class="text-muted m-b-0">Total Survey</h5></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card card-inverse card-primary" style="height: 88%">
            <div class="card-body">
                <div class="d-flex">
                    <div class="m-r-20 align-self-center">
                        <h1 class="text-white"><i class="ti-pie-chart"></i></h1></div>
                    <div>
                        <h3 class="card-title">Total Actual Loaded</h3>
                        <h6 class="card-subtitle" id="nama_perusahaan">-</h6></div>
                </div>
                <div class="row m-t-20">
                    <div class="col-12 align-self-center">
                        <center>
                            <h1 class="font-light text-white" id="total_loaded"><i class="fa fa-spin fa-spinner"></i></h1>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Column -->
</div>

<div class="row">

    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Barging Calendar</h3>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-md-5">
        <div class="card card-body">
            <h3 class="card-title">Reminder</h3>
            <div class="message-box">
                <div class="message-widget m-t-20" id="mynotif">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var DOM = {
        plan: '#total_plan',
        confirmed: '#total_confirmed',
        instruction: '#total_instruction',
        survey: '#total_survey',
        calendar: '#calendar',
        loaded: '#total_loaded',
        perusahaan: '#nama_perusahaan',
        notif: '#mynotif',
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
                url: `<?= base_url('ext/schedule/show/'); ?>${auth.token}`,
                error: function(){
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
                },
                success: function(response){
                    var events_array = [];

                    $.each(response.data, function(k, v){
                        if(v.status_schedule === 'Confirmed' || v.status_schedule === 'Complete'){
                             var obj = {
                                title: v.status_schedule,
                                start: v.confirmed_date,
                                className: v.status_schedule === 'Confirmed' ? 'bg-info' : 'bg-success'
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

        var checkSchedule = () => {
            $.ajax({
                url : `<?= base_url('ext/notif/schedule/'); ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    var {notif} = res;
                    var html = '';

                    if(notif === true){
                        html += `
                            <a href="#/add_schedule">
                                <div class="user-img"><span class="round bg-primary"><i class="mdi mdi-email"></i></span></div>
                                <div class="mail-contnet">
                                    <h5>You have to set Schedule Plan</h5> <span class="mail-desc">Schedule </span> <span class="time">9:30 AM</span> </div>
                            </a>
                        `;
                    }

                    $(DOM.notif).append(html);
                },
                error: function(err){

                }
            })
        }

        var checkConfirmed = () => {
            $.ajax({
                url: `<?= base_url('ext/instruction/lookup_schedule/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    var html = '';

                    if(response.data.length !== 0){
                        html += `
                            <a href="#/add_instruction">
                                <div class="user-img"><span class="round bg-danger"><i class="mdi mdi-earth"></i></span></div>
                                <div class="mail-contnet">
                                    <h5>${response.data.length} date confirmed, Lets build Shipping Instruction</h5> <span class="mail-desc">Todays headlines : Breakdancing Grandma Proves ..</span> <span class="time">9:10 AM</span> </div>
                            </a>
                        `
                    }

                    $(DOM.notif).append(html);
                },
                error: function(err){

                }
            })
        }

        var checkSurvey = () => {
            $.ajax({
                url: `<?= base_url('ext/notif/survey/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    var html = '';

                    if(response.data.length !== 0){
                        html += `
                            <a href="#/survey">
                                <div class="user-img"> <span class="round bg-success"><i class="mdi mdi-currency-usd"></i></span></div>
                                <div class="mail-contnet">
                                    <h5>${response.data.length} Survey Draft has send. Lets see..</h5> <span class="mail-desc">$3500 from Krishnan, $2000 from Akhil</span> <span class="time">9:08 AM</span> </div>
                            </a>
                        `
                    }

                    $(DOM.notif).append(html);
                },
                error: function(err){

                }
            })
        }
        
        var getPlan = () => {
            $.ajax({
                url : `<?= base_url('ext/schedule/show/'); ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    var { data } = res
                    var confirmed = data.filter((conf) => conf.status_schedule === 'Confirmed' || conf.status_schedule === 'Complete')

                    $(DOM.plan).text(parseInt(data.length).toLocaleString(['ban', 'id']))
                    $(DOM.confirmed).text(parseInt(confirmed.length).toLocaleString(['ban', 'id']))
                },
                error: function(err){
                    $(DOM.plan).html('<i style="color: red;">Error Access</i>')
                    $(DOM.confirmed).html('<i style="color: red;">Error Access</i>')
                }
            })
        }

        var getInstruction = () => {
            $.ajax({
                url : `<?= base_url('ext/instruction/show/'); ?>${auth.token}`,
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
                url : `<?= base_url('ext/survey/show/'); ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    var { data } = res
                    var loaded = 0;
                    
                    $.each(data, (k, v) => {
                        loaded += parseInt(v.total_loaded)
                    });

                    $(DOM.survey).text(parseInt(data.length).toLocaleString(['ban', 'id']))
                    $(DOM.perusahaan).text(auth.nama_perusahaan)
                    $(DOM.loaded).text(parseInt(loaded).toLocaleString(['ban', 'id'])+' MT')
                },
                error: function(err){
                    $(DOM.survey).html('<i style="color: red;">Error Access</i>')
                }
            })
        }

        

        return {
            init: () => {
                CALENDAR;
                checkSchedule();
                checkConfirmed();
                checkSurvey();
                getPlan();
                getInstruction();
                getSurvey();
            }
        }
    })();

    $(document).ready(function(){
        setupDashboard.init();
    })

</script>


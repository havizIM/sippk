<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Add Client</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#/client"><i class="fa fa-users"></i> Client</a></li>
            <li class="breadcrumb-item active">Add Client</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">

    </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card card-outline-info">
      <div class="card-header">
        <h4 class="m-b-0 text-white">Form Pendaftaran Client</h4>
      </div>
      <div class="card-body wizard-content">
            <form class="validation-wizard wizard-circle" id="form_client"  enctype="multipart/form-data">
                <!-- Step 1 -->
                <h6>Data Perusahaan</h6>
                <section>
                    <div class="row">
                        <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-control-label" for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan">
                            <div class="form-control-feedback" id="invalid_nama_perusahaan"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="penanggung_jawab">Penanggung Jawab</label>
                            <input type="text" class="form-control" name="penanggung_jawab" id="penanggung_jawab">
                            <div class="form-control-feedback" id="invalid_penanggung_jawab"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="alamat_perusahaan">Alamat Perusahaan</label>
                            <textarea class="form-control" name="alamat_perusahaan" id="alamat_perusahaan" rows="6"></textarea>
                            <div class="form-control-feedback" id="invalid_alamat_perusahaan"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="kode_pos">Kode Pos</label>
                            <input type="number" class="form-control" name="kode_pos" id="kode_pos">
                            <div class="form-control-feedback" id="invalid_kode_pos"></div>
                        </div>
                        </div>
                        <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-control-label" for="telepon">Telepon</label>
                            <input type="number" class="form-control" name="telepon" id="telepon">
                            <div class="form-control-feedback" id="invalid_telepon"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="telepon">Fax</label>
                            <input type="number" class="form-control" name="fax" id="fax">
                            <div class="form-control-feedback" id="invalid_fax"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="npwp">NPWP</label>
                            <input type="number" class="form-control" name="npwp" id="npwp">
                            <div class="form-control-feedback" id="invalid_npwp"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="mou">MOU <small><i>.doc / .docx / .pdf </i></small></label>
                            <input type="file" class="form-control" name="mou" id="mou">
                            <div class="form-control-feedback" id="invalid_mou"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="logo_perusahaan">Logo Perusahaan <small><i>.jpg / .jpeg / .png</i></small></label>
                            <input type="file" class="form-control" name="logo_perusahaan" id="logo_perusahaan">
                            <div class="form-control-feedback" id="invalid_logo_perusahaan"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="website">Website</label>
                            <input type="text" class="form-control" name="website" id="website">
                            <div class="form-control-feedback" id="invalid_website"></div>
                        </div>
                        </div>
                    </div>
                </section>
                
                <!-- Step 2 -->
                <h6>PIC</h6>
                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="nama_pic">Nama PIC</label>
                                <input type="text" class="form-control" name="nama_pic" id="nama_pic">
                                <div class="form-control-feedback" id="invalid_nama_pic"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="email_pic">Email PIC</label>
                                <input type="email" class="form-control" name="email_pic" id="email_pic">
                                <div class="form-control-feedback" id="invalid_email_pic"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="telepon_pic">Telepon PIC</label>
                                <input type="number" class="form-control" name="telepon_pic" id="telepon_pic">
                                <div class="form-control-feedback" id="invalid_telepon_pic"></div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Step 3 -->
                <h6>Account</h6>
                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email_perusahaan">Email Perusahaan</label>
                                <input type="text" class="form-control" name="email_perusahaan" id="email_perusahaan">
                                <div class="form-control-feedback" id="invalid_email_perusahaan"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username">
                                <div class="form-control-feedback" id="invalid_username"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="expired_date">Expired Date</label>
                                <input type="date" class="form-control" name="expired_date" id="expired_date">
                                <div class="form-control-feedback" id="invalid_expired_date"></div>
                            </div>
                        </div>
                    </div>
                </section>
                                    
            </form>
      </div>
    </div>
  </div>
</div>

<script>
    var setupForm = (function(){
        var form = $(".validation-wizard");

        var setupValidate = function(){
            $.validator.addMethod('filesize', function (value, element, arg) {
                if(element.files[0].size<=arg){
                    return true;
                }else{
                    return false;
                }
            });

            $.validator.addMethod('pdf', function (value, element, arg) {
                param = typeof param === "string" ? param.replace(/,/g, '|') : "pdf";
                return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
            });

            $.validator.addMethod('image', function (value, element, arg) {
                param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g";
                return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
            });

            form.validate({
                rules: {
                    nama_perusahaan: "required",
                    penanggung_jawab: "required",
                    alamat_perusahaan: "required",
                    kode_pos: "required",
                    telepon: "required",
                    fax: "required",
                    npwp: "required",
                    mou: {
                        required: true,
                        filesize: 200000
                    },
                    logo_perusahaan: {
                        required: true,
                        filesize: 200000
                    },
                    nama_pic: "required",
                    email_pic: "required",
                    telepon_pic: "required",
                    email_perusahaan: "required",
                    username: "required",
                    expired_date: "required",
                },
                messages: {
                    nama_perusahaan: "Masukkan nama perusahaan",
                    penanggung_jawab: "Masukkan penanggung jawab",
                    alamat_perusahaan: "Masukkan alamat perusahaan",
                    kode_pos: "Masukkan kode pos perusahaan",
                    telepon: "Masukkan telepon perusahaan",
                    fax: "Masukkan fax perusahaan",
                    npwp: "Masukkan npwp perusahaan",
                    mou: {
                        required: "Pilih file MOU",
                        filesize: "Ukuran maksimal 2 MB"
                    },
                    logo_perusahaan: {
                        required: "Pilih Logo Perusahaan",
                        filesize: "Ukuran maksimal 2 MB"
                    },
                    nama_pic: "Masukkan nama pic perusahaan",
                    email_pic: "Masukkan email pic perusahaan",
                    telepon_pic: "Masukkan telepon pic perusahaan",
                    email_perusahaan: "Masukkan email perusahaan",
                    username: "Masukkan username perusahaan",
                    expired_date: "Pilih tanggal expired MOU",
                },
                errorClass: 'form-control-danger',
                validClass: 'form-control-success',
                success: function(error, element){
                    $(element).parent('div').removeClass('has-danger');
                },
                errorPlacement: function(error, element) {
                    var name = $(element).attr("id");

                    $(element).parent('div').addClass('has-danger');
                    $('#invalid_'+name).text(error.text());
                },
            });
        }

        var setupStep = function(){
            form.steps({
                headerTag: "h6",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                labels: {
                    finish: "Simpan"
                },
                onStepChanging: function (event, currentIndex, newIndex)
                {   
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Used to skip the "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
                    {
                        form.steps("next");
                    }
                    // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        form.steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    form.validate().settings.ignore = ":disabled";
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    form.submit();
                }
            })
        }

        var submitForm = function(){
            $('#form_client').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url: `<?= base_url('api/client/add/') ?>${auth.token}`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: new FormData(this),
                    processData:false,
                    contentType:false,
                    beforeSend: function(){
                        $('#submit_client').addClass('disabled').html(`<i class="fa fa-spinner fa-spin"></i>`)
                    },
                    success: function(response){
                        if(response.status === 200){
                        makeNotif('success', 'Success', response.message, 'bottom-right')
                        location.hash = '#/client';
                        } else {
                        makeNotif('error', 'Failed', response.message, 'bottom-right')
                        $('#submit_client').removeClass('disabled').html(`<i class="fa fa-check" ></i> Simpan`)
                        }

                    },
                    error: function(err){
                        makeNotif('error', 'Failed', 'Tidak dapat mengakases server', 'bottom-right')
                        $('#submit_client').removeClass('disabled').html(`<i class="fa fa-check" ></i> Simpan`)
                    }
                })
            });
        }

        return {
            init : function(){
                setupValidate();
                setupStep();
                submitForm();
            }
        }
    })();

    $(document).ready(function(){
        setupForm.init();
    })
    

</script>
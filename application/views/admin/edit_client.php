<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Edit Client</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#/client"><i class="fa fa-users"></i> Client</a></li>
            <li class="breadcrumb-item active">Edit Client</li>
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
        <form id="edit_client" class="form-control-line" enctype="multipart/form-data">

          <div class="wizards">
              <div class="progressbar">
                  <div class="progress-line" data-now-value="19.66" data-number-of-steps="3" style="width: 19.66%;"></div> <!-- 19.66% -->
              </div>
              <div class="form-wizard active">
                  <div class="wizard-icon"><i class="fa fa-user"></i></div>
                  <p class="text-center">Data Pribadi</p>
              </div>
              <div class="form-wizard">
                  <div class="wizard-icon"><i class="fa fa-key"></i></div>
                  <p class="text-center">Informasi</p>
              </div>
              <div class="form-wizard">
                  <div class="wizard-icon"><i class="fa fa-globe"></i></div>
                  <p class="text-center">Account</p>
              </div>
          </div><br>

          <fieldset>
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="form-group">
                      <label class="form-control-label" for="nama_perusahaan">Nama Perusahaan</label>
                      <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan">
                  </div>
                  <div class="form-group">
                      <label class="form-control-label" for="penanggung_jawab">Penanggung Jawab</label>
                      <input type="text" class="form-control" name="penanggung_jawab" id="penanggung_jawab">
                  </div>
                  <div class="form-group">
                      <label class="form-control-label" for="alamat_perusahaan">Alamat Perusahaan</label>
                      <textarea class="form-control" name="alamat_perusahaan" id="alamat_perusahaan" rows="6"></textarea>
                  </div>
                  <div class="form-group">
                      <label class="form-control-label" for="kode_pos">Kode Pos</label>
                      <input type="number" class="form-control" name="kode_pos" id="kode_pos">
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="form-group">
                      <label class="form-control-label" for="telepon">Telepon</label>
                      <input type="number" class="form-control" name="telepon" id="telepon">
                  </div>
                  <div class="form-group">
                      <label class="form-control-label" for="telepon">Fax</label>
                      <input type="number" class="form-control" name="fax" id="fax">
                  </div>
                  <div class="form-group">
                      <label class="form-control-label" for="npwp">NPWP</label>
                      <input type="number" class="form-control" name="npwp" id="npwp">
                  </div>
                  <div class="form-group">
                      <label class="form-control-label" for="mou">MOU <small><i>.doc / .docx / .pdf</i></small></label>
                      <input type="file" class="form-control" name="mou" id="mou">
                  </div>
                  <div class="form-group">
                      <label class="form-control-label" for="logo_perusahaan">Logo Perusahaan <small><i>.jpg / .jpeg / .png</i></small></label>
                      <input type="file" class="form-control" name="logo_perusahaan" id="logo_perusahaan">
                  </div>
                  <div class="form-group">
                      <label class="form-control-label" for="website">Website</label>
                      <input type="url" class="form-control" name="website" id="website">
                  </div>
                </div>
              </div>
              <div class="wizard-buttons">
                  <button type="button" class="btn btn-next">Next</button>
              </div>
          </fieldset>
          <fieldset>
              <div class="form-group">
                  <label class="form-control-label" for="nama_pic">Nama PIC</label>
                  <input type="text" class="form-control" name="nama_pic" id="nama_pic">
              </div>
              <div class="form-group">
                  <label class="form-control-label" for="email_pic">Email PIC</label>
                  <input type="email" class="form-control" name="email_pic" id="email_pic">
              </div>
              <div class="form-group">
                  <label class="form-control-label" for="telepon_pic">Telepon PIC</label>
                  <input type="number" class="form-control" name="telepon_pic" id="telepon_pic">
              </div>
              <div class="wizard-buttons">
                  <button type="button" class="btn btn-previous">Previous</button>
                  <button type="button" class="btn btn-next">Next</button>
              </div>
          </fieldset>
          <fieldset>
              <div class="form-group">
                  <label class="form-control-label" for="email_perusahaan">Email Perusahaan</label>
                  <input type="text" class="form-control" name="email_perusahaan" id="email_perusahaan">
              </div>
              <div class="form-group">
                  <label class="form-control-label" for="username">Username</label>
                  <input type="text" class="form-control" name="username" id="username">
              </div>
              <div class="form-group">
                  <label class="form-control-label" for="expired_date">Expired Date</label>
                  <input type="date" class="form-control" name="expired_date" id="expired_date">
              </div>
              <div class="wizard-buttons">
                <button type="button" class="btn btn-previous">Previous</button>
                <button type="submit" name="save" id="submit_client" class="btn btn-primary btn-submit"><i class="fa fa-check"></i>Simpan</button>
              </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if($(window).scrollTop() != scroll_to) {
      $('html, body').stop().animate({scrollTop: scroll_to}, 0);
    }
  }

  function bar_progress(progress_line_object, direction) {
    var number_of_steps = progress_line_object.data('number-of-steps');
    var now_value = progress_line_object.data('now-value');
    var new_value = 0;
    if(direction == 'right') {
      new_value = now_value + ( 100 / number_of_steps );
    }
    else if(direction == 'left') {
      new_value = now_value - ( 100 / number_of_steps );
    }
    progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
  }

  function load_data(id_client){
    $.ajax({
      url: `<?= base_url('api/client/show/'); ?>${auth.token}?id_client=${id_client}`,
      dataType: 'JSON',
      type: 'GET',
      success: function(response){
        $.each(response.data, function(k,v){
          $('#nama_perusahaan').val(v.nama_perusahaan);
          $('#penanggung_jawab').val(v.penanggung_jawab);
          $('#alamat_perusahaan').val(v.alamat_perusahaan);
          $('#kode_pos').val(v.kode_pos);
          $('#telepon').val(v.telepon);
          $('#fax').val(v.fax);
          $('#npwp').val(v.npwp);
          $('#website').val(v.website);
          $('#nama_pic').val(v.nama_pic);
          $('#email_pic').val(v.email_pic);
          $('#telepon_pic').val(v.telepon_pic);
          $('#email_perusahaan').val(v.email_perusahaan);
          $('#username').val(v.username);
          $('#expired_date').val(v.expired_date);
        });
      },
      error: function(){
        makeNotif('error', 'Failed', 'Tidak dapat mengakases server', 'bottom-right')
      }
    })
  }

  $(document).ready(function(){
    var id_client = location.hash.substr(14);
    load_data(id_client);

    $('form fieldset:first').fadeIn('slow');

    $('form input[type="text"], input[type="date"], input[type="number"], input[type="url"], input[type="password"],  input[type="email"],  input[type="tel"], form textarea, form select').on('focus', function() {
      $(this).parent().removeClass('has-danger');
      $(this).removeClass('form-control-danger');
    });

    $('form .btn-next').on('click', function() {
     var parent_fieldset = $(this).parents('fieldset');
     var next_step = true;
     var current_active_step = $(this).parents('form').find('.form-wizard.active');
     var progress_line = $(this).parents('form').find('.progress-line');

     parent_fieldset.find('input[type="text"], input[type="date"], input[type="number"], input[type="password"], input[type="email"], input[type="tel"], input[type="url"], textarea, select, input[type="hidden"]').each(function() {
       if( $(this).val() == "" ) {
         $(this).parent().addClass('has-danger');
         $(this).addClass('form-control-danger');
         next_step = false;
       }
       else {
         $(this).parent().removeClass('has-danger');
         $(this).removeClass('form-control-danger');
       }
     });

     if( next_step ) {
       parent_fieldset.fadeOut(400, function() {
         current_active_step.removeClass('active').addClass('activated').next().addClass('active');
         bar_progress(progress_line, 'right');
         $(this).next().fadeIn();
         scroll_to_class( $('form'), 20 );
       });
     }

    });

    // previous step
    $('form .btn-previous').on('click', function() {
     var current_active_step = $(this).parents('form').find('.form-wizard.active');
     var progress_line = $(this).parents('form').find('.progress-line');

     $(this).parents('fieldset').fadeOut(400, function() {
       current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
       bar_progress(progress_line, 'left');
       $(this).prev().fadeIn();
       scroll_to_class( $('form'), 20 );
     });
    });

    $('#edit_client').on('submit', function(e) {
     e.preventDefault();

     $(this).find('input[type="text"], input[type="date"], input[type="number"], input[type="password"], input[type="email"], input[type="tel"], input[type="url"], textarea, select, input[type="hidden"]').each(function() {
       if( $(this).val() == "" ) {
         $(this).parent().addClass('has-danger');
         $(this).addClass('form-control-danger');
         makeNotif('warning', 'Warning', 'Masih ada field yang belum terisi', 'bottom-right')
       }
       else {
         $(this).parent().removeClass('has-danger');
         $(this).removeClass('form-control-danger');
       }
     });

     $.ajax({
       url: `<?= base_url('api/client/edit/') ?>${auth.token}?id_client=${id_client}`,
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
  })
</script>

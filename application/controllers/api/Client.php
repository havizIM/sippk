<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Client extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this->options = array(
      'cluster' => 'ap1',
      'useTLS' => true
    );

    $this->pusher = new Pusher\Pusher(
      '73148b9e44433055599c',
      '375df20a410d95d53ba4',
      '761632',
      $this->options
    );


		$this->load->model('ClientModel');
  }

  /* ------------------------------ Show Client ----------------------------- */
  function show($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi        = $auth->row();

          $where = array('id_client' => $this->input->get('id_client'));

          $show  = $this->ClientModel->show($where);
          $client  = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_client']          = $key->id_client;
            $json['nama_perusahaan']    = $key->nama_perusahaan;
            $json['penanggung_jawab']   = $key->penanggung_jawab;
            $json['alamat_perusahaan']  = $key->alamat_perusahaan;
            $json['kode_pos']           = $key->kode_pos;
            $json['telepon']            = $key->telepon;
            $json['fax']                = $key->fax;
            $json['npwp']               = $key->npwp;
            $json['mou']                = $key->mou;
            $json['logo_perusahaan']    = $key->logo_perusahaan;
            $json['website']            = $key->website;
            $json['nama_pic']           = $key->nama_pic;
            $json['email_pic']          = $key->email_pic;
            $json['telepon_pic']        = $key->telepon_pic;
            $json['email_perusahaan']   = $key->email_perusahaan;
            $json['username']           = $key->username;
            $json['expired_date']       = $key->expired_date;
            $json['status']             = $key->status;
            $json['tgl_registrasi']     = $key->tgl_registrasi;

            $client[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $client));
        }
      }
    }
  }

  /* ------------------------------ Add Client ----------------------------- */
  function add($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $nama_perusahaan      = $this->input->post('nama_perusahaan');
            $penanggung_jawab     = $this->input->post('penanggung_jawab');
            $alamat_perusahaan    = $this->input->post('alamat_perusahaan');
            $kode_pos             = $this->input->post('kode_pos');
            $telepon              = $this->input->post('telepon');
            $fax                  = $this->input->post('fax');
            $npwp                 = $this->input->post('npwp');
            $website              = $this->input->post('website');
            $nama_pic             = $this->input->post('nama_pic');
            $email_pic            = $this->input->post('email_pic');
            $telepon_pic          = $this->input->post('telepon_pic');
            $email_perusahaan     = $this->input->post('email_perusahaan');
            $username             = $this->input->post('username');
            $expired_date         = $this->input->post('expired_date');

            $mycode               = $username.'CL';
            $id_client            = $this->KodeModel->buatKode('client', $mycode, 'id_client', 3);


            if($nama_perusahaan == null || $nama_perusahaan == null || $penanggung_jawab == null || $alamat_perusahaan == null || $kode_pos == null || $telepon == null || $fax == null || $npwp == null || $nama_pic == null || $email_pic == null || $telepon_pic == null || $email_perusahaan == null || $username == null || $expired_date == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

              $logo_perusahaan = $this->upload_file('logo_perusahaan', $id_client);
              $mou             = $this->upload_file('mou', $id_client);

              if($logo_perusahaan == null || $mou == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'File yang dikirim tidak lengkap'));
              } else {
                $data = array(
                  'id_client'          => $id_client,
                  'nama_perusahaan'    => $nama_perusahaan,
                  'penanggung_jawab'   => $penanggung_jawab,
                  'alamat_perusahaan'  => $alamat_perusahaan,
                  'kode_pos'           => $kode_pos,
                  'telepon'            => $telepon,
                  'fax'                => $fax,
                  'npwp'               => $npwp,
                  'mou'                => $mou,
                  'logo_perusahaan'    => $logo_perusahaan,
                  'website'            => $website,
                  'nama_pic'           => $nama_pic,
                  'email_pic'          => $email_pic,
                  'telepon_pic'        => $telepon_pic,
                  'email_perusahaan'   => $email_perusahaan,
                  'username'           => $username,
                  'password'           => substr(str_shuffle("01234567890abcdefghijklmnopqestuvwxyz"), 0, 5),
                  'expired_date'       => $expired_date,
                  'status'             => 'Nonaktif',
                  'token'              => sha1($email_perusahaan)
                );

                $log = array(
                  'user'        => $otorisasi->id_user,
                  'id_ref'      => $id_client,
                  'refrensi'    => 'Client',
                  'keterangan'  => 'Menambah data client baru',
                  'kategori'    => 'Add'
                );

                $add = $this->ClientModel->add($data, $log);

                if(!$add){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah data client'));
                } else {
                  $this->pusher->trigger('sippk', 'client', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah data client'));
                }
              }
            }
          }
        }
      }
    }
  }

  /* ------------------------------ Edit Client ----------------------------- */
  function edit($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_client            = $this->input->get('id_client');
            $nama_perusahaan      = $this->input->post('nama_perusahaan');
            $penanggung_jawab     = $this->input->post('penanggung_jawab');
            $alamat_perusahaan    = $this->input->post('alamat_perusahaan');
            $kode_pos             = $this->input->post('kode_pos');
            $telepon              = $this->input->post('telepon');
            $fax                  = $this->input->post('fax');
            $npwp                 = $this->input->post('npwp');
            $website              = $this->input->post('website');
            $nama_pic             = $this->input->post('nama_pic');
            $email_pic            = $this->input->post('email_pic');
            $telepon_pic          = $this->input->post('telepon_pic');
            $email_perusahaan     = $this->input->post('email_perusahaan');
            $username             = $this->input->post('username');
            $expired_date         = $this->input->post('expired_date');

            if($id_client == null){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Client yang dipilih'));
            } else {
              if($nama_perusahaan == null || $nama_perusahaan == null || $penanggung_jawab == null || $alamat_perusahaan == null || $kode_pos == null || $telepon == null || $fax == null || $npwp == null || $nama_pic == null || $email_pic == null || $telepon_pic == null || $email_perusahaan == null || $username == null || $expired_date == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {

                $data = array(
                  'nama_perusahaan'    => $nama_perusahaan,
                  'penanggung_jawab'   => $penanggung_jawab,
                  'alamat_perusahaan'  => $alamat_perusahaan,
                  'kode_pos'           => $kode_pos,
                  'telepon'            => $telepon,
                  'fax'                => $fax,
                  'npwp'               => $npwp,
                  'website'            => $website,
                  'nama_pic'           => $nama_pic,
                  'email_pic'          => $email_pic,
                  'telepon_pic'        => $telepon_pic,
                  'email_perusahaan'   => $email_perusahaan,
                  'username'           => $username,
                  'expired_date'       => $expired_date,
                  'status'             => 'Nonaktif'
                );

                $logo_perusahaan = $this->upload_file('logo_perusahaan', $id_client);
                $mou             = $this->upload_file('mou', $id_client);

                if($logo_perusahaan != null){
                  $data['logo_perusahaan'] = $logo_perusahaan;
                }

                if($mou != null){
                  $data['mou'] = $mou;
                }

                $log = array(
                  'user'        => $otorisasi->id_user,
                  'id_ref'      => $id_client,
                  'refrensi'    => 'Client',
                  'keterangan'  => 'Mengedit data client',
                  'kategori'    => 'Edit'
                );

                $edit = $this->ClientModel->edit($id_client, $data, $log);

                if(!$edit){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit client'));
                } else {
                  $this->pusher->trigger('sippk', 'client', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit client'));
                }
              }
            }
          }
        }
      }
    }
  }

  /* ------------------------------ Delete Client ----------------------------- */
  function delete($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_client = $this->input->get('id_client');

            if($id_client == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Client tidak ditemukan'));
            } else {

              $this->delete_file('logo_perusahaan', $id_client);
              $this->delete_file('mou', $id_client);

              $log = array(
                'user'        => $otorisasi->id_user,
                'id_ref'      => $id_client,
                'refrensi'    => 'Client',
                'keterangan'  => 'Menghapus data client baru',
                'kategori'    => 'Delete'
              );

              $delete = $this->ClientModel->delete($id_client, $log);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus client'));
              } else {
                $this->pusher->trigger('sippk', 'client', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus client'));
              }
            }
          }
        }
      }
    }
  }

  /* ------------------------------ Aktivasi Client ----------------------------- */
  function aktif($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_client = $this->input->get('id_client');

            if($id_client == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Client tidak ditemukan'));
            } else {

              $where_cl = array('id_client' => $id_client);
              $client = $this->ClientModel->show($where_cl);

              if($client->num_rows() != 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Client tidak valid'));
              } else {
                foreach($client->result() as $key){
                   $nama_perusahaan  = $key->nama_perusahaan;
                   $nama_pic         = $key->nama_pic;
                   $email_perusahaan = $key->email_perusahaan;
                   $password         = $key->password;
                   $username         = $key->username;
                }

                $this->load->library('email');

                $data_email = array(
                  'nama_perusahaan'   => $nama_perusahaan,
                  'nama_pic'          => $nama_pic,
                  'email_perusahaan'  => $email_perusahaan,
                  'password'          => $password,
                  'username'          => $username,
                  'sender'            => $otorisasi->nama_user
                );

                $template = $this->load->view('email/aktivasi_mail', $data_email, true);

                $config = array(
                  'charset'   => 'utf-8',
                  'wordwrap'  => TRUE,
                  'mailtype'  => 'html',
                  'protocol'  => 'smtp',
                  'smtp_host' => 'ssl://smtp.gmail.com',
                  'smtp_user' => 'adm.titan001@gmail.com',
                  'smtp_pass' => 'cintaku1',
                  'smtp_port' => 465,
                  'crlf'      => "\r\n",
                  'newline'   => "\r\n"
                );

                $this->email->initialize($config);
                $this->email->from('adm.titan001@gmail.com', $otorisasi->nama_user);
                $this->email->to($email_perusahaan);
                $this->email->subject('Aktivasi Akun Client PT. Servero Lintas Raya');
                $this->email->message($template);

                $send = $this->email->send();
                if (!$send) {
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengirim email aktivasi'));
                } else {
                  $data = array(
                      'status' => 'Aktif'
                  );

                  $log = array(
                    'user'        => $otorisasi->id_user,
                    'id_ref'      => $id_client,
                    'refrensi'    => 'Client',
                    'keterangan'  => 'Aktivasi Client',
                    'kategori'    => 'Aktivasi'
                  );

                  $update = $this->ClientModel->edit($id_client, $data, $log);

                  if(!$update){
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mangaktivasi client'));
                  } else {
                    $this->pusher->trigger('sippk', 'client', $log);
                    json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengaktivasi client'));
                  }
                }
              }
            }
          }
        }
      }
    }
  }

  /* ------------------------------ Nonaktifkan Client ----------------------------- */
  function nonaktif($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_client = $this->input->get('id_client');

            if($id_client == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Client tidak ditemukan'));
            } else {
              $data = array(
                  'status' => 'Nonaktif'
              );

              $log = array(
                'user'        => $otorisasi->id_user,
                'id_ref'      => $id_client,
                'refrensi'    => 'Client',
                'keterangan'  => 'Menonaktifkan Client',
                'kategori'    => 'Nonaktif'
              );

              $update = $this->ClientModel->edit($id_client, $data, $log);

              if(!$update){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menonaktifkan client'));
              } else {
                $this->pusher->trigger('sippk', 'client', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menonaktifkan client'));
              }
            }
          }
        }
      }
    }
  }

  /* ------------------------------ Upload File ----------------------------- */
  function upload_file($name, $id)
  {
    if(isset($_FILES[$name]) && $_FILES[$name]['name'] != ""){
      $files = glob('doc/'.$name.'/'.$id.'.*');
      foreach ($files as $key) {
        unlink($key);
      }

      $config['upload_path']   = './doc/'.$name.'/';
      $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
      $config['overwrite']     = TRUE;
			$config['max_size']      = '3048';
			$config['remove_space']  = TRUE;
			$config['file_name']     = $id;

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if(!$this->upload->do_upload($name)){
        return null;
      } else {
        $file = $this->upload->data();
        return $file['file_name'];
      }
    } else {
      return null;
    }
  }

  /* ------------------------------ Delete File ----------------------------- */
  function delete_file($name, $id){
    $files = glob('doc/'.$name.'/'.$id.'.*');
    foreach ($files as $key) {
      unlink($key);
    }
  }

}

?>

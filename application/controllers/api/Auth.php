<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Auth extends CI_Controller {

  function __construct()
  {
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

		$this->load->model('AuthModel');
  }

  function login_user()
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {

      $username = $this->input->post('username');
      $password = $this->input->post('password');

      if($username == null || $password == null) {
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Username dan Password belum lengkap' ));
      } else {
        $user   = $this->AuthModel->loginUser($username);

        if($user->num_rows() == 0){
          json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Username tidak ditemukan' ));
        } else {
          foreach($user->result() as $key){
            $db_password    = $key->password;
            $status         = $key->status;
            $level          = $key->level;

            if($level == 'Kepala Gudang'){
              $level = 'kepala_gudang';
            }

            $session = array(
              'id_user'        => $key->id_user,
              'nama_user'      => $key->nama_user,
              'username'       => $key->username,
              'tgl_registrasi' => $key->tgl_registrasi,
              'foto'           => $key->foto,
              'level'          => strtolower($level),
              'token'          => $key->token
            );

            $log = array(
              'user'        => $key->id_user,
              'id_ref'      => '-',
              'refrensi'    => 'Auth',
              'keterangan'  => 'User login',
              'kategori'    => 'Login'
            );
          }

          if(hash_equals($password, $db_password)){
            if($status != 'Aktif'){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'User sudah tidak aktif' ));
            } else {

              $add = $this->LogModel->add($log);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal melakukan login' ));
              } else {
                $this->pusher->trigger('sippk', 'log', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan login', 'data' => $session ));
              }
            }
          } else {
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Password salah' ));
          }
        }
      }
    }
  }

  function logout_user($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $log = array(
            'user'        => $otorisasi->id_user,
            'id_ref'      => '-',
            'refrensi'    => 'Auth',
            'keterangan'  => 'User logout',
            'kategori'    => 'Logout'
          );

          $add = $this->LogModel->add($log);

          if(!$add){
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
          } else {
            $this->pusher->trigger('sippk', 'log', $log);
            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil logout'));
          }
        }
      }
    }
  }

  function password_user($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $db_password  = $otorisasi->password;
          $old_password = $this->input->post('password_lama');
          $new_password = $this->input->post('password_baru');

          if($old_password == null || $new_password == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
          } else {
            if($old_password != $db_password){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Password lama salah'));
            } else {

              $data = array(
                'password' => $new_password
              );

              $log = array(
                'user'        => $otorisasi->id_user,
                'id_ref'      => '-',
                'refrensi'    => 'Auth',
                'keterangan'  => 'Mengganti password lama menjadi password baru',
                'kategori'    => 'Change Password'
              );

              $pass = $this->AuthModel->gantiPass($otorisasi->id_user, $data, $log);

              if(!$pass){
                json_output(500, array('status' => 500, 'description' => 'Gagal', 'message' => 'Gagal mengganti password'));
              } else {
                $this->pusher->trigger('sippk', 'log', $log);
                json_output(200, array('status' => 200, 'description' => 'Gagal', 'message' => 'Berhasil mengganti password'));
              }
            }
          }
        }
      }
    }
  }

  function login_client(){
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {

      $username = $this->input->post('username');
      $password = $this->input->post('password');

      if($username == null || $password == null) {
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Username dan Password belum lengkap' ));
      } else {
        $param    = array('username' => $username);
        $client = $this->AuthModel->cekAuthClient($param);

        if($client->num_rows() == 0){
          json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Username tidak ditemukan' ));
        } else {
          foreach($client->result() as $key){
            $db_password    = $key->password;
            $status         = $key->status;

            $session = array(
              'id_client'       => $key->id_client,
              'username'        => $key->username,
              'nama_perusahaan' => $key->nama_perusahaan,
              'token'           => $key->token
            );
          }

          if(hash_equals($password, $db_password)){
            if($status != 'Aktif'){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Client sudah tidak aktif' ));
            } else {
              json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan login', 'data' => $session ));
            }
          } else {
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Password salah' ));
          }
        }
      }
    }
  }

  function lupa_password(){
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      $email_perusahaan = 'viz.ndinq@gmail.com';
			$new_password      = substr(str_shuffle("01234567890abcdefghijklmnopqestuvwxyz"), 0, 5);

      if($email_perusahaan == null){
        json_output(400, array('status' => 400, 'description' => 'Failed', 'message' => 'Email tidak boleh kosong' ));
      } else {
        $param    = array('email_perusahaan' => $email_perusahaan);
        $client = $this->AuthModel->cekAuthClient($param);

        if($client->num_rows() != 1){
  				json_output(400, array('status' => 400, 'description' => 'Failed', 'message' => 'Email tidak ditemukan' ));
  			} else {

          $this->load->library('email');
          $otorisasi = $client->row();

          $data_email = array(
            'nama_perusahaan' => $otorisasi->nama_perusahaan,
            'nama_pic'        => $otorisasi->nama_pic,
            'password'        => $new_password
          );

          $template = $this->load->view('email/lupa_password', $data_email, TRUE);

          $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'viz.ndinq@gmail.com',
            'smtp_pass' => 'haviz06142',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
          );

          $this->email->initialize($config);
          $this->email->set_mailtype("html");
          $this->email->set_newline("\r\n");
          $this->email->from('viz.ndinq@gmail.com', 'Admin SIPPK');
          $this->email->to($email_perusahaan);
          $this->email->subject('Reset Password Akun SIPPK');
          $this->email->message($template);

          $send = $this->email->send();

          if (!$send) {
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Tidak dapat mengirim email'));
          } else {
            $data = array(
              'password' => $new_password
            );

            $update = $this->AuthModel->updateClient($param, $data);

            if(!$update){
							json_output(400, array('status' => 400, 'description' => 'Failed', 'message' => 'Gagal melakukan reset password' ));
						} else {
							json_output(200, array('status' => 200, 'description' => 'Success', 'message' => 'Berhasil melakukan reset password. Silahkan cek email anda untuk mendapatkan password baru'));
						}
          }
        }
      }
    }
  }

  function password_client($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthClient($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $db_password  = $otorisasi->password;
          $old_password = $this->input->post('password_lama');
          $new_password = $this->input->post('password_baru');

          if($old_password == null || $new_password == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
          } else {
            if($old_password != $db_password){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Password lama salah'));
            } else {

              $data = array(
                'password' => $new_password
              );

              $update = $this->AuthModel->updateClient($param, $data);

              if(!$update){
                json_output(500, array('status' => 500, 'description' => 'Gagal', 'message' => 'Gagal mengganti password'));
              } else {
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengganti password'));
              }
            }
          }
        }
      }
    }
  }

  function logout_client($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      $param  = array('token' => $token);
      $auth   = $this->AuthModel->cekAuthClient($param);

      if($auth->num_rows() != 1){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
      } else {
        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan logout'));
      }
    }
  }

  function profile_client($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      $param  = array('token' => $token);
      $auth   = $this->AuthModel->cekAuthClient($param);

      if($auth->num_rows() != 1){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
      } else {
        $profile  = array();

        foreach($auth->result() as $key){
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

          $profile[] = $json;
        }
        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan logout', 'data' => $profile));
      }
    }
  }

}

 ?>

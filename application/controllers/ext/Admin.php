<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Admin extends CI_Controller {

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


	$this->load->model('UserModel');
  }

  function show($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $param  = array('token' => $token);
        $auth = $this->AuthModel->cekAuthClient($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

            $otorisasi = $auth->row();
            $where = array(
                'status' => 'Aktif',
                'helpdesk' => 'Helpdesk',
                'admin' => 'Admin' 
            );

            $show  = $this->UserModel->show(FALSE, $where);
            $user  = array();

            foreach($show->result() as $key){
                $json = array();

                $json['id_user']        = $key->id_user;
                $json['nama_user']      = $key->nama_user;
                $json['username']       = $key->username;
                $json['password']       = $key->password;
                $json['level']          = $key->level;
                $json['tgl_registrasi'] = $key->tgl_registrasi;
                $json['foto']           = $key->foto;
                $json['phone']          = $key->phone;
                $json['status']         = $key->status;

                $user[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $user));
        }
      }
    }
  }

}

?>

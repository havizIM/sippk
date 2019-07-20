<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Notif extends CI_Controller {

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

    $this->load->model('SurveyModel');

  }

  function schedule($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
	} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $param = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthClient($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
            $today  = date('Y-m-d');
            $start  = date('Y-m-d', mktime(0, 0, 0, date("m"), 20, date("Y")));
            $end    = date('Y-m-d', mktime(0, 0, 0, date("m"), 25, date("Y")));

            if(($today >= $start) && ($today <= $end)){
                $notif = true;
            } else {
                $notif = false;
            }
            
            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'notif' => $notif));
        }
      }
    }
  }

  function survey($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $param = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthClient($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

            $otorisasi      = $auth->row();
            $where          = array(
                'a.id_survey'           => $this->input->get('id_survey'),
                'MONTH(a.created_at)'   => date('m'),
                'YEAR(a.created_at)'    => date('Y'),
                'c.id_client'           => $otorisasi->id_client
            );

            $show         = $this->SurveyModel->show($where, FALSE, FALSE);
            $survey       = array();

            foreach($show->result() as $key){
                $json = array();

                $json['id_survey']              = $key->id_survey;
                $json['schedule']               = array('id_schedule' => $key->id_schedule, 'confirmed_date' => $key->confirmed_date,  'status' => $key->status_schedule);
                $json['client']                 = array('id_client' => $key->id_client, 'nama_perusahaan' => $key->nama_perusahaan, 'alamat_perusahaan' => $key->alamat_perusahaan, 'kode_pos' => $key->kode_pos, 'telepon' => $key->telepon, 'fax' => $key->fax, 'logo_perusahaan' => $key->logo_perusahaan, 'nama_pic' => $key->nama_pic);
                $json['instruction']            = array('no_si' => $key->no_si, 'commodity' => $key->commodity, 'qty' => $key->qty);
                $json['total_loaded']           = $key->total_loaded;
                $json['document']               = $key->document;
                $json['actual_date']            = $key->actual_date;
                $json['actual_time']            = $key->actual_time;

                $survey[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $survey));
        }
      }
    }
  }

}

?>

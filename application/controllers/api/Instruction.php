<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Instruction extends CI_Controller {

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


	$this->load->model('InstructionModel');
  }

  function show($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth   = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

            $otorisasi      = $auth->row();
            $where          = array(
                'a.no_si'       => $this->input->get('no_si')
            );

            $show         = $this->InstructionModel->show($where, FALSE, FALSE);
            $instruction  = array();

            foreach($show->result() as $key){
                $json = array();

                $json['no_si']                  = $key->no_si;
                $json['schedule']               = array('id_schedule' => $key->id_schedule, 'confirmed_date' => $key->confirmed_date, 'status' => $key->status);
                $json['client']                 = array('id_client' => $key->id_client, 'nama_perusahaan' => $key->nama_perusahaan, 'alamat_perusahaan' => $key->alamat_perusahaan, 'kode_pos' => $key->kode_pos, 'telepon' => $key->telepon, 'fax' => $key->fax, 'logo_perusahaan' => $key->logo_perusahaan, 'nama_pic' => $key->nama_pic);
                $json['owner_barge']            = $key->owner_barge;
                $json['owner_barge_address']    = $key->owner_barge_address;
                $json['consignee']              = $key->consignee;
                $json['consignee_address']      = $key->consignee_address;
                $json['commodity']              = $key->commodity;
                $json['qty']                    = $key->qty;
                $json['port_loading']           = $key->port_loading;
                $json['port_discharge']         = $key->port_discharge;
                $json['doc_required']           = $key->doc_required;
                $json['tug_boat']               = $key->tug_boat;
                $json['barge_name']             = $key->barge_name;
                $json['create_at']              = $key->create_at;

                $instruction[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $instruction));
        }
      }
    }
  }

}

?>

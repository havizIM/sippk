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
    $this->load->model('ScheduleModel');
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
        $auth   = $this->AuthModel->cekAuthClient($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

            $otorisasi      = $auth->row();
            $where          = array(
                'a.no_si'       => $this->input->get('no_si'),
                'c.id_client'   => $otorisasi->id_client
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
                $json['signature']              = $key->signature;
                $json['create_at']              = $key->create_at;

                $instruction[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $instruction));
        }
      }
    }
  }

  function lookup_schedule($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthClient($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

            $otorisasi      = $auth->row();
            $where          = array(
                'a.id_schedule'          => $this->input->get('id_schedule'),
                'a.id_client'            => $otorisasi->id_client,
                'a.status'              => 'Confirmed'
            );

            $show  = $this->ScheduleModel->show($where, FALSE, TRUE);
            $schedule  = array();

            foreach($show->result() as $key){
                $json = array();

                $json['id_schedule']        = $key->id_schedule;
                $json['plan_date']          = $key->plan_date;
                $json['plan_tonage']        = $key->plan_tonage;
                $json['confirmed_date']     = $key->confirmed_date;
                $json['status_schedule']    = $key->status_schedule;
                $json['created_at']         = $key->created_at;

                $schedule[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $schedule));
        }
      }
    }
  }

  function add($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
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

          $head                 = 'SI'.'-'.date('mY').'-'.$otorisasi->username.'-';
          $no_si                = $this->KodeModel->buatKode('instruction', $head, 'no_si', 4);
          $id_schedule          = $this->input->post('id_schedule');
          $owner_barge          = $this->input->post('owner_barge');
          $owner_barge_address  = $this->input->post('owner_barge_address');
          $consignee            = $this->input->post('consignee');
          $consignee_address    = $this->input->post('consignee_address');
          $commodity            = $this->input->post('commodity');
          $qty                  = $this->input->post('qty');
          $port_loading         = $this->input->post('port_loading');
          $port_discharge       = $this->input->post('port_discharge');
          $doc_required         = $this->input->post('doc_required');
          $tug_boat             = $this->input->post('tug_boat');
          $barge_name           = $this->input->post('barge_name');
          $signature            = $this->upload_file(base64_decode($this->input->post('signature')), $no_si);

          if($id_schedule == null || $owner_barge == null || $owner_barge_address == null || $consignee == null || $consignee_address == null || $commodity == null || $qty == null || $port_loading == null || $port_discharge == null || $doc_required == null || $tug_boat == null || $barge_name == null || $signature == null){
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
          } else {

            $data = array(
                'no_si'               => $no_si,
                'id_schedule'         => $id_schedule,
                'owner_barge'         => $owner_barge,
                'owner_barge_address' => $owner_barge_address,
                'consignee'           => $consignee,
                'consignee_address'   => $consignee_address,
                'commodity'           => $commodity,
                'qty'                 => $qty,
                'port_loading'        => $port_loading,
                'port_discharge'      => $port_discharge,
                'doc_required'        => $doc_required,
                'tug_boat'            => $tug_boat,
                'barge_name'          => $barge_name,
                'signature'           => $signature
            );

            $log = array(
              'description'        => 'Success add instruction'
            );

            $add = $this->InstructionModel->add($data, FALSE);

            if(!$add){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Failed add instruction'));
            } else {
              $this->pusher->trigger('sippk', 'instruction', $log);
              json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Success add instruction'));
            }
          }
        }
      }
    }
  }

  function upload_file($signature, $id)
  {
      $filename = $id.'.png';
      $path     = './doc/signature/'.$filename;
      file_put_contents($path, $signature);

      return $filename;
  }

  function edit($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
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

          $no_si                = $this->input->post('no_si');
          $id_schedule          = $this->input->post('id_schedule');
          $owner_barge          = $this->input->post('owner_barge');
          $owner_barge_address  = $this->input->post('owner_barge_address');
          $consignee            = $this->input->post('consignee');
          $consignee_address    = $this->input->post('consignee_address');
          $commodity            = $this->input->post('commodity');
          $qty                  = $this->input->post('qty');
          $port_loading         = $this->input->post('port_loading');
          $port_discharge       = $this->input->post('port_discharge');
          $doc_required         = $this->input->post('doc_required');
          $tug_boat             = $this->input->post('tug_boat');
          $barge_name           = $this->input->post('barge_name');
          $signature            = $this->upload_file(base64_decode($this->input->post('signature')), $no_si);

          if($no_si == null || $id_schedule == null || $owner_barge == null || $owner_barge_address == null || $consignee == null || $consignee_address == null || $commodity == null || $qty == null || $port_loading == null || $port_discharge == null || $doc_required == null || $tug_boat == null || $barge_name == null || $signature == null){
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
          } else {

            $data = array(
                'id_schedule'         => $id_schedule,
                'owner_barge'         => $owner_barge,
                'owner_barge_address' => $owner_barge_address,
                'consignee'           => $consignee,
                'consignee_address'   => $consignee_address,
                'commodity'           => $commodity,
                'qty'                 => $qty,
                'port_loading'        => $port_loading,
                'port_discharge'      => $port_discharge,
                'doc_required'        => $doc_required,
                'tug_boat'            => $tug_boat,
                'barge_name'          => $barge_name,
                'signature'           => $signature
            );

            $log = array(
              'description'        => 'Success edit instruction'
            );

            $edit = $this->InstructionModel->edit($no_si, $data, FALSE);

            if(!$edit){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Failed edit instruction'));
            } else {
              $this->pusher->trigger('sippk', 'instruction', $log);
              json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Success edit instruction'));
            }
          }
        }
      }
    }
  }

  function delete_file($id){
    $files = glob('doc/signature/'.$id.'.*');
    foreach ($files as $key) {
      unlink($key);
    }
  }

  function delete($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthClient($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi      = $auth->row();
          $no_si          = $this->input->get('no_si');

          if($no_si == null){
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No SI tidak ditemukan'));
          } else {
            $log = array('description' => 'Client Add instruction');

            $delete = $this->InstructionModel->delete($no_si, FALSE);

            if(!$delete){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus instruction'));
            } else {
              $this->pusher->trigger('sippk', 'instruction', $log);
              $this->delete_file($no_si);
              json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus instruction'));
            }
          }
        }
      }
    }
  }

}

?>

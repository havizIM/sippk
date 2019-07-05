<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Survey extends CI_Controller {

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
                'a.id_survey'       => $this->input->get('id_survey')
            );

            $show         = $this->SurveyModel->show($where, FALSE, FALSE);
            $survey  = array();

            foreach($show->result() as $key){
                $json = array();

                $json['id_survey']              = $key->id_survey;
                $json['schedule']               = array('id_schedule' => $key->id_schedule, 'confirmed_date' => $key->confirmed_date, 'status' => $key->status_schedule);
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

  function lookup_si($token = null){
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

            $show         = $this->InstructionModel->show(FALSE, FALSE, TRUE);
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

            $otorisasi  = $auth->row();
            $id_survey            = $this->KodeModel->buatKode('survey', 'SRY-', 'id_survey', 7);
            $no_si                = $this->input->post('no_si');
            $total_loaded         = $this->input->post('total_loaded');
            $actual_date          = $this->input->post('actual_date');
            $actual_time          = $this->input->post('actual_time');

            if($no_si == null || $total_loaded == null || $actual_date == null || $actual_time == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

                $document = $this->_upload_file('document', $id_survey);

                if($document == null){
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Document dibutuhkan'));
                } else {
                    $data = array(
                        'id_survey'     => $id_survey,
                        'no_si'         => $no_si,
                        'total_loaded'  => $total_loaded,
                        'actual_date'   => $actual_date,
                        'document'      => $document,
                        'actual_time'   => $actual_time
                    );

                    $log = array(
                        'user'        => $otorisasi->id_user,
                        'id_ref'      => $id_survey,
                        'refrensi'    => 'Survey',
                        'keterangan'  => 'Menambah data Survey baru',
                        'kategori'    => 'Add'
                    );

                    $add = $this->SurveyModel->add($data, $log);

                    if(!$add){
                        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Failed add survey'));
                    } else {
                        $this->pusher->trigger('sippk', 'survey', $log);
                        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Success add survey'));
                    }
                }

                
            }
        }
      }
    }
  }

  function _upload_file($name, $id)
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

  function edit($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth   = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

            $id_survey            = $this->input->get('id_survey');
            $no_si                = $this->input->post('no_si');
            $total_loaded         = $this->input->post('total_loaded');
            $actual_date          = $this->input->post('actual_date');
            $actual_time          = $this->input->post('actual_time');

          if($id_survey == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID User yang dipilih'));
          } else {
            if($no_si == null || $total_loaded == null || $actual_date == null || $actual_time == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {
                $data = array(
                    'id_survey'     => $id_survey,
                    'no_si'         => $no_si,
                    'total_loaded'  => $total_loaded,
                    'actual_date'   => $actual_date,
                    'actual_time'   => $actual_time
                );

                $document  = $this->_upload_file('document', $id_survey);

                if($document != null){
                  $data['document'] = $document;
                }

                $log = array(
                    'user'        => $otorisasi->id_user,
                    'id_ref'      => $id_survey,
                    'refrensi'    => 'Survey',
                    'keterangan'  => 'Mengedit data Survey baru',
                    'kategori'    => 'Add'
                );

                $edit = $this->SurveyModel->edit($id_survey, $data, $log);

                if(!$edit){
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Failed edit survey'));
                } else {
                    $this->pusher->trigger('sippk', 'survey', $log);
                    json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Success edit survey'));
                }
            }
          }
        }
      }
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
        $auth   = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi      = $auth->row();
          $id_survey    = $this->input->get('id_survey');

            if($id_survey == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Schedule tidak ditemukan'));
            } else {
              $log = array('description' => 'Client Add Schedule');

              $delete = $this->SurveyModel->delete($id_survey, FALSE);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus survey'));
              } else {
                $this->pusher->trigger('sippk', 'survey', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus survey'));
              }
            }
        }
      }
    }
  }

}

?>

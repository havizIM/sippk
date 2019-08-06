<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Schedule extends CI_Controller {

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
                'a.id_schedule' => $this->input->get('id_schedule'),
                'a.id_client'   => $otorisasi->id_client
            );

            $show  = $this->ScheduleModel->show($where, FALSE, FALSE);
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
        $param = array('token' => $token);
        $auth = $this->AuthModel->cekAuthClient($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

            $otorisasi  = $auth->row();
            $post       = $this->input->post();

            if(!isset($post['plan_date']) && count($post['plan_date']) < 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Pilih barang yang akan dipilih'));
              } else {
                $data       = array();
                foreach($post['plan_date'] as $key => $val){
                  $data[] = array(
                    'id_schedule'       => 'SCH-'.date('mY').'-'.rand(),
                    'id_client'         => $otorisasi->id_client,
                    'plan_date'         => $post['plan_date'][$key],
                    'plan_tonage'       => $post['plan_tonage'][$key],
                    'status'            => 'Proccess'
                  );
                }

                $log = array('description' => 'Client Add Schedule');

                $add = $this->ScheduleModel->add($data, FALSE);

                if(!$add){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Failed add schedule'));
                } else {
                  $this->pusher->trigger('sippk', 'schedule', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Success add schedule'));
                }
              }
        }
      }
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
        $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthClient($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $id_schedule    = $this->input->post('id_schedule');
          $plan_date      = $this->input->post('plan_date');
          $plan_tonage    = $this->input->post('plan_tonage');

          if($id_schedule == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Schedule yang dipilih'));
          } else {
            if($plan_tonage == null || $plan_date == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {
              $data = array(
                'plan_date'     => $plan_date,
                'plan_tonage'   => $plan_tonage
              );

              $log = array(
                'description'        => 'Success edit schedule'
              );

              $edit = $this->ScheduleModel->edit($id_schedule, $data, FALSE);

              if(!$edit){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Failed edit schedule'));
              } else {
                $this->pusher->trigger('sippk', 'schedule', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Success edit schedule'));
              }
            }
          }
        }
      }
    }
  }

  function confirm($token = null){
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
          $otorisasi = $auth->row();

          $id_schedule    = $this->input->get('id_schedule');

          if($id_schedule == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Schedule yang dipilih'));
          } else {
            $data = array(
              'status'     => 'Confirmed'
            );

            $log = array(
              'description'        => 'Success edit schedule'
            );

            $edit = $this->ScheduleModel->edit($id_schedule, $data, FALSE);

            if(!$edit){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Failed edit schedule'));
            } else {
              $this->pusher->trigger('sippk', 'schedule', $log);
              json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Success edit schedule'));
            }
          }
        }
      }
    }
  }

  function cancel($token = null){
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
          $otorisasi = $auth->row();

          $id_schedule    = $this->input->get('id_schedule');

          if($id_schedule == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Schedule yang dipilih'));
          } else {

            $data = array(
              'status'     => 'Cancel by Client'
            );

            $log = array(
              'description'        => 'Success edit schedule'
            );

            $edit = $this->ScheduleModel->edit($id_schedule, $data, FALSE);

            if(!$edit){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Failed edit schedule'));
            } else {
              $this->pusher->trigger('sippk', 'schedule', $log);
              json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Success edit schedule'));
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
        $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthClient($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi      = $auth->row();
          $id_schedule    = $this->input->get('id_schedule');

            if($id_schedule == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Schedule tidak ditemukan'));
            } else {
              $log = array('description' => 'Client Add Schedule');

              $delete = $this->ScheduleModel->delete($id_schedule, FALSE);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus schedule'));
              } else {
                $this->pusher->trigger('sippk', 'schedule', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus schedule'));
              }
            }
        }
      }
    }
  }

  function statistic($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuthClient($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Helpdesk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {

            $statistic  = $this->ScheduleModel->statistic()->result();
            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $statistic));

          }
        }
      }
    }
  }

}

?>

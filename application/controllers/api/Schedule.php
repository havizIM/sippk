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
    $this->load->model('InstructionModel');
    $this->load->model('SurveyModel');
    $this->load->model('ClientModel');
  }

  function show($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        // $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

            $otorisasi      = $auth->row();
            $where          = array(
                'a.id_schedule'       => $this->input->get('id_schedule'),
                'a.id_client'         => $this->input->get('id_client'),
                'MONTH(a.plan_date)'  => $this->input->get('bulan'),
                'YEAR(a.plan_date)'   => $this->input->get('tahun')
            );

            $show  = $this->ScheduleModel->show($where, FALSE, FALSE);
            $schedule  = array();

            foreach($show->result() as $key){
                $json = array();

                $json['id_schedule']        = $key->id_schedule;
                $json['client']             = array('id_client' => $key->id_client, 'nama_perusahaan' => $key->nama_perusahaan, 'username' => $key->username);
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
        $auth = $this->AuthModel->cekAuth($param);

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
                    'id_schedule'       => 'S-'.$otorisasi->username.'-'.rand(),
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
        $auth   = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $id_schedule         = $this->input->post('id_schedule');
          $confirmed_date      = $this->input->post('confirmed_date');

          if($id_schedule == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID User yang dipilih'));
          } else {
            if($confirmed_date == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {
              $where_sc = array(
                'a.confirmed_date' => $confirmed_date,
                'a.status !='      => 'Cancel by Admin',
                'a.status !='      => 'Cancel by Client',
              );

              $limit  = $this->ScheduleModel->show($where_sc, FALSE, FALSE)->num_rows();

              if($limit >= 3){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Tanggal sudah digunakan lebih dari 3 kali'));
              } else {
                $data = array(
                  'confirmed_date'     => $confirmed_date
                );

                $log = array(
                    'user'        => $otorisasi->id_user,
                    'id_ref'      => $id_schedule,
                    'refrensi'    => 'Schedule',
                    'keterangan'  => 'Mengedit data schedule baru',
                    'kategori'    => 'Edit'
                );

                $edit = $this->ScheduleModel->edit($id_schedule, $data, $log);

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
  }

  function complete($token = null){
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
          $otorisasi = $auth->row();

          $id_schedule    = $this->input->get('id_schedule');

          if($id_schedule == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Schedule yang dipilih'));
          } else {

            $data = array(
              'status'     => 'Complete'
            );

            $log = array(
                  'user'        => $otorisasi->id_user,
                  'id_ref'      => $id_schedule,
                  'refrensi'    => 'Schedule',
                  'keterangan'  => 'Mengedit data schedule baru',
                  'kategori'    => 'Edit'
              );

            $edit = $this->ScheduleModel->edit($id_schedule, $data, $log);

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
        $auth   = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $id_schedule    = $this->input->get('id_schedule');

          if($id_schedule == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Schedule yang dipilih'));
          } else {

            $data = array(
              'status'     => 'Cancel by Admin'
            );

            $log = array(
                  'user'        => $otorisasi->id_user,
                  'id_ref'      => $id_schedule,
                  'refrensi'    => 'Schedule',
                  'keterangan'  => 'Mengedit data schedule baru',
                  'kategori'    => 'Edit'
              );


            $edit = $this->ScheduleModel->edit($id_schedule, $data, $log);

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

  function report_schedule($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        // $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

            $otorisasi      = $auth->row();

            $where_cl       = array('status' => 'Aktif');
            $client         = $this->ClientModel->show($where_cl);
            $laporan        = array();

            foreach($client->result() as $key){
                $json         = array();
                $total_tonage = 0;

                $json['nama_perusahaan'] = $key->nama_perusahaan;
                $json['username']        = $key->username;
                $json['schedule']        = array();


                $where_sc = array(
                    'a.id_client'              => $key->id_client,
                    'MONTH(a.confirmed_date)'  => $this->input->get('bulan'),
                    'YEAR(a.confirmed_date)'    => $this->input->get('tahun')
                    
                );

                $where_or = array(
                  'confirmed'            => 'Confirmed',
                  'complete'             => 'Complete'
                );

                $schedule  = $this->ScheduleModel->schedule($where_sc, $where_or);
                $no        = 1;

                foreach($schedule->result() as $key2){
                    $json_s = array();
                    $total_tonage += $key2->plan_tonage;

                    $json_s['barging']        = $no++;
                    $json_s['plan_date']      = $key2->plan_date;
                    $json_s['confirmed_date'] = $key2->confirmed_date;
                    $json_s['plan_tonage']    = $key2->plan_tonage;
                    $json_s['status_schedule']    = $key2->status_schedule;

                    $json['schedule'][]       = $json_s;
                }

                $json['total_barging']   = $schedule->num_rows();
                $json['total_tonage']    = $total_tonage;

                $laporan[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $laporan));
        }
      }
    }
  }

  function report_sales($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        // $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

            $otorisasi      = $auth->row();

            $where = array(
                    'status' => 'Aktif',
                    'bulan'  => $this->input->get('bulan'),
                    'tahun'  => $this->input->get('tahun')
            );

            $sales          = $this->ScheduleModel->sales($where);
            $laporan        = array();

            foreach($sales->result() as $key){
                $json         = array();

                $json['nama_perusahaan']  = $key->nama_perusahaan;
                $json['username']         = $key->username;
                $json['total_plan']       = $key->total_plan;
                $json['total_revised']    = $key->total_revised;
                $json['count_schedule']   = $key->count_schedule;
                $json['actual_total']     = $key->actual_total;
                $json['count_survey']     = $key->count_survey;

                $laporan[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $laporan));
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
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          $tahun = date('Y');

          $schedule    = $this->ScheduleModel->statistic($tahun);
          $instruction = $this->InstructionModel->statistic($tahun);
          $survey      = $this->SurveyModel->statistic($tahun);

          $jml_schedule     = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
          $jml_instruction  = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
          $jml_survey       = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");

          $total_schedule     = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
          $total_instruction  = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
          $total_survey       = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");

          foreach($schedule->result() as $key){
            $index = $key->bulan - 1;

            $jml_schedule[$index]   = $key->jml_schedule;
            $total_schedule[$index] = $key->total_schedule;
          }

          foreach($instruction->result() as $key){
            $index = $key->bulan - 1;

            $jml_instruction[$index]    = $key->jml_instruction;
            $total_instruction[$index]  = $key->total_instruction;
          }

          foreach($survey->result() as $key){
            $index = $key->bulan - 1;

            $jml_survey[$index] = $key->jml_survey;
            $total_survey[$index] = $key->total_survey;
          }

          $statistic = array(
            'schedule'    => array(
              'count'   => $jml_schedule,
              'total'   => $total_schedule
            ),
            'instruction' => array(
              'count'   => $jml_instruction,
              'total'   => $total_instruction
            ),
            'survey'      => array(
              'count'   => $jml_survey,
              'total'   => $total_survey
            )
          );

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $statistic));
        }
      }
    }
  }

  

}

?>

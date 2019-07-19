<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduleModel extends CI_Model {

    function show($where, $like, $not_in)
    {
      $this->db->select('b.*, a.id_schedule, a.plan_date, a.plan_tonage, a.confirmed_date, a.status as status_schedule, a.created_at')
               ->from('schedule a')
               ->join('client b', 'a.id_client = b.id_client');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      if(!empty($not_in) && $not_in == TRUE){
        $this->db->where('`id_schedule` NOT IN (SELECT `id_schedule` FROM `instruction`)', NULL, FALSE);
      }

      if(!empty($like)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->like($key, $value);
            }
        }
      }

      $this->db->order_by('a.created_at', 'desc');
      return $this->db->get();
    }

    function add($data, $log)
    {
      $this->db->trans_start();
      $this->db->insert_batch('schedule', $data);

      if(!empty($log)){
        $this->db->insert('log', $log);
      }

      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function edit($param, $data, $log)
    {
      $this->db->trans_start();
      $this->db->where('id_schedule', $param)->update('schedule', $data);

      if(!empty($log)){
        $this->db->insert('log', $log);
      }
      
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function delete($param, $log)
    {
      $this->db->trans_start();
      $this->db->where('id_schedule', $param)->delete('schedule');
      
      if(!empty($log)){
        $this->db->insert('log', $log);
      }

      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function schedule($where, $where_or)
    {
      $this->db->select('b.*, a.id_schedule, a.plan_date, a.plan_tonage, a.confirmed_date, a.status as status_schedule, a.created_at')
               ->from('schedule a')
               ->join('client b', 'a.id_client = b.id_client');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      if(!empty($where_or)){
        $this->db->where('(a.status = "'.$where_or['confirmed'].'" OR a.status = "'.$where_or['complete'].'")');
      }

      $this->db->order_by('a.created_at', 'desc');
      return $this->db->get();
    }

    function sales($where)
    {
      $this->db->select('a.*')
               ->select('(SELECT SUM(b.plan_tonage) FROM schedule b WHERE b.id_client = a.id_client AND MONTH(b.confirmed_date) = "'.$where['bulan'].'" AND YEAR(b.confirmed_date) = "'.$where['tahun'].'" AND (b.status = "Complete" OR b.status = "Confirmed")) as total_plan')
               ->select('(SELECT COUNT(b.id_schedule) FROM schedule b WHERE b.id_client = a.id_client AND MONTH(b.confirmed_date) = "'.$where['bulan'].'" AND YEAR(b.confirmed_date) = "'.$where['tahun'].'" AND (b.status = "Complete" OR b.status = "Confirmed")) as count_schedule')
               ->select('(SELECT SUM(b.qty) FROM instruction b LEFT JOIN schedule c ON c.id_schedule = b.id_schedule WHERE c.id_client = a.id_client AND MONTH(c.confirmed_date) = "'.$where['bulan'].'" AND YEAR(c.confirmed_date) = "'.$where['tahun'].'" AND (c.status = "Complete" OR c.status = "Confirmed")) as total_revised')
               ->select('(SELECT SUM(b.total_loaded) FROM survey b LEFT JOIN instruction c ON c.no_si = b.no_si LEFT JOIN schedule d ON d.id_schedule = c.id_schedule WHERE d.id_client = a.id_client AND MONTH(d.confirmed_date) = "'.$where['bulan'].'" AND YEAR(d.confirmed_date) = "'.$where['tahun'].'" AND (d.status = "Complete" OR d.status = "Confirmed")) as actual_total')
               ->select('(SELECT COUNT(b.id_survey) FROM survey b LEFT JOIN instruction c ON c.no_si = b.no_si LEFT JOIN schedule d ON d.id_schedule = c.id_schedule WHERE d.id_client = a.id_client AND MONTH(d.confirmed_date) = "'.$where['bulan'].'" AND YEAR(d.confirmed_date) = "'.$where['tahun'].'" AND (d.status = "Complete" OR d.status = "Confirmed")) as count_survey')
              

               ->from('client a');

      $this->db->group_by('a.username');
      // $this->db->order_by('a.created_at', 'desc');
      return $this->db->get();
    }

    function statistic($tahun)
    {
      $this->db->select("YEAR(confirmed_date) as tahun, MONTH(confirmed_date) as bulan, COUNT('id_schedule') as jml_schedule, SUM(plan_tonage) as total_schedule");

      $this->db->from("schedule");
      $this->db->where("YEAR(confirmed_date)", $tahun);
      $this->db->where('(status = "Confirmed" OR status = "Complete")');

      $this->db->group_by("MONTH(confirmed_date)");
      return $this->db->get();
    }
}

?>

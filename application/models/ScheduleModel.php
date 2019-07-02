<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduleModel extends CI_Model {

    function show($where, $like)
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
}

?>

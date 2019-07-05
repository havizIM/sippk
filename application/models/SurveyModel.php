<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SurveyModel extends CI_Model {

    function show($where, $like)
    {
      $this->db->select('a.*, b.qty, b.commodity, c.id_schedule, c.plan_date, c.plan_tonage, c.confirmed_date, c.status as status_schedule, c.created_at, d.*')
               ->from('survey a')
               ->join('instruction b', 'b.no_si = a.no_si')
               ->join('schedule c', 'c.id_schedule = b.id_schedule')
               ->join('client d', 'd.id_client = c.id_client');

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
      $this->db->insert('survey', $data);

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
      $this->db->where('id_survey', $param)->update('survey', $data);

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
      $this->db->where('id_survey', $param)->delete('survey');
      
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

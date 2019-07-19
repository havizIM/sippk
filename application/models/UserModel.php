<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    function show($where, $where_or)
    {
      $this->db->select('*')->from('user');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      if(!empty($where_or)){
        $this->db->where('status', $where_or['status']);
        $this->db->where('(level = "'.$where_or['helpdesk'].'" OR level = "'.$where_or['admin'].'")');
      }

      $this->db->order_by('tgl_registrasi', 'desc');
      return $this->db->get();
    }

    function add($data, $log)
    {
      $this->db->trans_start();
      $this->db->insert('user', $data);
      $this->db->insert('log', $log);
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
      $this->db->where('id_user', $param)->update('user', $data);
      $this->db->insert('log', $log);
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
      $this->db->where('id_user', $param)->delete('user');
      $this->db->insert('log', $log);
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function statistic()
    {
      $this->db->select("level, COUNT('id_user') as jml_user");

      $this->db->from("user");
      $this->db->where('level !=', 'Helpdesk');

      $this->db->group_by("level");
      return $this->db->get();
    }
}

?>

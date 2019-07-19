<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class InstructionModel extends CI_Model {

    function show($where, $like, $not_in)
    {
      $this->db->select('a.*, b.confirmed_date, b.status, c.id_client, c.nama_pic, c.nama_perusahaan, c.alamat_perusahaan, c.kode_pos, c.telepon, c.fax, c.logo_perusahaan')
               ->from('instruction a')
               ->join('schedule b', 'a.id_schedule = b.id_schedule')
               ->join('client c', 'c.id_client = b.id_client');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      if(!empty($not_in) && $not_in == TRUE){
        $this->db->where('`no_si` NOT IN (SELECT `no_si` FROM `survey`)', NULL, FALSE);
      }

      if(!empty($like)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->like($key, $value);
            }
        }
      }

      $this->db->order_by('a.create_at', 'desc');
      return $this->db->get();
    }

    function add($data, $log)
    {
      $this->db->trans_start();
      $this->db->insert('instruction', $data);

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
      $this->db->where('no_si', $param)->update('instruction', $data);

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
      $this->db->where('no_si', $param)->delete('instruction');
      
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

    function statistic($tahun)
    {
      $this->db->select("YEAR(create_at) as tahun, MONTH(create_at) as bulan, COUNT('no_si') as jml_instruction, SUM(qty) as total_instruction");

      $this->db->from("instruction");
      $this->db->where("YEAR(create_at)", $tahun);

      $this->db->group_by("MONTH(create_at)");
      return $this->db->get();
    }

}

?>

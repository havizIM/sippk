<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ClientModel extends CI_Model {

    function show($id_client = null, $nama_perusahaan = null)
    {
      $this->db->select('*')->from('client');

      if($id_client != null){
        $this->db->where('id_client', $id_client);
      }

      if($nama_perusahaan != null){
        $this->db->like('nama_perusahaan', $nama_perusahaan);
      }

      $this->db->order_by('tgl_registrasi', 'desc');
      return $this->db->get();
    }

    function add($data, $log)
    {
      $this->db->trans_start();
      $this->db->insert('client', $data);
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
      $this->db->where('id_client', $param)->update('client', $data);
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
      $this->db->where('id_client', $param)->delete('client');
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
}

?>

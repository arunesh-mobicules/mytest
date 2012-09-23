<?php
/**
 * Created by JetBrains PhpStorm.
 * User: akhilesh
 * Date: 11/7/11
 * Time: 4:14 PM
 * To change this template use File | Settings | File Templates.
 */

class Test_model extends CI_Model
{


    function get_email($email)
    {
        $query = $this->db->where("email", $email)->get('info');
        return $query->row();
    }

    function add_info($data)
    {
        $this->db->insert('info', $data);
        return true;
    }

    function get_all_info()
    {
        $query = $this->db->get('info');
        return $query->result();

    }

    function delete_info($id)
    {
        $this->db->where('id', $id)->delete('info');
    }

    function get_update($id)
    {
        $query = $this->db->where('id', $id)->get('info');
        return $query->result();
    }

    function update_info($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('info', $data);
    }

    function search_by_gender($gender)
    {
        $query = $this->db->where("gender", $gender)->get('info');
        return $query->result();
    }

    function save($data){
        $this->db->insert('password', $data);
    }

    function get_login($name, $hash){
//        $query= $this->db->where('name',$name and 'password', $password)->get('password');
        $query= $this->db->query("select * from password where name = '$name' and password = '$hash'");
        return $query->row();
    }
}

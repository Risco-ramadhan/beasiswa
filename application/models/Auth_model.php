<?php
class Auth_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function Register($data)
    {
        $this->db->insert('user', $data);
    }

    public function cekUser($email)
    {
        $query = $this->db->get_where('user', array('email' => $email))->row_array();
        return $query;
    }

    public function getDatauser()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }
}

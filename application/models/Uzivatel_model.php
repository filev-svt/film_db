<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 28.05.18
 * Time: 14:36
 */

class Uzivatel_model extends CI_Model
{


    public function __construct()
    {
        $this->load->database();
    }

    public function validuj($udaje)
    {
        $sql = 'SELECT * FROM uzivatel WHERE username = ?';
        $query = $this->db->query($sql, array($udaje['username']));

        $row = $query->row();

        return $row;
    }

    public function registruj($udaje)
    {
        $select = 'SELECT * FROM uzivatel WHERE email = ? OR username = ?';
        $query = $this->db->query($select, array($udaje['email'], $udaje['username']));
        $result = $query->result_array();

        if (empty($result)) {
            $sql = 'INSERT INTO uzivatel (username, pass, email, jmeno_uzivatel, prijmeni_uzivatel) VALUES (?, ?, ?, ?, ?)';
            return $this->db->query($sql, array($udaje['username'],
                password_hash($udaje['heslo'], PASSWORD_DEFAULT), $udaje['email'], $udaje['jmeno'], $udaje['prijmeni']));
        } else {
            return false;
        }
    }
}
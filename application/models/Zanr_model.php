<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 27.05.18
 * Time: 20:52
 */

class Zanr_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_zanry_filmu($id)
    {
        $sql = 'SELECT nazev_zanr FROM zanr JOIN zanr_has_film ON zanr.id_zanr = zanr_has_film.zanr_id_zanr 
            WHERE film_id_film = ?';
        $query = $this->db->query($sql, $id);

        return $query->result_array();
    }

    public function get_seznam_zanru()
    {
        $sql = 'SELECT id_zanr, nazev_zanr FROM zanr';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
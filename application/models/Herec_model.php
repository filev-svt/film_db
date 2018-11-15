<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 26.05.18
 * Time: 12:37
 */

class Herec_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_herci_filmu($film)
    {
        $sql = 'SELECT id_osobnost, jmeno_osobnost, prijmeni_osobnost FROM film_has_osobnost JOIN osobnost ON film_has_osobnost.osobnost_id_osobnost = osobnost.id_osobnost WHERE film_id_film = ? AND role = "herec"';
        $query = $this->db->query($sql, $film);

        return $query->result_array();

    }

    public function get_seznam_hercu() {
        $sql = 'SELECT id_osobnost, jmeno_osobnost, prijmeni_osobnost FROM osobnost';
        $query = $this->db->query($sql);
        return $query->result_array();
    }


}
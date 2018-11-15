<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 26.05.18
 * Time: 18:20
 */

class Reziser_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_reziseri_filmu($film)
    {
        $sql = 'SELECT id_osobnost, jmeno_osobnost, prijmeni_osobnost FROM film_has_osobnost JOIN osobnost ON film_has_osobnost.osobnost_id_osobnost = osobnost.id_osobnost WHERE film_id_film = ? AND role = "reziser"';
        $query = $this->db->query($sql, $film);

        return $query->result_array();

    }
}
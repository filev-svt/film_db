<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 05.06.18
 * Time: 22:38
 */

class Clanek_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_nejnovejsi_clanky()
    {
        $sql = 'SELECT nadpis, text_clanek, id_osobnost, jmeno_osobnost, prijmeni_osobnost, id_film, nazev_film
FROM clanek LEFT JOIN film ON clanek.film_id_film = film.id_film JOIN osobnost ON osobnost_id_osobnost = osobnost.id_osobnost LIMIT 20';
        $query = $this->db->query($sql);

        return $query->result_array();
    }
}
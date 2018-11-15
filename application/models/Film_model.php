<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 25.05.18
 * Time: 17:06
 */

class Film_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_best_film_list()
    {
        $sql = 'SELECT id_film, nazev_film, YEAR(vydani_kino) AS rok, AVG(ciselne_hodnoceni) as hodnoceni 
            FROM film LEFT JOIN hodnoceni ON film.id_film = hodnoceni.film_id_film 
            GROUP BY id_film ORDER BY AVG(ciselne_hodnoceni) DESC LIMIT 50';
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    public function get_film($id)
    {
        $sql = 'SELECT id_film, nazev_film, delka_film, YEAR(vydani_kino) AS rok, 
            DATE_FORMAT(vydani_kino, "%e.%c.%Y") AS premiera,vydani_nosic, popis_film, poster FROM film WHERE id_film = ?';
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }

    public function search_film($nazev)
    {
        $sql = 'SELECT id_film, nazev_film, YEAR(vydani_kino) AS rok, AVG(ciselne_hodnoceni) as hodnoceni 
            FROM film LEFT JOIN hodnoceni ON film.id_film = hodnoceni.film_id_film WHERE nazev_film LIKE ?';
        $query = $this->db->query($sql, '%'.$nazev.'%');
        return $query->result_array();
    }

    public function get_nejlepsi_film_osobnosti($id)
    {
        $sql = 'SELECT id_film, nazev_film, AVG(ciselne_hodnoceni) as prumer FROM film LEFT JOIN hodnoceni ON film.id_film = hodnoceni.film_id_film
JOIN film_has_osobnost ON film.id_film = film_has_osobnost.film_id_film WHERE osobnost_id_osobnost = ? GROUP BY id_film ORDER BY prumer DESC';
        $query = $this->db->query($sql, array($id));

        return $query->row();
    }

    public function get_filmografie($id)
    {
        $sql = 'SELECT id_film, nazev_film, YEAR(vydani_kino) AS rok, AVG(ciselne_hodnoceni) AS prumer FROM film JOIN film_has_osobnost 
            ON film.id_film = film_has_osobnost.film_id_film LEFT JOIN hodnoceni ON film.id_film = hodnoceni.film_id_film WHERE osobnost_id_osobnost = ? GROUP BY id_film ORDER BY rok DESC';
        $query = $this->db->query($sql, array($id));

        return $query->result_array();
    }

    public function vlozit_novy_film($udaje) {
        $sql = 'INSERT INTO film (nazev_film, delka_film) VALUES (?,?)';



        return $this->db->query($sql, array($udaje['nazev'], $udaje['stopaz']));

    }

}
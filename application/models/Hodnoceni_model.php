<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 27.05.18
 * Time: 19:14
 */

class Hodnoceni_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_hodnoceni_filmu($id)
    {
        $sql = 'SELECT id_hodnoceni, ciselne_hodnoceni, text_hodnoceni, id_uzivatel, username, COUNT(upvote) AS palce
FROM hodnoceni LEFT JOIN hodnoceni_rating_uzivatel
ON hodnoceni.id_hodnoceni = hodnoceni_rating_uzivatel.hodnoceni_id_hodnoceni
AND hodnoceni.film_id_film = hodnoceni_rating_uzivatel.hodnoceni_film_id_film
AND hodnoceni.uzivatel_id_uzivatel = hodnoceni_rating_uzivatel.hodnoceni_uzivatel_id_uzivatel
JOIN uzivatel ON hodnoceni.uzivatel_id_uzivatel = uzivatel.id_uzivatel WHERE film_id_film = ? GROUP BY id_hodnoceni ORDER BY palce DESC, ciselne_hodnoceni DESC';
        $query = $this->db->query($sql, array($id));

        return $query->result_array();
    }

    public function get_prumer($id)
    {
        $sql = 'SELECT AVG(ciselne_hodnoceni) AS prumer FROM hodnoceni WHERE film_id_film = ?';
        $query = $this->db->query($sql, $id);

        return $query->row();
    }

    public function vloz_hodnoceni($id, $uzivatel)
    {
        $select = 'SELECT * FROM hodnoceni WHERE uzivatel_id_uzivatel = ? AND film_id_film = ?';
        $query = $this->db->query($select, array($uzivatel, $id));
        $result = $query->result_array();

        if (empty($result)) {
            $data = array(
                'ciselne_hodnoceni' => $this->input->post('hodnoceni'),
                'film' => $id,
                'text_recenze' => $this->input->post('text_recenze'),
                'uzivatel' => $this->session->id_uzivatel

            );

            $sql = 'INSERT INTO hodnoceni (ciselne_hodnoceni, film_id_film, text_hodnoceni, uzivatel_id_uzivatel) 
                VALUES (?,?,?,?)';
            return $this->db->query($sql, $data);
        } else {
            return false;
        }
    }

    public function pridej_palec()
    {
        $sql = 'INSERT INTO hodnoceni_rating_uzivatel 
(hodnoceni_id_hodnoceni, hodnoceni_film_id_film, hodnoceni_uzivatel_id_uzivatel, uzivatel_id_uzivatel, upvote) 
VALUES (?, ?, ?, ?, ?)';

        $hodnoceni = $this->input->post('id_hodnoceni');
        $film = $this->input->post('id_film');
        $autor = $this->input->post('autor');
        $prihlaseny_uzivatel = $this->input->post('prihlaseny_uzivatel');


        return $this->db->query($sql, array($hodnoceni, $film, $autor, $prihlaseny_uzivatel, 1));

    }


    public function check_palec($uzivatel)
    {
        $hodnoceni = $this->input->post('id_hodnoceni');
        $sql = 'SELECT * FROM hodnoceni_rating_uzivatel WHERE uzivatel_id_uzivatel = ? AND hodnoceni_id_hodnoceni = ?';
        $query = $this->db->query($sql, array($uzivatel, $hodnoceni));

        return $query->result_array();

    }

}
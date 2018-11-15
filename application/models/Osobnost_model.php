<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 27.05.18
 * Time: 0:44
 */

class Osobnost_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_osobnost($id)
    {
        $sql = 'SELECT id_osobnost, jmeno_osobnost, prijmeni_osobnost, misto_narozeni, 
              DATE_FORMAT(datum_narozeni_osobnost, "%e.%c.%Y") as datum_narozeni,  
              DATE_FORMAT(datum_umrti_osobnost, "%e.%c.%Y") as datum_umrti, zivotopis, fotografie
               FROM osobnost WHERE id_osobnost = ?';
        $query = $this->db->query($sql, $id);

        return $query->row();
    }

    public function vyhledat_osobnosti($name)
    {
        $sql = 'SELECT id_osobnost, jmeno_osobnost, prijmeni_osobnost, misto_narozeni, 
              DATE_FORMAT(datum_narozeni_osobnost, "%e.%c.%Y") as datum_narozeni FROM osobnost WHERE jmeno_osobnost or prijmeni_osobnost LIKE ?';
        $query = $this->db->query($sql, '%'.$name.'%');

        return $query->result_array();
    }
}
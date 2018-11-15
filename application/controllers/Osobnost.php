<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 27.05.18
 * Time: 1:19
 */

class Osobnost extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('osobnost_model');
        $this->load->model('film_model');
        $this->load->model('zanr_model');
    }

    public function profil($id)
    {
        $data['osobnost_profil'] = $this->osobnost_model->get_osobnost($id);
        $data['title'] = $this->osobnost_model->get_osobnost($id)->jmeno_osobnost
            . ' ' . $this->osobnost_model->get_osobnost($id)->prijmeni_osobnost;
        $data['nejlepsi_film_osobnosti'] =
            $this->film_model->get_nejlepsi_film_osobnosti($id);
        $data['filmografie'] = $this->film_model->get_filmografie($id);
        foreach ($data['filmografie'] as $film) {
            $data['zanry'][$film['id_film']] = $this->zanr_model->get_zanry_filmu($film['id_film']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/osobnost_profil', $data);
        $this->load->view('templates/footer');
    }
}
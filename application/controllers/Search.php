<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 05.06.18
 * Time: 21:41
 */

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('film_model');
        $this->load->model('herec_model');
        $this->load->model('zanr_model');
        $this->load->model('osobnost_model');
    }

    public function find()
    {

        $data['films'] =  $this->film_model->search_film($this->input->post('search'));
        $data['title'] = 'Výsledky vyhledávání';
        foreach ($data['films'] as $film) {
            $data['herci'][$film['id_film']] = $this->herec_model->get_herci_filmu($film['id_film']);
            $data['zanry'][$film['id_film']] = $this->zanr_model->get_zanry_filmu($film['id_film']);
        }

        $data['osobnosti'] = $this->osobnost_model->vyhledat_osobnosti($this->input->post('search'));

        $this->load->view('templates/header', $data);
        $this->load->view('pages/search_result', $data);
        $this->load->view('templates/footer');

    }
}
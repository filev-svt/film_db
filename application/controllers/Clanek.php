<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 06.06.18
 * Time: 10:43
 */

class Clanek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('clanek_model');
    }

    public function novinky()
    {
        $data['clanky'] = $this->clanek_model->get_nejnovejsi_clanky();
        $data['title'] = 'Novinky';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/novinky', $data);
        $this->load->view('templates/footer');
    }
}
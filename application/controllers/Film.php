<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 25.05.18
 * Time: 17:02
 */

class Film extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('film_model');
        $this->load->model('herec_model');
        $this->load->model('reziser_model');
        $this->load->model('hodnoceni_model');
        $this->load->model('zanr_model');
    }

    public function list()
    {
        $data['films'] = $this->film_model->get_best_film_list();
        $data['title'] = 'Seznam filmů';
        foreach ($data['films'] as $film) {
            $data['herci'][$film['id_film']] = $this->herec_model->get_herci_filmu($film['id_film']);
            $data['zanry'][$film['id_film']] = $this->zanr_model->get_zanry_filmu($film['id_film']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/list_films', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['film_detail'] = $this->film_model->get_film($id);
        $data['title'] = $this->film_model->get_film($id)->nazev_film;
        $data['herci'] = $this->herec_model->get_herci_filmu($id);
        $data['reziseri'] = $this->reziser_model->get_reziseri_filmu($id);
        $data['hodnoceni'] = $this->hodnoceni_model->get_hodnoceni_filmu($id, $this->session->id_uzivatel);
        $data['prumerne_hodnoceni'] = $this->hodnoceni_model->get_prumer($id);
        $data['zanry'] = $this->zanr_model->get_zanry_filmu($id);

        $this->load->view('templates/header', $data);
        $this->load->view('pages/film_detail', $data);
        $this->load->view('templates/footer');
    }

    public function nove_hodnoceni($id)
    {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('hodnoceni', 'Hodnocení', 'required');


        if ($this->form_validation->run() === FALSE) {

            redirect(base_url() . 'film/detail/' . $id);
        } else {
            if ($this->hodnoceni_model->vloz_hodnoceni($id, $this->session->id_uzivatel)) {
                $this->session->set_flashdata('message', 'Hodnocení úspěšně vloženo.');
                redirect(base_url() . 'film/detail/' . $id);

            } else {
                $this->session->set_flashdata('message', 'K tomuto filmu už jste recenzi vložil/a.');
                redirect(base_url() . 'film/detail/' . $id);
            }

        }

    }

    public function palec_nahoru($id)
    {
        if (empty($this->hodnoceni_model->check_palec($this->session->id_uzivatel))) {
            if ($this->hodnoceni_model->pridej_palec()) {
                $this->session->set_flashdata('message', 'Hodnocení úspěšně označeno.');
                redirect(base_url() . 'film/detail/' . $id);

            } else {
                $this->session->set_flashdata('message', 'Chyba při zpracování.');
                redirect(base_url() . 'film/detail/' . $id);

            }
        } else {
            $this->session->set_flashdata('message', 'Pro toto hodnocení už jste hlasovali.');
            redirect(base_url() . 'film/detail/' . $id);

        }

    }

    public function vloz_film()
    {


        $data['herci'] = $this->herec_model->get_seznam_hercu();
        $data['zanry'] = $this->zanr_model->get_seznam_zanru();

        $this->load->view('templates/header');
        $this->load->view('pages/insert_film', $data);
        $this->load->view('templates/footer');
    }

    public function vlozit_novy_film()
    {

        if (!empty($this->input->post('nazev'))
        ) {
            $udaje = array(
                'nazev' => $this->input->post('nazev'),
                'stopaz' => $this->input->post('stopaz'),
                'zanr' => $this->input->post('zanr'),
                'herec' => $this->input->post('herec'),
            );
        } else {
            $this->session->set_flashdata('message', 'Chyba při vyplnění');
            redirect(base_url() . 'vloz_film');
        }




        if ($this->film_model->vlozit_novy_film($udaje)) {
            $this->session->set_flashdata('message', 'Film úspěšně přidán');
            redirect(base_url(). 'film/list');
        } else {
            $this->session->set_flashdata('message', 'Chyba při vkládání');
            redirect(base_url() . 'vloz_film');
        }
    }

}
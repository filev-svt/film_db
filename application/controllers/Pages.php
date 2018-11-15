<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 25.05.18
 * Time: 14:56
 */

class Pages extends CI_Controller
{
    public function view($page = 'home')
    {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');

    }

    public function login()
    {
        $data['title'] = 'Přihlášení';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/login');
        $this->load->view('templates/footer');
    }

    public function registrace()
    {
        $data['title'] = 'Registrace';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/registrace', $data);
        $this->load->view('templates/footer');
    }



}
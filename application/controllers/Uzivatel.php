<?php
/**
 * Created by PhpStorm.
 * User: sf
 * Date: 28.05.18
 * Time: 15:16
 */

class Uzivatel extends CI_Controller
{



    private $client_id = '728237900630-k62mlti54fsisv0jmicadh6uoi6mr33r.apps.googleusercontent.com';
    private $client_secret = 'Cn0lfTEvYc5qiaDO2Nnj7wTj';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('uzivatel_model');
    }

    public function registrace()
    {
        if(!empty($this->input->post('registrace_username'))
        && !empty($this->input->post('registrace_heslo'))
            && !empty($this->input->post('registrace_jmeno'))
            && !empty($this->input->post('registrace_email'))
            && !empty($this->input->post('registrace_prijmeni'))


        ) {
            $udaje = array(
                'username' => $this->input->post('registrace_username'),
                'heslo' => $this->input->post('registrace_heslo'),
                'email' => $this->input->post('registrace_email'),
                'jmeno' => $this->input->post('registrace_jmeno'),
                'prijmeni' => $this->input->post('registrace_prijmeni')
            );
        }
        else {
            $this->session->set_flashdata('message', 'Chybné údaje registrace');
            $this->session->set_flashdata('prijmeni', $this->input->post('registrace_prijmeni'));


            redirect(base_url() . 'registrace');
        }


        if ($this->uzivatel_model->registruj($udaje)) {
            $this->session->set_flashdata('message', 'Registrace provedena úspěšně');
            redirect(base_url(). 'login');
        } else {
            $this->session->set_flashdata('message', 'Chyba při registraci');
            redirect(base_url() . 'registrace');
        }
    }


    public function gLogin(){


        $redirect_uri = base_url('gcallback');;

        //Create Client Request to access Google API
        $client = new Google_Client();
        $client->setApplicationName("Yourappname");
        $client->setClientId($this->client_id);
        $client->setClientSecret($this->client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        $client->addScope("profile");

        //Send Client Request
        $objOAuthService = new Google_Service_Oauth2($client);

        redirect($client->createAuthUrl());
    }

    public function gCallBack(){

        $redirect_uri = base_url('gcallback');;
        //Create Client Request to access Google API
        $client = new Google_Client();
        $client->setApplicationName("Yourappname");
        $client->setClientId($this->client_id);
        $client->setClientSecret($this->client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        //$client->addScope("profile");

        //Send Client Request
        $service = new Google_Service_Oauth2($client);

        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();

        // User information retrieval starts..............................

        $user = $service->userinfo->get(); //get user info


        // Prep the query
        //$this->db->where('google_id', $user->email);

        $sql = 'SELECT * FROM uzivatel WHERE email = ?';
        $query = $this->db->query($sql, $user->email);

        if ($query->num_rows() == 1) {
            // If there is a user, then create session data
            $row = $query->row();

            $this->session->set_userdata('id_uzivatel', $row->id_uzivatel);
            $this->session->set_userdata('username', $row->username);
            $this->session->set_userdata('jmeno_uzivatel', $row->jmeno_uzivatel);
            $this->session->set_userdata('prijmeni_uzivatel', $row->prijmeni_uzivatel);

            $this->session->set_flashdata('message', 'Úspěšné přihlášení přes účet Google');


            redirect(base_url());
        }
        else{
            $this->session->set_flashdata('message', 'Chyba při přihlášení přes účet Google');


            redirect(base_url());
        }
    }



    public function login()
    {
        if (!isset($this->session->id_uzivatel)) {
            $udaje = array(
                'username' => $this->input->post('login_username')
            );
            $row = $this->uzivatel_model->validuj($udaje);

            if (!empty($row)) {

                $this->session->set_userdata('id_uzivatel', $row->id_uzivatel);
                $this->session->set_userdata('username', $row->username);
                $this->session->set_userdata('jmeno_uzivatel', $row->jmeno_uzivatel);
                $this->session->set_userdata('prijmeni_uzivatel', $row->prijmeni_uzivatel);


                $this->session->set_flashdata('message', 'Úspěšné přihlášení');

                redirect(base_url());
            } else {

                $this->session->set_flashdata('message', 'Chyba při přihlašování');
                redirect(base_url() . 'login');
            }
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect(base_url());
        $this->session->set_flashdata('message', 'Úspěšné odhlášení');
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: mm
 * Date: 09.04.15
 * Time: 00:32
 */
class controller
{

    public function index($klient_id)
    {
        $uzytkownik = $this->load->model('uzytkownik')->zalogowany();
        $adres_strony = $this->input->post('adres_strony');
        $phrasePerClient = $this->load->model('frazyPerKlient');
        $allPhrasesPerClient = $phrasePerClient->getAllPhrasePerClient();
        $this->load->view('frazyPerKlient', array('adres_strony' => $adres_strony,
            'uzytkownik' => $uzytkownik,
            'allPhrasesPerClient' => $allPhrasesPerClient,
            'klientId' => $klient_id
        ));
    }

    public function addPhrase()
    {
        $user = $this->load->model('uzytkownik')->zalogowany();
        $url = $this->input->post('adres_strony');
        $clientIdForm = $this->input->post('clientId');
        $phrasesForClientForm = $this->input->post('phrasesForClient');
        if (empty($phrasesForClientForm) || empty($clientIdForm)) {
            $this->session->set('error', 1);
        }
        if ($this->session->get('error')) {
            $phrasePerClient = $this->load->model('frazyPerKlient');
            $allPhrasesPerClient = $phrasePerClient->getAllPhrasePerClient();
            $this->load->view('frazyPerKlient',
                array(
                    'adres_strony' => $url,
                    'uzytkownik' => $user,
                    'klientId' => $clientIdForm,
                    'allPhrasesPerClient' => $allPhrasesPerClient,
                )
            );
        } else {
            $phrasePerClient = $this->load->model('frazyPerKlient');
            $phrasePerClient->saveMultiPhrasePerClient($phrasesForClientForm, $clientIdForm);
            $this->session->set('info', 1);
            url::redirect('frazyPerKlient/index/' . $clientIdForm);
        }
    }

    public function editPhrase($id, $clientId)
    {
        $user = $this->load->model('uzytkownik')->zalogowany();
        if ($user['typ'] != 'admin') {
            $this->load->error('no-access');
        }
        $phrasePerClient = $this->load->model('frazyPerKlient')->getOnePublicPhrase($id, $clientId);
//        var_dump($phrasePerClient);die;
        $this->load->view(
            'frazyPerKlient_form',
            array(
                'phrasePerClient' => $phrasePerClient,
                'uzytkownik' => $user,
                'clientId' => $clientId
            )
        );
    }

    public function updatePhrase()
    {
        $user = $this->load->model('uzytkownik')->zalogowany();
        $url = $this->input->post('adres_strony');
        $clientPhraseForm = trim($this->input->post('phrasesForClient'));
        $idForm = $this->input->post('id');
        $clientIdForm = trim($this->input->post('clientId'));
        $phrasePerClient = $this->load->model('frazyPerKlient')->getOnePublicPhrase($idForm, $clientIdForm);
        if (empty($clientPhraseForm) || empty($idForm) || empty($clientIdForm)) {
            $this->session->set('error', 1);
        }
        if ($this->session->get('error')) {
            $this->load->view(
                'frazyPerKlient_form',
                array(
                    'phrasePerClient' => $phrasePerClient,
                    'uzytkownik' => $user,
                    'clientId' => $clientIdForm
                )
            );
        } else {
            $publicPhrase = $this->load->model('frazyPerKlient');
            $publicPhrase->updatePublicPhrase($idForm, $clientIdForm, $clientPhraseForm);
            $this->session->set('info', 'Prawidłowo zaktualizowano frazę dla klienta');
            url::redirect('frazyPerKlient/index/'.$clientIdForm);
        }
    }

    public function deletePhrase($id, $clientId)
    {
        $user = $this->load->model('uzytkownik')->zalogowany();
        if ($user['typ'] != 'admin') {
            $this->load->error('no-access');
        }
        $status = $this->load->model('frazyPerKlient')->deletePhraseForClient($id, $clientId);
        if ($status) {
            $this->session->set('info', 'Fraza została usunięta');
        } else {
            $this->session->set('error', 'Coś poszło nie tak');
        }
        url::redirect('frazyPerKlient/index/'.$clientId);
    }
}

?>
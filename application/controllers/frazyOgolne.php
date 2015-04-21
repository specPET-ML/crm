<?php

/**
 * Created by PhpStorm.
 * User: mm
 * Date: 09.04.15
 * Time: 00:32
 */
class controller
{

    public function index()
    {
        $uzytkownik = $this->load->model('uzytkownik')->zalogowany();
        $adres_strony = $this->input->post('adres_strony');
        $publicPhrases = $this -> load -> model('frazyOgolne');

        $allPublicPhrases = $publicPhrases->getAllPublicPhrases();
        $this->load->view('frazyOgolne', array('adres_strony' => $adres_strony,
            'uzytkownik' => $uzytkownik,
            'allPublicPhrases' => $allPublicPhrases,
        ));


    }

    public function addPhrase()
    {
        $user = $this->load->model('uzytkownik')->zalogowany();
        $url = $this->input->post('adres_strony');

        $phraseForm = $this->input->post('phrase');

        if (empty($phraseForm)){
            $this -> session -> set('error', 1);
        }
        if($this -> session -> get('error')){
            $this->load->view('frazyOgolne',
                array(
                    'adres_strony' => $url,
                    'uzytkownik' => $user
                )
            );
        } else {
            $publicPhrase = $this -> load -> model('frazyOgolne');

            $publicPhrase->saveMultiPublicPhrase($phraseForm);

            $this -> session -> set('info', 1);

            url::redirect('frazyOgolne');
        }
    }

    public function editPhrase($id){
        $user = $this -> load -> model('uzytkownik') -> zalogowany();

        if($user['typ'] != 'admin') {
            $this->load->error('no-access');
        }

        $publicPhrase = $this -> load -> model('frazyOgolne') -> getOnePublicPhrases($id);
        $this -> load -> view('frazyOgolne_form', array('publicPhrase' => $publicPhrase,
            'uzytkownik' => $user));
    }

    public function updatePhrase() {
        $user = $this->load->model('uzytkownik')->zalogowany();
        $url = $this->input->post('adres_strony');

        $phraseForm = $this->input->post('phrase');
        $idForm = trim($this->input->post('id'));
        if (empty($phraseForm)){
            $this -> session -> set('error', 1);
        }
        if($this -> session -> get('error')){
            $this->load->view('frazyOgolne',
                array(
                    'adres_strony' => $url,
                    'uzytkownik' => $user
                )
            );
        } else {

            $publicPhrase = $this -> load -> model('frazyOgolne');

            $publicPhrase->updatePublicPhrase($idForm,$phraseForm);

            $this -> session -> set('info', 'Prawidłowo zaktualizowano frazę ogólną');

            url::redirect('frazyOgolne');
        }
    }

    public function deletePhrase($id){
        $user = $this -> load -> model('uzytkownik') -> zalogowany();

        if($user['typ'] != 'admin') {
            $this->load->error('no-access');
        }

        $status = $this -> load -> model('frazyOgolne') -> deletePublicPhrase($id);
        if($status){
            $this -> session -> set('info', 'Fraza została usunięta');
        } else {
            $this -> session -> set('error', 'Coś poszło nie tak');
        }

        url::redirect('frazyOgolne');

    }
}

?>
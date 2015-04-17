<?php

/**
 * Created by Marcin Ławniczak
 * specPET Marcin Ławniczak
 * Date: 14.04.15
 */

class controller
{
    public function index($id_klienta, $afterUpload = false, $errorUpload = null, $succesUpload = null)
    {
        $uzytkownik = $this->load->model('uzytkownik')->zalogowany();
        $adres_strony = $this->input->post('adres_strony');
        $this->load->view('phraseStatsImport', array(
            'adres_strony' => $adres_strony,
            'uzytkownik' => $uzytkownik,
            'id_klienta' => $id_klienta,
            'errorUpload' => $errorUpload ? $errorUpload : null,
            'succesUpload' => $succesUpload ? $succesUpload : null,
            'afterUpload' => $afterUpload ? $afterUpload : null,
        ));
    }

    public function upload()
    {
        $uzytkownik = $this->load->model('uzytkownik')->zalogowany();
        $adres_strony = $this->input->post('adres_strony');
        $fileForm = $this->input->files('file');
        $statsDateForm = $this->input->post('statsDate');
        $idKlientaForm = $this->input->post('id_klienta');
        if (empty($fileForm['name']) || $fileForm['size'] == 0 || empty($statsDateForm)) {
            $this->session->set('error', 1);
        }
        if (!preg_match("/.csv$/i", $fileForm['name'])) {
            $this->session->set('error', 'Błędne rozszerzenie pliku');
        }
        if ($this->session->get('error')) {
            $this->load->view('phraseStatsImport', array(
                'adres_strony' => $adres_strony,
                'uzytkownik' => $uzytkownik,
                'id_klienta' => $idKlientaForm,
                'errorUpload' => null,
                'succesUpload' => null,
                'afterUpload' => null,
                'statsDateForm' => $statsDateForm,
            ));
        } else {
            $resultsFromReadingCSV = $this->readCSV($fileForm);
            $publicPhrase = $this->load->model('phraseStatsImport');
            $phraseMaps = $publicPhrase->getPhrasesByClientId($idKlientaForm);
            $resultsFromPreaparingData = $this->preapareDataToImport($resultsFromReadingCSV[0], $phraseMaps, $statsDateForm);
            $resultsFromImport = $publicPhrase->importStats($resultsFromPreaparingData[0]);
            $this->index($idKlientaForm, true, $resultsFromPreaparingData[1], $resultsFromImport);

        }
    }

    public function readCSV($fileForm)
    {
        $handle = fopen($fileForm['tmp_name'], "r");
        while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {

            if (is_numeric($data[1])) {
                if ($col = count($data) == 2) {
                    if ($data[1] >= 1 && $data[1] <= 10) {
                        $pierwsza_strona = 1;
                    } else {
                        $pierwsza_strona = 0;
                    }
                    $csvStats[$data[0]] = array('wynik' => $data[1], 'pierwsza_strona' => $pierwsza_strona);
                }
                if ($col = count($data) == 3) {
                    $csvStats[$data[0]] = array('wynik' => $data[1], 'pierwsza_strona' => $data[2]);
                }

            } else {
                $errorData[] = array(
                    'phrase' => $data[0],
                    'rank' => $data[1],
                    'reason' => 'Ranking nie jest wartością liczbową'
                );
            }
        }
        fclose($handle);
        return array($csvStats, $errorData);
    }

    public function preapareDataToImport($csvStats, $phraseMaps, $statsDateForm)
    {
        foreach ($csvStats as $csvStatsKey => $csvStatsValue) {
            if (array_key_exists($csvStatsKey, $phraseMaps)) {
                $dataToImport[] = array(
                    'data' => $statsDateForm,
                    'id_frazy' => $phraseMaps[$csvStatsKey],
                    'pierwsza_strona' => $csvStatsValue['pierwsza_strona'],
                    'fraza' => $csvStatsKey,
                    'wynik' => $csvStatsValue['wynik'],
                );
            } else {
                $errorData[] = array(
                    'phrase' => $csvStatsKey,
                    'rank' => $csvStatsValue,
                    'reason' => 'Brak przypisanej frazy dla klienta'
                );
            }
        }
        return array($dataToImport, $errorData);
    }

}
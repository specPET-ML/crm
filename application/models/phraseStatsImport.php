<?php

/**
 * Created by Marcin Ławniczak
 * specPET Marcin Ławniczak
 * Date: 14.04.15
 */

class phraseStatsImport_model
{

    public function getPhrasesByClientId($clientId)
    {
        $table = $this->db->table('frazy');
        $clientPhrases = $table->select('id_frazy', 'nazwa', 'id_klienta')
            ->where('id_klienta', '=', $clientId)
            ->execute();
        if (!empty($clientPhrases)) {
            $results = $this->preaparePhraseMaps($clientPhrases);
        }
        return $results ? $results : false;
    }

    public function preaparePhraseMaps($clientPhrases)
    {
        if (!empty($clientPhrases)) {
            foreach ($clientPhrases as $row) {
                $results[$row['nazwa']] = $row['id_frazy'];
            }
        }
        return $results ? $results : false;
    }

    public function importStats($dataToImport)
    {
        $table = $this->db->table('frazy_wyniki');
        foreach ($dataToImport as $row) {
            $insert = $this->checkIfExistStatsForPhraseInDay($row['data'], $row['id_frazy']);
            if ($insert) {
                $table->insert(array('data' => $row['data'],
                    'id_frazy' => $row['id_frazy'],
                    'pierwsza_strona' => $row['pierwsza_strona'],
                    'wynik' => $row['wynik']
                ), false);
                $results[] = array(
                    'data' => $row['data'],
                    'fraza' => $row['fraza'],
                    'id_frazy' => $row['id_frazy'],
                    'wynik' => $row['wynik'],
                    'action' => 'dodano'
                );
            } else {
                $table->update(array('wynik' => $row['wynik'], 'pierwsza_strona' => $row['pierwsza_strona']))
                    ->where('data', '=', $row['data'])
                    ->clause('AND')
                    ->where('id_frazy', '=', $row['id_frazy'])
                    ->execute();
                $results[] = array(
                    'data' => $row['data'],
                    'fraza' => $row['fraza'],
                    'id_frazy' => $row['id_frazy'],
                    'wynik' => $row['wynik'],
                    'action' => 'aktualizacja'
                );
            }
        }
        return $results;
    }

    public function checkIfExistStatsForPhraseInDay($data, $phrase)
    {
        $table = $this->db->table('frazy_wyniki');

        $publicPhrase = $table->select('*')
            ->where('data', '=', $data)
            ->clause('AND')
            ->where('id_frazy', '=', $phrase)
            ->limit(1)
            ->execute();
        return empty($publicPhrase) ? true : false;
    }

}
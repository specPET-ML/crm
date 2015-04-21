<?php

/**
 * Created by PhpStorm.
 * User: mm
 * Date: 09.04.15
 * Time: 23:17
 */
class frazyPerKlient_model
{
    public function saveClientPhrase($clientPhrase, $clientId, $id = null)
    {
        $table = $this->db->table('frazyPerKlient');
        if (!empty($id)) {
            $table->update(
                array(
                    'clientPhrase' => $clientPhrase))
                ->where('id', '=', $id)
                ->clause('AND')
                ->where('clientId', '=', $clientId)
                ->execute();
        } else {
            $table->insert(array(
                'id' => NULL,
                'clientPhrase' => $clientPhrase,
                'clientId' => $clientId), false);
        }
    }

    public function getAllPhrasePerClient()
    {
        $table = $this->db->table('frazyPerKlient');
        $phrasesPerClient = $table->select('*')
            ->order_by('id', 'ASC')
            ->execute();
        return $phrasesPerClient ? $phrasesPerClient : false;
    }

    public function getOnePublicPhrase($id, $clientId)
    {
        $table = $this->db->table('frazyPerKlient');
        $phrasePerClient = $table->select('*')
            ->where('id', '=', $id)
            ->clause('AND')
            ->where('clientID', '=', $clientId)
            ->limit(1)
            ->execute();
        return $phrasePerClient ? $phrasePerClient[0] : false;
    }

    public function getOnePhrasePerClientByName($phrasePerClient, $clientId)
    {
        $table = $this->db->table('frazyPerKlient');
        $phrasePerClient = $table->select('*')
            ->where('clientPhrase', '=', $phrasePerClient)
            ->clause('AND')
            ->where('clientID', '=', $clientId)
            ->limit(1)
            ->execute();
        return $phrasePerClient ? $phrasePerClient[0] : false;
    }

    public function saveMultiPhrasePerClient($phrasesForClient, $clientId)
    {
        if ($phrasesForClient) {
            $phrasesForClient = str_replace('<br>', ',', str_replace('<br />', ',', nl2br($phrasesForClient)));
            $phrasesForClient = explode(',', $phrasesForClient);
            $phrasesForClient = array_map("trim", $phrasesForClient);
            $phrasesForClient = array_map("strtolower", $phrasesForClient);

            foreach ($phrasesForClient as $phrasePerClient) {
                $phrasePerClientExist = $this->getOnePhrasePerClientByName($phrasePerClient, $clientId);
                if (!empty($phrasePerClient) && $phrasePerClientExist == false) {
                    $this->saveClientPhrase($phrasePerClient, $clientId);
                }
            }
        }
        return true;
    }

    public function deletePhraseForClient($id, $clientId)
    {
        $table = $this->db->table('frazyPerKlient');
        $publicPhraseExist = $this->getOnePublicPhrase($id, $clientId);
        if ($publicPhraseExist != false) {
            $table->delete()
                ->where('id', '=', $id)
                ->clause('AND')
                ->where('clientID', '=', $clientId)
                ->execute();
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }

    public function updatePublicPhrase($id, $clientId, $phraseForClient)
    {
        $table = $this->db->table('frazyPerKlient');
        $publicPgraseExist = $this->getOnePublicPhrase($id, $clientId);
        if ($publicPgraseExist != false) {
            $table->update(array('clientPhrase' => $phraseForClient))
                ->where('id', '=', $id)
                ->clause('AND')
                ->where('clientID', '=', $clientId)
                ->execute();
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
}
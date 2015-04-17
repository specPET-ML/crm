<?php
/**
 * Created by PhpStorm.
 * User: mm
 * Date: 09.04.15
 * Time: 23:17
 */

class frazyOgolne_model {

    public function savePublicPhrase($publicPhrase, $id = null){
        $table = $this -> db -> table('frazyOgolne');
        if (!empty($id)){
            $table -> update(
                array(
                    'publicPhrase' => $publicPhrase))
                -> where('id','=',$id)
                -> execute();
        }else{
            $table -> insert(array(
                'id' => NULL,
                'publicPhrase' => $publicPhrase), false);
        }
    }

    public function getAllPublicPhrases(){
        $table = $this -> db -> table('frazyOgolne');

        $publicPhrases = $table -> select('*')
            -> order_by('id', 'ASC')
            -> execute();

        return $publicPhrases ? $publicPhrases : false;
    }

    public function getOnePublicPhrases($id){
        $table = $this -> db -> table('frazyOgolne');

        $publicPhrase = $table -> select('*')
            -> where('id','=',$id)
            -> limit(1)
            -> execute();

        return $publicPhrase ? $publicPhrase[0] : false;
    }

    public function getOnePublicPhraseByName($name){
        $table = $this -> db -> table('frazyOgolne');

        $publicPhrase = $table -> select('*')
            -> where('publicPhrase','=',$name)
            -> limit(1)
            -> execute();

        return $publicPhrase ? $publicPhrase[0] : false;
    }

    public function saveMultiPublicPhrase($publicPhrases){

        if($publicPhrases){
            $publicPhrases = str_replace('<br>', ',', str_replace('<br />', ',', nl2br($publicPhrases)));
            $publicPhrases = explode(',', $publicPhrases);
            $publicPhrases = array_map("trim", $publicPhrases);
            $publicPhrases = array_map("strtolower", $publicPhrases);

            foreach($publicPhrases as $publicPhrase){
                $publicPhraseExist = $this -> getOnePublicPhraseByName($publicPhrase);

                if(!empty($publicPhrase) && $publicPhraseExist == false){
                    $this -> savePublicPhrase($publicPhrase);
                }
            }
        }

        return true;
    }

    public function deletePublicPhrase($id){
        $table = $this -> db -> table('frazyOgolne');

        $publicPgraseExist = $this -> getOnePublicPhrases($id);

        if ($publicPgraseExist != false) {
            $table->delete()
                ->where('id', '=', $id)
                ->execute();
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }

    public function updatePublicPhrase($id,$publicPhrase){
        $table = $this -> db -> table('frazyOgolne');

        $publicPgraseExist = $this -> getOnePublicPhrases($id);

        if ($publicPgraseExist != false) {
            $table->update(array('publicPhrase' => $publicPhrase))
                ->where('id','=',$id)
                ->execute();
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }

}
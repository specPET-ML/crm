<?php
class Model_Client extends ADPCRM_Model {

	protected $tableName='klienci';

	protected $idColumn='id_klienta';

	protected $columns=array (
			'id_klienta' => Model::TYPE_NORMAL,
			'adres_strony' => Model::TYPE_STRING,
			'faktura_nazwa' => Model::TYPE_STRING,
			'faktura_adres' => Model::TYPE_STRING,
			'faktura_kod_pocztowy' => Model::TYPE_STRING,
			'faktura_miejscowosc' => Model::TYPE_STRING,
			'telefon' => Model::TYPE_STRING,
			'google_mapa' => Model::TYPE_STRING,
	);
	
	public function getPhrases() {
		
		$phrases = new Model_Phrase();
		$phrases = $phrases->findAll(' id_klienta = ' . $this->getID());
		
		return $phrases;
		
	}

	public function getEntries() {		
		$entries = R::findAll('privcatentry', ' client = ? AND deleted = ?', array($this->getID(), false));
		return $entries;
	}

	public function getHistories() {
		
		$entries = $this->getEntries();
		
		$histories = array();
		
		foreach($entries as $entry) {
			$histories[$entry->id] = $this->getHistory($entry->id);
		}
		
		return $histories;
	}
	
	public function getHistory($entryId) {
		$entry = R::load('privcatentry', $entryId);
		
		$histories = R::findAll('privcathistory', ' entry_id = ? ', array($entry->id));
		
		return $histories;
	}
	
	public function getNumOfEntries() {
		$entries = R::count('privcatentry', ' client = ? AND deleted = ?', array($this->getID(), false));
		return $entries;
	}
	
	public function getNumOfUploadedEntries() {
		$entries = R::count('privcatentry', 'client = ? AND deleted = ? AND uploaded = ? ', array($this->getID(), false, true));
		return $entries;
	}

	public function getTexts() {		
		$texts = R::findAll('text', ' client = ? AND deleted = ?', array($this->getID(), false));
		return $texts;
	}
	
	public function getNumOfTexts() {
		$texts = R::count('text', ' client = ? AND deleted = ?', array($this->getID(), false));
		return $texts;
	}
	
	public function getAvailableTexts() {
		$clientTexts = $this->getTexts();
		$clientEntries = $this->getEntries();
		
		$unusedTexts = array();
		
		foreach($clientTexts as $clientText) {
			$unusedTexts[$clientText->id] = $clientText;
			foreach($clientEntries as $entry) {
				if($entry->text->id == $clientText->id) {
					unset($unusedTexts[$clientText->id]);
				}
			}
		}
		
		return $unusedTexts;
	}
	
	public function getNumOfAvailableTexts() {		
		return count($this->getAvailableTexts());
	}
	
	public function findAll($where = null, $limit = null) {
		$sql='SELECT * FROM ' . $this->tableName . ' WHERE 1 ';
		if($where != null) {
			$sql .= ' AND '.$where;
		}
		
		if($limit != null) {
			$sql .= ' LIMIT '.$limit;
		}
		
		$result=array ();
		$dbh=new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
		$rows=$dbh->query($sql);
		
		foreach ( $rows as $row ) {
			$model=new Model_Client();
			$model->createFromRow($row);
			$result[$model->getId()]=$model;
		}
		
		return $result;
	}

	/**
	 * 
	 * @param string $method can be 'entries' or 'texts'
	 * @return multitype:Model_Client
	 */
	public function getAllSortedBy ($method='entries'){

    	$sql = "
        SELECT
    				klienci.id_klienta,
    				klienci.adres_strony,
    				
    				-- TODO: nie potrzeba, ale klasa wymaga
    				'' AS faktura_nazwa,
    				'' AS faktura_adres,
    				'' AS faktura_kod_pocztowy,
    				'' AS faktura_miejscowosc,
    				'' AS telefon,
					'' AS google_mapa,";

    	switch ($method)
    	{
    		default:
    		case 'entries':
    			$sql.="
    				COUNT(entries.client)  as numofentries";
    			break;
    		
    		case 'texts':
    			$sql.="
    				COUNT(texts.client)    as numoftexts,
    				COUNT(alltexts.client) as numofalltexts";
    			break;
    	}
        $sql.="
        FROM
				klienci";

    	switch ($method)
    	{
    		default:
    		case 'entries':
    			$sql .= "
            LEFT JOIN (
    								-- 1379 idkow clienta z 1493
    								SELECT client FROM privcatentry 
    								WHERE deleted = 0 AND client IS NOT NULL
                        ) as entries
                ON klienci.id_klienta = entries.client 
    				";
    			break;
    		
    		case 'texts':
    			$sql .= "
            LEFT JOIN (
    						SELECT client FROM text 
    						WHERE deleted = 0 AND text.id NOT IN 
    							( 	
    									-- 1379 wierszy z text_id (przypisany klient i nie usuniete)
    									SELECT text_id FROM privcatentry 
    									WHERE deleted = 0 AND client IS NOT NULL
    							)
                        ) as texts
                ON klienci.id_klienta = texts.client 
    			
            LEFT JOIN (
    						-- 2187 idkow clienta z 2220
    						SELECT client FROM `text` 
    						WHERE deleted = 0
                        ) as alltexts
                ON klienci.id_klienta = alltexts.client 					
    							";
    			break;
    	}					

    	$sql .=		"
    	WHERE 
                    klienci.etap IN ( 2, 5, 7 )
    	GROUP BY 
                    klienci.id_klienta";		

    	switch ($method)
    	{
    		default:
    		case 'entries':
    			$sql .= "
    	HAVING     (numofentries > 0)
    	ORDER BY    numofentries DESC,	 
                    adres_strony ASC";	
    			break;
    		
    		case 'texts':
    			$sql .= "
    	HAVING     (numoftexts > 0)
    	ORDER BY    numoftexts DESC, 
                    numofalltexts DESC,
                    adres_strony ASC";
    			break;
    	}			
				

		// if (DEBUG || TESTING)
		// {
		// 	echo "<pre>".$sql."</pre>";
		// }
		$result=array ();
		 $dbh=new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
		// $ts_start = microtime(TRUE);
		$rows=$dbh->query($sql);
		/* $ts_end = microtime(TRUE);
		echo "Query time: " . (float)($ts_end - $ts_start). " s"; */
		foreach ( $rows as $row ) {
			//echo "<pre>"; print_r ($row); echo "</pre><br />";

			$model = new Model_Client();
			$model->createFromRow($row);
			$result[$model->getId()] = $model;
		}
		return $result;	
	}	
}
<?php
 
class DbOperation
{
    
    private $con;
 
 
    function __construct()
    {
  
        require_once dirname(__FILE__) . '/DbConnect.php';
 
     
        $db = new DbConnect();
 

        $this->con = $db->connect();
    }
	
	
	function createNOMETROCAR($campo_1, $campo_2, $campo_3, $campo_4){
		$stmt = $this->con->prepare("INSERT INTO tabela (campo_1, campo_2, campo_3, campo_4) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssis", $campo_1, $campo_2, $campo_3, $campo_4);
		if($stmt->execute())
			return true; 
		return false; 
	}

	
	function getNOMETROCAR(){
		$stmt = $this->con->prepare("SELECT id, campo_1, campo_2, campo_3, campo_4 FROM TABELA");
		$stmt->execute();
		$stmt->bind_result($id, $campo_1, $campo_2, $campo_3, $campo_4);
		
		$NOMEMUDARS = array(); 
		
		while($stmt->fetch()){
			$NOMEMUDAR  = array();
			$NOMEMUDAR['id'] = $id; 
			$NOMEMUDAR['campo_1'] = $campo_1; 
			$NOMEMUDAR['campo_2'] = $campo_2; 
			$NOMEMUDAR['campo_3'] = $campo_3; 
			$NOMEMUDAR['campo_4'] = $campo_4; 
			
			array_push($NOMEMUDARS, $NOMEMUDAR); 
		}
		
		return $NOMEMUDARS; 
	}
	
	
	function updateNOMETROCAR($id, $campo_1, $campo_2, $campo_3, $campo_4){
		$stmt = $this->con->prepare("UPDATE tabela SET campo_1 = ?, campo_2 = ?, campo_3 = ?, campo_4 = ? WHERE id = ?");
		$stmt->bind_param("ssisi", $campo_1, $campo_2, $campo_3, $campo_4, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	
	function deleteNOMETROCAR($id){
		$stmt = $this->con->prepare("DELETE FROM tabela WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
}
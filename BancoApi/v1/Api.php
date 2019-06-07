<?php 


	require_once '../includes/DbOperation.php';

	function isTheseParametersAvailable($params){
	
		$available = true; 
		$missingparams = ""; 
		
		foreach($params as $param){
			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}
		
		
		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
			
		
			echo json_encode($response);
			
		
			die();
		}
	}
	
	
	$response = array();
	

	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
	
			case 'createNOMETROCAR':
				
				isTheseParametersAvailable(array('campo_1','campo_2','campo_3','campo_4'));
				
				$db = new DbOperation();
				
				$result = $db->createHero(
					$_POST['campo_1'],
					$_POST['campo_2'],
					$_POST['campo_3'],
					$_POST['campo_4']
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Dados adicionado com sucesso';

					
					$response['NOMETROCAR'] = $db->getNOMETROCAR();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getNOMETROCAR':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['NOMETROCAR'] = $db->getNOMETROCAR();
			break; 
			
			
		
			case 'updateNOMETROCAR':
				isTheseParametersAvailable(array('id','campo_1','campo_2','campo_3','campo_4'));
				$db = new DbOperation();
				$result = $db->updateHero(
					$_POST['id'],
					$_POST['campo_1'],
					$_POST['campo_2'],
					$_POST['campo_3'],
					$_POST['campo_4']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Dados atualizado com sucesso';
					$response['NOMETROCAR'] = $db->getNOMETROCAR();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteNOMETROCAR':

				
				if(isset($_GET['id'])){
					$db = new DbOperation();
					if($db->deleteNOMETROCAR($_GET['id'])){
						$response['error'] = false; 
						$response['message'] = 'Dado excluído com sucesso';
						$response['NOMETROCAR'] = $db->getNOMETROCAR();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break; 
		}
		
	}else{
		 
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}
	

	echo json_encode($response);
	
	

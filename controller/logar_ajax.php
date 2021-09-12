<?php

require_once "funcoes.php";

include("../model/Login.php");

$dados = json_decode(file_get_contents('php://input'), true);

if ($dados != null) {
	$credenciais = new Login($dados);	
	$ajax = new LogarAjax($credenciais);
	$resultado = $ajax->verificarTipoLogin();
	
	// Cabecalho da resposta
	header("Content-type: application/json");

	// Resposta convertida para Json
	echo json_encode($resultado);
}


/**
* Classe que representa as ações para efetuar o Login via ajax
*
*/
class LogarAjax {

	// Atributo que representa a Classe Login
	private $loginClass;

	/**
	* Construtor
	* @param $loginClass
	*/
	public function LogarAjax($login) {
		$this->setLoginClass($login);
	}

	/**
	* Getter e Setter
	*
	*/
	public function getLoginClass() {
		return $this->loginClass;
	}

	public function setLoginClass($login) {
		$this->loginClass = $login;
	}


	/**
	* Verifica o tipo de Login que será feito com base no parametros da classe Login
	*
	*/
	public function verificarTipoLogin() {

		$email = $this->getLoginClass()->getEmail();
		$senha = $this->getLoginClass()->getSenha();
		$userId = $this->getLoginClass()->getUserId();
		$lembrar = $this->getLoginClass()->isLembrar();

		if (!empty($email) && !empty($senha)) {
			return $this->logarFormulario($email, $senha, $lembrar);

		} else if (!empty($email) && !empty($userId)) {
			return $this->logarRedeSocial($email, $userId);

		} else {
			return $this->semDados();

		}
	}

	/**
	* Login com a rede social Google
	*
	*/
	private function logarRedeSocial($email, $userId) {

		$logado = Funcoes::logarRedeSocial($email, $userId);
		
	    if ($logado == true) {

	    	// Colocar o nome do usuário que vc vai recuperar do banco de dados
    	   $_SESSION['usuario']['nome'] = "Jepeto";

    	   return $retorno = [
   			    'status' => 'success',	            
    	        'msg' => 'Bem vindo Jepeto RedeSocial!'
	        ];
	    }

	    return $this->loginInvalido();
	}

	/**
	* Login padrão por parametro
	*
	*/
	private function logarFormulario($email, $senha, $lembrar) {

	    $logado = Funcoes::logar($email, $senha, $lembrar);

	    if ($logado == true) {

	    	// Colocar o nome do usuário que vc vai recuperar do banco de dados
    	   $_SESSION['usuario']['nome'] = "Jepeto";
    	   
    	   return $retorno = [
	            'status' => 'success',	            
	            'msg' => 'Bem vindo Jepeto!'
	        ];
	    } 

	    return $this->loginInvalido();
	}
	
	private function semDados() {

	    return $retorno = [
    		'status' => 'danger',
    		'msg' => "Informe e-mail e senha para acessar!"
		];
	}

	private function loginInvalido() {

        return $retorno = [
            'status' => 'warning',
            'msg' => "E-mail e/ou senha inválidos!"
        ];
	}
	
}


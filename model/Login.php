<?php

/**
* Classe que representa o Login com os possiveis parametros
*
*/
class Login {

	private $email;
	private $senha;
	private $user_id;
	private $lembrar;

	/**
	* Construtor
	* @param $dados
	*/
	public function Login($dados) {

		$this->setEmail($dados['email'] ?? false);
		$this->setSenha($dados['senha'] ?? false);
		$this->setUserId($dados['user_id'] ?? false);
		$this->setLembrar(isset($dados['lembrar']) ? true : false);

	}


	/**
	* Getter e Setters
	*
	*/
	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function getUserId() {
		return $this->user_id;
	}

	public function setUserId($user_id) {
		$this->user_id = $user_id;
	}

	public function isLembrar() {
		return $this->lembrar;
	}

	public function setLembrar($lembrar) {
		$this->lembrar = $lembrar;
	}


}
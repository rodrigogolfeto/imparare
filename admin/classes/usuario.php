<?php
class Usuario {
	private $nome;
	private $cliente;
	private $email;
	private $funcao;
	private $id;

	public function Usuario($nome, $cliente, $email, $funcao, $id) {
		$this->nome = $nome;
		$this->cliente = $cliente;
		$this->email = $email;
		$this->funcao = $funcao;
		$this->id = $id;
	}

	public function getNome() {
		return $this->nome;
	}
	public function getClienteId() {
		return $this->cliente;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getFuncao() {
		return $this->funcao;
	}
	public function getId() {
		return $this->id;
	}
}
?>
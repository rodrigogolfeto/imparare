<?php

class Conexao{
	
	/*
	——————————————
	| Métodos:
	| * desconectar -> encerra a conexão
	| * consulta -> executa query sql
	| * conta -> número de reultados
	| * busca -> array resultado do select
	| * tratar -> trata string
	|——————————————|
	| Utilize à vontade ;- )
	——————————————
	*/

	
	protected $server 	= "mariadb"; //host - servidor
	protected $user 	= "root"; // Usuário do banco de dados
	protected $senha 	= "root"; // Senha do banco de dados
	protected $bd 		= "imparare"; // Nome do Banco de dados MySQL
	protected $con;
	
	// protected $server 	= "62.149.150.191"; //host - servidor
	// protected $user 	= "Sql672369"; // Usuário do banco de dados
	// protected $senha 	= "383e75c6"; // Senha do banco de dados
	// protected $bd 		= "Sql672369_2"; // Nome do Banco de dados MySQL
	// protected $con;
	
	//Construtor
	public function __construct() {

		$this->con = mysqli_connect($this->server, $this->user, $this->senha) or die("Falha ao conectar com o banco de dados");
		mysqli_select_db($this->con,$this->bd);
		$this->con->set_charset("utf8");
		
		$_SESSION['user']	= $this->user;
		$_SESSION['senha'] 	= $this->senha;
		$_SESSION['server'] = $this->server;
		$_SESSION['bd'] 	= $this->bd;
		
	}
	
	//Encerra a conexão
	public function desconectar() {
		mysqli_close($this->con);
	}
	
	//Executa query sql
	public function consulta($sql) {
		$res = mysqli_query($this->con,$sql);
		if(!$res){
			return false;
		}else{
			if(substr($sql,0,6) == "INSERT" && mysqli_insert_id($this->con)){
				return mysqli_insert_id($this->con);
			}else{
				return $res;
			}
		}
	}
	
	//Número de resultados que atendem a uma dada consulta
	public function conta($res) {
		if($res){
			return $res->num_rows;
		}
	}
	
	//Array resultado do select
	public function busca($res) {
		if($res){
			return $res->fetch_array(MYSQLI_BOTH);
		}
	}

	//Trata string
	public function tratar($string) {
		if($string){
			$substituir = array('select','insert','update','delete');
			return $this->con->real_escape_string(str_ireplace($substituir,'',$string));
		}
	}
	
	public function getConn(){
		return $this->con;
	}
	
} //fim da classe

?>
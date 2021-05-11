<?php
class Conexao{
/*
——————————————
| Métodos:
| * desconectar -> encerra a conexão
| * consulta -> executa query sql
| * conta -> número de reultados
| * busca -> array resultado do select
|——————————————|
| Utilize à vontade ;- )
——————————————
*/
	///*
	protected $user = "tagadepol"; // Usuário do banco de dados
	protected $senha = "qv1fbrE#ZS"; // Senha do banco de dados
	protected $bd = "tagadepol"; // Nome do Banco de dados MySQL
	protected $server = "localhost"; //host - servidor
	protected $con;
	/*
	protected $user = "sonarenergia1"; // Usuário do banco de dados
	protected $senha = "sonarsite90"; // Senha do banco de dados
	protected $bd = "sonarenergia1"; // Nome do Banco de dados MySQL
	protected $server = "mysql01.sonarenergia1.hospedagemdesites.ws"; //host - servidor
	protected $con;
	//*/
	//Construtor
	public function __construct() {
		$this->con = mysql_connect($this->server, $this->user, $this->senha) or die("Falha ao conectar com o banco de dados");
		mysql_select_db($this->bd, $this->con);
		mysql_set_charset('utf8',$this->con);
	}
	
	//Encerra a conexão
	public function desconectar() {
		mysql_close($this->con);
	}
	
	//Executa query sql
	public function consulta($sql) {
		$res = mysql_query($sql,$this->con);
		if(!$res){
			return false;
		}else{
			if(substr($sql,0,6) == "INSERT" && mysql_insert_id($this->con)){
				return mysql_insert_id($this->con);
			}else{
				return $res;
			}
		}
	}
	
	//Número de resultados que atendem a uma dada consulta
	public function conta($res) {
		if($res){
			return mysql_num_rows($res);
		}
	}
	
	//Array resultado do select
	public function busca($res) {
		if($res){
			return mysql_fetch_array($res);
		}
	}
} //fim da classe
?>

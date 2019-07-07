<?php 

namespace Hcode\DB;


class Sql {
	/*
	const HOSTNAME = "127.0.0.1";
	const USERNAME = "root";
	const PASSWORD = "";
	const DBNAME = "estrela_guia_final";
	*/
	
	const HOSTNAME 	= "www.mpgsystem.com.br:3303";
	const USERNAME 	= "mpgsyste_mancruz";
	const PASSWORD 	= "matrix@798mmc";
	const DBNAME 	= "mpgsyste_db_estrela_guia";
	             

	private $conn;

	public function __construct()
	{
		# CRIA CONEXÃO
		$this->conn = new \PDO("mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME,Sql::USERNAME,Sql::PASSWORD);
		
	}

	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

	public function encriptPass($password){

		$password = password_hash($password,PASSWORD_DEFAULT,[
			"const"=>12
		]);

		return $password;

	}

	public function dencriptPass($password){

		$password = base64_decode($password);

		return $password;

	}
}

 ?>
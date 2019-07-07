<?php 

	namespace Hcode\Model;

	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\Mailer;


	class User extends Model{

		const SESSION = "User";
		const SECRET = "HcodePhp7_Secret";
		const ERROR = "UserError";
		const ERROR_REGISTER = "UserErrorRegister";
		const SUCCESS = "UserSuccess";

		public function update(){

			$sql = new Sql();

			$results = $sql->select("call sp_funcionario_change_pass(:cod_func,:senha)", array(
				':cod_func'	=>	$this->getcod_func(),
				':senha'	=>	 $sql->encriptPass($this->getsenha())
			));

			$this->setData($results[0]);
			
			$_SESSION[User::SESSION] = $this->getValues();

		}

		public static function getFromSession(){

			$user = new User;

			if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[user::SESSION]['cod_func'] > 0 ){

				$user->setData($_SESSION[User::SESSION]);

			}

			return $user;

		}

		public static function login($email, $password){
			$sql = new Sql();

			$results = $sql->select("SELECT cod_func,nome_func, email_func, senha,status_func,revogado,acesso_sistema FROM tb_funcionario WHERE email_func = :email",array(':email' => $email));

			if (count($results) === 0) {
				
				throw new \Exception("Usuário ou senha inválido!");
				
			}

			$data = $results[0];

			if (password_verify($password, $data["senha"]) === true)
			{
				$user = new User();

				$user->setData($data);

				$_SESSION[User::SESSION] = $user->getValues();

				return $user;


			}else{

				throw new \Exception("Usuário ou senha inválido!");
					
			}

		}

		public static function verifyLogin($inadmin = true){
			# if the session is not define, go to login page
			if (
				!isset($_SESSION[User::SESSION])
				||
				!$_SESSION[User::SESSION]
				||
				!(int)$_SESSION[User::SESSION]["email_func"] == ''
				||
				(bool)$_SESSION[User::SESSION]["email_func"] == ''
				) {
				# send the user to login page
				header("location: /admin/login");

				# finish the proccess
				exit;
			}
		}

		public static function logOut(){

			# Clean de current session
			$_SESSION[User::SESSION] = NULL;

		}

		public static function listAll(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) ORDER BY b.desperson");
		}

		public static function getForgot($email, $inadmin = true){
			 $sql = new Sql();
			 $results = $sql->select("
				 SELECT *
				 FROM tb_persons a
				 INNER JOIN tb_users b USING(idperson)
				 WHERE a.desemail = :email;
			 ", array(
				 ":email"=>$email
			 ));
			 
			 if (count($results) === 0)
			 {
				 throw new \Exception("Não foi possível recuperar a senha.");
			 }
			 else
			 {
				 $data = $results[0];
				 $results2 = $sql->select("CALL sp_userspasswordsrecoveries_create(:iduser, :desip)", array(
					 ":iduser"=>$data['iduser'],
					 ":desip"=>$_SERVER['REMOTE_ADDR']
				 ));
				 if (count($results2) === 0)
				 {
					 throw new \Exception("Não foi possível recuperar a senha.");
				 }
				 else
				 {
					 $dataRecovery = $results2[0];
					 $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
					 $code = openssl_encrypt($dataRecovery['idrecovery'], 'aes-256-cbc', User::SECRET, 0, $iv);
					 $result = base64_encode($iv.$code);
					 if ($inadmin === true) {
						 $link = "http://www.hcodecommerce.com.br/admin/forgot/reset?code=$result";
					 } else {
						 $link = "http://www.hcodecommerce.com.br/forgot/reset?code=$result";
					 } 
					 $mailer = new Mailer($data['desemail'], $data['desperson'], "Redefinir senha da Hcode Store", "forgot", array(
						 "name"=>$data['desperson'],
						 "link"=>$link
					 )); 
					 $mailer->send();
					 return $link;
				 }
			 }
		 }

		 public static function validForgotDecrypt($result)
		 {
			 $result = base64_decode($result);
			 $code = mb_substr($result, openssl_cipher_iv_length('aes-256-cbc'), null, '8bit');
			 $iv = mb_substr($result, 0, openssl_cipher_iv_length('aes-256-cbc'), '8bit');;
			 $idrecovery = openssl_decrypt($code, 'aes-256-cbc', User::SECRET, 0, $iv);
			 $sql = new Sql();
			 $results = $sql->select("
				 SELECT *
				 FROM tb_userspasswordsrecoveries a
				 INNER JOIN tb_users b USING(iduser)
				 INNER JOIN tb_persons c USING(idperson)
				 WHERE
				 a.idrecovery = :idrecovery
				 AND
				 a.dtrecovery IS NULL
				 AND
				 DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();
			 ", array(
				 ":idrecovery"=>$idrecovery
			 ));
			 if (count($results) === 0)
			 {
				 throw new \Exception("Não foi possível recuperar a senha.");
			 }
			 else
			 {
				 return $results[0];
			 }
		 }

		 public static function setForgotUsed($idrecovery){

			$sql = new Sql;

			$sql->query("UPDATE tb_userspasswordsrecoveries SET dtrecovery = NOW() WHERE idrecovery = :idrecovery", array(
				":idrecovery"=>$idrecovery
			));
		 }

		 public function setPassword($password){

			$sql = new Sql;

			$sql->query("UPDATE tb_users SET despassword = :password WHERE iduser = :iduser", array(
				":password"=>$password,
				":iduser"=>$this->getiduser()
			));
		 }

		 public static function getAcess($userEmail){

			$sql = new Sql();

			return $sql->select("CALL sp_user_acess(:userEmail)",array(
				":userEmail"	=> $userEmail
			));
		}

		public static function setError($msg)
		{

			$_SESSION[User::ERROR] = $msg;
		
		}

		public static function getError()
		{

			$msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';

			User::clearError();

			return $msg;
			
		}

		public static function clearError()
		{
			$_SESSION[User::ERROR] = NULL;
		}

		public static function setSuccess($msg)
		{

			$_SESSION[User::SUCCESS] = $msg;
		
		}

		public static function getSuccess()
		{

			$msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';

			User::clearSuccess();

			return $msg;
			
		}

		public static function clearSuccess()
		{
			$_SESSION[User::SUCCESS] = NULL;
		}

		public static function setErrorRegister($msg)
		{
			
			$_SESSION[User::ERROR_REGISTER] = $msg;

		}
	}



 ?>
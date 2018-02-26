<?php
!defined('SQL_HOST')?define('SQL_HOST'	, 	'127.0.0.1'):'';
!defined('SQL_USER')?define('SQL_USER'	, 	'bene'):'';
!defined('SQL_PASS')?define('SQL_PASS'	, 	'root'):'';
!defined('SQL_DB')?define('SQL_DB'		, 	'example'):'';
!defined('LOG_LEVEL')?define('LOG_LEVEL'	,	0):'';

$sql = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);

class UserLib {
	/*************\
	| MYSQL INFO  |
	\*************/
	private $sql_host;
	private $sql_user;
	private $sql_pass;
	private $sql_db;
	private $sql_table;
	private $connection = null;
	
	/**************\
	|  User Info   |
	\**************/
	private $realm;
	private $user_id;
	private $user_auth_hash;
	
	function __construct($host, $user, $pass, $db, $table, $id, $realm){
		$this->sql_host = $host;
		$this->sql_user = $user;
		$this->sql_pass = $pass;
		$this->sql_db = $db;
		$this->sql_table = $table;
		$this->user_id = $id;
		$this->realm = $realm;
	}
	
	public function connect(){
		if($this->connection == null)
		{
			$this->connection = mysqli_connect($this->sql_host, $this->sql_user, $this->sql_pass, $this->sql_db);
			return $this->connection;
		}else{
			$this->disconnect();
			return $this->connect();
		}
	}
	
	public function disconnect(){
		mysqli_close($this->connection);
		$this->connection = null;
	}
	
	public function getLoginRealm(){
		return $this->realm;
	}


    public function encode($password) {
        $secret_salt = "jhkfgjkgkjzhrf4564";
        $salted_password = $secret_salt . $password;
        $password_hash = hash('sha256', $salted_password);
        return $password_hash;
    }
	public function query($query){
		return mysqli_query($this->connection, $query);
	}

	public function getUserInfo(){
		$id = $this->user_id;
		return mysqli_fetch_object($this->query("SELECT * FROM users WHERE id=$id"));
	}


    public function verifyLogin($username, $password){

        $secret_salt = "jhkfgjkgkjzhrf4564";
        $salted_password = $secret_salt . $password;
        $hashed = hash('sha256', $salted_password);


        $query = $this->query("SELECT * FROM users WHERE name LIKE '" . mysqli_real_escape_string($this->connection, $username) . "' AND password LIKE '$hashed'");
        if(mysqli_num_rows($query)>0)
        {
            return mysqli_fetch_object($query);
        }
        return false;

    }


	public function setUserId($id){
		$this->user_id = $id;
	}
}
?>
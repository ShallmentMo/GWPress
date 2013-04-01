<?php
class Session
{
	public function __construct()
	{
		session_start();
	}
	public function set($name,$value)
	{
		$_SESSION[$name]=$value;
	}
	public function get($name)
	{
		if(isset($_SESSION[$name]))
		{
			return $_SESSION[$name];
		}else{
			return false;
		}
	}
	public function del($name)
	{
		unset($_SESSION[$name]);
	}
	function destroy()
	{
		$_SESSION=array();
		session_destroy();
		session_regenerate_id();
	}
}

class Auth
{
	protected $session;
	protected $redirect;
	protected $hashKey;
	
	function __construct($redirect,$hashKey)
	{
		$this->redirect=$redirect;
		$this->session=new Session();
		$this->hashKey=$hashKey;
		$this->login();
	}
	
	private function login()
	{
		$var_login='user_login';
		$var_pass='password';
		$user_table='users';
		$user_login='user_login';
		$user_pass='user_pass';
		
		if($this->session->get('login_hash'))
		{
			$this->confirmAuth();
			return;
		}
		if(!isset($_POST[$var_login])||!isset($_POST[$var_pass]))
		{
			$this->redirect();
		}
		$password=md5($_POST[$var_pass]);
		global $db;
		$s=$db->prepare('select count(*) as num_users from users where user_login = "%1$s" and user_pass = "%2$s";',$_POST[$var_login],$password);
		$db->query($s);
		$r=$db->get_rows();
		if($r[0]['num_users']!=1)
		{
			//print_r($r);
			$this->redirect();
		}else{
			$this->storeAuth($_POST[$var_login],$password);
		}
	}
	public function storeAuth($login,$password)
	{
		$this->session->set('login_name',$login);
		$this->session->set('password',$password);
		$hashKey=md5($this->hashKey.$login.$password);
		$this->session->set('login_hash',$hashKey);
	}
	private function confirmAuth()
	{
		$login=$this->session->get('login_name');
		$password=$this->session->get('password');
		$hashKey=$this->session->get('login_hash');
		if(md5($this->hashKey.$login.$password)!=$hashKey)
		{
			$this->logout(true);
		}
	}
	public function logout()
	{
		$this->session->del('login_name');
		$this->session->del('password');
		$this->session->del('login_hash');
		$this->session->destroy();
		$this->redirect();
	}
	
	private function redirect()
	{
		header('Location: '.$this->redirect);
		exit();
	}
	
	public function get_login_name()
	{
		return $this->session->get('login_name');
	}
}

?>
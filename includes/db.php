<?php
/**
 * the DB class
 */
class DB
{
	var $prefix = '';
	var $dbh = false;
	var $tables = array();
	var $real_escape = false;
	var $result;

	/**
	 * PHP 4 style constructor
	 *
	 * @return the result of DB::__construct()
	 */
	function BPDB()
	{
		$args = func_get_args();
		register_shutdown_function( array( &$this, '__destruct' ) );
		return call_user_func_array( array( &$this, '__construct' ), $args );
	}
	
	/**
	 * PHP5 style constructor
	 *
	 * @return void
	 */
	function __construct()
	{
		$args = func_get_args();
		$args = call_user_func_array( array( &$this, '_init' ), $args );
		$this->db_connect_host( $args );
	}
	
	/**
	 * Initialize the variables
	 *
	 * @return void
	 */
	function _init( $args )
	{
		if ( !extension_loaded( 'mysql' ) ) {
			gwpress_die("MySQL extension haven't been load");
		}

		if ( 4 == func_num_args() ) {
			$args = array(
				'user' => $args,
				'password' => func_get_arg( 1 ),
				'name' => func_get_arg( 2 ),
				'host' => func_get_arg( 3 )
			);
		}

		$defaults = array(
			'user' => false,
			'password' => false,
			'name' => false,
			'host' => 'localhost',
			'charset' => false,
			'collate' => false,
			'errors' => false
		);

		$args = parse_args( $args, $defaults );
		return $args;
	}
	/**
	 * destructor
	 *
	 * @return true
	 */
	function __destruct()
	{
		return true;
	}
	
	/**
	 * connect to dbhost
	 */
	function db_connect_host( $args )
	{
		extract( $args, EXTR_SKIP );

		unset( $this->dbh );
		$this->dbh = @mysql_connect( $host, $user, $password, true );

		if ( !$this->dbh ) {
			gwpress_die('can\'t connect to database with host %1$s and $2$s',$host,$user);
		}
		mysql_query("set names utf8");
		return $this->select( $name, $this->dbh );
	}
	
	/**
	 * select a db
	 *
	 * @param db name
	 * @param db host
	 * @return bool True on success, false on failure.
	 */
	function select( $db, &$dbh )
	{
		if ( !@mysql_select_db( $db, $dbh ) ) {
			return false;
		}
		return true;
	}
	
	/**
	 * set prefix
	 *
	 * @param prefix
	 */
	function set_prefix($prefix)
	{
		$this->prefix=$prefix;
	}
	
	/**
	 * Prepares a SQL query for safe execution.  Uses sprintf()-like syntax.
	 *
	 * @param string $query Query statement with sprintf()-like placeholders
	 * @param array|mixed $args The array of variables to substitute into the query's placeholders if being called like {@link http://php.net/vsprintf vsprintf()}, or the first variable to substitute into the query's placeholders if being called like {@link http://php.net/sprintf sprintf()}.
	 * @param mixed $args,... further variables to substitute into the query's placeholders if being called like {@link http://php.net/sprintf sprintf()}.
	 * @return null|string Sanitized query string
	 */
	function prepare( $query = null )
	{
		if ( is_null( $query ) ) {
			return;
		}
		$args = func_get_args();
		array_shift( $args );
		if ( isset( $args[0] ) && is_array( $args[0] ) ) {
			$args = $args[0];
		}
		$query = str_replace( "'%s'", '%s', $query ); 
		$query = str_replace( '"%s"', '%s', $query ); 
		$query = str_replace( '%s', "'%s'", $query ); 
		//global $log;
		//$log->debug(@vsprintf( $query, $args ));
		return @vsprintf( $query, $args );
	}
	
	function query($query)
	{
		$this->result = @mysql_query( $query, $this->dbh );
	}
	
	function get_rows()
	{
		$return=array();
		while($tmp=mysql_fetch_array($this->result))
		{
			array_push($return,$tmp);
		}
		return $return;
	}
}
$db=new DB(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
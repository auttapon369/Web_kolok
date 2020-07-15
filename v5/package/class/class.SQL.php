<?php
/* --------------------------------------------------------------------------------------- MSSQL */
class sqlMS
{
	protected static $_instance;
	protected static $_where;
	protected static $_order;

	public function __construct($conn)
	{
		$connect = @mssql_connect($conn['host'], $conn['user'], $conn['pass']) or die('errorSQL');
		//mssql_select_db($this->dbname, $connect);
		self::$_instance = $connect;
	}

	public function get($table, $q = null)
	{
		$sql = ( !empty($q) ) ? $q : "SELECT * FROM ".$table.self::$_where.self::$_order;
		$res = mssql_query($sql);
		$field_count = mssql_num_rows($res);
		$field_name = array();
		$i = 0;

		while ( $i < $field_count )
		{
			$i++;
			$field_name[] = mssql_field_name($res, $i);
		}
			
		$results = array();

		while ($arr = mssql_fetch_array($res))
		{
			foreach ($field_name as $key => $val)
			{
				$arr[$key] = $val;
			}
			array_push($results, $arr);
		}

		$this->reset();

		return $results;
	}

	public function get_stored($table, $q = null)
	{
		$sp = mssql_init("KOLOK.dbo.valtime"); // stored proc name

		mssql_bind($sp, "@id", stripslashes($q[0]), SQLVARCHAR, false, false, 8);
		mssql_bind($sp, "@t", stripslashes($q[1]), SQLVARCHAR, false, false, 20);
		mssql_bind($sp, "@b1", &$wl, SQLVARCHAR, true, false, 8);
		mssql_bind($sp, "@b2", &$wl_diff, SQLVARCHAR, true, false, 8);
		mssql_bind($sp, "@b3", &$flow, SQLVARCHAR, true, false, 8);
		mssql_bind($sp, "@b4", &$capacity, SQLVARCHAR, true, false, 8);
		mssql_execute($sp);

		$results = array();
		array_push($results, $wl,$wl_diff,$flow,$capacity);
		
		return $results;
	}
	public function where($prop = null, $value = null)
	{
		$x = (!empty($prop)) ? " WHERE ".$prop." = '".$value."'" : null;
		self::$_where = $x;
	}

	public function order($value = null)
	{
		$x = (!empty($value)) ? " ORDER BY ".$value : null;
		self::$_order = $x;
	}

    protected function reset()
    {
		self::$_order = null;
		self::$_where = null;
    }
}




/* ---------------------------------------------------------------------------------------- ODBC */
class sqlODBC
{
	protected static $_instance;
	protected static $_where;
	protected static $_order;

	public function __construct($conn)
	{
		if ( !empty($conn) )
		{
			//$host = $conn['host'];
			$host = "Driver={SQL Server}; Server=".$conn['host']."; Database=".$conn['db']."";
			$connect = odbc_connect($host, $conn['user'], $conn['pass']);
			self::$_instance = $connect;
		}
		else
		{
			return;
		}
	}

	public function get($table, $q = null)
	{
		$sql = ( !empty($q) ) ? $q : "SELECT * FROM ".$table.self::$_where.self::$_order;
		//$res = odbc_exec(self::$_instance, $sql) or die('not exec'.self::$_instance);
		$res = odbc_exec(self::$_instance, $sql);
		$field_count = odbc_num_rows($res);
		$field_name = array();
		$i = 0;

		while ( $i < $field_count )
		{
			$i++;
			$field_name[] = odbc_field_name($res, $i);
		}
			
		$results = array();

		while ($arr = odbc_fetch_array($res))
		{
			foreach ($field_name as $key => $val)
			{
				$arr[$key] = $val;
			}
			array_push($results, $arr);
		}

		$this->reset();

		return $results;
	}

	public function where($prop = null, $value = null)
	{
		$x = (!empty($prop)) ? " WHERE ".$prop." = '".$value."'" : null;
		self::$_where = $x;
	}

	public function order($value = null)
	{
		$x = (!empty($value)) ? " ORDER BY ".$value : null;
		self::$_order = $x;
	}

    protected function reset()
    {
		self::$_order = null;
		self::$_where = null;
    }
}		
?>
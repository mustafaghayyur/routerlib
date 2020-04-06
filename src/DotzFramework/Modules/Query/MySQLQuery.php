<?php
namespace DotzFramework\Modules\Query;

use DotzFramework\Core\DB;
use DotzFramework\Core\Query;
use DotzFramework\Core\Dotz;

/**
 *  MySQLQuery can hold any logic that may partain more to this engine, as
 *  opposed to all DataBase engines. 
 */
class MySQLQuery extends Query {
	
	public function __construct(){
		
		parent::__construct();

		/**
		 * If you needed to instantiate a custom PDO connection, you would
		 * do the following:
		 *   
		 *   $this->connection = new \PDO($dns, $user, $pass);;
		 * 
		 * This would configure the right database to your Query module.
		 */
		
		$c = Dotz::config('composer');
		$v = (int)preg_replace('#[a-zA-Z\.]#', '', $c['dotz/framework']);

		$db = new DB();

		if($v > 21){
			$this->pdo = $db->connection;
		}else{
			$this->connection = $db->connection;
		}

	}

}
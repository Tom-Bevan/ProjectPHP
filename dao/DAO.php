<?php
namespace mvcCore\Dao;

/*
 * @author : Jean-Michel Bruneau
 * @version : 1.0
 * 
 * Data Object Access
 * 
 */

class DAO {
	
	const DEBUG = false;
	
	private static $dbtype = '';
	
	private static $dbhost = '';
	private static $dbport = '';
	private static $dbname = '';
	
	private static $dbuser = '';
	private static $dbpasswd = '';
	
	// Data source name
	private static $dsn = '';
	
	// PDO
	public static $pdo = null;

	public function __construct( $dbtype, $dbhost, $dbport, $dbname, $dbuser, $dbpasswd) {
		self::$dbtype = $dbtype;
		self::$dbhost = $dbhost;
		self::$dbport = $dbport;
		
		self::$dbname = $dbname;
		self::$dbuser = $dbuser;
		self::$dbpasswd = $dbpasswd;
		// Set DSN
		self::$dsn = self::$dbtype . ":host=" . self::$dbhost . ";port=" . self::$dbport . ";dbname=" . self::$dbname;
	}
	
	// Database connection
	private function pdo() {
		if ( self::$pdo == null) {
			try {
				self::$pdo = new \PDO(self::$dsn, self::$dbuser, self::$dbpasswd, array( \PDO::ATTR_PERSISTENT => true));
			} catch ( \PDOException $e) {
				print "Database commection error : " . $e->getMessage();
				die();
			}
		}
	}
	
	// Create ( i.e. Insert)
	// @param $table : table name
	// @param $data - array( key1 => value1, key2 => value2, …)
	public function create( $table_name, $data, $begin_transaction = true) {
		
		// Connection
		$this->pdo();
		
		// Get data keys :
		// id, lastname, firstname, email, …, return_price, total_price
		$keys = implode(", ", array_keys( $data));
		// Get value names :
		// :id, :lastname, :firtsname, :email, …, :return_price, :total_price
		$values = ':' . implode(", :", array_keys( $data));
		// ( $data['reversing_radar']) ? 'true' : 'false'
		
		// SQL query
		// e.g. INSERT INTO orders ( lastname, firstname, …) VALUES ( :lastname, :firstname, …);
		$sql = <<< _EOS_
INSERT INTO $table_name
	( $keys) VALUES ( $values);
_EOS_;
		if ( self::DEBUG) var_dump( 'INSERT =>', $sql, $data);
		// Prepare and execute INSERT statement
		$id = null;
		try {
			// Start transaction
			if( $begin_transaction) self::$pdo->beginTransaction();
			// Prepare and execute insert
			$pst = self::$pdo->prepare( $sql);
			$pst->execute( $data);
			// Commit transaction
			if ( $begin_transaction) self::$pdo->commit();
			// Get the result
			$id = self::$pdo->lastInsertId();
		} catch( \PDOException $e) {
			// Rollback on error
			if ( self::$pdo->inTransaction())
				self::$pdo->rollBack();
				throw new \UnexpectedValueException( 'DAO SQL Persit Exception : ', $e->getMessage());
		}
		// Last insert id
		return $id;
	}
	
	// Read ( i.e. Select)
	// @param $table : table name
	// @param $data - array( key1 => value1, key2 => value2, …)
	public function read( $table_name, $object_class, $id = null, $limit = 0, $offset = 0) {
		
		// Connection
		$this->pdo();
		
		// SQL query
		// e.g. SELECT * FROM orders WHERE id = :id;
		if ( empty( $id)) {
			$sql = <<< _EOS_
SELECT *
	FROM $table_name;
_EOS_;
			$data = array();
		} else {
			$sql = <<< _EOS_
SELECT *
	FROM $table_name
	WHERE id = :id;
_EOS_;
			$data = array( 'id' => $id);
		}
		if ( self::DEBUG) var_dump( 'SELECT =>', $sql, $data);
		// Prepare and execute statement
		try {
			$pst = self::$pdo->prepare( $sql);
			$pst->execute( $data);
			// Fetch all find object
			$results = $pst->fetchAll( \PDO::FETCH_CLASS, $object_class);
		} catch( \PDOException $e) {
			throw new \UnexpectedValueException( 'DAO SQL Read Exception : ', $e->getMessage());
		}
		if ( self::DEBUG) var_dump( $results);
		return $results;
	}
	
	// Update
	// @param $table_name : table name
	// @param $object_class : object name
	// @param $id : object id
	public function update( $table_name, $data, $id, $begin_transaction  = true) {
		// Connection
		$this->pdo();
		
		// Get data keys :
		// id, lastname, firstname, email, …, return_price, total_price
		$set = [];
		foreach ( array_keys( $data) as $key) {
			$set[] = "$key = :$key";
		}
		
		// Get value names :
		// :id, :lastname, :firtsname, :email, …, :return_price, :total_price
		$keys_values = implode( ', ', $set);
		
		// SQL query
		// e.g. SELECT * FROM orders WHERE id = :id;
		$sql = <<< _EOS_
UPDATE $table_name
	SET $keys_values
	WHERE id = :id;
_EOS_;
		// Add the id value to the data
		$data['id'] = $id;
		if ( self::DEBUG) var_dump( 'UPDATE =>', $sql, $data);
		// Prepare and execute statement
		$result = false;
		try {
			// Start transaction
			if ( $begin_transaction) self::$pdo->beginTransaction();
			// Prepare and execute update
			$pst = self::$pdo->prepare( $sql);
			$pst->execute( $data);
			// Commit transaction
			if ( $begin_transaction) self::$pdo->commit();
			// Get the result
			$result = ( $pst->rowCount() == 1) ? true : false;
		} catch( \PDOException $e) {
			// Rollback on error
			if ( self::$pdo->beginTransaction())
				self::$pdo->rollBack();
				throw new \UnexpectedValueException( 'DAO Update SQL Exception : ', $e->getMessage());
		}
		if ( self::DEBUG) var_dump( $result);
		return $result;
	}
	
	// Delete
	// @param $table_name : table name
	// @param $id : object id
	public function delete( $table_name, $id, $begin_transaction = true) {
		
		// Connection
		$this->pdo();
		
		// SQL query
		// e.g. DELETE FROM orders WHERE id = :id;
		$sql = <<< _EOS_
DELETE
	FROM $table_name
	WHERE id = :id;
_EOS_;
		$data = array( 'id' => $id);
		if ( self::DEBUG) var_dump( 'DELETE =>', $sql, $data);
		// Prepare and execute statement
		$result = false;
		try {
			// Start transaction
			if ( $begin_transaction) self::$pdo->beginTransaction();
			// Prepare and execute delete
			$pst = self::$pdo->prepare( $sql);
			$pst->execute( $data);
			// Commit transaction
			if ( $begin_transaction) self::$pdo->commit();
			// Get the result
			$result = ( $pst->rowCount() == 1) ? true : false;
		} catch( \PDOException $e) {
			// Roolback on error
			if ( self::$pdo->inTransaction())
				self::$pdo->rollBack();
				throw new \UnexpectedValueException( 'DAO SQL Exception : ', $e->getMessage());
		}
		return $result;
	}
	
	// Close database connection
	public function __destruct() {
		self::$pdo = null;
	}
	
}


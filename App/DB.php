<?php

namespace Korona;

class DB {
	public static $con = null;

	public static function getDB()
	{
		if(self::$con == null) {
			
			$db_host = "localhost";
			$db_user = "root";
			$db_password = "";
			$db_name = "korona";
			try{
				self::$con = new \PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
				self::$con->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
				self::$con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}catch(Exception $e){
				echo $e->getMessage();
			}

		}

		return self::$con;
	}

	public static function fetchAll($sql, $param=[])
	{
		$con = self::getDB();
		$q = $con->prepare($sql);
		$q->execute($param);
		return $q->fetchAll(\PDO::FETCH_OBJ);
	}

	public static function fetch($sql, $param = [])
	{
		$con = self::getDB();
		$q = $con->prepare($sql);
		$q->execute($param);
		return $q->fetch(\PDO::FETCH_OBJ);
	}

	public static function query($sql, $param = [])
	{
		$con = self::getDB();
		$q = $con->prepare($sql);
		return $q->execute($param);
	}

	public static function msgAndGo($msg, $link)
	{
		echo "<script>";
		echo "alert('$msg');";
		echo "location.href = '$link';";
		echo "</script>";
	}

	public static function msgAndBack($msg)
	{
		echo "<script>";
		echo "alert('$msg');";
		echo "history.back();";
		echo "</script>";
	}

	public static function lastId()
	{
		$con = self::getDB();
		return $con->lastInsertId();
	}

	public static function goBack() {
		echo "<script>";
		echo "history.back();";
		echo "</script>";
	}

	public static function goPage($link) {
		echo "<script>";
		echo "location.href = '$link';";
		echo "</script>";
	
	}

}
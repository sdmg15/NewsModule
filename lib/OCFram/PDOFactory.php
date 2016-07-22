<?php
Namespace OCFram;
/**
 ** @ClassName PDOFactory
 ** @ClassInfo this class is the factory(pattern factory)
 ** @Author Sonkeng Donfack Maldini (SDM)
 ** @Authored 9 sep 2015
 **/

 class PDOFactory 
 {
	 public static function getPdoInstance()
	 {
		 $object = new \PDO('mysql:host=localhost;dbname=poo;charset=utf8','root','');
		 $object->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		 return  $object;
	 }
	 
 }
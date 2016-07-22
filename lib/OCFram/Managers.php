<?php 
Namespace OCFram;
/**
 * @ClassName Managers
 * @ClassInfo this class handler all managers
 * @Author Sonkend Donfack Maldini (SDM)
 * @Authored 9 sep 2015
 */
 
 class Managers 
 {
	 protected $api='',
			   $dao='',
			   $managers = [];
	 
	 public function __construct($api, $dao)
	 {

		 
		 $this->setDao($dao);
		 $this->setApi($api);
	 }
	 
	 public function setApi($api)
	 {
		 if(is_string($api) || !empty($api))
		 {
			 $this->api = $api;
		 }
	 }
	 
	 public function setDao($dao)
	 {
		 $this->dao = $dao;
	 }
	 
	 public function getManagerOf($module)
	 {
		 if(empty($module) || !is_string($module))
		 {
			 throw new \InvalidArgumentException('la module est inconnu');
		 }
		 
		 if(!isset($this->managers[$module]))
		 {
			 $manager = '\\Model\\'.$module.'Manager'.$this->api;
			 $this->managers[$module] = new $manager($this->dao);
		 }
		 
		 return $this->managers[$module];
	 }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
 }
 
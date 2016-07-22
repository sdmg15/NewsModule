<?php
Namespace OCFram; 
/** 
 * @ClassName  Manager
 * @ClassInfo content the DAO which is instanciated during the execution of the script 
 * @Author Sonkeng Donfack Maldini (SDM)
 * @Authored 9 sep 2015
 */
 
abstract class Manager
{
	protected $dao;
	
	public function __construct($dao)
	{
		$this->dao = $dao;
	}
	
	public function getDao()//this is facultative we can pass this.
	{
		return $this->dao;
	}
}
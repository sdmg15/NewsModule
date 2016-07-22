<?php 
namespace OCFram;

/************************************************
 * @Author : Sonkeng Donfack Maldini  (SDM)
 * @Date : 7 sep 2015
 * @ClassName :  ApplicationComponent 
 * @ClassInfo :this class represent components of the application | just has the object of the application which is instanciated.
 * @see : App >
 ************************************************/

abstract  class ApplicationComponent 
{
	protected $app;
	
	public function __construct(Application $app)
	{
		$this->app = $app;
	}
	
	public function getApp()
	{
		return $this->app; 
	}
}
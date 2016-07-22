<?php 
namespace OCFram;

/************************************************
 * @Author : Sonkeng Donfack Maldini  (SDM)
 * @Date : 6 sep 2015
 * @ClassName :  HTTPRequest 
 * @ClassInfo : this class represent requests of customers and extends the application component class and contents in the NS OCFram.
 * @see : _POST, _GET, & _COOKIE 
 ************************************************/

class HTTPRequest extends ApplicationComponent
{
	public function getExists($get)
	{
		return !empty($_GET[$get]);
	}
	
	public function getData($get)
	{
		return isset($_GET[$get])? $_GET[$get]: null;
	}
	
	public function postExists($post)
	{
		return isset($_POST[$post]);
	}
	
	public function postData($post)
	{
		return isset($_POST[$post])? $_POST[$post]: null;
	}
	
	public function cookieData($data)
	{
		return isset($_COOKIE[$data])?$_COOKIE[$data]: null;
	}
	
	public function cookieExists($data)
	{
		return isset($_COOKIE[$data]);
	}
	
	public function requestURI()
	{
		return $_SERVER['REQUEST_URI'];
	}
	
	public function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
}




















<?php 
Namespace OCFram;
/**
 * @ClassName User it's an application component because we need the the object of the App which is running
 * @ClassInfo see top
 * @Author Sonkeng Donfack Maldini (SDM)
 * @Authored 8 sep 2015
 */
 session_start();
 
class User extends ApplicationComponent
{
	public function hasFlash()
	{
		return isset($_SESSION['flash']);
	}
	
	public function isAuthenticated()
	{
		if(isset($_SESSION['auth']) && $_SESSION['auth'] === true)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public function setAuthenticated($auth = true)
	{
		if(!is_bool($auth))
		{
			throw new \invalidArgumentException('Le type doit être bool');
		}
		$_SESSION['auth'] = $auth;
	}
	
	public function getFlash()
	{
		$flash = $_SESSION['flash'];
		unset($_SESSION['flash']);
		
		return $flash;
	}
	
	public function setFlash($flash)
	{
		return $_SESSION['flash'] = $flash;
	}
	
	public function setAttribute($attr, $val)
	{
		$_SESSION[$attr] = $val;
	}
		
	public function getAttribute($atrr)
	{
		return isset($_SESSION[$atrr])?$_SESSION[$atrr]: null;
	}
} 
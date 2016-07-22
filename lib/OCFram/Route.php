<?php
Namespace OCFram;

class Route 
{
	protected $url,	
			  $module,
			  $action,
			  $vars = [],
			  $varsNames;
			  
	public function __construct($url,$module,$action,array $varsNames)
	{
		$this->setUrl($url);
		$this->setModule($module);
		$this->setAction($action);
		$this->setVarsNames($varsNames);
	}
	
	public function setUrl($url)
	{
		if(!is_string($url)|| empty($url))
		{
				throw new \Exception('url '.$url.' est invalide');
		}
		
		$this->url = $url;
	}
	
	public function setAction($action)
	{
		if(!is_string($action) || empty($action))
		{
			throw new \InvalidArgumentexception('action '.$action.' ivalide');
		}
		
		$this->action = $action;
	}
	
	
	public function setModule($module)
	{
		if(!is_string($module) || empty($module))
		{
			THROW NEW \RuntimeException('le module spécifié '.$module.' invalide');
		}
		$this->module = $module;
	}
	
	
	public function setVarsNames(array $varsNames)
	{
		$this->varsNames = $varsNames;
	}
	
	public function setVars(array $vars)
	{
		$this->vars = $vars;
	}
	
	public function getModule()
	{
		return $this->module;
	}
	
	public function getAction()
	{
		return $this->action;
	}
	
	public function getVars()
	{
		return $this->vars;
	}
	
	public function getVarsNames()
	{
		return $this->varsNames;
	}
	
	public function hasVars()
	{
		return !empty($this->varsNames);
	}
	
	public function match($url)
	{
		if(preg_match('#^'.$this->url.'$#i',$url,$match))
		{
		
			return $match;
		}
		else 
		{
			return false;
		}
	}
	
}
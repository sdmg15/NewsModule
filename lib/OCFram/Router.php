<?php 
namespace OCFram;

/************************************************
 * @Author : Sonkeng Donfack Maldini  (SDM)
 * @Date : 7 sep 2015
 * @ClassName :  	Router 
 * @ClassInfo : none dependence.
 * @see : -------------------
 ************************************************/
 
 class Router 
 {
	 protected $routes = [];
	 
	 const NO_ROUTE = 1;
	 
	 public function addRoute(Route $route)
	 {
		 if(!in_array($route,$this->routes))
		 {
			 $this->routes[] = $route;
		 }
	 }
	 
	 public function getRoute($url)
	 {
		foreach($this->routes as $route) 
		{
			if(($valeursVariables = $route->match($url)) !== false)
			{
				
				if($route->hasVars())
				{
					$variables = $route->getVarsNames(); // id,slug
					$listVars = [];
					
					//On récupère les valeurs renvoyées par la regex.
					foreach($valeursVariables as $cle => $valeurs)
					{
						if($cle !== 0)
						{
							$listVars[$variables[$cle - 1]] = $valeurs;
						}
				
					}
					
					$route->setVars($listVars);
				}
				
				return $route;
			}
		}
		throw new \RuntimeException('La route correspondante à l\'url n\'a pas été trouvé.',self::NO_ROUTE);
	 }
	 
 }
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
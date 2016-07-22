<?php 
namespace OCFram;

/************************************************
 * @Author : Sonkeng Donfack Maldini  (SDM)
 * @Date : 7 sep 2015
 * @ClassName :  Application
 * @ClassInfo :this class is the main application class so all application will entended this.
 * @see : ------
 ************************************************/

abstract class Application 
{
	protected $httpRequest,
			  $httpResponse,
			  $page,
			  $user,
			  $config,
			  $nom;
			  
	public function __construct()
	{
		$this->httpRequest = new HTTPRequest($this);
		$this->httpResponse = new HTTPResponse($this);
		
		$this->page = new Page($this);
		$this->config = new Config($this);
		$this->user = new User($this);
		$this->nom = ' ' ;
	}
	
	//getters 
	
	public function getPage()
	{
		return $this->page;
	}
	
	public function getConfig()
	{
		return $this->config;
	}
	
	public function getUser()
	{
		return $this->user;
	}
	
	public function getNom()
	{
		return $this->nom;
	}
	
	public function httpRequest()
	{
		return $this->httpRequest;
	}
	
	public function httpResponse()
	{
		return $this->httpResponse;
	}
//end of getters...
	
//this method each applications will implement his own.

abstract public function run();

//La méthode getController: permet d'obtenir le controlleur de l'application qui est cours d'execution tout en ouvrant sono configFile.
//Et d'autres opérations très complexes.

public function getController()
{
	$router = new Router;
	
	$xml = new \DOMDocument;
	$xml->load(__DIR__.'/../../App/'.$this->nom.'/Config/routes.xml');
	
	$routes = $xml->getElementsByTagName('route'); //liste de toutes les routes présente dans le fichier de conf.
	
	foreach($routes as $route)
	{
		$vars = [];
		
		if($route->hasAttribute('vars'))
		{
			$vars = explode(',',$route->getAttribute('vars'));//transformation des vars='var1,var2' en tableau 
		}
		
		//on peut maintenant ajouter la route/les routes au router.
		
		$router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'),$vars));
	}
		//Maintenant on test voir si une URI peut correspondre a la liste des routes dans notre router.
		try 
		{
			$routeTrouvee = $router->getRoute($this->httpRequest->requestURI());
		}
		catch(\RuntimeException $e)
		{
			if($e->getCode() == Router::NO_ROUTE)
			{
				$this->httpResponse->redirect404();
			}
		}
		
		//Maintenant on lie les variables au _GET.
		
		$_GET = array_merge($_GET,$routeTrouvee->getVars());
		//On peut donc call le controlleur correspondant!!!!
		
		$controlleurClass = '\\App\\'.$this->nom.'\\Modules\\'.$routeTrouvee->getModule().'\\'.$routeTrouvee->getModule().'Controller';
		($routeTrouvee);
		return new $controlleurClass($this,$routeTrouvee->getModule(),$routeTrouvee->getAction());
	
}
	
	
	
	
	
	
	
	
	
	
	
	
	
}
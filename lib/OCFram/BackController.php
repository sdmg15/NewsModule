<?php 
Namespace OCFram;
/**
 * @ClassName BackController 
 * @ClassInfo The base backcontroller of our Application. it will extended the application component class. 
 * @Author Sonkeng Donfack Maldini (SDM)
 * @Authored 8 sep 2015
 */
 
abstract Class BackController extends ApplicationComponent
 {
	 protected $module = '',
			   $action = '' ,
			   $view = '',
			   $page = null,
			   $manager;
			   
	public function __construct(Application $app, $module,$action)
	{
		parent::__construct($app);
		
		$this->setModule($module);
		
		$this->page = new Page($app);
		
		$this->setAction($action);
		
		
		$this->manager = new Managers('PDO',PDOFactory::getPdoInstance());
		//the view and action had same values ..
		
		
		$this->setView($action);
		
	}
	
	//Les setters correspondants 
	
	public function setAction($action)
	{
		if(is_string($action))
		{
			$this->action = $action;
		}
	}
	
	public function setModule($mod)
	{
		if(is_string($mod))
		{
			$this->module = $mod;
		}
	}
	
	public function setView($action)
	{
		if(is_string($action))
		{
			$this->view = $action;
		}
		
		//dès qu'on modifie la vue alors on notifie la page
		
		$this->page->setContentFile(__DIR__.'/../../App/'.$this->app->getNom().'/Modules/'.$this->module.'/Views/'.$this->view.'.php');

	}
	
	//la méthode qui suit permet d'obtenir un e vue en fonction de l'action 
	
	public function execute()
	{
		$methode = 'execute'.ucfirst($this->action);
		
		if(is_callable([$this,$methode]))
		{
			$this->$methode($this->app->httpRequest());
		}
		else 
		{
			throw new \RuntimeException('l\'action à exécuté n\'est pas définie.');
		}
	}
public function getPage()
 {
	 return $this->page;
 }
			  
 }
 
 //the only getter ...
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
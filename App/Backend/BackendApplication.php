<?php 
Namespace App\Backend;

use \OCFram\Application;

/**
 * @ClassName BackendApplication
 * @ClassInfo class du backend contient la partie invisible de l'iceberg
 * @
 */
 
Class BackendApplication extends Application
{
	public function __construct()
	{
		parent::__construct();
		
		$this->nom='Backend';
	}
	
	public function run()
	{
		//vérification si l'user est authentifié avant d'instancier le controlleur.
		
		if($this->getUser()->isAuthenticated())
		{
			$controlleurClass = $this->getController();
			
		}
		else 
		{
			$controlleurClass = new Modules\Connexion\ConnexionController($this,'connexion','index');
		}
		
		$controlleurClass->execute();
		
		$this->httpResponse->setPage($controlleurClass->getPage());
		$this->httpResponse->send();
	}
}



















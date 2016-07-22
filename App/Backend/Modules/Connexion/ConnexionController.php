<?php 
Namespace App\Backend\Modules\Connexion;

use \OCFram\BackController;

use \OCFram\HTTPRequest;

class ConnexionController extends BackController
{
	public function executeIndex(HTTPRequest $request)
	{
		$this->page->addVar('title','Connexion à la page d\'administration');
		if($request->postExists('login'))
		{
			$default_pass =  $this->app->getConfig()->get('pass');
			$default_login =  $this->app->getConfig()->get('login');
			
			if($request->postData('login') == $default_login && $request->postData('mdp') == $default_pass)
			{
				$this->app->getUser()->setAuthenticated(true);
				
				$this->app->httpResponse()->redirect('.');
			}
			else 
			{
				$this->app->getUser()->setFlash('Les indentifiants sont incorrect.');
			}
		}
	}
}
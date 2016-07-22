<?php
Namespace OCFram; 


class Config extends ApplicationComponent
{
	protected $vars = []; //typeof array
	
	
	public function get($variable)
	{
		if(!$this->vars)
		{
			
			$xml = new \DOMDocument;
			$xml->load(__DIR__.'/../../App/'.$this->app->getNom().'/Config/app.xml');
			$confs = $xml->getElementsByTagName('define');
			
			foreach($confs as $conf)
			{
				$this->vars[$conf->getAttribute('var')] = $conf->getAttribute('value');
			}
		}
		
		if(isset($this->vars[$variable]))
		{
			return $this->vars[$variable];
		}
		else 
		{
			return null;                                 
		}
	}
}
 
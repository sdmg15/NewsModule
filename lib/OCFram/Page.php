<?php 
Namespace OCFram;
/**
 * @Author Sonkeng Donfack Maldini G (SDMG)
 * @Authored 8 sep 2015
 * @ClassInfo  this class represent a page with the content generated to the view by the controller
 * @Class Name Page 
 */
 
 Class Page extends ApplicationComponent
 {
	 protected $variables = []; // tableau de varibales qui seront transmises à la vue par le controller
	 protected $contentFile; // est le fichier transmis 
	 
	 public function addVar($valeur , $content)
	 {
		 if(!is_string($valeur) || is_numeric($valeur) || empty($valeur))
		 {
			 throw new \InvalidArgumentException('Ajoutez un bon type de variables à la vue.');
		 }
		 
		 $this->variables[$valeur] = $content; 
	 }
	 
	 
	 public function setContentFile($fichier)
	 {
		 if(!file_exists($fichier))
		 {
			 throw new \InvalidArgumentException('la page est introuvable.'.$fichier);
		 }
		 
		 
		 $this->contentFile = $fichier;
	 }
	 
	 public function getContentFile()
	 {
		 return $this->contentFile;
	 }
	 
	 public function getGeneratedPage()
	 {
		 $user = $this->app->getUser();	 //variable contenant les infos about l'user 
		 
		 extract($this->variables);
		
		 
		 ob_start();
			
		require $this->contentFile;
		 
		 $content = ob_get_clean();
		 
		 ob_start();
		 //on inclut le layout correspondant à l'application.
		 require __DIR__.'/../../App/'.$this->app->getNom().'/Templates/layout.php';
		 
		 return ob_get_clean();
	 }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
 }
<?php 
Namespace Entity;

use \OCFram\Entity;


class Comment extends Entity
{
	protected $newsId,
	
			  $auteur,
			  
			  $contenu,

			  $dateAjout,
			  $dateModif;
			  
			  
	const CONTENU_INVALIDE =1,
		  AUTEUR_INVALIDE = 2;
		  
	public function __construct(array $data=[])
	{
		parent::__construct($data);
	}
	
	public function setNewsId($id)
	{
		$this->newsId = (int)$id;
	}
	
	public function isValid()
	{
		return !(empty($this->auteur) || empty($this->contenu));
	}
	
	public function setAuteur($auteur)
	{
		if(!is_string($auteur) || empty($auteur))
		{
			$this->erreurs[] = self::AUTEUR_INVALIDE;
		}
		$this->auteur = $auteur;
		
	}
	
	public function setContenu($contenu)
	{
		if(!is_string($contenu) || empty($contenu))
		{
			$this->erreurs[] = self::CONTENU_INVALIDE;
		}
		$this->contenu = $contenu;
	}
	
	public function setDateAjout(\DateTime $date)
	{
		$this->dateAjout = $date;
	}
	
	public function setDateModif(\DateTime $date)
	{
		$this->dateModif = $date;
	}
	public function getNewsId()
	{
		return $this->newsId;
	}
	
	public function getAuteur()
	{
		return $this->auteur;
	}
	
	public function getContenu()
	{
		return $this->contenu;
	}
	public function getDateAjout()
	{
		return $this->dateAjout;
	}
	
	public function getErreurs()
	{
		return $this->erreurs;
	}

	public function getDateModif()
	{
		return $this->dateModif;
	}
	
}
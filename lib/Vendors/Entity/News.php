<?php 
Namespace Entity;

use \OCFram\Entity;
use \OCFram\CodeParser;

class News extends Entity
{
	protected $titre,
			  $auteur,
			  $contenu,
			  $dateAjout,
			  $dateModif,
			  $nombreComment,
			  $vues;
	const AUTEUR_INVALIDE = 1,
		 CONTENU_INVALIDE =2,
		 TITRE_INVALIDE = 3;
	
	public function __construct(array $data=[])
	{
		parent::__construct($data);
	}
	
	static public function parser($value)
	{
		$value = preg_replace('#\[b\](.+)\[/b\]#','<span style="color: red;">$1</span>',$value);
	}
	
	//les setters 
	
	public function setTitre($titre)
	{
		if(!is_string($titre) || empty($titre))
		{
			$this->erreurs[] = self::TITRE_INVALIDE;
		}
		$this->titre = $titre;
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
	
	public function setDateAjout(\DateTime $data)
	{
		$this->dateAjout = $data;
	}
	
	public function setDateModif(\DateTime $date)
	{
		$this->dateModif = $date;
	}
	
	public function augmenterVues()
	{
		return $this->vues +=1;;
	}
	
	public function setNombreComment($nombrComment)
	{
		$this->nombreComment = (int) $nombrComment;
	}
	
	
	//les getters 
	
	public function getAuteur()
	{
		return $this->auteur;
	}
	
	public function getVues()
	{
		return $this->vues;
	}
	public function getTitre()
	{
		return $this->titre;
	}
	
	public function getContenu()
	{
		return $this->contenu;
	}

	public function dateAjout()
	{
		return $this->dateAjout;
		
	}
	
	public function dateModif()
	{
		return $this->dateModif;
	}
	
	public function getErreurs()
	{
		return $this->erreurs;
	}
	
	public function getNbrComment()
	{
		return $this->nombreComment;
	}
	
	public function isValid()
	{
		return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
	}
}











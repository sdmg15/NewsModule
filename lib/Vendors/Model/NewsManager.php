<?php
Namespace Model;

use \OCFram\Manager;
use \Entity\News;

/*
 * class abstraite contenant toutes
 * les méthodes à implémenté par chaque API
 */

 abstract class NewsManager extends Manager
 {
	 /* Méthode qui permet d'obtenir la liste de toutes les news*/

	 abstract public function getList($debut=-1,$limit=-1);

	/* méthode qui permet d'obtenir une news spécifique*/

	abstract public function getUnique($info);

	//compter et retourne le nombre d'entrée en BD.

	abstract public function count();

	//méthode qui supprime une News

	abstract public function deleteNews($id);

	//ajout

	abstract public function addNews(News $news);

	//la modification
	
	abstract public function updateNews(News $news);

	//method check whether the news id exists
	abstract public function exists($id);

	//this method update view each time we open the view show.
	abstract public function vueUpdate($vue,$id);
	public function save(News $news)
	{
		if($news->isValid())
		{
			$news->isNew()? $this->addNews($news) : $this->updateNews($news);
		}
	}
 }

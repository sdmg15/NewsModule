<?php 
Namespace Model;

use \Entity\News;
use \Michelf\Markdown;

//cette class se passe de commentaires.

class NewsManagerPDO  extends  NewsManager 
{
	public function getList($debut=-1,$limit=-1)
	{
		$req ='SELECT * FROM news ORDER BY dateAjout,id DESC';
		
		if($debut != -1 || $limit != -1)
		{
			$req.= ' LIMIT '.(int)$debut.','.(int)$limit;
		}
		
		$reponse = $this->dao->query($req);
		
		$reponse->setFetchMode(\PDO::FETCH_CLASS, '\Entity\News');
		
		$liste = $reponse->fetchAll();
		
		foreach($liste as $news)
		{
			$news->setDateAjout(new \DateTime($news->dateAjout(), new \DateTimeZone('Africa/Douala')));
			$news->setDateModif(new \DateTime($news->dateModif(), new \DateTimeZone('Africa/Douala')));
						
			$news->setNombreComment($this->commentCount((int)$news->getId()));
		}
		
		$reponse->closeCursor();
		return $liste;
		
		
	}
	
	public function getUnique($id)
	{
		$req = $this->dao->prepare('SELECT * FROM news WHERE id=:id');
		$req->bindValue(':id',(int)$id,\PDO::PARAM_INT);
		$req->execute();
		$req->setFetchMode(\PDO::FETCH_CLASS, '\Entity\News');
		if($this->exists($id))
		{
			if($news = $req->fetch())
			{	
				$news->setDateAjout(new \DateTime($news->dateAjout(), new \DateTimeZone('Africa/Douala')));
				$news->setDateModif(new \DateTime($news->dateModif(), new \DateTimeZone('Africa/Douala')));
				//le nombre de vue de chaque la news.
				
				$news->augmenterVues();
				$this->vueUpdate($news->getVues(),$id);
				return $news;
			}
		
		}
		
	}
	
	public function count()
	{
		return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
	}
	
	public function deleteNews($id)
	{
		$this->dao->exec('DELETE FROM news WHERE id='.(int)$id);
	}
	
	public function addNews(News $news)
	{
		$req = $this->dao->prepare('INSERT INTO news SET auteur=:auteur,titre=:titre,contenu=:contenu , dateAjout=NOW(), dateModif=NOW()');
		$req->bindValue(':auteur',$news->getAuteur());
		$req->bindValue(':titre',$news->getTitre());
		$req->bindValue(':contenu',$news->getContenu());
		$req->execute();
	}
	
	public function UpdateNews(News $news)
	{
		$req = $this->dao->prepare('UPDATE news SET auteur=:auteur,titre=:titre,contenu=:contenu,dateModif=NOW() WHERE id=:id');
		$req->bindValue(':auteur',$news->getAuteur());
		$req->bindValue(':titre',$news->getTitre());
		$req->bindValue(':contenu',$news->getContenu());
		$req->bindValue(':id',$news->getId());
		
		$req->execute();
	}
	
	public function commentCount($id)
	{
		return $this->dao->query('SELECT COUNT(*) FROM comments WHERE newsId='.(int) $id)->fetchColumn();
	}
	
	public function vueUpdate($vue,$id)
	{
		$req = $this->dao->prepare('UPDATE news SET vues=:vue WHERE id=:id');
		$req->bindValue(':vue',$vue,\PDO::PARAM_INT);
		$req->bindValue(':id',$id,\PDO::PARAM_INT);
		$req->execute();
	}
	
	public function exists($id)
	{
		return (bool) $this->dao->query('SELECT * FROM news WHERE id ='.(int)$id)->fetchColumn();
	}
}














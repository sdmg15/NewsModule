<?php 
Namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{
	
	public function getCommentsOf($newsId)
	{
		$req = $this->dao->prepare('SELECT * FROM comments  WHERE newsId=:id');
		
		$req->bindValue(':id',(int) $newsId,\PDO::PARAM_INT);
		
		$req->execute();
		
		$req->setFetchMode(\PDO::FETCH_CLASS,'\Entity\Comment');
		
		$comment = $req->fetchAll();
		
		foreach($comment as $comments)
		{
			$comments->setDateAjout(new \DateTime($comments->getDateAjout(),new \DateTimeZone('Africa/Douala')));
			$comments->setDateModif(new \DateTime($comments->getDateModif(),new \DateTimeZone('Africa/Douala')));
		}
		
		return $comment;
	}
	
	
	public function addComment(Comment $comment)
	{
		$req = $this->dao->prepare('INSERT INTO comments SET auteur=:auteur,contenu=:contenu,newsId=:id,dateAjout=NOW(),dateModif=NOW()');
		$req->bindValue(':auteur',$comment->getAuteur());
		$req->bindValue(':contenu',$comment->getContenu());
		$req->bindValue(':id',(int) $comment->getNewsId(), \PDO::PARAM_INT);

		$req->execute();
		$comment->setId($this->dao->lastInsertId());
	}
	
	public function updateComment(Comment $comment)
	{
		$req = $this->dao->prepare('UPDATE comments SET auteur=:auteur,contenu=:contenu,dateModif=NOW() WHERE id=:id');
		$req->bindValue(':auteur',$comment->getAuteur());
		$req->bindValue(':contenu',$comment->getContenu());
		$req->bindValue(':id',$comment->getId(),\PDO::PARAM_INT);
		$req->execute();
	
	}
	
	public function getUniqueComment($id)
	{
		$req = $this->dao->prepare('SELECT * FROM comments WHERE id=:id');
		$req->bindValue(':id',(int)$id, \PDO::PARAM_INT);
		
		$req->execute();
		
		$req->setFetchMode(\PDO::FETCH_CLASS, '\Entity\Comment');
		$unique = $req->fetch();
		
		return $unique;
	}
	
	public function deleteComment($id)
	{
		$this->dao->exec('DELETE FROM comments WHERE id='.(int)$id);
	}
	
	public function countComment($id)
	{
		return $this->dao->query('SELECT COUNT(comments.id) AS nbr FROM comments INNER JOIN news ON news.id = comments.newsId WHERE comments.newsId='.$id)->fetchColumn();
	}
}























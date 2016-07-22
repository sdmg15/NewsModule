<?php 
Namespace Model;

use \OCFram\Manager;
use \Entity\Comment;


abstract class CommentsManager extends Manager
{
	//fonction qui permet de recupérer la liste de commentaires d'une news
	
	abstract public function getCommentsOf($newsId);

	//méthode qui vérifi si la news est nouvelle ou pas pour insérer ou modifier.
	
	public function save(Comment $data)
	{
		if($data->isValid())
		{
			$data->isNew()? $this->addComment($data): $this->updateComment($data);
		}
	}

abstract public function addComment(Comment $data);

abstract public function updateComment(Comment $comment);	

abstract public function getUniqueComment($id);

abstract public function deleteComment($id);
}
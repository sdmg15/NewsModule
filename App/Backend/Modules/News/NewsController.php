<?php
Namespace App\Backend\Modules\News;

use \OCFram\BackController;
use  \OCFram\HTTPRequest;
use \Entity\News;
use \Entity\Comment;

class NewsController extends BackController
{
	//l'action index 
	
	public function executeIndex(HTTPRequest $request)
	{
		$manager = $this->manager->getManagerOf('News');
		
		$this->page->addVar('title','Administration des news');
		$this->page->addVar('nombreNews', $manager->count());
		$this->page->addVar('listNews',$manager->getList());
	}
	
	//l'action de suppression 
	
	public function executeDeleteNews(HTTPRequest $request)
	{
		$this->manager->getManagerOf('News')->deleteNews($request->getData('id'));
		$this->app->getUser()->setFlash('La news à été bien supprimée.');
		$this->app->httpResponse()->redirect('.');
	}
	//l'action de modification d'une news 
	public function executeInsertNews(HTTPRequest $request)
  {
	  if($request->postExists('auteur'))
	  {
      $this->processForm($request);
	  }
    
    $this->page->addVar('title', 'Ajout d\'une news');
  }

  public function processForm(HTTPRequest $request)
  {
    $news = new News([
      'auteur' => $request->postData('auteur'),
      'titre' => $request->postData('titre'),
      'contenu' => $request->postData('contenu')
    ]);
    // L'identifiant de la news est transmis si on veut la modifier.
	
    if ($request->postExists('id'))
    {
      $news->setId($request->postData('id'));
    }
    if ($news->isValid())
    {
      $this->manager->getManagerOf('News')->save($news);
      $this->app->getUser()->setFlash($news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !');
	  $this->app->httpResponse()->redirect('/admin/');
    }
    else
    {
      $this->page->addVar('erreurs', $news->getErreurs());
    }
    $this->page->addVar('news', $news);
  }

  //les actions parlent d'elles mêmes 
  
 public function executeUpdateNews(HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }

    else
    {
      $this->page->addVar('news', $this->manager->getManagerOf('News')->getUnique($request->getData('id')));
    }
    $this->page->addVar('title', 'Modification d\'une news');
  }
  
  
  public function executeUpdateComment(HTTPRequest $request)
  {
	  if($request->postExists('auteur'))
	  {
		  $comment = new Comment(['auteur' => $request->postData('auteur'),
		  
								  'contenu' => $request->postData('contenu'),
								  
								  'id' => $request->getData('id')
								]);
		
			if($comment->isValid())
			{
				$this->manager->getManagerOf('Comments')->save($comment);
					
				$this->app->getUser()->setFlash('Le commentaire à bien été modifié.');
				
				$this->app->httpResponse()->redirect('/News-'.$_COOKIE['redirect_id'].'.html');
			}
			
			else 
			{
				$this->page->addVar('erreurs',$comment->getErreurs());
			}
			
		}	
		else 
		{
			$this->page->addVar('comment',$this->manager->getManagerOf('Comments')->getUniqueComment($request->getData('id')));
		}
		$this->page->addVar('title','modification de commentaire');
	}
	
	public function executeDeleteComment(HTTPRequest $request)
	{
		$this->manager->getManagerOf('Comments')->deleteComment($request->getData('id'));
		
		$this->app->getUser()->setFlash('Commentaire bien supprimé!');
		$this->app->httpResponse()->redirect('/News-'.$_COOKIE['redirect_id'].'.html');
	}
}




















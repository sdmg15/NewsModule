<?php 
Namespace App\Frontend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \Michelf\Markdown;
/**
 * @ClassName NewsController
 * @ClassInfo just read the source code and you will understood
 * @Authored 10 sep 2015
 * @Author Sonkeng Donfack Maldini (SDM)
 */
 
class NewsController extends BackController
{
	
	//la première action executeIndex
	
	public function executeIndex(HTTPRequest $request)
	{
		$nombre_news = $this->app->getConfig()->get('nombre_news');
		$nombre_caractere = $this->app->getConfig()->get('nombre_caracteres');
		
		$listNews = $this->manager->getManagerOf('News')->getList(0,$nombre_news);
		
		
		$this->page->addVar('title','Liste des '.$nombre_news.' derniÃ¨res news');
		//on réduit le nombre de caractères ............
		
		foreach($listNews as $news)
		{
			if(strlen($news->getContenu()) > $nombre_caractere)
			{
				$contenu = substr($news->getContenu(),0,$nombre_caractere);
				
				$contenu = substr($contenu,0,strrpos($contenu,' ')).'.....';		
				$news->setContenu($contenu);
			}


		}
		$this->page->addVar('listNews',$listNews);
	}
	
	//la seconde action 
	
	public function executeShow(HTTPRequest $request)
	{
		$manager = $this->manager->getManagerOf('News');
		$news = $manager->getUnique((int) $request->getData('id'));
		
		if(empty($news) || !$manager->exists($request->getData('id')))
		{
			$this->app->httpResponse()->redirect404();
		}
	
		$this->page->addVar('title',$news->getTitre());
		$this->page->addVar('uneNews',$news);
		$this->page->addVar('listComments',$this->manager->getManagerOf('Comments')->getCommentsOf((int) $request->getData('id')));
		$this->app->httpResponse()->setCookie('redirect_id',(int)$news->getId(),time()+ 36*24);
	}
	
	public function executeInsertComment(HTTPRequest $request)
	{	
    $this->page->addVar('title', 'Ajout d\'un commentaire');

	if($request->postExists('auteur'))
    {
      $comment = new Comment([
        'newsId' => $request->getData('newsId'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
	  
      if ($comment->isValid())
      {
       $this->manager->getManagerOf('Comments')->save($comment);
       
        $this->app->getUser()->setFlash('Le commentaire a bien Ã©tÃ© ajoutÃ©, merci !');
        $this->app->httpResponse()->redirect('/news-'.$request->getData('newsId').'.html');
      }
      else
      {
        $this->page->addVar('erreurs', $comment->getErreurs());
		
      }
      
      $this->page->addVar('comment', $comment);
    }
  }
		 
}    
	























<?php 
namespace OCFram;
/************************************************
 * @Author : Sonkeng Donfack Maldini  (SDM)
 * @Date : 6 sep 2015
 * @ClassName :  HTTPResponse
 * @ClassInfo : this class represent responses sent to customers and extends the application component class and contents in the NS OCFram.
 * @see : only response.
 ************************************************/
 
 class HTTPResponse extends ApplicationComponent
 {
	 //l'attribut contenant la page genérée par le controlleur.
	 
	 protected $page;
	 
	 
	 public function redirect($location)
	 {
		 header('Location: '.$location);
	 }
	 
	 public function redirect404()
	 { 
		$this->page = new Page($this->app);
		
		$this->page->addVar('title','404 NOT FOUND');
		
		$this->page->setContentFile(__DIR__.'/../../Errors/404.html');
		 
		 $this->addHeader('HTTP/1.1 404 NOT FOUND');
		 
		 $this->send();
	 }
	 
	 public function send()
	 {
		 exit($this->page->getGeneratedPage());
	 }
	 
	 public function addHeader($location)
	 {
		 header($location);
	 }
	 
	 public function setPage(Page $page)
	 {
		 $this->page = $page;
	 }
	 
 public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
  {
   setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
}
public function cookieData($data)
{
	return isset($_COOKIE[$data])? $_COOKIE[$data]: null;
}
 }

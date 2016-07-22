<?Php 
Namespace App\Frontend;
use \OCFram\Application;
  /*
   +----------------------------------------------------------------------+
   | CAMGIT Version 5 based on PHP 5.9 POO                                |
   +----------------------------------------------------------------------+
   | Copyright (c) 1997-2010 The CAMGIT Group                             |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@camgit.net so we can mail you a copy immediately.            |
   +----------------------------------------------------------------------+
   | Authors:   @ClassName FrontendApplication                            |
   |            @Authored 9 sep 2015                                      |
   |            Sonkeng Donfack Maldini (SDM)<sonkengmaldini@camgit.com>  |
   |                                                                      |
   |                                                                      |
   | (based on version by: Stig Bakken <ssb@php.net>)                     |
   | (based on the PHP 3 test framework by Rasmus Lerdorf)                |
   +----------------------------------------------------------------------+
 */

class FrontendApplication extends Application
{
	public function __construct()
	{
		parent::__construct();
		
		$this->nom='Frontend';
	}
	
	public function run()
	{
		$controller = $this->getController();
		
		$controller->execute();
		
		
		$this->httpResponse()->setPage($controller->getPage());
		
		
		$this->httpResponse()->send();
	}
}
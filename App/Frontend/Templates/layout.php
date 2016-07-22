<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= isset($title)? $title: 'Camgit'?></title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet"/>

  </head>
  <body>
	<div id="row" class="col-xs-10">
		<div class="container">
			<header>
				<h3 class="nav-tabs nav-justified" id="logo" role="badge"><a href=".">CAMGIT</a></h3>
				<p>the world largest cameroonian's Git !</p>
			</header>
			<nav>
				<aside>
					 <?php include('/../Web/nav.php')?>
				</aside>
			</nav>
			<div class="content">
					<?php if($user->hasFlash()) echo '<div class="alert alert-success" role="alert">'.$user->getFlash().'</div>'?>
<?= $content ?>
			</div>
			<footer class="modal-header" id="footer">
				<div class="panel-footer">
					<a href="mailto:sonkengmaldini@gmail.com">Contactez-nous.</a>
					<span class="text text-warning">Copyright © 2015 all rights reserved.</span><br/>
					<span class="label" id="l">Follow <b>@getbootstrap</b></span><br>
					<span class="github-btn github-stargazers" id="github-btn"><a class="gh-btn" id="gh-btn" href="https://github.com/undefined/undefined/" target="_blank" aria-label="Star on GitHub"><span class="gh-ico" aria-hidden="true"></span> <span class="gh-text" id="gh-text">Star</span></a> <a style="display: block;" class="gh-count" id="gh-count" href="https://github.com/twbs/bootstrap/stargazers" target="_blank" aria-label="86,168 stargazers on GitHub">86,168</a></span>
				</div>
			</footer>
		</div>
	</div>
 </body>
</html>

















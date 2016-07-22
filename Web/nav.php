<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
	<?php
$liens = ['accueil' => '/',];
$admin = ['accueil' => '/', 'Admin' =>'/admin/', 'Inserer une news' => '/admin/insert-news.html'];
		foreach($liens as $nom => $chemin)
		{
				if($user->isAuthenticated())
				{
					foreach($admin as $nom => $chemin)
					{
						if($_SERVER['REQUEST_URI'] == $chemin)
						{
							echo '<li class="active"><a href="'.$chemin.'" id="current">'.$nom.'<span class="sr-only">(current)</span></a></li>';
						}
					else
					{
						echo '<li><a href="'.$chemin.'">'.$nom.'</a></li>';
					}
					}

				}else {

					echo '<li class="active"><a href="'.$chemin.'">'.$nom.'</a></li>';
				}
		}


?>
			</ul>
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
				  <input type="text" class="form-control" placeholder="Search"/>
				</div>
				 <button type="submit" class="btn btn-primary">Rechercher</button>
			</form>
		</div>
	</div>
</nav>

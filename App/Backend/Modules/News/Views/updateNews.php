 <form method="post" action="">
	<div class="input-group input-group-ls">
	
		<?= isset($erreurs) && in_array(\Entity\News::TITRE_INVALIDE,$erreurs) ? '<span class="alert alert-danger" role="alert">Titre invalide.</span>': ''?>
		
		<span class="input-group-addon" id="sizing-addon1">Titre</span>
		
		<input type="text" name="titre" value="<?= isset($news)? htmlspecialchars($news->getTitre()) : ''?>" class="form-control" placeholder="Titre" aria-describedby="basic-addon1">
	</div> 	<br/>
	<div class="input-group input-group-ls">
			<?= isset($erreurs) && in_array(\Entity\News::AUTEUR_INVALIDE,$erreurs) ? '<span class="alert text-danger" role="alert"> Auteur invalide.</span>': ''?>
			<span class="input-group-addon" id="sizing-addon1">Auteur</span>
			<input type="text" name="auteur" value="<?= isset($news)? htmlspecialchars($news->getAuteur()): ''?>" class="form-control" placeholder="Auteur" aria-describedby="basic-addon2">
	</div> <br/>
	<div class="contenu">
			<?= isset($erreurs) && in_array(\Entity\News::CONTENU_INVALIDE,$erreurs) ? '<span class="alert text-danger" role="alert">Contenu invalide.</span>': ''?>
				<textarea name="contenu" ><?=isset($news)? htmlspecialchars($news->getContenu()): ''?></textarea>
	</div>	
	<div class="btn btn-group">
		<?php 
		if(isset($news) && !$news->isNew())
		{
			echo '<input type="submit" class="btn btn-primary" id="inser" value="modifier">';
			echo '<input type="hidden" name="id" value="'.$news->getId().'">';
		}
		else 
		{
			echo '<input class="btn btn-default" id="inser" type="submit" value="insérer">';
		}
	
		
		?>
	</div>
	</form>
	
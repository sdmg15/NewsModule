<h2>Ajouter un commentaire pour la news.</h2><br/>

<form action="" method="post">
	<?= isset($erreurs) && in_array(\Entity\Comment::AUTEUR_INVALIDE,$erreurs) ? '<div class="alert alert-danger" role="alert"> Auteur invalide.</div>': ''?>
	<div class="input-group input-group-ls">
		<span class="input-group-addon" id="sizing-addon1">Auteur</span>
			<input type="text" name="auteur" value="<?= isset($comment)? htmlspecialchars($comment->getAuteur()): ''?>" class="form-control" placeholder="Auteur" aria-describedby="basic-addon2">
	</div> <br/>
	<?= isset($erreurs) && in_array(\Entity\Comment::CONTENU_INVALIDE,$erreurs) ? '<div class="alert alert-danger" role="alert">Contenu invalide.</div>': ''?>
	<div class="contenu">
		<textarea name="contenu" ><?=isset($comment)? htmlspecialchars($comment->getContenu()): ''?></textarea>
	</div>
	<div class="btn btn-group">
		<input type="submit" class="btn btn-primary">
	</div>
</form>
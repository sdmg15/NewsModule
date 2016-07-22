<h1>Modifier le commentaire de <b><em><small><?=$comment->getAuteur()?></small></em></b></h1>
 <form method="post" action="">
	<?= isset($erreurs) && in_array(\Entity\Comment::AUTEUR_INVALIDE,$erreurs)? '<span class="text-danger">Auteur invalide.</span>':''?>
	<input type="text" name="auteur" value="<?=isset($comment)?htmlspecialchars($comment['auteur']):''?>">
	
	<?= isset($erreurs) && in_array(\Entity\Comment::CONTENU_INVALIDE,$erreurs)?'<span class="text-danger">Contenu invalide.</span>':''?>
	<textarea name="contenu"><?=isset($comment)?$comment->getContenu(): ''?></textarea><br>
	<input type="submit" value="modifier le commentaire">
</form>
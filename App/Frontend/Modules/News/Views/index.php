<?php 
	if(empty($listNews))
	{
		echo '<span class="text-warning">Pas de news pour le moment merci de patienter.</span>';
	}
	else
	{
		foreach($listNews as $uneNews)
	{
?>
<div class="col-lm-10 well">
	<p>
		<h1><img src="/../glyphicons_free/glyphicons_free/glyphicons/png/glyphicons-67-tags.png" alt="tags"/> <a href="/News-<?=$uneNews->getId()?>.html"><?= $uneNews->getTitre()?></a>
		<span style="font-size: 0.5em;padding: 15px; margin:4px;">
		<img src="/../glyphicons_free/glyphicons_free/glyphicons/png/glyphicons-55-clock.png" alt="date"/><small><em><?=$uneNews->dateAjout()->format('d/m/Y à H\h:m\m')?> <?php if($uneNews->dateAjout() != $uneNews->dateModif()) echo ' Modifiée le '.$uneNews->dateModif()->format('d/m/Y à H\h:m\m')?> <img src="/../glyphicons_free/glyphicons_free/glyphicons/png/glyphicons-52-eye-open.png" alt="vues"/><?=$uneNews->getVues()?> <img src="/../glyphicons_free/glyphicons_free/glyphicons/png/glyphicons-310-comments.png" alt="comment"/><?= $uneNews->getNbrComment()?></em></small></span></h1>

	<p role="badge">
		<img src="/../glyphicons_free/glyphicons_free/glyphicons/png/glyphicons-4-user.png" alt="user-banner"/> <button type="button" class="btn btn-success"><?=htmlspecialchars(ucfirst($uneNews->getAuteur()))?></button>
	</p>
	<div class="col-xm-5">
		<img src="/../images/quote.gif" alt="quote" style="margin: 12px;"><?= nl2br(ucfirst($uneNews->getContenu()))?>
	</div>
	
</div>

<?php 
	}
	}
	
?>

<?php 

include_once "C:\wamp\www\NewsModule\lib\OCFram\parser.php";
?>
<div class="col-lm-10 well">
	<p>
		<h1><img src="/../glyphicons_free/glyphicons_free/glyphicons/png/glyphicons-67-tags.png" alt="tags"/> <a href="/News-<?=$uneNews->getId()?>.html"><?= $uneNews->getTitre()?></a>
		<span style="font-size: 0.5em;padding: 15px; margin:4px;"><img src="/../glyphicons_free/glyphicons_free/glyphicons/png/glyphicons-55-clock.png" alt="date"/><small><em><b><?=$uneNews->dateAjout()->format('d/m/Y à H\h:m\m')?><?php if($uneNews->dateAjout() != $uneNews->dateModif()) echo ' Modifiée le '.$uneNews->dateModif()->format('d/m/Y à H\h:m\m')?> <img src="/../glyphicons_free/glyphicons_free/glyphicons/png/glyphicons-52-eye-open.png" alt="vues"/><?=$uneNews->getVues()?></b></em></small></span></h1>
	<p role="badge">
		<img src="/../glyphicons_free/glyphicons_free/glyphicons/png/glyphicons-4-user.png" alt="user-banner"/> <button type="button" class="btn btn-success">
		<?=htmlspecialchars(ucfirst($uneNews->getAuteur()))?></button>
	</p>
	<p class="col-xm-9">
		<p class="jumbotron" style="line-height: 30px; text-indent: 409902px;" oninput="refreshMirrorCode();" id="code" >
			<br><?= htmlspecialchars($uneNews->getContenu())?>
		</p>
			<img src="/../glyphicons_free/glyphicons_free/glyphicons/png/glyphicons-309-share-alt.png" alt="Share"> 
			<img src="/../glyphicons_free/glyphicons_free/glyphicons_social/png/social-22-github.png" alt="Github">
			<img src="/../glyphicons_free/glyphicons_free/glyphicons_social/png/social-44-apple.png" alt="Github">
			<img src="/../glyphicons_free/glyphicons_free/glyphicons_social/png/social-23-youtube.png" alt="Github">
			<img src="/../glyphicons_free/glyphicons_free/glyphicons_social/png/social-3-google-plus.png" alt="Github">
			<img src="/../glyphicons_free/glyphicons_free/glyphicons_social/png/social-49-android.png" alt="Github">
			<img src="/../glyphicons_free/glyphicons_free/glyphicons_social/png/social-18-linked-in.png" alt="Github">
			<img src="/../glyphicons_free/glyphicons_free/glyphicons_social/png/social-45-windows.png" alt="Github">
</div>

<!-- les commentaires associés à la news -->

<div id="container">
	<a href="/commenter-news-<?=$uneNews['id']?>.html" style="font-size:1.5em">Laisser un commentaire.</a>
		<?php
		if(empty($listComments))
		{
			echo '<br><br>Pas de commentaires pour le moment soyez le premier à laisser un.<br><br>';
		}
		foreach($listComments as $comment)
		{
		?>
		  <h2><span class="label label-default"><?= $comment->getAuteur()?></span></h2>
		<div class="well">
			<?= parseText($comment['contenu']) ?>
			<br><br><span class="disabled"><em>-Ajouté <?= $comment->getDateAjout()->format('d/m/Y à H\h:m\m')?> <?php if($comment->getDateAjout() != $comment->getDateModif()) echo ' Modéré par un admin le'.$comment->getDateModif()->format('d/m/Y à H\h:m\m')?></em></span>
			
			<?php 
				if($user->isAuthenticated())
				{
				?>
			<div class="col-xm-8">
				
				<a href="/admin/update-comment-<?=$comment['id']?>.html" class="btn btn-warning" role="button">Modifier <img src="/../images/update.png" alt="update" role="button"/></a>
				|  <a href="/admin/delete-comment-<?=$comment['id']?>.html" class="btn btn-danger" role="button">supprimer <img src="/../images/delete.png" alt="supprimer" role="button"/></a>
				
			</div>
				<?php 
					}
				?>
		</div>
	<?php 
			
					
		}
	?>
</div>
	
<a class="btn-link" href="/commenter-news-<?=$uneNews['id']?>.html" style="font-size:1.5em">Laisser un commentaire.</a>
 <?php 


 
 ?>
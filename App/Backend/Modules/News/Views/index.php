<h1 class="content" style="color: navy; text-align: center;font-weight: bold;">Page d'administration.</h1><br><br>	
	<?php 
		if(empty($listNews))
		{
			echo '<span class="text-warning">Pas de news créee pour l\'instant.</span>';
		}
		else 
		{
		?>
	<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading" style="font-weight: bold;font-size: 2em;"><b>Panel heading</b></div>
			<div class="panel-body">
				Voici la liste de toute les news crées.Vous pouvez les modifiée et supprimée en temps voulu.Vous pourrez ce pendant aussi <b class="bolder"><a href="/admin/insert-news.html">Insérer une news</a></b>.
					<p class="btn btn-info">Il y a actuellement <?=$nombreNews?> news crées.</p>
		  </div>
		  <table class="table">
			<tr>
				<th>Auteur</th>
				<th>Titre</th>
				<th>Date ajout</th>
				<th>Last modified</th>
				<th>Actions</th>
			</tr>
				<?php 
		foreach($listNews as $news)
		{
			echo '<tr>';
		?>
			<td><?=$news['auteur']?></td>
			<td><?=$news['titre']?></td>
			<td><?=$news->dateAjout()->format('d/m/y à h\h:m\m:s\s')?></td>
			<td><?php if($news->dateAjout()!= $news->dateModif()) echo $news->dateModif()->format('d/m/y à h\h:m\m:s\s'); else {echo '<span style="text-align:center;">-</span>';}?></td>
			<td><a href="/admin/modifier-news-<?=$news['id']?>.html" class="btn btn-warning" role="button">Modifier <img src="/../images/update.png" alt="update" role="button"/></a>
				|  <a href="/admin/delete-news-<?=$news['id']?>.html" class="btn btn-danger" role="button">supprimer <img src="/../images/delete.png" alt="supprimer" role="button"/></a>
				</td>
		
		<?php
		   echo '</tr>'; 
		}
		}
		
		?>
		</table>
	</div>
		
		
		
		
 <form method="post" action="">	
	<?= isset($erreurs) && in_array(\Entity\News::TITRE_INVALIDE,$erreurs) ? '<div class="alert alert-danger" role="alert">Titre invalide.</div>': ''?>
		
	<div class="input-group input-group-ls">
	

		<span class="input-group-addon" id="sizing-addon1">Titre</span>
		
		<input type="text" name="titre" value="<?= isset($news)? htmlspecialchars($news->getTitre()) : ''?>" class="form-control" placeholder="Titre" aria-describedby="basic-addon1">
	</div> 	<br/>
	
	<?= isset($erreurs) && in_array(\Entity\News::AUTEUR_INVALIDE,$erreurs) ? '<div class="alert alert-danger" role="alert"> Auteur invalide.</div>': ''?>
	
	<div class="input-group input-group-ls">
			
			<span class="input-group-addon" id="sizing-addon1">Auteur</span>
			<input type="text" name="auteur" value="<?= isset($news)? htmlspecialchars($news->getAuteur()): ''?>" class="form-control" placeholder="Auteur" aria-describedby="basic-addon2">
	</div> <br/>
	
	<?= isset($erreurs) && in_array(\Entity\News::CONTENU_INVALIDE,$erreurs) ? '<div class="alert alert-danger" role="alert">Contenu invalide.</div>': ''?>
	
	<div class="contenu">
		   <div>
        <p>
            <input type="button" value="G" onclick="insertTag('<gras>','</gras>','textarea');"/>
            <input type="button" value="I" onclick="insertTag('<italic>','</italic>','textarea');"/>
            <input type="button" value="Lien" onclick="insertTag('<link>','</link>','textarea','lien');"/>
            <input type="button" value="Image" onclick="insertTag('<img>','</img>','textarea','image');"/>
            <input type="button" value="Citation" onclick="insertTag('<quote>','</quote>','textarea','citation');"/>
            <select onchange="insertTag('<' + this.options[this.selectedIndex].value + '>', '</' + this.options[this.selectedIndex].value + '>','textarea');">
                <option value="none" class="selected" selected="selected">Taille</option>
                <option value="ttpetit">Très très petit</option>
                <option value="tpetit">Très petit</option>
                <option value="petit">Petit</option>
                <option value="gros">Gros</option>
                <option value="tgros">Très gros</option>
                <option value="ttgros">Très très gros</option>
            </select>
            <img src="smileys/270c.png" alt="smiley" onclick="insertTag('' ,':D' ,'textarea')"/>
            <img src="smileys/1f44d.png" alt="smiley" onclick="insertTag('',':(','textarea')"/>
        </p>
        <p>
            <input name="previsualisation" type="checkbox" id="previsualisation" value="previsualisation" />
            <label for="previsualisation">Prévisualisation automatique</label>
        </p>
    </div>
	<div id="previewDiv"></div>
    <p>
        <input type="button" value="Visualiser" onclick="view('textarea','viewDiv');" />
    </p>
    <div id="viewDiv"></div>
			
				<textarea name="contenu" id="textarea" onkeyup="prevView(this,'previewDiv')" onselect="prevView(this,'previewDiv')"><?=isset($news)? htmlspecialchars($news->getContenu()): ''?></textarea>
	</div>
	<div class="btn btn-group">
		<?php 
		if(isset($news) && !$news->isNew())
		{
			echo '<input type="submit" class="btn btn-default" id="inset" value="modifier">';
			echo '<input type="hidden" name="id" value="'.$news->getId().'">';
		}
		else 
		{
			echo '<input class="btn btn-primary" id="inst" type="submit" value="insérer">';
		}
			
		?>
	</div>
	</form>
<script>

function insertTag(startTag,endTag,textareaId,tagType){ 

	var field = document.getElementById(textareaId);
	var scroll = field.scrollTop;
	field.focus();
	
	var startSelection =field.value.substring(0,field.selectionStart),
		currentSelection = field.value.substring(field.selectionStart,field.selectionEnd),
		endSelection = field.value.substring(field.selectionEnd);
	

	if(tagType){ 
	
		switch(tagType){
			case "lien": 
				if(currentSelection){ 
				
					if(currentSelection.indexOf('http://') == 0)
					{ 
						var label = prompt('Entrez le libellé du lien');
							startTag = '<link href=' + currentSelection + '>';
							currentSelection = label;
					}else { 
						var lien = prompt('Entrez le lien ');
							startTag = '<link href=' + lien + '>';
					}
				}else { 
				
					var url = prompt('Entrez l\'url') || '' ,
						libellé = prompt('Entrez le libellé du lien') || ' ';
						
						startTag = '<link href=' + url + '>';
					currentSelection = libellé;
					}
						
			
			
			break;
			
			case "citation": 
				var endTag = '</quote>';
				
					if(currentSelection){ 
						if(currentSelection.length > 50 || currentSelection.indexOf('[') || currentSelection.lastIndexOf(']')){ 
						
						var auteur = prompt('Quel est l\'auteur de la citation ? ') || ' unknown';
						startTag = '<quote auteur=' + auteur + '>';
				
						}else{ 
						
							var citation = prompt('Entrez la citation','')|| ' ';
								startTag = '<quote auteur=' + currentSelection + '>';
								currentSelection = citation;
						}
					}else{
					
						var author = prompt('Entrez le nom de l\'auteur')|| 'unknown';
						var citation = prompt('Entrez la citation') || ' ' ;
						startTag = '<quote auteur='+ author + '>';
						currentSelection = citation;
					
					}
				
			break;
			
			case "image": currentSelection = 'Coming soon';
			break;	
		}
	}
		field.value = startSelection + startTag + currentSelection + endTag + endSelection;

	field.focus();
	field.setSelectionRange(startSelection.length + startTag.length, startSelection.length + startTag.length + currentSelection.length);
	field.scrollTop = scroll;
}
	function prevView(textarea,divPreview){ 
	
		var field = textarea.value;
		if(document.getElementById('previsualisation').checked && field){ 
		
			field = field.replace(/<gras>([\s\S]*?)<\/gras>/g,'<strong>$1</strong>');
			field = field.replace(/<italic>([\s\S]*?)<\/italic>/g,'<i>$1</i>');
			field = field.replace(/<link href=([\s\S]*?)>([\s\S]*?)<\/link>/g,'<a href="$1">$2</a>');
			field = field.replace(/<quote auteur=([\s\S]*?)?>([\s\S]*?)<\/quote>/g,'<blockquote><i>$1 said : $2</i></blockquote>');
			field = field.replace(/<ttpetit>([\s\S]*?) <\/ttpetit>/g,'<span style="font-size: 0.3em"> $1</span>');
			field = field.replace(/<tpetit>([\s\S]*?)<\/tpetit>/g,'<span style="font-size: 0.6em"> $1</span>');
			field = field.replace(/<petit>([\s\S]*?)<\/petit>/g,'<span style="font-size: 0.9em"> $1</span>');
			field = field.replace(/<gros>([\s\S]*?)<\/gros>/g,'<span style="font-size: 1.4em"> $1</span>');
			field = field.replace(/<tgros>([\s\S]*?)<\/tgros>/g,'<span style="font-size: 2em"> $1</span>');
			field = field.replace(/<ttgros>([\s\S]*?)<\/ttgros>/g,'<span style="font-size: 3em"> $1</span>');
			document.getElementById(divPreview).innerHTML = field;
		}else { 
		
			document.getElementById(divPreview).innerHTML = ' ';
		}
	}
	
	
	function getXmlRequest(){ 
	if(window.XMLHttpRequest || window.ActiveXObject){
		
	
		if(window.ActiveXObject){ 
		
			try { 
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			}catch(e){ 
				xhr = new ActiveXObject('Microsoft.XMLHTTP');
			}
		}else { 
		
			xhr = new XMLHttpRequest();
		}
	
	}else{ 
	
		alert('Your navigator don\'t support XMLHttpRequest please update it ');
		return null;
	}
	return xhr;
} 
	
	
	
	
	function view(textareaId,divDeVision){ 
	
		var content = encodeURIComponent(document.getElementById(textareaId).value);
		
		var xhr = getXmlRequest();
		
		if(xhr && xhr.readyState != 0){ 
		
			xhr.abort();
			delete xhr;
		}
	
		xhr.addEventListener('readystatechange',function(e){ 
		
		if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200){ 
		
			document.getElementById(divDeVision).innerHTML = xhr.responseText;
		}else if(xhr.status == 3){ 
			document.getElementById(divDeVision).innerHTML  = '<p style="text-align: center"><img src="ajax-loader.gif"></p>';
		}
		
		},false);
		xhr.open('POST','parser.php',true);	
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		xhr.send('script=' + content);
	}
</script>

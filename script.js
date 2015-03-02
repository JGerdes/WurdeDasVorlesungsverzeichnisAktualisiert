window.addEventListener('load', function(){
	var link = document.querySelector('a.ifttt'),
		box = document.querySelector('div.ifttt-recipes'),
		blocker = document.querySelector('div.blocker'),
		first = true,
		recipeLinks = [
						'https://ifttt.com/recipe_embed/265226',
						'https://ifttt.com/recipe_embed/265241',
						'https://ifttt.com/recipe_embed/265243'
		],
		frameStart = '<iframe scrolling="no" src="',
		frameEnd = '" style="display: inline-block; border-style: solid; border-width: 0px; width: 100%; height: 90px; min-width: 220px; max-width: 640px; padding: 0px; border-radius: 5px; margin: 5px 0px;"></iframe>';


	function hideBox(){
		box.style.bottom = -box.clientHeight - 100 + 'px';
		blocker.style.opacity = 0;
		window.setTimeout(function(){
			blocker.style.display = 'none';
		},500);
	}

	function showBox(){
		if(first){
			var frames = [];
			recipeLinks.forEach(function(link){
				frames.push(frameStart + link + frameEnd);
			});
			box.innerHTML = 'IFTTT Rezepte '+frames.join('');
			first = false;
		}
		box.style.left = window.innerWidth/2 - 300 + 'px';
		box.style.bottom = -box.clientHeight - 100 + 'px';
		box.style.display = 'block';
		blocker.style.display = 'block';
		window.setTimeout(function(){
			box.style.bottom = window.innerHeight/2 - box.clientHeight/2 + 'px';
			blocker.style.opacity = 0.7;
		},10);
		
	};


	link.addEventListener('click', showBox);
	blocker.addEventListener('click', hideBox);
});
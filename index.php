<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo get_bloginfo('name'); ?></title>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.core.js"></script>
<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.slide.js"></script>

<link href='http://fonts.googleapis.com/css?family=Alegreya:400italic,700italic,400,700' rel='stylesheet' type='text/css'>



<link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css" />

<script>
	if(window.location.hash) {
		var hash = window.location.hash;
		var hashtourl = hash.substring(2)
		window.location.href = "/"+hashtourl;
	}
</script>


</head>

<body>

<a class="shift" id="goarchive">&rarr;</a>
<a class="shift" id="gopost">&larr;</a>


<ul id="content">
	<li id="post">
		
		<div class="content">
			
			<?php $my_query = new WP_Query($query_string . "&showposts=1"); while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID; ?>
				
				<p id="hello">
					 <?php echo get_bloginfo('description'); ?> This blog post was published on <?php the_time('F j Y') ?>. <a href="<?php the_permalink(); ?>">&sect;</a> 
				</p>
			
			
				<h1><?php the_title(); ?></h1>
							
				<?php the_content(); ?>
					
			<?php endwhile; ?>
			
		</div>
		
		<div id="footer">
			Using the <a href="http://tomcreighton.com/glider-theme">Glider</a> theme.
		</div>
												
	</li>
	
	<li id="archive">
		
		<div class="content">
			
			<ul>
				<?php $my_query = new WP_Query("showposts=999999"); while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID; ?>
					<li><h2><a rel="<? the_permalink(); ?>" id="<? the_id(); ?>" title="<?php echo( basename(get_permalink()) ); ?>"><?php the_title(); ?></a></h2> <span><?php the_time('F j Y') ?></span></li>
				<?php endwhile; ?>
			</ul>
			
		</div>
												
	</li>
	
</ul>



<script>
	jQuery(function($) { //changed document.ready to jQuery
		
		function goarchive() {
			$('#goarchive').fadeOut(300);
			$('#post').hide('slide', {direction: 'left'}, 600, function() {
				$("#archive").scrollTop(0);
				$('#archive').show('slide', {direction: 'right'}, 600);
				$('#gopost').fadeIn(300);
			});
		};
		
		function gopost() {
			$('#gopost').fadeOut(300);
			$('#archive').hide('slide', {direction: 'right'}, 600, function() {
				$("#post").scrollTop(0);
				$('#post').show('slide', {direction: 'left'}, 600);
				$('#goarchive').fadeIn(300);
			});
		};
		
		function loadpost() {
			
			//removed successive 'var' calls
			var perma = $(this).attr("rel"),
				postid = $(this).attr("id"),
				postitle = $(this).attr("title"); //consider changing variable name to posttitle
			
			$(this).parent().parent().addClass('loader'); //changed '#'+postid to 'this'
			
			$("#post").load(perma + ' #post', function() { //removed empty quotation
				$('#gopost').fadeOut(300);
				$('#archive').hide('slide', {direction: 'right'}, 600, function() {
					$("#post").scrollTop(0);
					$('#goarchive').fadeIn(300);
					$('#post').show('slide', {direction: 'left'}, 600, function() {
						$('#'+postid).parent().parent().removeClass('loader');
						window.location.hash = "/"+postitle;
						$("title").html(postitle); //Added line to update title upon loading new post
						twttr.widgets.load()
					});
				});
				
			});
		}
		
		$('#goarchive').live("click", goarchive);
		
		$('#gopost').live("click", gopost);
		
		$("#archive a").live("click", loadpost);
		

						
	})(jQuery);
</script>


</body>
</html>

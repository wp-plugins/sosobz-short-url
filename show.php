<div style="margin-top:2em;">
	<?php echo __("<font size='4'>* A <a href='http://ur1.bz' style='text-decoration:none;' target='_blank'> short link</a> for this article:&nbsp;&nbsp;</font>") ?>
	<input type="text" size="25" id="SosoBz" value="<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>">&nbsp;&nbsp;<a href="<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>~" target="_blank" style="text-decoration:none;"><font size='3'>Stats</font></a>
	<p><a target="_blank" href="http://www.addthis.com/bookmark.php?url=<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>&title=<?php the_title(); ?>"><img src="http://ur1.bz/imgs/bookmark.gif"></a></p>
</div>
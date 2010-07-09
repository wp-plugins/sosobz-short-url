<div style="margin-top:2em;">
	<?php echo __("<font size='4'>* A <a href='http://soso.bz' style='text-decoration:none;' target='_blank'> shorter link</a> for this article:&nbsp;&nbsp;</font>") ?>
	<input type="text" size="25" id="SosoBz" value="<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>">&nbsp;&nbsp;
	<p><a target="_blank" href="http://www.addthis.com/bookmark.php?url=<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>"><img src="http://soso.bz/jscss/bookmark.gif"></a></p>
</div>
<script type="text/javascript"> 
function copySosoBz() 
{ 
var SosoBz=document.getElementById("SosoBz"); 
SosoBz.select();
document.execCommand("Copy");
alert("Have been copied!"); 
} 
</script> 
<div style="margin-top:2em;">
    <?php echo __("<font size='4'>* A <a href='http://soso.bz' style='text-decoration:none;' target='_blank'> shorter link</a> for this article:&nbsp;&nbsp;</font>") ?>
    <input type="text" size="25" id="SosoBz" onClick="copySosoBz()" value="<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <p><a href="http://www.facebook.com/sharer.php?u=<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>&t=<?php the_title(); ?>" title="Share on Facebook" target="_blank"><img src="http://soso.bz/jscss/facebook.gif" alt="Facebook" /></a> 
		<a target="_blank" href="http://twitter.com/home?status=<?php the_title(); ?> <?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>" title="Share on Twitter"><img src="http://soso.bz/jscss/twitter.gif" alt="Twitter" /></a> 
    <a target="_blank" href="http://digg.com/submit?phase=2&url=<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>&title=<?php the_title(); ?>"><img title="Digg This Story" alt="Digg This Story" src="http://soso.bz/jscss/digg.gif" border="0"></a>
		<a target="_blank" href="http://del.icio.us/post?url=<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>&title=<?php the_title(); ?>"><img title="Add to del.icio.us" alt="Add to del.icio.us" src="http://soso.bz/jscss/delicious.gif" border="0"></a>  
		<a target="_blank" href="http://myweb2.search.yahoo.com/myresults/bookmarklet?u=<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>&t=<?php the_title(); ?>"><img title="Add Yahoo Myweb" alt="Add Yahoo Myweb" src="http://soso.bz/jscss/yahoo_myweb.gif" border="0"></a> 
		<a target="_blank" href="http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>&title=<?php the_title(); ?>"><img title="Add Google Bookmarks" alt="Add Google Bookmarks" src="http://soso.bz/jscss/google_bmarks.gif" border="0"></a>  
		<a target="_blank" href="http://blogmarks.net/my/new.php?mini=1&url=<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>&title=<?php the_title(); ?>"><img title="Add to Blogmarks" alt="Add to Blogmarks" src="http://soso.bz/jscss/blogmarks.gif" border="0"></a>
		<a target="_blank" href="https://favorites.live.com/quickadd.aspx?marklet=1&mkt=en-us&url=<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>&title=<?php the_title(); ?>"&top=1"><img title="Add to Windows Live" alt="Add to Windows Live" src="http://soso.bz/jscss/windows_live.gif" border="0"></a>
		<a target="_blank" href="javascript:window.external.AddFavorite('<?php echo get_post_meta($post->ID, 'SosoBzShortURL', true); ?>','<?php the_title(); ?>');"><img title="Add to Favorites" alt="Add to Favorites" src="http://soso.bz/jscss/internetexplorer.gif" border="0"></a></p>
</div>
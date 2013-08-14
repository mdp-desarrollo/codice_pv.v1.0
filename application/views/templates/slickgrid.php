<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="en-us" />
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $meta_keywords;?>" />
    <meta name="description" content="<?php echo $meta_description;?>" />
    <meta name="copyright" content="<?php echo $meta_copywrite;?>" />
    <?php foreach($styles as $file => $type) { echo HTML::style($file, array('media' => $type)), "\n"; }?>

    <?php foreach($scripts as $file) { echo HTML::script($file, NULL, TRUE), "\n"; }?>
  </head>
  <body>
    <div id="page">
        <div id="wrapper">
            <div id="header">
            <div id="top">
                <div class="topmenu">
                <ul>
                    <li class="page_item page-item-2"><a title="About" href="http://www.montolz.com/about/">About</a></li>
                    <li class="page_item page-item-429"><a title="Privacy Policy At Montolz.com" href="http://www.montolz.com/privacy-policy-at-montolz/">Privacy Policy At Montolz.com</a></li>
                    <li><a href="http://www.montolz.com/feed/" class="rss">rss</a></li>
                </ul>
                </div><!-- /topmenu -->
                <div class="search">
                <form action="http://www.montolz.com/" class="searchform" method="get">
                <p>
                <input type="text" class="searchbox" name="s" onblur="if (this.value == '') {this.value = 'Search this site...';}" onfocus="if (this.value == 'Search this site...') {this.value = '';}" value="Search this site..."/>
                <input type="submit" class="submitbutton" value="Buscar"/>
                </p>
                </form>
                </div><!-- /search -->
                <div class="cleared"></div>
            </div><!-- /top -->
            <div id="logo">
            <h1><a href="http://www.montolz.com">Code Jutsu</a></h1>
            <div id="desc"><span id="IL_AD1" class="IL_AD">The Best Game</span> Cheats Website</div>
            </div><!-- /logo -->
            <div id="headerbanner">
            <p><a href="http://www.montolz.com/feed/">RSS feed</a></p>
            </div><!-- /headerbanner -->
            <div class="cleared"></div>
        </div>
         <div id="catnav">
        <?php echo $header;?>
        <div class="cleared"></div>
        </div><!-- fin catnav-->
        <div id="main">
            <div id="content">
                <?php echo $content;?>
            </div>
            <div id="sidebar">
                <ul>
                    <li class="boxed widget widget_recent_entries" id="recent-posts-3">		<h3 class="widgettitle">Recent Post</h3>		<ul>
				<li><a title="China Watch Children Game Through Parents" href="http://www.montolz.com/china-watch-children-game-through-parents/">China Watch Children Game Through Parents </a></li>
				<li><a title="EA Game Master the Top Chart Apple, Microsoft, and Sony" href="http://www.montolz.com/ea-game-master-the-top-chart-apple-microsoft-and-sony/">EA Game Master the Top Chart Apple, Microsoft, and Sony </a></li>
				<li><a title="Game Can Bring Dad and Daughter Relationships" href="http://www.montolz.com/game-can-bring-dad-and-daughter-relationships/">Game Can Bring Dad and Daughter Relationships </a></li>
				<li><a title="Rocksteady Game Systems Batman: Arkham City" href="http://www.montolz.com/rocksteady-game-systems-batman-arkham-city/">Rocksteady Game Systems Batman: Arkham City </a></li>
				<li><a title="Official Sony PlayStation Portable Reveal Successor" href="http://www.montolz.com/official-sony-playstation-portable-reveal-successor/">Official Sony PlayStation Portable Reveal Successor </a></li>
				</ul>
		</li>
                </ul>
            </div>
        </div>

        </div>
        
        <div id="footerwrapper">
         <?php echo $footer;
         ?>
        </div>
     
     
    </div>
  </body>
</html>

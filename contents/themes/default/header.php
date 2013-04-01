		<header>
			<h1><a href="<?php echo get_option('siteurl');?>"><?php echo get_option('site_name');?></a></h1>
			<h2><?php echo get_option('site_description');?></h2>
			<nav>
			<ul class="sf-menu" id="nav">
			<?php
				foreach(get_menu_nav() as $m)
				{
					$url=get_page_url_by_page_id(get_page_id_by_menu_name($m));
					echo "<li><a href='$url'>$m</a></li>";
				}
			?>
			</ul>
			</nav>
		</header>
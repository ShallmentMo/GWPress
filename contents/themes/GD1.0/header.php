 <header id="banner">
   <div class="center-wrap">
    <div id="logo">     <!--添加公司的logo -->
    </div>
  
    <nav id="menu"><ul>
	
     <!--<li class="current"><a href="#">首页</a></li>
     <li><a href="section/about/about.html">关于我们</a></li>
     <li><a href="section/product/product.html">产品中心</a></li>
     <li><a href="section/work/work.html">工作中心</a></li> 	 
     <li><a href="section/news/news.html">新闻中心</a></li> 
     <li><a href="section/recruitment/recruitment.html">招聘英才</a></li>       
      <li><a href="section/contact/contact.html">联系我们</a></li> 
	  -->
	  <?php
		foreach(get_menu_nav() as $m)
				{
					
					$p=get_page_id_by_menu_name($m);
					$url=get_page_url_by_page_id($p);
					$log->debug($m.' '.$p.' '.$url);
					echo "<li";
					if ($page_id==$p) echo " class='current'><a href='$url'>$m</a></li>";
					else echo "><a href='$url'>$m</a></li>";
				}
	  ?>
    </ul></nav>
   </div>	
  </header>
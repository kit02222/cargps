<body class="is-preload">
<?php include 'script.php';?>
<?php 
                                    $menu_ar = $session->get("menu"); 
                                    $cur_menu = $session->get("cur_menu");
									$delete_ar = array();
									//echo 'Before:<pre>'.print_r($menu_ar,true).'</pre>';
									//echo 'cur_menu:<pre>'.print_r($cur_menu,true).'</pre>';
									$i = 0;
									if(null != $menu_ar):
    									foreach ($menu_ar as $menu):
    									   
        									$menu_id = $menu["menu_id"];
        									$sub_menu_id = $menu["sub_menu_id"];
        									if(isset($sub_menu_id)):
        									   
            									for($z = 0 ; $z < count($menu_ar) ; $z++):
            									   $temp_id = $menu_ar[$z]["menu_id"];
            									  
            									   if($sub_menu_id == $temp_id):
                									//echo $sub_menu_id.' is equal to '.$menu_ar[$z]["menu_id"].'<br>';
                									   array_push($menu_ar[$z]["menus"],$menu );
                									   array_push($delete_ar,$i);
                									   //unset($menu_ar[$z]);
                									endif;
            									endfor;
        									endif;   
    									$i++;   
    									endforeach;
    									
    									for($i = 0 ; $i < count($delete_ar); $i++):
    									   unset($menu_ar[$delete_ar[$i]]);
    									endfor;
									endif;
									//echo 'After:<pre>'.print_r($menu_ar,true).'</pre>';
									//return;
									//echo 'Current class: <pre>'.print_r(get_userdata("cur_menu"),true).'</pre>';
?>
<script>
$(function(){
<?php 

if(isset($cur_menu["read"]) && $cur_menu["read"] != "Y"):
    echo "$('.features').hide();";
endif;

if(isset($cur_menu["write"]) && $cur_menu["write"] != "Y"):
    echo "$('#new_bt').hide();";
    echo "$('#update_bt').hide();";
endif;

if(isset($cur_menu["delete"]) && $cur_menu["delete"] != "Y"):
    echo "$('#delete_bt').hide();";
endif;

?>	
});

</script>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header" >
									<a href="#" class="logo"><strong><?php echo $cur_menu["name"];?></strong></a>
									<ul class="icons" style="display:none;">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner" style="display:none;">
									<div class="content">
										<header>
											<h1>Hi, I��m Editorial<br />
											by HTML5 UP</h1>
											<p>A free and fully responsive site template</p>
										</header>
										<p>Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin aliquam facilisis ante interdum congue. Integer mollis, nisl amet convallis, porttitor magna ullamcorper, amet egestas mauris. Ut magna finibus nisi nec lacinia. Nam maximus erat id euismod egestas. Pellentesque sapien ac quam. Lorem ipsum dolor sit nullam.</p>
										<ul class="actions">
											<li><a href="#" class="button big">Learn More</a></li>
										</ul>
									</div>
									<span class="image object">
										<img src="<?php echo base_url(); ?>/implements/theme/images/pic10.jpg" alt="" />
									</span>
								</section>

							<!-- Section -->
								
							<?php echo $body; ?>
									

							<!-- Section -->
								<section  style="display:none;">
									<header class="major">
										<h2>Ipsum sed dolor</h2>
									</header>
									<div class="posts">
										<article>
											<a href="#" class="image"><img src="<?php echo base_url(); ?>/implements/theme/images/pic01.jpg" alt="" /></a>
											<h3>Interdum aenean</h3>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="<?php echo base_url(); ?>/implements/theme/images/pic02.jpg" alt="" /></a>
											<h3>Nulla amet dolore</h3>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="<?php echo base_url(); ?>/implements/theme/images/pic03.jpg" alt="" /></a>
											<h3>Tempus ullamcorper</h3>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="<?php echo base_url(); ?>/implements/theme/images/pic04.jpg" alt="" /></a>
											<h3>Sed etiam facilis</h3>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="<?php echo base_url(); ?>/implements/theme/images/pic05.jpg" alt="" /></a>
											<h3>Feugiat lorem aenean</h3>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="<?php echo base_url(); ?>/implements/theme/images/pic06.jpg" alt="" /></a>
											<h3>Amet varius aliquam</h3>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
									</div>
								</section>

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Search -->
								<section id="search" class="alt">
									<form method="post" action="#">
										<input type="text" name="query" id="query" placeholder="Search" />
									</form>
								</section>

							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2><?php //echo get_userdata("user_id").":".get_userdata("user_name").":".get_userdata("user_fullname");
                                                echo "Hello ".$session->get("user_fullname");
                                                ?>
                                        </h2>
									</header>
									<ul>
										<?php 
										if(null != $menu_ar):
    										foreach ($menu_ar as $menu):
    										  
        										$menu_id = $menu["menu_id"];
        										$class = $menu["class"];
        										$name = $menu["name"];
        										$menus = $menu["menus"];
        
        										if(count($menus) > 0):
            										//---------should use recursion --------------//
        										    echo'<li>';
            										echo '<span class="opener">'.$name.'</span>';
            										echo '<ul>';
            										foreach ($menus as $sub_menu):
            										  $sub_name = $sub_menu["name"];
            										  $sub_class = $sub_menu["class"];
            										
            										  echo '<li><a href="'.base_url().'/'.$sub_class.'">'.$sub_name.'</a></li>';
        										    endforeach;
        										    echo '</ul>';
        										else:
        										  echo '<li><a href="'.base_url().'/'.$class.'">'.$name.'</a></li>';
        										endif;
    										
    										endforeach;
                                        endif;
										?>
									
										
										<li><a href="<?php echo base_url().'/ssoctr/logout';?>" onclick="">Logout</a></li>
									</ul>
								</nav>

							<!-- Section -->
								<section style="display: none;">
									<header class="major">
										<h2>Ante interdum</h2>
									</header>
									<div class="mini-posts">
										<article>
											<a href="#" class="image"><img src="<?php echo base_url(); ?>/implements/theme/images/pic07.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="<?php echo base_url(); ?>/implements/theme/images/pic08.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="<?php echo base_url(); ?>/implements/theme/images/pic09.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
									</div>
									<ul class="actions">
										<li><a href="#" class="button">More</a></li>
									</ul>
								</section>

							<!-- Section -->
								<section  style="display: none;">
									<header class="major">
										<h2>Get in touch</h2>
									</header>
									<p>Sed varius enim lorem ullamcorper dolore aliquam aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin sed aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
									<ul class="contact">
										<li class="icon solid fa-envelope"><a href="#">information@untitled.tld</a></li>
										<li class="icon solid fa-phone">(000) 000-0000</li>
										<li class="icon solid fa-home">1234 Somewhere Road #8254<br />
										Nashville, TN 00000-0000</li>
									</ul>
								</section>

							<!-- Footer -->
								<footer id="footer">
									
								</footer>

						</div>
					</div>

			</div>
</body>
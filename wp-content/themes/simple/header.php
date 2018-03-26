<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <?php get_template_part( 'inc/seo' ); ?>
    <!-- Bootstrap -->
	  <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>  
	  <link rel='stylesheet'  href="<?php bloginfo('template_url'); ?>/css/bootstrap.css" type='text/css' media='all' /> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	 <?php wp_head(); ?>
 </head>
  <body <?php body_class(); ?>>
       <div class="header-outer" role="navigation">
      <div class="container">
	  <div class="row">
        <h1 class="navbar-header col-md-4 col-xs-6 col-sm-4">
		<a class="logo" href="<?php bloginfo('url')?>"><?php bloginfo('name')?></a>
                  </h1>
       
    <div id="nav" class="col-md-8 col-xs-12 col-sm-8">  
 <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'fallback_cb' => 'default_menu','menu_class'=>'nav-top' ,'container'        =>  '') ); ?> </div>
 <script>
      // Init responsive-nav.js
      var navigation = responsiveNav("#nav");
    </script>
      </div>
	  </div>
    </div>

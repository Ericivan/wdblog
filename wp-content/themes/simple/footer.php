<footer id="footer">
  
      <div class="container">
        <div class="row">
	      <div class="copyright col-md-6 col-sm-6 col-xs-12">
		   <p>© 2015 <?php bloginfo('name')?><?php echo stripslashes(get_option('cx_track')); ?> </p>
		
		  </div>
		  <div class="social col-md-6 col-sm-6 col-xs-12">
		 <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'fallback_cb' => 'default_menu','menu_class'=>'nav-footer' ,'container'        =>  '') ); ?>
		  </div>
		   <div class="searchs col-md-12 col-sm-12 col-xs-12"> <?php get_search_form(); ?></div>
			
		</div>
		</div>
		
		</footer>
		 
</body>
</html>
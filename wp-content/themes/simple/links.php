<?php
/*
Template Name: 我的链接
*/
?>
<?php get_header(); ?>


<div id="primary" class="site-content container">
<div class="row">
<ul class="linkpage col-md-12">
<div class="row">
<?php wp_list_bookmarks('title_before=<h2 style="margin-left:30px">&class=linkmain&before=<li class="col-md-6">&show_name=true&show_description=true&between='); ?>
</div>
</ul>
</div>
</div>
<!-- #content -->
<?php get_footer(); ?>
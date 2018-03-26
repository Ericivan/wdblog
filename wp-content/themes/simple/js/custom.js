(function ($) {

$(document).ready(function(){
// 使用 on() 使 js 对通过 Ajax 获得的新内容仍有效
    $(".pagenav a").on("click", function(){
        $(this).addClass("loading").text("LOADING...");
        $.ajax({
    type: "POST",
            url: $(this).attr("href"),
            success: function(data){
                result = $(data).find(".content-ajax .post");
                nextHref = $(data).find(".pagenav a").attr("href");
                // 渐显新内容
                $(".content-ajax").append(result.fadeIn(300));
                $(".pagenav a").removeClass("loading").text("还有更多");
                if ( nextHref != undefined ) {
                    $(".pagenav a").attr("href", nextHref);
                } else {
                // 若没有链接，即为最后一页，则移除导航
                    $(".pagenav").remove();
                }
            }
        });
        return false;
    });
var b=$("body"),
    c=$(window),
	d=$('<div class="back2top"></div>').appendTo(b);
c.scroll(function(){c.scrollTop()>100?d.addClass("scrolled"):d.removeClass("scrolled")});
b.on("click",".back2top",function(){$("html,body").animate({scrollTop:0},600)});
	$('.expand_collapse, .archives-yearmonth').css({cursor:"pointer"});
	$('.archives ul li ul.archives-monthlisting').hide();
	$('.archives ul li ul.archives-monthlisting:first').show();
	$('.archives ul li span.archives-yearmonth').click(function(){$(this).next().slideToggle('fast');return false;});
	$(".expand_collapse").click(function(){
		$(".archives ul li ul.archives-monthlisting").slideToggle("slow");
		$('.archives ul li ul.archives-monthlisting:first').slideToggle("fast");
		return false;
	});
$(".fancybox-buttons").fancybox({
		prevEffect		: 'none',
		nextEffect		: 'none',
		closeBtn		: false,
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});
	$('.post img').addClass("img-responsive");
	$('.single-main img').parent().addClass("fancybox-buttons").attr("rel","button");
	 $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
  $(document).on('click', '.comment-nav a', function(e) {
    e.preventDefault();
    $.ajax({
      type: "GET",
      url: $(this).attr('href'), 
      beforeSend: function() {
         $('.comment-nav').remove();
         $('.commentlist').remove();
         $('#loading-comments').slideDown();
         $body.animate({scrollTop: $('#comments').offset().top - 65}, 800 );
         },//beforeSend
      dataType: "html",
      success: function(out) {
         result = $(out).find('.commentlist');
         abovenav = $(out).find('.comment-nav');  
         $('#loading-comments').slideUp(550);
         $('#loading-comments').after(result.fadeIn(800));
        result.after(abovenav);
$('.fn a').click (function() {$(this).attr('target','_blank');});
         }//success
    });//$.ajax
  });//function(e)
	
});

})(jQuery);



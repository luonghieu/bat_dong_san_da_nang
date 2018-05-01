<!-- <script type="text/javascript" src="{!! asset('public_asset/js/jquery-1.8.2.min.js') !!}"></script> -->
<!-- <script src="{!! asset('public_asset/js/jquery.min.js') !!}"></script> -->
<script src="{!! asset('public_asset/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('public_asset/js/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('public_asset/js/dataTables.bootstrap4.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('public_asset/js/menu-onpage.js') !!}"></script>
@yield('script')
    <script type="text/javascript" src="{!! asset('public_asset/js/nivo.slider.js') !!}"></script>

    <script>

    $('#slider').nivoSlider({

         animSpeed: 1000,

         pauseTime: 300000,

         effect:'random',

         manualAdvance:false,

         pauseOnHover: true,

    });

    $('#slider1').nivoSlider({

         animSpeed: 1000,

         pauseTime: 300000,

         effect:'random',

         manualAdvance:false,

         pauseOnHover: true,

    });

    $('#slider2').nivoSlider({

         animSpeed: 1000,

         pauseTime: 300000,

         effect:'random',

         manualAdvance:false,

         pauseOnHover: true,

    });

    </script>

<div class="bottom_wrapper" >

    <div class="container">

        <div class="col-md-8">

            <div class="row">

                <ul class="ul_bot hidden-xs wow fadeInUp">

                    <li><h2><a href="http://phoson.vn">Trang chủ</a></h2></li>

                    <li><h2><a href="http://phoson.vn/gioi-thieu.html">Giới thiệu</a></h2></li>

                    <li><h2><a href="http://phoson.vn/du-an/">Dự án</a></h2></li>

                    <li><h2><a href="http://phoson.vn/san-giao-dich/">Sàn giao dịch</i></a></h2></li>

                    <li><h2><a href="http://phoson.vn/tin-tuc/">Tin tức</i></a></h2></li>

                    <li><h2><a href="http://phoson.vn/tuyen-dung/">Tuyển dụng</a></h2></li>

                    <li><h2><a style="border: none;padding-right: 0;" href="http://phoson.vn/lien-he.html">Liên hệ</a></h2></li>

                    <div class="clear"></div>

                </ul>

                <ul class="tt_bot">

                    <li class="home wow fadeInUp">

                        <span>Trụ sở chính: 05 Đào Tấn - Q. Hải Châu - TP. Đà Nẵng</span>

                        <span>Chi nhánh: 274 Đường 2 Tháng 9 - Q. Hải Châu - TP. Đà Nẵng</span>

                    </li>

                    <li class="phone wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">

                        <span class="tel_hotline_email"><a href="tel:0943 822 922">0943 822 922</a></span>

                        <span class="tel_hotline_email"><a href="tel:0963 822 922">0963 822 922</a></span>

                    </li>

                    <li class="mail wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">

                        <span class="tel_hotline_email"><a href="mailto:phosonland@gmail.com">phosonland@gmail.com</a></span>

                    </li>

                    <div class="clear"></div>

                </ul>

            </div>

        </div>

        <div class="col-md-4 wow fadeInRight">

                <script>

                    function CheckForm ()
                    {
                        email=document.formdk.txt_mail.value;
                        if (!email.match(/^([-\d\w][-.\d\w]*)?[-\d\w]@([-\w\d]+\.)+[a-zA-Z]{2,6}$/)){
                            alert('Email của bạn không đúng.');
                            document.formdk.txt_mail.focus();
                            return false;
                        }else if(document.formdk.captcha.value!=document.formdk.txtCaptcha.value){
                            alert('capcha của bạn không đúng.');
                            document.formdk.captcha.focus();
                            return false;
                        }else{
                            alert('Đăng ký nhận tin thành công. Cảm ơn!');
                        }
                        return true;
                    }

                    </script>

                    
                    <form name="formdk" class="form3" method="post" onsubmit="return CheckForm();" >
                        <input type="hidden" value="sendmail" name="func" />
                        <div style="border: 1px solid #bababa;padding: 5px;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;">
                        <input type="hidden" id="txtCaptcha" name="txtCaptcha" />
                        <span id="txtCaptchaDiv" style="width: 30%;float: left;background: #0066b3;text-align: center;padding: 4px 0;margin-bottom: 2px;color: #fff;"></span>
                        <input style="width: 65%;background: #dadada;float: right;" id="captcha" placeholder="Nhập captcha" class="input_captcha" name="captcha" type="text" required=""/>
                        <div class="clear"></div>
                        </div>

                        <input required="" class="sea1" name="txt_mail" type="text" id="email" placeholder="Nhận thông tin dự án qua email..."  />

                        <button class="bt1" type="submit"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>

                        <div class="clear"></div>

                    </form>

                    <div class="facebook">

                        <div class="face_img"><img src="{!! asset('public_asset/images/logo.png') !!}" alt="logo" /></div>

                        <div class="face_name">

                            <a class="face_name_title" href="https://www.facebook.com/phosonrealestate/">BẤT ĐỘNG SẢN PHỐ SON</a>

                            <div id="fb-root"></div>

                            <div id="fb-root"></div>

                            <script>(function(d, s, id) {

                              var js, fjs = d.getElementsByTagName(s)[0];

                              if (d.getElementById(id)) return;

                              js = d.createElement(s); js.id = id;

                              js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";

                              fjs.parentNode.insertBefore(js, fjs);

                            }(document, 'script', 'facebook-jssdk'));</script>

                            <div class="fb-like" data-href="https://www.facebook.com/phosonrealestate/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>

                        </div>

                        <div class="clear"></div>

                    </div>

        </div>

    </div>

</div>

<div class="footer_wrapper">

    <div class="container">Copyright © 2012 - Công Ty Cổ Phần Bất Động Sản Phố Son</div>

</div>

<div id="showgio" style="overflow-y: hidden;padding: 0px;display: none;">

    <span style="color: #fff;font-size: 18px;text-transform: uppercase;text-align: center;margin-bottom: 25px;display: block;">GIỜ MỞ CỦA THAM QUAN NHÀ MẪU</span>

    <p style="text-align: center;">
	&nbsp;</p>
<ul>
	<li>
		<ul dir="ltr">
			<li style="color: rgb(255, 255, 255); float: left; line-height: 20px; margin-right: 30px;">
				<span style="color:#cccccc;">&nbsp;+ Thứ 4:<br />
				<em>Chiều: 4h</em>.</span></li>
			<li style="color: #fff;float: left;line-height: 20px;">
				<span style="color:#cccccc;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + Thứ 7 :<br />
				<em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;S&aacute;ng: 10h.</em></span><br />
				&nbsp;</li>
		</ul>
	</li>
</ul>

</div>

</body>

<!-- <script type="text/javascript" src="{!! asset('public_asset/js/jquery.1.10.2.min.js') !!}"></script> -->

<script type="text/javascript" src="{!! asset('public_asset/js/jquery.mmenu.min.all.js') !!}"></script>

<script type="text/javascript" src="{!! asset('public_asset/js/wow.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('public_asset/js/jquery.lazyload.min.js') !!}"></script>

<script type="text/javascript" src="{!! asset('public_asset/js/owl.carousel.min.js') !!}"></script>

<!-- Add jQuery library -->
	<!-- Add mousewheel plugin (this is optional) -->
	<!--<script type="text/javascript" src="http://phoson.vn/lib/jquery.mousewheel-3.0.6.pack.js"></script>-->

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="{!! asset('public_asset/source/jquery.fancybox.js?v=2.1.5') !!}"></script>
   <!--  <script type="text/javascript" src="{!! asset('public_asset/source/jquery-ui.min.js?v=2.1.5') !!}"></script> -->
	<link rel="stylesheet" type="text/css" href="{!! asset('public_asset/source/jquery.fancybox.css?v=2.1.5') !!}" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="{!! asset('public_asset/source/helpers/jquery.fancybox-buttons.css?v=1.0.5') !!}" />
	<script type="text/javascript" src="{!! asset('public_asset/source/helpers/jquery.fancybox-buttons.js?v=1.0.5') !!}"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="{!! asset('public_asset/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') !!}" />
	<script type="text/javascript" src="{!! asset('public_asset/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7') !!}"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="{!! asset('public_asset/source/helpers/jquery.fancybox-media.js?v=1.0.6') !!}"></script>

	<script type="text/javascript">
			/*
			 *  Simple image gallery. Uses default settings
			 */
	    $('.fancybox').fancybox({
		    padding : 0,
		    arrows: true,
            play: true,
            showCloseButton: true,
            showNavArrows: true,
            hideOnContentClick: true,
		    helpers : {
                thumbs : {
				    width  : 80,
				    height : 40
			    }
		    },
		    onUpdate:function(){
			    $('#fancybox-thumbs ul').draggable({
				    axis: "x"
			    });
			    var posXY = '';
			    $('.fancybox-skin').draggable({
				    axis: "x",
				    drag: function(event,ui){
					    // get position
                        posXY = ui.position.left;
                        // if drag distance bigger than +- 100px: cancel drag function..
                        if(posXY > 100){return false;}
					    if(posXY < -100){return false;}
				    },
				    stop: function(){
                        // ... and get next oder previous image
					    if(posXY > 95){$.fancybox.prev();}
					    if(posXY < -95){$.fancybox.next();}
				    }
			    });
		    }
		    });

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}


	</style>


<script>

$(document).ready(function(){  

	var maxheight = 0;
	$("div.hproduct").each(function(){
		if($(this).height() > maxheight) { maxheight = $(this).height(); }
	});
	$("div.hproduct").height(maxheight);  

    $('nav#menu').mmenu();
    $("img.lazy").lazyload({ placeholder : "http://phoson.vn/images/sp-lazy.jpg",});
	var nsslider1 = $("#ns-slider1");

     nsslider1.owlCarousel({

				pagination: false,

				navigation: true,

				items: 3,

                scrollPerPage: 1,

				addClassActive: true,

				itemsCustom : [

					[0, 1],

					[320, 1],

					[480, 2],

					[700, 2],

					[768, 2],

					[1024, 3],

					[1200, 3],

					[1400, 3],

					[1600, 3]

				]

			});

         $(".ns-slider1Next").click(function (e) {

            e.preventDefault()

            nsslider1.trigger('owl.next');

        })

        $(".ns-slider1Prev").click(function (e) {

            e.preventDefault()

            nsslider1.trigger('owl.prev');

        })

      

        var ccslider = $("#cc-slider");

        ccslider.owlCarousel({

            items : 6,

            itemsCustom : false,

            itemsDesktop : [1199,5],

            itemsDesktopSmall : [980,4],

            itemsTablet: [768,3],

            itemsTabletSmall: false,

            itemsMobile : [479,2],

            pagination: false,

            scrollPerPage: 1,

            autoPlay : 3000,

            stopOnHover : true,

            loop:true,

        });

        

        $(".block-detail:first").show();

        $(".block-list li a").click(function () {

            $(".block-list li a").removeClass("active");

            $(this).addClass("active");

            var activeTab = $(this).attr("href");

            $(".block-detail").hide();

            $(activeTab).fadeIn();

            return false;

        });

        $(".various").fancybox({

    		maxWidth	: 900,

    		maxHeight	: 700,

    		fitToView	: false,

    		width		: '85%',

    		height		: '85%',

    		autoSize	: false,

    		closeClick	: false,

    		openEffect	: 'none',

    		closeEffect	: 'none',

            padding : 0,

            autoscale  : 'true',

            allowfullscreen   : 'true',

             helpers : {

                thumbs : {

				    width  : 150,

				    height : 100

			    }

		    }

    	});

        $(".down").click(function () {

            var $down = $('.content_wrapper');

            var vTop = $down.offset().top-75;

            $("html, body").animate({ scrollTop: vTop },800);

            return false;

        });

    

});
var a = Math.ceil(Math.random() * 9)+ '';
var b = Math.ceil(Math.random() * 9)+ '';
var c = Math.ceil(Math.random() * 9)+ '';
var d = Math.ceil(Math.random() * 9)+ '';
var e = Math.ceil(Math.random() * 9)+ '';

var code = a + b + c + d + e;
document.getElementById("txtCaptcha").value = code;
document.getElementById("txtCaptchaDiv").innerHTML = code;
</script>

<script>

$(window).scroll(function(){

            if ($(this).scrollTop() > 0){

                $('.menutop_wrapper').addClass('fixed');

                $('.tt_left').addClass('thunho');

            }else{

                $('.menutop_wrapper').removeClass('fixed');

                $('.tt_left').removeClass('thunho');

            }

        });

</script>

<script>

function getgio ()

{

            $.fancybox({

            'href': '#showgio',

             padding : 20,

             arrows: true,

                showCloseButton: true,

                showNavArrows: true,

                hideOnContentClick: true,

            });

}

</script>

 <script>

		new WOW().init();

</script>
<script type="text/javascript">
var scrolltotop={setting:{startline:100,scrollto:0,scrollduration:1e3,fadeduration:[500,100]},controlHTML:'<img src="http://phoson.vn/images/icon_top.png" />',controlattrs:{offsetx:5,offsety:5},anchorkeyword:"#top",state:{isvisible:!1,shouldvisible:!1},scrollup:function(){this.cssfixedsupport||this.$control.css({opacity:0});var t=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);t="string"==typeof t&&1==jQuery("#"+t).length?jQuery("#"+t).offset().top:0,this.$body.animate({scrollTop:t},this.setting.scrollduration)},keepfixed:function(){var t=jQuery(window),o=t.scrollLeft()+t.width()-this.$control.width()-this.controlattrs.offsetx,s=t.scrollTop()+t.height()-this.$control.height()-this.controlattrs.offsety;this.$control.css({left:o+"px",top:s+"px"})},togglecontrol:function(){var t=jQuery(window).scrollTop();this.cssfixedsupport||this.keepfixed(),this.state.shouldvisible=t>=this.setting.startline?!0:!1,this.state.shouldvisible&&!this.state.isvisible?(this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]),this.state.isvisible=!0):0==this.state.shouldvisible&&this.state.isvisible&&(this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]),this.state.isvisible=!1)},init:function(){jQuery(document).ready(function(t){var o=scrolltotop,s=document.all;o.cssfixedsupport=!s||s&&"CSS1Compat"==document.compatMode&&window.XMLHttpRequest,o.$body=t(window.opera?"CSS1Compat"==document.compatMode?"html":"body":"html,body"),o.$control=t('<div id="topcontrol">'+o.controlHTML+"</div>").css({position:o.cssfixedsupport?"fixed":"absolute",bottom:o.controlattrs.offsety,right:o.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"Scroll to Top"}).click(function(){return o.scrollup(),!1}).appendTo("body"),document.all&&!window.XMLHttpRequest&&""!=o.$control.text()&&o.$control.css({width:o.$control.width()}),o.togglecontrol(),t('a[href="'+o.anchorkeyword+'"]').click(function(){return o.scrollup(),!1}),t(window).bind("scroll resize",function(t){o.togglecontrol()})})}};scrolltotop.init();
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/58e1bd3bf7bbaa72709c3d27/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
 var img = document.images['captchaimg'];
 img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
</html>

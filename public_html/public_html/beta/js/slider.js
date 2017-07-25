//add pager
jQuery(document).ready(function ($) {
	(function(){
		var slider = {
			init: function(){
				this.casheDOM();
				this.setStyle();
				this.events();
				this.slideStart();
			},
			//cashes DOM and sets variables
			casheDOM: function(){
				this.$slideBox = $('#slide-box');
				this.$slides = this.$slideBox.find('ul');
				this.$buttonPre = this.$slideBox.find('.pre');
				this.$buttonNext = this.$slideBox.find('.next');
				this.$slideCount = this.$slides.find('li').length;
				this.$slideWidth = this.$slides.find('li').width();
				this.$slideHeight = this.$slides.find('li').height();
				this.slidesWidth = this.$slideCount * this.$slideWidth;
			},
			//adjusts css for scaleability
			setStyle: function(){
				this.$slideBox.css({width: this.$slideWidth, height: this.$slideHeight});
				this.$slides.css({ width: this.slidesWidth , marginLeft: - this.$slideWidth });
				this.$slides.find('li:last-child').prependTo(this.$slides);
			},
			//on mouse enter stop slides on mouse leave start slides
			//on click change slide
			events: function(){
				this.$slideBox.on({
					mouseenter: slider.slideStop,
					mouseleave: slider.slideStart
				});
				this.$buttonPre.on('click',function(){slider.slideLeft();});
				this.$buttonNext.on('click',function(){slider.slideRight();});
			},
			slideRight: function(){
				this.$slides.animate({left: - this.$slideWidth},this.animSpeed,function(){
					slider.$slides.find('li:first-child').appendTo(slider.$slides);
					slider.$slides.css('left', '');
				});
			},
			slideLeft: function(){
				this.$slides.animate({left: + this.$slideWidth},this.animSpeed,function(){
					slider.$slides.find('li:last-child').prependTo(slider.$slides);
					slider.$slides.css('left', '');
				});
			},
			slideStart: function(){
				if(!this.interval){
					slider.interval = setInterval(function(){slider.slideRight();},4000);
				}
			},
			slideStop: function(){
				clearInterval(slider.interval);
			},
			animSpeed: 750
		};
		slider.init();
	})();
});    

/*
$(document).ready(function(){
    var animSpeed = 1000;
    var pause = 4000;
    var width = "100%";
    var atSlide = 1;
    //cache DOM
    var $slider = $("#slider");
    var $slideBox = $slider.find(".slides");
    var $slides = $slideBox.find(".slide");
    var $img = $slides.find(".slide-img");
    //
    var interval;
    var clicked = false;
    //
    function imgSize(){
        $img
    }
    function startSlides(){
        interval = setInterval(function(){
            $slideBox.animate({'margin-left': '-='+width},animSpeed, function(){
                atSlide++;
                if(atSlide >= $slides.length){
                    atSlide = 1;
                    $slideBox.css('margin-left',0);
                }
                console.log(atSlide);
            });
        },pause);
    }
    function stopSlides(){
        clearInterval(interval);
    }
    $("#pre").click(function(){
        if(clicked==false){
            clicked=true;
            setTimeout(function(){
                clicked=false;
            },1000);
            if(atSlide!=1){
                atSlide--;
                $slideBox.animate({'margin-left': '+='+width},animSpeed);
                console.log(atSlide);
            }else if(atSlide<=1){
                atSlide = $slides.length;
                $slideBox.css('margin-left','-800%');
                $slideBox.animate({'margin-left': '+='+width},animSpeed);
                atSlide--;
                console.log(atSlide);
            }
        }
    });
    $("#next").click(function(){
        if(clicked==false){
            clicked=true;
            setTimeout(function(){
                clicked=false;
            },1000);
            if(atSlide!=$slides.length){
                atSlide++;
                $slideBox.animate({'margin-left': '-='+width},animSpeed);
                console.log(atSlide);
            }else if(atSlide>=$slides.length){
                atSlide = 1;
                $slideBox.css('margin-left',0);
                $slideBox.animate({'margin-left': '-='+width},animSpeed);
                atSlide++;
                console.log(atSlide);
            }
        }
    });
    imgSize();
    startSlides();
    $slider.on('mouseenter',stopSlides).on('mouseleave',startSlides);
});
*/
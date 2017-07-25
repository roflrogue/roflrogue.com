//add pagentor

$(document).ready(function ($) {
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
            console.log("slides started");
			if(!this.interval){
				slider.interval = setInterval(function(){slider.slideRight();},4000);
			}
		},
		slideStop: function(){
            console.log("slides stopped");
			clearInterval(slider.interval);
		},
		animSpeed: 750
	};
	slider.init();
});    

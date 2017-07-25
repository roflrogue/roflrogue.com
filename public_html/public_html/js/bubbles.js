jQuery(document).ready(function(){
    var canvas = document.getElementById("header-canvas");
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    var context = canvas.getContext("2d");
    var timer = 10;
    var bubbles = [];
    function init(){
        loop();
    }
    function update(){
        $(window).resize(function(){
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
        if(timer<=0){
            var bubble = {
                x:Math.random()*canvas.width,
                y:canvas.height + 25,
                radius:Math.random()*20,
                speed: 1,
                color: "white"
            }
            bubble.speed =.5-(1/(bubble.radius));
            if(bubble.speed>0){bubbles.push(bubble);}
            //console.log("new bubble");
            timer = Math.random() * (260 - 120) + 120;
        }
        for(i in bubbles){
            bubbles[i].y-=bubbles[i].speed;
            if(bubbles[i].y<-25){
                bubbles.splice(i,1);
                //console.log("bubble deleted");
            }
        }
        timer--;
    }
    function render(){
        
        for(i in bubbles){
            var bubble = bubbles[i];
            context.clearRect(
                bubble.x-(1.2*bubble.radius),
                bubble.y,
                bubble.radius*2.4, 
                bubble.radius*1.25
            );
            context.beginPath(); 
            context.arc(
                bubble.x,
                bubble.y,
                bubble.radius,
                2*Math.PI,
                false
            );
            context.fillStyle = bubble.color;
            context.fill();
        }
    }
    function loop(){
        requestAnimFrame(function(){
           loop(); 
        });
        update();
        render();
    }
    init();
});
    // shim layer with setTimeout fallback
    window.requestAnimFrame = (function(){
        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame ||window.oRequestAnimationFrame || window.msRequestAnimationFrame || function( callback ){
            window.setTimeout(callback, 1000 / 60);
        };
})();
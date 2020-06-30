<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Flappy 2</title>

    <style>
    #myCanvas {background-image: url("bg_flappy.jpg"); background-repeat: no-repeat; background-size: cover;}
  </style>

  </head>

  <body>
<canvas id="myCanvas" width="600" height="800"></canvas>

  <script>

  var canvas = document.getElementById("myCanvas");
  var ctx = canvas.getContext("2d");

// load images

 var bird = new Image();
 var topPipe = new Image();
 var bottomPipe = new Image();

 bird.src = "bird2.png";
 topPipe.src = "pipe_top.png";
 bottomPipe.src = "pipe_bottom.png";

 // variables

var gap = 100;
var constant = topPipe.height + gap;

var bX = 50;
var bY = 400;
var gravity = 1;

var pipe = [];

pipe[0] = {
  x : canvas.width,
  y : 0
};

// draw images

function draw() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
for (var i = 0; i < pipe.length; i++) {

  ctx.drawImage(topPipe,pipe[i].x, pipe[i].y);
  ctx.drawImage(bottomPipe, pipe[i].x, pipe[i].y+constant); //0 + topPipe + gap

  pipe[i].x--;

  if (pipe[i].x == 150) {
    pipe.push({
      x : canvas.width,
      y : Math.floor(Math.random()*topPipe.height)-topPipe.height
    })
  }
}

ctx.drawImage(bird, bX, bY, 90, 70);
//ctx.clearRect(bird, bX, bY, 90, 70);
bY += gravity;



}
  setInterval(draw, 10);


//  BALL UP
document.addEventListener("keydown", up);

function up(){
  bY -= 20;
}





  </script>
  </body>
</html>

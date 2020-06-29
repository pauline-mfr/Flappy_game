<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Flappy</title>

    <style>
    #myCanvas {background-image: url("bg_flappy.jpg"); background-repeat: no-repeat; background-size: cover;}
    #bird {display: none;}
    </style>

  </head>

  <body>
    <img id="bird" src="bird.png" alt="">
  <canvas id="myCanvas" width="500" height="800"></canvas>
  <script>


  var canvas = document.getElementById("myCanvas");
  var ctx = canvas.getContext("2d");
  var img = document.getElementById('bird');
  var x = canvas.width/2;
  var y = canvas.height/2;
  var dx = 0; // déplacement en X
  var dy = 1; // déplacement en Y
  var gravity = 1;
  var speed = 0;

  img.addEventListener("load", display);
  function display(){
    ctx.drawImage(img, 50, 25, 100,70);
  }




function dessineBall() {
      ctx.beginPath();
      ctx.arc(x, y, 10, 0, Math.PI*2);
      ctx.fillStyle = "#0095DD";
      ctx.fill();
      ctx.closePath();
  }
  function chute() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      dessineBall();
      x += dx;
      y += dy;

      //stop ball
      if (y == canvas.height) {
        dy = 0;
      }
  }

  //dessineBall();
  setInterval(chute, 10);

 //ball up
 window.addEventListener("keydown", up, true);
  function up(e) {
    if (e.keyCode == "32") {

      ctx.clearRect(0, 0, canvas.width, canvas.height);
      y = y - 50;
      ctx.fill(x, y, 10, 0, Math.PI*2);
    }
  }






  </script>
  </body>
</html>

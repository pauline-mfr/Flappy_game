<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
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
  var gameOver = new Image();

  bird.src = "bird2.png";
  topPipe.src = "pipe_top.png";
  bottomPipe.src = "pipe_bottom.png";
  gameOver.src = "game_over.png";

  // load sounds

  var lift = new Audio();
  var step = new Audio();
  var hit = new Audio();

  lift.src = "lift.mp3";
  step.src = "step.mp3";
  hit.src = "hit.mp3";

  // variables

  var bX = 50;
  var bY = 400;
  var gravity = 1;
  var gap = 150;
  var constant = topPipe.height + gap;
  var running = setInterval(draw, 10);
  var score = 0;
  var pipe = [];

  pipe[0] = {    // position 1st pipe
    x : canvas.width,
    y : 0
  };

   // draw images

  function draw() {

    ctx.clearRect(0, 0, canvas.width, canvas.height);

    function restart() {
      //setTimeout(restart(), 2000);  //tentative delay 2s
      ctx.fillStyle = "#fff";
      ctx.font = "28px 'Press Start 2P'";
      ctx.fillText ("RESTART", 200, 600);
      ctx.fillStyle = "#fff";
      ctx.font = "14px 'Press Start 2P'";
      ctx.fillText ("press enter", 218, 620);
    }

    function endGame() {
      gravity = 0;
      clearInterval(running);
      ctx.drawImage(gameOver, 150, 280, 300, 157);
      hit.play();
    }

    for (var i = 0; i < pipe.length; i++) { // pipe loop

      ctx.drawImage(topPipe,pipe[i].x, pipe[i].y);
      ctx.drawImage(bottomPipe, pipe[i].x, pipe[i].y+constant); //0 + topPipe + gap

      pipe[i].x--; //incrémente la position en x

      if (pipe[i].x == 150) { // si pipe atteint 150 > push nouveau pipe
        pipe.push({
          x : canvas.width,
          y : Math.floor(Math.random()*topPipe.height)-topPipe.height
        });
      } // FIN APPARITION PIPES

      // hit pipe

      if (bX + bird.width >= pipe[i].x && bX <= pipe[i].x + topPipe.width && (bY <= pipe[i].y + topPipe.height || bY + bird.height >= pipe[i].y + constant) || (bY + bird.height == canvas.height)) {
        endGame();
        restart();

      } // END HIT

      // SCORE

      if (pipe[i].x == 15) { //si pipe à 5px sans game over, score +1
        score++;
        step.play();
      }

    } // FIN BOUCLE PIPES

    ctx.drawImage(bird, bX, bY,);

    // make it fall
    bY += gravity;

    // display score

    ctx.fillStyle = "#fff";
    ctx.font = "25px 'Press Start 2P'";
    ctx.fillText ("Score : "+score, 200, 50);

  } // END OF DRAW FONCTION

  running; // intervalle

  //  BALL UP
  window.addEventListener("keydown", up, true); // spacebar
  function up(e){
    if (e.keyCode == "32") {
      bY -= 25;
      lift.play();
    }
  }

  document.addEventListener("click", up); // click

  function up(){
    bY -= 25;
    lift.play();
  }

  // RELOAD
  window.addEventListener("keydown", reload, true);
  function reload(e) {
    if (e.keyCode == "13") {
      location.reload();
    }
  }
  </script>
</body>
</html>

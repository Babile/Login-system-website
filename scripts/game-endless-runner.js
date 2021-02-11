// Getting canvas
const canvas = document.getElementById('game');
const ctx = canvas.getContext('2d');

// Variables Controller, View, Player
let view;
let controler;
let player;

// Variables key press
let keys = {};
let touchScreen = false;
let mouseLeftClick = false;

// Variables list of object that is creater. In list is Player in position 0
let objects = [];

// Variables for how fast will run player, score and high score that player scored in game
let gameSpeed;
let score;
let highScore;

// Variables for responding obstacle
let initialObjectSpondTime = 250;
let objectSpondTime = initialObjectSpondTime;

// Variables for bacground game image, obstacle image, sound of game when player hit obstacle and game background width 
let gameBackgroundWidth = 0; 
let gameBackground = new Image();
let obstacleImage = new Image();
let gameDeadEffect = new Audio();

// Event Listeners
document.addEventListener('keydown', function (evt) {
    keys[evt.code] = true;
});
document.addEventListener('keyup', function (evt) {
    keys[evt.code] = false;
});

canvas.addEventListener('mousedown', function(evt) {
    if(evt.button == 0) {
        mouseLeftClick = true;
        evt.preventDefault();
    }
}, { passive: false });
canvas.addEventListener('mouseup', function(evt) {
    if(evt.button == 0) {
        mouseLeftClick = false;
        evt.preventDefault();
    }
}, { passive: false });

canvas.addEventListener('touchstart', function (evt) {
    touchScreen = true;
    evt.preventDefault();
}, { passive: false });
canvas.addEventListener('touchend', function (evt) {
    touchScreen = false;
    evt.preventDefault();
}, { passive: false });

//Function that run all code
function GameLoop() {
    requestAnimationFrame(GameLoop);
    
    --objectSpondTime;
    if (objectSpondTime <= 0) {
        controler.ObejctMake(17, 43);
        view.Draw();
        
        objectSpondTime = initialObjectSpondTime - gameSpeed * 4;
        
        if (objectSpondTime < 40) {
            objectSpondTime = 40;
        }
    }
    
    //Check is player hit Obstacle and reset game
    for (let i = 1; i < objects.length; i++) {
        if ((player.xCord < objects[i].xCord + objects[i].width) && (player.xCord + player.width > objects[i].xCord) &&
            (player.yCord < objects[i].yCord + objects[i].height) && (player.yCord + player.height > objects[i].yCord)) {
			window.navigator.vibrate(50);
			gameDeadEffect.play();
            objects = [];
            objects.push(player);
            objectSpondTime = initialObjectSpondTime;
            gameSpeed = 2;
            score = 0;
            localStorage.setItem("highScoreStore", highScore);
            break;
        }
    }

    if(keys['Space'] || touchScreen || mouseLeftClick) {
        player.Jump();
    }

    controler.ObjectMove(gameSpeed);
    view.Draw();
    controler.ObejctDestroy();
    view.Draw();

    player.Move();
    view.Draw();

    ++score;

    if(highScore <= score){
        highScore = score;
    }

    ctx.fillText("Score: " + score, 3, 22);
    ctx.fillText("High score: " + highScore, 186, 22);

    if(Math.abs(gameBackgroundWidth) >= gameBackground.width - canvas.width){
        gameBackgroundWidth = 0;
    }

    if(gameSpeed >= 38) {
        gameSpeed = gameSpeed;
        gameBackgroundWidth = gameSpeed;
    }
    else {
        gameSpeed += 0.003;
        gameBackgroundWidth -= gameSpeed;
    }
}

//Main function of game
function GameDemo() {
    view = new View();
    controler = new Controller();
    ctx.font = "7px GameFont";
   
    player = new Player(4, 20, 40, 35);
    objects.push(player);
    gameSpeed = 2;
    score = 0;
   
    gameBackground.src = "img/game-background.png";
    obstacleImage.src = "img/game-obstacle-trees.png";
    gameDeadEffect.src = "sound/game-dead-effect.mp3";

    if(localStorage.getItem("highScoreStore") === null) {
        highScore = 0;
    }
    else {
       highScore = parseInt(localStorage.getItem("highScoreStore"));
    }

    requestAnimationFrame(GameLoop);
}

GameDemo();
const canvas = document.getElementById('game');
const ctx = canvas.getContext('2d');

// Variables
let keys = {};
let touchScreen = false;
let objects = [];
let gravity;
let gameSpeed;
let controler;
let score;
let highScore;
let player;
let initialObjectSpondTime = 250;
let objectSpondTime = initialObjectSpondTime;

// Event Listeners
document.addEventListener('keydown', function (evt) {
    keys[evt.code] = true;
});
document.addEventListener('keyup', function (evt) {
    keys[evt.code] = false;
});

document.getElementById("gameScene").addEventListener('touchstart', function (evt) {
    touchScreen = true;
    evt.preventDefault();
}, { passive: false });
document.getElementById("gameScene").addEventListener('touchend', function (evt) {
    touchScreen = false;
    evt.preventDefault();
}, { passive: false });

class Obstacle {
    constructor(xCord, yCord, height, width, color) {
        this.xCord = xCord;
        this.yCord = yCord;
        this.height = height;
        this.width = width;
        this.color = color;
        this.name = "obstacle";
    }
}

class Player extends Obstacle {
    constructor(pXCord, pYCord, pHeight, pWidth, pColor) {
        super(pXCord, pYCord, pHeight, pWidth, pColor);
        this.name = "player";

        this.dy = 0;
        this.jumpForce = 11;
        this.originalHeight = pHeight;
        this.grounded = false;
        this.jumpTimer = 0;
    }

    PlayerJumpControle() {
        // Jump
        if(keys['Space'] || touchScreen) {
          this.Jump();
        } 
        else {
          this.jumpTimer = 0;
        }
    
        this.yCord += this.dy;
    
        // Gravity
        if(this.yCord + this.height < canvas.height) {
          this.dy += gravity;
          this.grounded = false;
        } 
        else {
          this.dy = 0;
          this.grounded = true;
          this.yCord = canvas.height - this.height;
        }
    }

    Jump() {
        if(this.grounded && this.jumpTimer == 0) {
          this.jumpTimer = 1;
          this.dy = -this.jumpForce;
        } 
        else if(this.jumpTimer > 0 && this.jumpTimer < 8) {
          this.jumpTimer++;
          this.dy = -this.jumpForce - (this.jumpTimer / 50);
        }
    }
}

class View {
    Draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for(let i = 0; i < objects.length; i++){
            ctx.beginPath();
            ctx.fillStyle = objects[i].color;
            ctx.fillRect(objects[i].xCord, objects[i].yCord, objects[i].width, objects[i].height);
            ctx.closePath();
        }   
    }
}

class Controller {
    ObejctMake(min, max) {
        let size = Math.round(Math.random() * (max - min) + min);
        let obstacle = new Obstacle((canvas.width + 150), (canvas.height - size), size, size, '#003cb3');
        if(obstacle.width > player.width) {
            let temp = obstacle.width - player.width;
            obstacle.width -= temp;
        }
        objects.push(obstacle);
    }

    ObejctDestroy() {
        for(let i = 1; i < objects.length; i++){
            if(objects[i].xCord < -150) {
                objects.splice(i, 1);
            }
        }   
    }

    ObjectMove(gameSpeed) {
        for(let i = 1; i < objects.length; i++){
            objects[i].xCord -= gameSpeed;
        } 
    }
}

function GameLoop() {
    requestAnimationFrame(GameLoop);
    
    --objectSpondTime;
    if (objectSpondTime <= 0) {
        controler.ObejctMake(20, 70);
        view.Draw();
        
        objectSpondTime = initialObjectSpondTime - gameSpeed * 4;
        
        if (objectSpondTime < 40) {
            objectSpondTime = 40;
        }
    }
    
    for (let i = 1; i < objects.length; i++) {
        if ((player.xCord < objects[i].xCord + objects[i].width) && (player.xCord + player.width > objects[i].xCord) &&
            (player.yCord < objects[i].yCord + objects[i].height) && (player.yCord + player.height > objects[i].yCord)) {
            objects = [];
            objects.push(player);
            objectSpondTime = initialObjectSpondTime;
            gameSpeed = 2;
            gravity = 1;
            score = 0;
            break;
        }
    }

    controler.ObjectMove(gameSpeed);
    view.Draw();
    controler.ObejctDestroy();
    view.Draw();
    player.PlayerJumpControle();
    ++score;

    if(highScore <= score){
        highScore = score;
    }

    ctx.fillText("Score: " + score, 5, 22);
    ctx.fillText("High score: " + highScore, 220, 22);

    if(gameSpeed >= 38) {
        gameSpeed = gameSpeed;
    }
    else {
        gameSpeed += 0.003;
    }
}


function GameDemo() { 
   view = new View();
   controler = new Controller();

   ctx.font = "10px Comic Sans MS";
   player = new Player(5, 110, 40, 30, '#FF0000');
   objects.push(player);
   gameSpeed = 2;
   gravity = 1;
   score = 0;
   highScore = 0;

   requestAnimationFrame(GameLoop);
}

GameDemo();
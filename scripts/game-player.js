//Player object
class Player extends Obstacle {
    constructor(pXCord, pYCord, pHeight, pWidth) {
        super(pXCord, pYCord, pHeight, pWidth);
        this.name = "player";
		this.img = new Image();
        this.img.src = "img/game-t-rex.png";

        this.vlastitiSpeedYCord = 0;
        this.gravity = 0.4;
    }

    Jump() {
        if(this.yCord == (canvas.height - 45)){
            this.vlastitiSpeedYCord = -8.5;
        }
    }

    Move() {
        this.yCord += this.vlastitiSpeedYCord;
        this.vlastitiSpeedYCord += this.gravity;
        this.yCord = Math.min(Math.max(this.yCord, 0), (canvas.height - 45));
    }
}

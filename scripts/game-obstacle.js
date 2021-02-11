//Base object
class Obstacle {
    constructor(xCord, yCord, height, width) {
        this.xCord = xCord;
        this.yCord = yCord;
        this.height = height;
        this.width = width;
        this.name = "obstacle";
		this.img = new Image();
    }
}
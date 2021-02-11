//Controler for muving object
class Controller {
    ObejctMake(min, max) {
        let size = Math.round(Math.random() * (max - min) + min);
        let obstacle = new Obstacle((canvas.width + 250), (canvas.height - (size + 5)), size, (size + size));
		obstacle.img = obstacleImage;
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
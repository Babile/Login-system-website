//Controler for View
class View {
    Draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for(let i = 0; i < objects.length; i++){
            ctx.beginPath();
            ctx.drawImage(gameBackground, gameBackgroundWidth, canvas.height - gameBackground.height + 4);
            ctx.drawImage(objects[i].img ,objects[i].xCord, objects[i].yCord, objects[i].width, objects[i].height);
            ctx.closePath();
        }   
    }
}
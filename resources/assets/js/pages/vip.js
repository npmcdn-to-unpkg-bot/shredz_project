slide( $('#move_workout_videos'), $('#workout_videos'));
slide( $('#move_recipes'), $('#recipes'));
show($('.video-highlight'), $('#video-overlay'));
hide($('#video-overlay'));
setWidth($('#workout_videos'));

function setWidth(aElement){
    var childrenSize = aElement.children().length;
    aElement.width(childrenSize *50 + '%');
}//setWidth

function slide (aClicked, aSlide){
    var clicksCount = 0;
    aClicked.on('click', function(){
        var moveMe = aSlide;
        var childrenSize = moveMe.children().length;
        clicksCount++;
        if(clicksCount >= childrenSize ){
            moveMe.animate({"right":"0"});
            clicksCount = 0;
            return;
        }
        moveMe.animate({"right":"+=50%"});
    });
}//slide

function show(aClicked, aOverlay){
    aClicked.on('click', function(){
        aOverlay.css({'display':'block'});
    });
}//show

function hide(aOverlay){
    aOverlay.on('click', function(){
        aOverlay.css({'display':'none'});
    }).children().click(function(e) {
        return false;
    });
}//hide
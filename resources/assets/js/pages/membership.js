
//show membership preview and bind button
$("body").on("click",".left_grid",function(){

    if ($(this).attr("id") !="the_banner") {
        $("body").colorbox({html:'<div id="white_frame"><h2>FREE PREVIEW OF VIP MEMBERSHIP CONTENT</h2><iframe width="" height="" src="https://www.youtube-nocookie.com/embed/oxxgoz1ge7g" frameborder="0" allowfullscreen></iframe>'
        + '<img id="get_mem" src="/images/notifymem.png"/></div><div id="button_hold"><button id="red_left">SIGN UP NOW</button><button id="grey_right">LEARN MORE</button></div> '});

        bindButton();
    }
});//body click

//take user to cart with flag to add subscription
function bindButton() {
    $("#red_left").on("click",function(e){
        e.preventDefault();
        window.location.href="/cart/?addSub=yes";
    });
}//bind button

//additional subscription redirect
$("body").on("click","#red_left",function(e){
    e.preventDefault();
    window.location.href="/cart/?addSub=yes";
});//body click

$("body").on("click",".right_grid",function(e){

    if ($(this).attr("id") !="the_banner") {

        $("body").colorbox({html:'<div id="white_frame"><h2>FREE PREVIEW OF VIP MEMBERSHIP CONTENT</h2><iframe width="" height="" src="https://www.youtube-nocookie.com/embed/oxxgoz1ge7g" frameborder="0" allowfullscreen></iframe>'
        + '<img id="get_mem" src="/images/notifymem.png"/></div><a href="/cart/?addSub=yes"> <div id="button_hold"><button id="red_left">SIGN UP NOW</button></a><button id="grey_right">LEARN MORE</button></div> '});
    }
});//body click
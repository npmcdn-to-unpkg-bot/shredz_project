<script>
/*
* Shredz Utilities
*
*
* */

function defenestrate(el, selected)
{
    if(!selected)
    {
        selected = 0;
    }
    //console.log(selected);
    //console.log(el);

    var options = [];
    var largest = 0;
    el.find("p").each(function(){
        if($(this).width() > largest)
        {
            largest = $(this).width();
        }
        options.push($(this));
        $(this).remove();
    });
    el.width(largest + 48);

    el.append('<p class="value">'+options[selected].text()+'</p>');
    el.append('<img src="{{ asset('images/droparrow.png') }}">');
    options[selected].addClass("selected");

    $(el).on("click", function(){
        if(el.find(".drop").length != 0)
        {
            el.find(".drop").remove();
            el.removeClass("open");
        }
        else
        {
            el.append('<div class="drop"></div>');
            el.addClass("open");
            el.find(".drop").width(el.width());
            for(var i = 0;i < options.length;i++)
            {
                el.find(".drop").append(options[i]);

            }
            el.find(".drop").scrollTop(el.find(".drop .selected").position().top - 46);
            //click events in different scope
            el.find(".drop p").each(function(n){
                $(this).on("click", function(){
                    var val = $(this).text();
                    el.find(".value").html(
                        val +
                        '<img src="{{ asset('images/droparrow.png') }}">'
                    );
                    el.find(".selected").removeClass("selected");
                    $(this).addClass("selected");
                });
            });
        }
    });
}//defenestrate

//clicking off of a select will close any open ones
function initSelectFunctionality()
{
    $(document).on("click", function(event){
        var target = $(event.target);
        $(".select").each(function(){

            if($(this)[0] == target[0] || $(this)[0] == target.parent()[0] || $(this)[0] == target.parent().parent()[0])
            {
                //do nothing
            }
            else
            {
                $(this).find(".drop").remove();
                $(this).removeClass("open");
            }
        });
    });
}//init sleect functionality

function microwave(el)
{
    var l = el.length;
    el.each(function(n){
        $(this).append('<div></div>');
        if(n == 0 && l != 1)
        {
            $(this).addClass("active");
        }
        $(this).on("click", function(){
            if(l == 1)
            {
                $(this).toggleClass("active");
                if($(this).hasClass("active"))
                {
                    $(this).addClass("checked");
                }
                else
                {
                    $(this).removeClass("checked");
                }
            }
            else
            {
                $(this).parent().find(".active").removeClass("active");
                $(this).addClass("active");
            }
        });
    });
}//microwave

function loginPopup()
{
   
 //   $("body").css("overflow", "hidden");
    $("body").append(
            '        <div class="overlay">' +
            '            <div class="login">' +
            '                <img onclick="closePopup()" style="position: absolute; right: 5px; top: 5px; left: initial; cursor: pointer; width: 25px;" src="{{ asset('images/white-x.png') }}">' +
            '                <div class="head">' +
                     
            '                </div>' +
            '                <div class="body sign_in_body">' +
   
            '                    <input id="username" class="username login_input" name="email" type="text" placeholder="Email">' +
            '                    <input id="password" class="password login_input" name="password" type="password" placeholder="Password">' +
            '                     <span onClick="popoutForgot()" class="forgot_password_text">Forgot Passowrd?</span>' + 
     
            '                    <button id="login">SIGN IN</button>' +

            '  <p class="light no_acct"><i>Don\'t have an account? <span><a href="/createAccount">Sign Up</a></span></i></p>' +
            '                </div>' +
            '                <div class="tail">' +
            '                    <div class="ghLine"></div>' +
            '                    <h3>OR</h3>' +
            '                    <div class="ghLine"></div>' +
            '                    <div id="instagram"><p>LOGIN WITH INSTAGRAM</p></div>' +
            '                    <div id="google"><p>LOGIN WITH GOOGLE</p></div>' +
            '                    <div id="facebook"><p>LOGIN WITH FACEBOOK</p></div>' +
            '                </div>' +
            '            </div><!-- login -->' +
            '        </div>'
    );

    bindEnterPress();
   // <!--                          <p>Remember My Password</p -->
    $("#login").on("click", function(){
    
    $("#login").attr("disabled",true).text("LOADING");
        $.ajax({
            //url : "/auth/login?email="+$("#username").val()+"&password="+$("#password").val(),
            url : "/auth/login",
            type : "post",
            data : {
                "email" : $("#username").val(),
                "password" : $("#password").val()
            },
            success : function(data) {
                if(data.data.auth)
                {
                
                    $("#login").removeAttr("disabled").text("SUCCESS").css({
                    "background-color":"#64e864"
                    });
                    setTimeout(function(){
                        window.location.reload(true);
                    },400);
                    
                }
                else
                {
                    console.log(data);
                    fixButton();
                    toast("Username/Password Incorrect");
                }
            },
            error : function(err) {
                console.log(err.responseText);
                fixButton();
                toast(err.responseText);
            },
            complete : function() {
              
            }
        });
    });
 
}//login popup 

function bindEnterPress() {

    $("#password").keypress(function(e) {
    if(e.which == 13) {
        $("#login").trigger("click");
    }
    else
    {
       
    }
    
     $('input.login_input').bind('focusin focus', function(e){
          e.preventDefault();
        });
    });

}


function toast(text) {
   $(".login").append("<div class='toast'>"+text+"</div>");
   $(".toast").css({
    "position":"absolute",
    "bottom":"10px",
     "width":"80%",
     "left":"10%",
      "background-color":"rgba(0,0,0,.8)",
      "color":"white",
      "padding":"10px 5px",
      "border-radius":"3px",
      "text-align":"center",
      "z-index":"1000",
      "border":"1px solid #cc0000"
   });
   
   setTimeout(function(){
        $(".toast").fadeOut(1000);
        
        setTimeout(function(){
            $(".toast").remove(); 
        },1000);
    
   },2000);
}

function fixButton() {
    $("#login").removeAttr("disabled").text("LOGIN");
}

function closePopup()
{
    $(".overlay").remove();
    $("body").css("overflow", "");
}//close popup

    function commas(n)
    {
        var s = n.toString();
        var a = s.split(".");

        a[0] = a[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        if(a[1])
        {
            if(a[1].length == 1)
            {
                a[1] += "0";
            }
            a[1] = a[1].substr(0,2);
        }
        else
        {
            a[1] = "00";
        }

        return a[0] +"."+ a[1];
    }//commas

    
    
function popoutForgot() {
var len = $("#forgot_password_wrapper").length;

        if (len == 0) {
 

    $(".sign_in_body").append("<div id='forgot_password_wrapper'>"+
                              "<div id='close_forgot' onClick='cancelForgot()'>Back</div>"+
                              "<input type='email' name='forgotemail' id='forgot_email' placeholder='Email Address'/> "+
                              "<button id='forgot_my_pass_button'>RESET PASSWORD</button></div>");
                              
    }
}


function cancelForgot() {
    $("#forgot_password_wrapper").remove();
}
    
</script>
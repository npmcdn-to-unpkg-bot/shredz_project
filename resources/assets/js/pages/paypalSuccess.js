
$(document).on("ready", function(){

    //wait for auth token to be available to proceed
    var poll = setInterval(function(){
        if(cart.authToken)
        {
            clearInterval(poll);
            submitPayToken();
        }
    }, 10);

});//document ready

function submitPayToken()
{
    cart.payPal(
        {
            success : function(data) {

                cart.sendPayment(
                    {
                        "token" : data.data.token
                    },
                    {
                        "success" : function(res) {
                            setTimeout(function(){
                                //redirect user to thank you page on success
                                window.location.href = "/thanks/" + res.meta["_self"].substr(res.meta["_self"].indexOf("/orders/")+8);
                            }, 400);
                        },
                        "error" : function(err) {
                            //console.log(err);
                            setTimeout(function(){
                                //redirect user to cart on error
                                window.location.href = "/cart";
                            }, 400);
                        }
                    }
                );
            },
            error : function(err) {
                //console.log(err);
                setTimeout(function(){
                    window.location.href = "/cart";
                }, 400);
            }
        }
    );
}//submit pay token

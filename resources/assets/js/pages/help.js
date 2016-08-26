$(document).on("ready", function()
{
    setupFaqButtons();
    $("#support_ticket_form button").on("click", function(){
        sendSupportTicket();
    });
});//document ready

//bind buttons to show and hide respective help text sections
function setupFaqButtons()
{
    $(".faqButtons button").each(function(n){
        $(this).on("click", function(){

            var id = $(this).attr("name");

            var toggle = $(this).hasClass("active");
            if (!toggle)
            {
                var el = $(".active");
                if (el)
                {
                    var d =  el.attr("name");
                    $("#"+d).hide(0);
                    el.removeClass("active");
                }

                var openid = $(this).attr("name");
                $("#"+openid).show(0);
                $(this).toggleClass("active");
            }
            else
            {
                $("#"+$(this).attr("name")).hide(0);
                $(this).removeClass("active");
            }
        });//this click
    });//faqbuttons button each
}//setup faq buttons

function sendSupportTicket()
{
    //support ticket parameters
    var obj = {
        name : $("#support_ticket_form #fullname").val(),
        email : $("#support_ticket_form #email").val(),
        email_confirmation : $("#support_ticket_form #email_verify").val(),
        message : $("#support_ticket_form textarea").val()
    };
   $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
    });

    $.ajax({
        type : "post",
        url : "/support_ticket",
        data : obj,
        success : function(res) {
            console.log(res.data);
            if(res.error == null)
            {
                $("#support_ticket_form #fullname").val('');
                $("#support_ticket_form #email").val('');
                $("#support_ticket_form #email_verify").val('');
                $("#support_ticket_form textarea").val('');
                $('.support-error-list').hide();
                $('.support-success-message').html('<p>'+res.data+'</p>');
                $('.support-success-message').show();

            }
        },
        error : function(err) {
            var parsed = JSON.parse(err.responseText);

            var errorList = '<ul>';
            if(Object.keys(parsed).length > 1){
                $.each(parsed, function(i, val){
                    errorList += '<li>'+val[0]+'</li>';                                
                });                                    
            }else{
                 $.each(parsed, function(i, val){
                    if(Array.isArray(val)){
                        errorList += '<li>'+val[0]+'</li>'; 
                    }else{
                        errorList += '<li>'+val+'</li>';                                           
                    }
                });
            }
                $('.support-success-message').hide();
                errorList += '</ul>';
                $('.support-error-list').html(errorList);
                $('.support-error-list').show();

        }
    });
}//sendSupportTicket

loadAccount();
settingsMobileNav();

function loadAccount() {

    $('.mobile-settings-nav h2').html('Account <span class="turny droparrownav"></span>');

    $("#my_account_p").addClass("active");

    // $('.mobile-settings-nav h2').html('Account');

    $(".mobile-settings-nav h2").on("click", function(){
        $(this).find(".turny").toggleClass("turned");
        $('.mobile-settings-nav ul').toggle();
    });

    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 5) {
            $(".mobile-settings-nav h2").css({"margin-top":"0"});
        }
    });
    $(window).on("scroll", function () {
        if ($(this).scrollTop() < 5) {
            $(".mobile-settings-nav h2").css({"margin-top":"28px"});
        }
    });
    if(typeof userimg !== 'undefined'){
        $(".account #imgup").attr("src", userimg);
    }

    $("#imgup").on("click", function(){
        $("#imgin").trigger("click");
    });

    $("#imgin").on("change", function(){
        var fd = new FormData();
        //fd["image"] = $("#imgin")[0].files[0];
        fd.append('image', $("#imgin")[0].files[0]);

        $.ajax({
            type : "post",
            url : "/user/image",
            contentType: false,
            processData: false,
            data : fd,
            success : function(data){

                $("#imgup").attr("src", data.data.url);
            }
        });
    });

    //$('#phone').formance('format_phone_number');
    initSelect();
    /*$(".select").each(function(){
     defenestrate($(this));
     });*/


    dob = dob.split(' ')[0].split('-');


    if(dob[0] == "0000")
    {
        dob[0] = new Date().getFullYear() - 18;
    }
    if(dob[1] == "00")
    {
        dob[1] = "01";
    }
    if(dob[2] == "00")
    {
        dob[2] = "01";
    }

    /*console.log("user weight");
     console.log(weight);*/

    defenestrate($("#month"), Number(dob[1]) -1);
    defenestrate($("#day"), Number(dob[2]) -1);
    defenestrate($("#year"), new Date().getFullYear() - 18 - Number(dob[0]));
    initRadio();


    if(gender != "male")
    {
        $(".gender .radio").each(function(){$(this).toggleClass("active");});
    }

    if(height_unit != "ft")
    {
        $("#height .radio").each(function(){
            $(this).toggleClass("active");
        });
        selectHeightMetric(Number(height) - 120);
    }
    else
    {
        var bits = height.split("&#039;");
        selectHeightUS(Number(bits[1]), Number(bits[0]) - 1);
    }

    var w_index = 0;

    if(weight_unit != "lbs")
    {
        $("#weight .radio").each(function(){
            $(this).toggleClass("active");
        });
    }

    if(weight == "< 100" || weight == "< 45")
    {
        w_index = 0;
    }
    else if(weight == "100-150" || weight == "45-68")
    {
        w_index = 1;
    }
    else if(weight == "150-200" || weight == "68-91")
    {
        w_index = 2;
    }
    else if(weight == "200-250" || weight == "91-113")
    {
        w_index = 3;
    }
    else if(weight == "250-300" || weight == "113-137")
    {
        w_index = 4;
    }
    else if(weight == "300+" || weight == "137 +")
    {
        w_index = 5;
    }

    //$("#weight input").val(weight);
    defenestrate($("#weight-select"), w_index);
    defenestrate($("#weight-select-metric"), w_index);

    //console.log(weight);

    if(weight_unit == "lbs")
    {
        $("#weight-select").addClass("vis");
        $("#weight-select-metric").css("display", "none");
    }
    else
    {
        $("#weight-select-metric").addClass("vis");
        $("#weight-select").css("display", "none");
    }

    $("#lb").on("click", function(){
        if($("#weight-select").hasClass("vis") == false)
        {
            $("#weight-select").css("display", "").addClass("vis");
            $("#weight-select-metric").css("display", "none").removeClass("vis");
        }
    });
    $("#kg").on("click", function(){
        if($("#weight-select-metric").hasClass("vis") == false)
        {
            $("#weight-select").css("display", "none").removeClass("vis");
            $("#weight-select-metric").css("display", "").addClass("vis");
        }
    });



    for(var i = 0;i < goals.length;i++)
    {
        if(goals[i].id == "1")
        {
            $(".goals .radio:eq(0)").addClass("active").addClass("checked");
        }
        else if(goals[i].id == "2")
        {
            $(".goals .radio:eq(1)").addClass("active").addClass("checked");
        }
        else if(goals[i].id == "3")
        {
            $(".goals .radio:eq(2)").addClass("active").addClass("checked");
        }
        else if(goals[i].id == "4")
        {
            $(".goals .radio:eq(3)").addClass("active").addClass("checked");
        }
    }

    $(window).scrollTop(0);
}//load account

function go()
{
    if(formValidated())
    {
        changeProInfo();
        return false;
    }
}//go


function changeProInfo()
{

    var pass = $("#pass").val().trim();

    var gender = "female";
    if($(".gender .active").index() == 0)
    {
        gender = "male";
    }

    var measurement;
    var height;
    if($("#height .active").index() == 3)
    {
        measurement = "ft";
        height = $("#height .select:eq(0) .value").text() + "'" + $("#height .select:eq(1) .value").text();
    }
    else
    {
        measurement = "cm";
        height = $("#centi .value").text();
    }

    var weight = $("#weight .vis p").text();
    var unit = "lbs";
    if($("#kg").hasClass("active"))
    {
        unit = "kg";
    }

    var goals = [];
    $(".goals .active").each(function(){
        goals.push($(this).next("p").text());
    });

    var obj = {
        "email" : $("#email").val(),
        "first_name" : $("#fname").val(),
        "last_name" : $("#lname").val(),
        "phone" : $("#phone").val(),
        "gender" : gender,
        //"password" : $("input:eq(4)").val(),
        "date_of_birth" : $("#month .value").text() + "/" + $("#day .value").text() + "/" + $("#year .value").text(),
        "height" : height,
        "height_measurement_type" : measurement,
        "weight" : weight,
        "weight_measurement_type" : unit,
        "fitness_goals" : goals
    };
    if(pass.length > 0) {
        obj.password = pass;
    }



    $.ajax({
        type : "post",
        url : "/user/settings",
        data : JSON.stringify(obj),
        success : function(data) {

            if(data.error)
            {
                alert("Error updating user");
            }
            else
            {
                alert("Profile Information Updated!");

            }
        },
        error : function(err) {

        }
    });
}//change profile info

function initRadio()
{
    microwave($(".numeric .gender .radio"));
    microwave($("#height .radio"));
    microwave($("#weight .radio"));
    $(".goals .radio").each(function(){
        microwave($(this));
    });

    $("#height .radio").each(function(n){
        if(n == 0)
        {
            $(this).on("click", function(){selectHeightUS(0, 0);});
        }
        else if(n == 1)
        {
            $(this).on("click", function(){selectHeightMetric(0);});
        }
    });
}//init radio

function initSelect()
{
    initSelectFunctionality();

    for(var i = 0;i < 12;i++)
    {
        $("#month").append(
            '<p data-dv="'+i+'">'+(i+1)+'</p>'
        );
    }

    for(i = 0;i < 31;i++)
    {
        $("#day").append(
            '<p data-dv="'+i+'">'+(i+1)+'</p>'
        );
    }

    var cyear = new Date().getFullYear();
    for(i = 0;i < 200;i++)
    {
        $("#year").append(
            '<p data-dv="'+i+'">'+(cyear - 18 - i)+'</p>'
        );
    }

    //selectHeightUS(false);
}//init select

function selectHeightUS(offsetInch, offsetFoot)
{
    if($("#height #foot")[0])
    {
        return;
    }
    $("#centi").remove();
    $("#height p:eq(0)").after(
        '<div id="foot" class="select"></div>' +
        '<div id="inch" class="select"></div>'
    );

    for(var i = 0;i < 9;i++)
    {
        $("#foot").append('<p>'+(i+1)+'</p>');
    }

    for(i = 0;i < 12;i++)
    {
        $("#inch").append('<p>'+(i)+'</p>');
    }

    defenestrate($("#inch"), offsetInch);
    defenestrate($("#foot"), offsetFoot);
}//select height us

function selectHeightMetric(offset)
{
    if($("#height #centi")[0])
    {
        return;
    }

    $("#foot").remove();
    $("#inch").remove();
    $("#height p:eq(0)").after(
        '<div id="centi" class="select"></div>'
    );

    for(var i = 0;i < 220;i++)
    {
        $("#centi").append(
            '<p>'+(120+i)+'</p>'
        );
    }

    defenestrate($("#centi"), offset);
}//select height metric


function formValidated() {
    var ids = ["fname","lname","email","pass"];
    var alerts = [
        "First Name Cannot Be Empty",
        "Last Name Cannot Be Empty",
        "Email Cannot Be Empty",
        "Password Cannot Be Empty"
    ];


    for (i=0;i<ids.length;i++) {

        var id = ids[i];
        var len = $("#"+id).val().trim().length;

        if (len == 0 && id != "pass") {
            alert(alerts[i]);
            return false;
        }
        if (ids[i] == "email") {


            if (!validEmail($("#"+ids[i]).val().trim())) {

                alert("Not a Valid Email");
                return false;
            }

        }

        var pass = $("#pass").val();

        if (ids[i] == "pass") {

            if (pass.length < 5 && pass.length > 0) {
                alert("Password Must Be 5 Characters");
                return false;
            }


        }


    }
    return true;

}


function validEmail(v) {
    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
    return (v.match(r) == null) ? false : true;
}
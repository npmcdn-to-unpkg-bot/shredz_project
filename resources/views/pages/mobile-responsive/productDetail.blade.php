@include('includes.head')
@include('includes.header')
@include('includes.mobile-header')
@include('includes.mobile-sideNav')




<main class="productPage product-details" >
    <div class="container-fluid" style="background-color: #e6e6e6;">
        <div class="bread content" style="margin-bottom:0px;">
            <p><a href="/">HOME</a> / <a href="{{ route('shop') }}">SHOP</a> / <b>30 Day Quick Weight Loss Plan + Supplements for Men + FREE Testosterone</b></p>
        </div><!-- bread -->
    </div>
    <div class="spinner">
        <img style="display: block; margin: auto; padding: 100px 0;" src="{{ asset('images/loading.gif') }}">
    </div>
        <section class=" container">
            <!--PRODUCT INFO -->
            <section class="row offer product">
                <figure class="col-sm-5">
                    <img id="product-img" style="width: 100%;">
                </figure>
                <div class="col-sm-7 plan">
                    <div class="special">
                        <p><s></s></p>
                        <h2></h2>
                        <h3><i></i></h3>
                    </div><!-- special -->
                    <div class="includes" id="includes">
                        <h2>Includes...</h2>

                    </div><!--includes-->
                    <div class="options" id="options">

                    </div>
                    <button class="addToCart">ADD TO CART</button>
                </div>
            </section>
            <!-- END PRODUCT INFO-->
        </section>
        <section class="container-fluid">
            <!--POLAROID SLIDESHOW -->
            <!--
            <div class="personal">
                <div class="photo tilt"><img></div>
                <div class="photo shrink"><img></div>
                <div class="photo middle"><img></div>
                <div class="photo shrink"><img></div>
                <div class="photo tilt"><img></div>
            </div>
            -->
            <!--END POLAROID SLIDESHOW -->
        </section>
        <!--WHAT"S INCLUDED-->
        <section class="container store">
            <div class="title">
                <p>30 DAY QUICK WEIGHT LOSS PLAN + SUPPLEMENTS</p>
                <h2>WHAT'S INCLUDED</h2>
            </div>
            <div class="row products" id="products">
                <!--
                <figure class="col-sm-4 col-xs-6 product">
                    <img src="https://s3.amazonaws.com/SHREDZ-CARTS/products/en/MFWBMX-1M/whatyouget_01.jpg">
                </figure>
                <figure class="col-sm-4 col-xs-6 product">
                    <img src="https://s3.amazonaws.com/SHREDZ-CARTS/products/en/MFWMV-1M/whatyouget_01.jpg">
                </figure>
                <figure class="col-sm-4 col-xs-6 product">
                    <img src="https://s3.amazonaws.com/SHREDZ-CARTS/products/en/MFWCR-1M/whatyouget_01.jpg">
                </figure>
                <figure class="col-sm-4 col-xs-6  product">
                    <img src="https://s3.amazonaws.com/SHREDZ-CARTS/products/en/MFWBMX-1M/whatyouget_01.jpg">
                </figure>
                <figure class="col-sm-4 col-xs-6  product">
                    <img src="https://s3.amazonaws.com/SHREDZ-CARTS/products/en/MFWMV-1M/whatyouget_01.jpg">
                </figure>
                <figure class="col-sm-4 col-xs-6  product">
                    <img src="https://s3.amazonaws.com/SHREDZ-CARTS/products/en/MFWCR-1M/whatyouget_01.jpg">
                </figure>
                <figure class="col-sm-4 col-xs-6  product">
                    <img src="https://s3.amazonaws.com/SHREDZ-CARTS/products/en/MFWBMX-1M/whatyouget_01.jpg">
                </figure>
                <figure class="col-sm-4 col-xs-6  product">
                    <img src="https://s3.amazonaws.com/SHREDZ-CARTS/products/en/MFWMV-1M/whatyouget_01.jpg">
                </figure>
                <figure class="col-sm-4 col-xs-6  product">
                    <img src="https://s3.amazonaws.com/SHREDZ-CARTS/products/en/MFWCR-1M/whatyouget_01.jpg">
                </figure>
                <figure class="col-sm-offset-4 col-sm-4 col-xs-offset-3 col-xs-6 product">
                    <img src="https://s3.amazonaws.com/SHREDZ-CARTS/products/en/MSRTP/whatyouget_01.jpg">
                </figure>
                -->
            </div>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4 col-xs-12">
                    <button class="addToCart">ADD TO CART</button>
                </div>
            </div>
        </section>
        <!-- END WHAT"S INCLUDED-->

        <!-- PRODUCT DESCRIPTION -->
        <section class="ltGreyBg container-fluid">
            <section class="container">
                <div class="middle content">
                    <div class="desc">
                        <h3>30 DAY QUICK WEIGHT LOSS PLAN + SUPPLEMENTS</h3>
                        <h2>PRODUCT DESCRIPTION</h2>
                        <p>[product description with <b>some bold text</b>]</p>
                        <p>
                            Please review our <span>30 Day Weight Loss Challenge Official Rules</span>, which govern all
                            Challenges and Challenge participation.
                        </p>
                    </div><!-- desc -->
                    <div class="benefits">
                        <h2>DESIGNED TO PROVIDE BENEFITS LIKE</h2>
                        <div class="group">
                            <p><img src="{{asset('images/pinkCheck.png')}}">WEIGHT LOSS</p>
                            <div class="margins">
                                <p><img src="{{asset('images/pinkCheck.png')}}">PRIME SUPPLEMENTS</p>
                                <p><img src="{{asset('images/pinkCheck.png')}}">REACH GOALS</p>
                            </div>
                            <p><img src="{{asset('images/pinkCheck.png')}}">HOLISTIC FITNESS LIFESTYLE</p>
                        </div>
                        <div class="group">
                            <p><img src="{{asset('images/pinkCheck.png')}}">QUICK WORKOUTS</p>
                            <div class="margins">
                                <p><img src="{{asset('images/pinkCheck.png')}}">EASY TO FOLLOW</p>
                            </div>
                            <p><img src="{{asset('images/pinkCheck.png')}}">EFFECTIVE EXERCISES</p>
                        </div>
                    </div><!-- benefits -->
                    <div class="mobile-description-selectors">
                        <h1>SELECT PRODUCT FOR INFO</h1>
                        <div class="button-wrapper" id="description-buttons">
                        </div>
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="left"><h2>HOW IT WORKS</h2></div>
                            <div class="center"><h2>DOSAGE</h2></div>
                            <div class="right"><h2>LABELS</h2></div>
                        </div>
                    </div><!-- info -->
                </div><!-- middle -->
            </section>
        </section>
        <!-- END PRODUCT DESCRIPTION -->

        <!--REVIEWS-->
    <!--
        <section class="container">
            <div class="overall">
                <div class="stars">
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                </div>
                <h2><span>45</span> REVIEWS</h2>
                <p>99% of REVIEWERS RECOMEND THIS PRODUCT</p>
                <button>ADD MY REVIEW</button>
            </div><!-- overall -->
    <!--
            <div class="review">
                <div class="stars">
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                </div><!-- stars -->
    <!--
                <h2>SHREDZ CHANGED MY LIFE</h2>
                <p><b>Sarah S.</b></p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                    in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div><!-- review -->
    <!--
            <img class="toTop" src="//ec2-54-84-38-150.compute-1.amazonaws.com/images/toTop.png">
        </section>
        <!--END REVIEWS-->


</main><!-- product page -->

@include('includes.footer')
@include('includes.mobile-footer')

<script>

    //which variant to load
    var params = {};
    var variants = [];
    var product = {};
    var sku = "";
    var cart;

    $(document).on("ready", docReady);
    function docReady()
    {
        //4.5 rating
        /*$(".reviews .stars .star:eq(4)").css({
         "background" : "-webkit-linear-gradient(to right, #ff0095 50%, white 50%)",
         "background" : "-o-linear-gradient(to right, #ff0095 50%, white 50%)",
         "background" : "-moz-linear-gradient(to right, #ff0095 50%, white 50%)",
         "background" : "linear-gradient(to right, #ff0095 50%, white 50%)"
         }); */

        //fakeData();
        cart = new CartModule("eyJhbGciOiJIUzI1NiJ9.eyJleHAiOjE0NDc4NjY0NjEsImlhdCI6MTQ0Nzg2NTU2MSwibmJmIjoxNDQ3ODY1NTYxLCJkYXRhIjp7ImFwaV9rZXkiOiJ1bzg5NWIiLCJhZ2VudF9rZXkiOm51bGx9fQ.kd--EHKJpq-SD3KKMa5CehOHwM6mEbs1UHTPSbVAuGU");
        doBindings();
        getData();
    }//docReady

    function addToCart()
    {
        var response = cart.addToCart({
            "sku" : sku,
            "quantity" : 1
        });

        console.log(response);
    }//addToCart

    function getData()
    {
        $.ajax({
            url : "/ajax/products/{{$id}}",
            success : function(d) {
                product = JSON.parse(d);
                console.log(product);
                variants = product.data.variants;

                loadVariant(0);
                //getComponents(product.data.components);
               // getOptions(product.data.options);
                $(".spinner").remove();
                //set inline to avoid visual bugs
                $("main").css("display", "");
            }//success
        });//ajax
    }//get data

    function loadVariant(index)
    {
        $(".bread p b").html(variants[index].name);
        $("#product-img").attr('src', product.data.variants[index].asset_location+'primaryimage_01.jpg');

        $(".offer .preview:eq(0)").on("click", function(){
            setLightbox(product.data.variants[index].asset_location+'primaryimage_01.jpg');
        });
        $(".offer .preview:eq(0)").css("cursor", "pointer");

        $(".offer .special p").html("<s>REGULAR PRICE $"+product.data.variants[index].msrp+"</s>");
        $(".offer .special h2").html("TODAY'S OFFER $"+product.data.variants[index].price);
        $(".offer .special h3").html("<i>"+(Math.floor((product.data.variants[index].msrp - product.data.variants[index].price)/product.data.variants[index].msrp * 100))+"% OFF</i>");

        parse_components(product.data.components, product.data.options, product.data.variants[index]);
        $(".male").each(function(){$(this).removeClass("male")});

        //male default
        if(product.data.variants[0].gender != "Female")
        {
            $(".offer .special h2").addClass("male");
            $(".offer .options button").addClass("male");
            $(".addToCart").each(function(){$(this).addClass("male");});
            $(".products .title").addClass("male");
            $(".middle").addClass("male");
            $(".userReviews").addClass("male");
            $(".reviews:eq(0)").addClass("male");
            $(".preview").each(function(){$(this).addClass("male")});
            $(".benefits img").each(function(){$(this).attr("src", "{{ asset('images/redCheck.png') }}")});
        }//male

        sku = variants[index].sku;
    }//load variant

    function setLightbox(url)
    {
        $("body").css("overflow", "hidden");
        $("body").after(
                '<div class="overlay store_lightbox">' +
                '<img src="'+url+'">' +
                '</div>'
        );
        $(".overlay").on("click", function(){
            $("body").css("overflow", "");
            $(this).remove();
        });
    }//set lightbox

    function reset()
    {
        $(".offer .special p").html('');
        $(".offer .special h2").html('');
        $(".offer .special h3").html('');

        $('.offer .includes').html('<h2>Includes...</h2>');

        $('#options').html('');

        $('#products').html('');

        $('#description-buttons').html('');

        $("#target").html("");
        $(".info .row").each(function(){
            if($(this).index() > 0)
            {
                $(this).remove();
            }
        });
    }//unload

    //iterate through variant select_options and choose closest match
    function selectVariant()
    {
        var index = -1;
        for(var i = 0;i < variants.length;i++)
        {
            var match = true;
            for(var key in variants[i].selected_options)
            {
                var test = variants[i].selected_options.hasOwnProperty(key)
                        && params.hasOwnProperty(key)
                        && params[key] == variants[i].selected_options[key];

                if(test == false)
                {
                    match = false;
                    break;
                }
            }

            if(match)
            {
                index = i;
                break;
            }
        }

        return index;
    }//select variant


    //get product components and populate image views
    function getComponents(components){
        console.log(components);

        $.each( components, function( key, value ) {
            var figure = '<figure class="col-sm-4 col-xs-6 product">' +
                            '<img src="'+ value.asset_location + 'whatyouget_01.jpg">' +
                        '</figure>';
            $('#products').append(figure);
        });
    }

    //get options for product and populate button view
    function getOptions(options){
        $.each(options, function(key, value){
           var optionWrapper = '<div>' +
                                    '<h2>' + key + '</h2>' +
                                    '<div class="buttons">';
            for(var i = 0; i<value.length; i++){
                optionWrapper += '<button data-option="' + value[i] + '">' + value[i] + '</button>';

            }
            optionWrapper += '</div>' + '</div>';
            $('#options').append(optionWrapper);
        });
    }

    //get information from product.data.components
    function parse_components(obj, options, variant)
    {

        var row = '<div class="row">';
        var count = 0;
        var el = "";

        for(var i = 0;i < variant.includes.length;i++)
        {
            el = '<p>';
            var key = variant.includes[i].sku;

            //includes section
            /*if(obj[key].price == 0)
             {
             el += '<span class="pink">FREE </span>';
             }
             el += obj[key].name.toUpperCase()+' <span class="light">($'+obj[key].msrp+' VALUE)</span></p>'; */
            if(variant.price == 0)
            {
                if(variant.gender == "Male")
                {
                    el += '<span class="male">+ FREE </span>';
                }
                else
                {
                    el += '<span class="pink">+ FREE </span>';
                }
            }
            el += obj[key].name.toUpperCase()+' <span class="light">($'+obj[key].msrp+' VALUE)</span></p>';
            $(".offer .includes").append(el);

            //description

            $(".desc h3").html(variant.name);
            $(".desc p:eq(0)").html(variant.description);

            //how it works section
            if(obj[key].how_it_works || obj[key].dosage_instructions) {
                $(".info").append(
                        '                <div class="row' + '" sku="' + key + '">' +
                        '                    <div class="left">' +
                        '                           <h3>HOW IT WORKS</h3>' +
                        '                           ' + obj[key].how_it_works +
                        '                    </div>' +
                        '                    <div class="center">' +
                        '                        <h3>DOSAGE</h3>' +
                        '                        <div class="top">' +
                        '                            ' + obj[key].dosage_instructions +
                        '                        </div>' +
                        '                    </div>' +
                        '                    <div class="right">' +
                        '                        <h3>LABELS</h3>' +
                        '                        <button data-label="' + obj[key].asset_location + 'usalabel.jpg">VIEW USA LABEL</button>' +
                        '                        <button data-label="' + obj[key].asset_location + 'intlabel.jpg">VIEW INTL LABEL</button>' +
                        '                    </div>' +
                        '                </div><!-- row -->'
                );

                var descriptionButton = '<button ' + ' sku="' + key + '">' + obj[key].name.toUpperCase() + '</button>';
                $('#description-buttons').append(descriptionButton);
            }
            var figure = '<figure class="product">' +
                    '<img src="'+ obj[key].asset_location + 'whatyouget_01.jpg">' +
                    '</figure>';
            $('#products').append(figure);

        }//for

        //element correction
        $(".info strong").each(function(){
            $(this).replaceWith(
                    '<b>' + $(this).text() + '</b>'
            );
        });

        //buttons
        $(".info .right").each(function(){
            //usa label
            $(this).find("button:eq(0)").on("click", function(){
                //console.log($(this).data("label"));
                var win = window.open($(this).data("label"), "_blank");
                win.focus();
            });

            //intl label
            $(this).find("button:eq(1)").on("click", function(){
                //console.log($(this).data("label"));
                var win = window.open($(this).data("label"), "_blank");
                win.focus();
            });
        });


        if(count != 3)
        {
            row += '</div>';
            $("#target").append(row);
        }

        //options

        for(key in options)
        {
            if(options.hasOwnProperty(key))
            {
                if(!params[key])
                {
                    params[key] = options[key][0];
                }
                if(options[key].length > 1)
                {
                    el = '<div class="row" id="'+key+'">' +
                    '<h2>'+key+'</h2>' +
                    '<div class="buttons">';

                    for(i = 0;i < options[key].length;i++)
                    {
                        el +=   '<button data-option="'+options[key][i]+'">'+options[key][i]+'</button>';
                    }

                    el += '</div></div>';

                    $(".offer .options").append(el);
                }
            }
        }

        //button margins & highlights
        $(".offer .options .row").each(function(){
            var row = $(this);
            row.find("button").each(function(){
                var button = $(this);
                if(button.index() == 0)
                {
                    button.css("margin-right", "20px");
                }
                else if(button.is(":last-child"))
                {
                    button.css("margin-left", "0px");
                }
                else
                {
                    button.css({
                        "margin-left" : "5px",
                        "margin-right" : "5px"
                    });
                }

                if(containsValue(params, $(this).text()))
                {
                    $(this).addClass("active");
                }
            });
        });

        //button bindings
        $(".offer .options .row").each(function(){
            var row = $(this);
            row.find("button").each(function(){
                var button = $(this);
                button.on("click", function(){
                    var current = selectVariant();
                    params[button.parent().parent().attr("id")] = button.data("option");
                    var next = selectVariant();
                    if(current != next)
                    {
                        reset();
                        loadVariant(next);
                    }
                });
            });
        });

    }//parse

    function containsValue(obj, value)
    {
        for(var key in obj)
        {
            if(obj.hasOwnProperty(key)
                    && obj[key] == value)
            {
                return true;
            }
        }

        return false;
    }//contains value

    function doBindings()
    {
        $(".toTop").on("click", function(){
            $(window).scrollTop(0);
        });
    }//do bindings


    $('body').on('click', '#description-buttons button', function(){
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        var description = $('body .info .row[sku='+($(this).attr('sku')));
        description.siblings().removeClass('active');
        description.addClass('active');
    });
</script>

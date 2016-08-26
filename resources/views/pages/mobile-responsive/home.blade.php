@include('includes.head')
@include('includes.header')
@include('includes.mobile-header')
@include('includes.mobile-sideNav')

<main class="home">
    <section class="container">
        <!-- PROMOS -->
        <div class="row two-promos">
            <figure class="col-md-6">
                <img src="{{ asset('images/homeshredz_banner_her.jpg') }}">
                <!--
                <h3>30 DAY</h3>
                <h2 class="female">QUICK WEIGHT LOSS</h2>
                <h3>PLAN + SUPPLEMENTS</h3>
                <button class="percent-btn female">GET 50% OFF TODAY</button>
                <button class="claim-btn female">CLAIM OFFER</button>
                -->
            </figure>
            <figure class="col-md-6">
                <img src="{{ asset('images/homeshredz_banner_him.jpg') }}">
                <!--
                <h3>30 DAY</h3>
                <h2 class="male">QUICK WEIGHT LOSS</h2>
                <h3>PLAN + SUPPLEMENTS</h3>
                <button class="percent-btn male">GET 50% OFF TODAY</button>
                <button class="claim-btn male">CLAIM OFFER</button>
                -->
            </figure>
        </div>
        <!-- END PROMOS -->
    </section>
    <section class="container-fluid">
        <!-- FORM (HIDDEN FOR PHASE 1) -->
        <!--
        <form class="row">
            <div class="col-md-7">
                NAME + EMAIL
            </div>
            <div class="col-md-5">
                AGE + GENDER
            </div>
            <div class="col-md-7">
                WEIGHT + GOAL WEIGHT
            </div>
            <div class="col-md-5">
                FITNESS GOAL
            </div>
            <buton>BEGIN TODAY</buton>
        </form>
        -->
        <!-- END FORM -->
        <section class="row">
            <div class="transformations">
                <!-- <div class="consult">
                    <div class="group">
                        <p><b>FREE DIET</b></p>
                        <p>CONSULTATION</p>
                    </div>
                    <button>BEGIN TODAY</button>
                </div><!-- consult -->
                <h2>CUSTOMER TRANSFORMATIONS & REVIEWS</h2>
                <div class="con"></div>
            </div><!-- transformations -->
        </section>
    </section>
    <!-- FEATURED PRODUCTS -->
    <section class="products container">
        <h1>FEATURED PRODUCTS</h1>
        <div class="row"  id="products">
            <!--
            <figure class="col-xs-6 col-md-3 product">
                <div class="special">
                    <p>47% off!</p>
                </div>
                <img src="//ec2-54-84-38-150.compute-1.amazonaws.com/images/product1.png">
                <button class="redeem female">CLICK TO REDEEM</button>
            </figure>
            <figure class="col-xs-6 col-md-3 product">
                <div class="special">
                    <p>47% off!</p>
                </div>
                <img src="//ec2-54-84-38-150.compute-1.amazonaws.com/images/product1.png">
                <button class="redeem female">CLICK TO REDEEM</button>
            </figure>
            <figure class="col-xs-6 col-md-3 product">
                <div class="special">
                    <p>47% off!</p>
                </div>
                <img src="//ec2-54-84-38-150.compute-1.amazonaws.com/images/product1.png">
                <button class="redeem female">CLICK TO REDEEM</button>
            </figure>
            <figure class="col-xs-6 col-md-3 product">
                <div class="special">
                    <p>47% off!</p>
                </div>
                <img src="//ec2-54-84-38-150.compute-1.amazonaws.com/images/product1.png">
                <button class="redeem female">CLICK TO REDEEM</button>
            </figure>
            <figure class="col-xs-6 col-md-3 product">
                <div class="special">
                    <p>47% off!</p>
                </div>
                <img src="//ec2-54-84-38-150.compute-1.amazonaws.com/images/product1.png">
                <button class="redeem female">CLICK TO REDEEM</button>
            </figure>
            <figure class="col-xs-6 col-md-3 product">
                <div class="special">
                    <p>47% off!</p>
                </div>
                <img src="//ec2-54-84-38-150.compute-1.amazonaws.com/images/product1.png">
                <button class="redeem female">CLICK TO REDEEM</button>
            </figure>
            <figure class="col-xs-6 col-md-3 product">
                <div class="special">
                    <p>47% off!</p>
                </div>
                <img src="//ec2-54-84-38-150.compute-1.amazonaws.com/images/product1.png">
                <button class="redeem female">CLICK TO REDEEM</button>
            </figure>
            <figure class="col-xs-6 col-md-3 product">
                <div class="special">
                    <p>47% off!</p>
                </div>
                <img src="//ec2-54-84-38-150.compute-1.amazonaws.com/images/product1.png">
                <button class="redeem female">CLICK TO REDEEM</button>
            </figure>
            -->
        </div>
    </section>
    <!-- END FEATURED PRODUCTS -->
    <section class="container-fluid">
        <!-- LINK BOXES -->
        <section class="row link-blocks community">
            <div class="col-md-3 col-sm-6 link-block" id="meetAthletes"><p>MEET THE ATHLETES</p></div>
            <div class="col-md-3 col-sm-6 link-block" id="shop"><p>SHOP</p></div>
            <div class="col-md-3 col-sm-6 link-block" id="chat"><p>LIVE CHAT</p></div>
            <div class="col-md-3 col-sm-6 link-block" id="movement"><p>JOIN THE MOVEMENT</p></div>
        </section>
        <!-- END LINK BOXES -->
    </section>
    <section class="container">
        <section class="quote">
            <p>
                At <b>SHREDZ</b>, we believe that having both a fit body and mind will take you further than
                having only one. That's why we believe in providing the best nutritional supplements and fitness
                information to our millions of followers in over 100 countries.
            </p>
            <p>
                <i>We've helped hundreds of thousands of people take control of their lives and become something
                    they've always aspired to be.</i> Take a look through our has tags #SHREDZ and #SHREDZARMY
                and use them to post your own transformation.
            </p>
            <p><b style="font-size: 28px;">Join the lifestyle. Join the movement. Join the army.</b></p>
        </section>
        <div class="shredzBG">
            <button class="bigRed">ENTER THE STORE</button>
        </div>
    </section>
    <section class="container-fluid">
        <!-- ANECDOTES -->
        <div class="reviews">
            <!-- <span class="stretch"></span> -->
        </div><!-- reviews -->
        <!-- END ANECDOTES -->
    </section>
</main>

@include('includes.footer')
@include('includes.mobile-footer')

<script>

    $(document).on("ready", function() {

        for(var i = 0;i < 12;i++)
        {
            var n = i+1;
            if(n < 10)
            {
                n = "0"+(i+1);
            }
            var l = "{{ asset('') }}" + "/images/" + n + "_shredzhome_transformation.jpg";
            $(".transformations .con").append(
                    '                <img class="transformation" src="'+l+'">'
            );
        }

        //fakeProducts();
        getData();
        fakeReviews();

        $(".con:eq(0)").slick({
            infinite : true,
            slidesToShow : 4,
            slidesToScroll : 2,
            draggable : false,
            autoplay : false,
            autoplaySpeed : 2000,
            variableWidth: true
        });
        $(".con:eq(0) .slick-prev").append('<img src="{{ asset('images/arrows/transformations_leftarrow.png') }}">');
        $(".con:eq(0) .slick-next").append('<img src="{{ asset('images/arrows/transformations_rightarrow.png') }}">');

        $(".reviews:eq(0)").slick({
            infinite : true,
            slidesToShow : 6,
            slidesToScroll : 2,
            draggable : false,
            autoplay : false,
            autoplaySpeed : 2000,
            variableWidth: true
        });
        $(".reviews .slick-prev").append('<img src="{{ asset('images/arrows/transformations_leftarrow.png') }}">');
        $(".reviews .slick-next").append('<img src="{{ asset('images/arrows/transformations_rightarrow.png') }}">');
    });//document ready

    $('body').on('click', 'img.transformation', function(){
        $('body').append('<div class="overlay"><img src="'+ $(this).attr('src') +'"></div>');

        $('.overlay').on('click', function(e) {
            if( e.target == this ) {
                $(this).remove();
            }
        });
    });

    function getData()
    {
        $.ajax({
            url : "/ajax/products",
            success : function(data) {
                data = JSON.parse(data);
                console.log(data);

                $(".spinner").remove();

                for(var i = 0;i < data.data.length;i++)
                {
                    //load no more than 8 items
                    if(i == 8){break;}

                    var disc = (1 - (data.data[i].base_variant.price / data.data[i].base_variant.msrp)) * 100;
                    disc = Math.floor(disc);
                    var ind = "";
                    if(Math.floor(disc) > 1)
                    {
                        ind = '<div class="special"><p>'+disc+'%<br>off!</p></div>';
                    }

                    $("#products").append(
                            '<a class="col-xs-6 col-md-3" href="/products/'+data.data[i].id+'"><figure id="pid-'+data.data[i].id+'" class="product">' +
                            ind +
                            '<img src="'+data.data[i].asset_location+'primaryimage_01.jpg">' +
                            '<button class="redeem female">CLICK TO REDEEM</button>' +
                            '</figure></a>'
                    );

                    if(!data.data[i].base_variant.gender || data.data[i].base_variant.gender.toLowerCase() == "male")
                    {
                        $(".products .product:eq("+i+") .redeem").removeClass("female").addClass("male");
                    }

                }
            }//success
        });//ajax
    }

    function desktize()
    {
        $("table tr").each(function(){
            if($(this).index() > 1)
            {
                $(this).remove();
            }
        });
        for(var i = 0;i < 2;i++)
        {
            $("table tr").each(function(){
                $(this).append(
                        '<td></td>'
                );
            });
        }
    }//desktize

    function mobilize()
    {
        $("table td").each(function(){
            if($(this).index() > 1)
            {
                $(this).remove();
            }
        });
        for(var i = 0;i < 2;i++)
        {
            $("table").append(
                    '<tr>' +
                    '<td></td>' +
                    '<td></td>' +
                    '</tr>'
            );
        }
    }//mobilize

    function fakeProducts()
    {
        for(var i = 0;i < 12;i++)
        {
            var discount = Math.floor(Math.random() * 50) + 25;
            $(".products").append(
                    '<div class="product">' +
                    '<div class="special"><p>'+discount+'% off!</p></div>' +
                    '<img src="{{asset('images/product1.png')}}">' +
                    '<button class="redeem female">CLICK TO REDEEM</button>' +
                    '</div>'
            );
        }
    }//fake products

    function fakeReviews()
    {
        var profiles = [
            '@misslaw.png',
            '@Couponista101.png',
            '@Danuelle2887.png',
            '@JUSTPERLAPEREZ.png',
            '@KellsBellz333.png',
            '@Krys.Luvs.Shredz.png',
            '@mattbrown1508.png',
            '@MonkeyButtAngel.png',
            '@my_my_maya.png',
            '@Mzdianak.png',
            '@swolesarah.png',
            '@themilnelife.png',
            'profileimage_template.png',
            'profileimage_template.png'
        ];
        for(var i = 0;i < 14;i++)
        {
            var path = "{{ asset('') }}";

            $(".reviews").append(
                    '        <div class="review">' +
                    '            <img class="photo">' +
                    '            <h2>SHREDZ CHANGED MY LIFE</h2>' +
                    '            <h3>RYAN S.</h3>' +
                    '            <div class="star"></div>' +
                    '            <div class="star"></div>' +
                    '            <div class="star"></div>' +
                    '            <div class="star"></div>' +
                    '            <div class="star"></div>' +
                    '        </div>'
            );

            var s = path + 'images/'+profiles[i];
            $(".reviews .review:eq("+i+") img").attr("src", s);
        }
    }//fake reviews

</script>

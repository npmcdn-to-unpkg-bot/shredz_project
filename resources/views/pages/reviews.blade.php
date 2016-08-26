@inject('pageComponent', 'App\Http\Components\Page')
@extends('themes.default.layout')

@section('content')
    <section id="review-page-slider" class="section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="large-font">FEATURED REVIEWS</h1>
                    <h4>Dedicated Shredz Customers, Exemplary Results</h4>

                </div>
            </div>
        </div>
        <div class="container inside-section-margin">
            <div class="review-page-slider row">
            @foreach ($featuredReviews as $featuredReview)
                <div class="col-lg-12 col-sm-12 text-center page-{{$featuredReview['id']}}">
                    <div class="row">
                        <div class="col-sm-12 text-center heading">
                            <h3>{{ $featuredReview['title'] }}</h3>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-5 inside-section-margin">
                             <img src="{{ @$featuredReview['assets']['primary_image'][0]['path'] }}" class="img-thumbnail no-border">
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-7 inside-section-margin full-reviews text-left">
                             <h3 class="medium-font">{{ $featuredReview['_subtitle'] }}</h3>
                             <div class="full-content">
                                {!! $featuredReview['content'] !!}
                             </div>
                             <p>{!! $pageComponent->limitString(@$featuredReview['content'], 400) !!}...</p><br />
                            <a href="#" data-toggle="modal" data-target="#review-page-modal" class="read-more-link">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    <section id="exercise-info-holder">
        <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-push-1 text-center">
                <p class="exercise-instruction">WE HOSTED THE CUSTOMERS HIGHLIGHTED ABOVE TO VISIT AND MEET THE SHREDZ TEAM TO SHARE THEIR STORIES WITH US. THESE INDIVIDUALS HAVE BEEN DEDICATED MEMBERS OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH DIFFERENT COMBINATIONS OF PROPER EXERCISE PLANS, DIET PLANS, COACHING, AND SUPPLEMENTS, HAVE ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND EACH AND EVERY ONE OF THEM AND ARE HONORED TO BE PART OF THEIR FITNESS JOURNEY.</p>
            </div>
        </div>
        <div class="row">
            <div class="text-center inside-section-margin" style="margin-bottom: 20px">
                <a href="{{ route('shop') }}" class="button-cta button start-story-button">START YOUR STORY TODAY</a>
            </div>
        </div>
    </div>
    </section>

    <section id="success-stories">
        <div class="container section-margin">
            <div class="row">

                <div class="col-xs-12 text-center">
                <p class="exercise-instruction text-center" style="width: 68%; margin-left: 18%">EXERCISE AND PROPER DIET ARE NECESSARY TO ACHIEVE AND MAINTAIN WEIGHT LOSS. REGARDING THE TESTIMONIALS BELOW, RESULTS MAY VARY DEPENDING UPON STARTING POINT, GOALS, AND EFFORT.</p>
                    <h1 class="large-font">SUCCESS STORIES</h1>
                </div>
                <div class="col-xs-12">
                    <div id="success-stories-grid">
                    @foreach (array_chunk($reviews, 3, true) as $chunk )
                        <div class="row">
                            @foreach ($chunk as $review)
                                <div class="col-sm-4 col-xs-12 inside-section-margin">
                                    <img src="{{ @$review['assets']['primary_image'][0]['path'] }}" class="img-thumbnail">
                                    <p class="hidden-xs">{!! $review['content'] !!}</p>
                                    {{-- <a href="#" data-toggle="modal" data-target="#review-page-modal" class="read-more-link hidden-xs">Read More</a> --}}
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    </div>
                </div>

                <div class="col-xs-12 load-button-spacing">
                    <button id="load-more-button" type="button" class="btn btn-large center-block load-more-button-styling">Load More</button>
                    <!-- <div id="spinner-load"></div> -->
                </div>
                    
                <p class="exercise-instruction text-center" style="width: 68%; margin-left: 18%">EXERCISE AND PROPER DIET ARE NECESSARY TO ACHIEVE AND MAINTAIN WEIGHT LOSS. REGARDING THE TESTIMONIALS BELOW, RESULTS MAY VARY DEPENDING UPON STARTING POINT, GOALS, AND EFFORT.</p>

            </div>
        </div>
    </section>
    <!-- Base Modal -->
    <div class="modal fade" id="review-page-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header before-after-modal-header">
                    <div class="row">
                        <button type="button" class="close button-close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"></h3>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row added-product-image-flex-style">
                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12 image-holder">
                            <img class="img-responsive" src="">
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
                            <h3 class="subheading"></h3>
                            <p class="description"></p>
                            <a href="{{ route('shop') }}" class=" visible-xs button-cta button center-block start-story-button modal-start-story-button">START YOUR STORY TODAY</a>
                            <p class="exercise-instruction-modal visible-xs" style="text-transform: uppercase;">WE HOSTED THE CUSTOMERS HIGHLIGHTED ABOVE TO VISIT AND MEET THE SHREDZ TEAM TO SHARE THEIR STORIES WITH US. THESE INDIVIDUALS HAVE BEEN DEDICATED MEMBERS OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH DIFFERENT COMBINATIONS OF PROPER EXERCISE PLANS, DIET PLANS, COACHING, AND SUPPLEMENTS, HAVE ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND EACH AND EVERY ONE OF THEM AND ARE HONORED TO BE PART OF THEIR FITNESS JOURNEY.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer hidden-xs">
                    <a href="{{ route('shop') }}" class="hidden-xs button-cta button center-block start-story-button modal-start-story-button">START YOUR STORY TODAY</a>
                    <p class="exercise-instruction-modal" style="text-transform: uppercase;">WE HOSTED THE CUSTOMERS HIGHLIGHTED ABOVE TO VISIT AND MEET THE SHREDZ TEAM TO SHARE THEIR STORIES WITH US. THESE INDIVIDUALS HAVE BEEN DEDICATED MEMBERS OF THE SHREDZ MOVEMENT FOR MONTHS AND, WITH DIFFERENT COMBINATIONS OF PROPER EXERCISE PLANS, DIET PLANS, COACHING, AND SUPPLEMENTS, HAVE ACHIEVED EXTRAORDINARY RESULTS. WE COMMEND EACH AND EVERY ONE OF THEM AND ARE HONORED TO BE PART OF THEIR FITNESS JOURNEY.</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        function showOnLoad(selector, howManyRows){
            $(selector+" .row:lt(" + howManyRows + ")").show();
        }

        $(document).ready(function(){
            $('.review-page-slider').slick({
                arrows: true,
                adaptiveHeight: true
            });

            $("#success-stories-grid .row").hide();
            totalNoOfReviews = $("#success-stories-grid .row").size();
            howManyAtOnce=2;

            showOnLoad('#success-stories-grid', 2);

            $('#load-more-button').click(function(){
                howManyAtOnce= (howManyAtOnce+1 <= totalNoOfReviews) ? howManyAtOnce+1 : totalNoOfReviews;
                if(howManyAtOnce == totalNoOfReviews){
                    $("#load-more-button").removeClass("load-more-button-styling").addClass("button-cta start-story-button").css({"color":"#fff", "-webkit-font-smoothing": "antialiased"}).text("START YOUR STORY TODAY").click(function(){
                        window.location.href = "{{ route('shop') }}";
                    });
                }
                $('#success-stories-grid .row:lt('+howManyAtOnce+')').show();
            });
          //POPULATING DATA TO BEFORE-AFTER MODAL
          // $("#success-stories a").on("click", function(){
          //   var parentContainer = $(this).parent();
          //   var image = parentContainer.children("img").prop("src");
          //   var description = parentContainer.children('p').text();
          //   $(".modal-body img").attr("src", image);
          //   $(".modal-footer .description").text(description);
          // });

          //POPULATING DATA TO REVIEW MODAL
          $("#review-page-slider a").on("click", function(){
            var titleContainer = $(this).parents(':eq(1)').find('.heading');
            var imageContainer = $(this).parents(':eq(2)');
            var image = imageContainer.find("img").prop("src");
            var textContainer = $(this).parent();
            var heading = titleContainer.find('h3').text();
            var subheading = textContainer.find('h3').text(); 
            var description = textContainer.find('.full-content').text();
            $(".modal-header .modal-title").text(heading);
            $(".modal-body img").attr("src", image);
            $(".modal-body .subheading").text(subheading);
            $(".modal-body .description").text(description);
            $(".modal-body, .description").animate({scrollTop: 0});
          });
        });
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js"></script>
    <script>
        /*blade variables*/
        var downArrowUrl = "{{asset('images/down_arrow.png')}}";
        var blackCheckUrl = "{{asset('images/blackCheck.png')}}";
        var yellowStarShadowUrl = "{{asset('images/yellowStarShadow.png')}}";
        var buttonCursorUrl = "{{asset('images/button-cursor.png')}}";
	</script>
@append

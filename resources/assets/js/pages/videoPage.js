// (function(window, undefined) {
    var $ = window.jQuery || window.$ || {};
    var document = window.document;
    var _category = $('meta[name="category"]').attr('content');

    var TYPE_SHREDZ_API = 'ShredzAPI';
    var TYPE_JQUERY = 'JQuery';
    var TYPE_STRING = 'String';
    var TYPE_OBJECT = 'Object';
    var TYPE_MATH = 'Math';
    var TYPE_HANDLEBARS = 'Handlebars';

    /////////////////////
    //  G L O B A L S  //
    /////////////////////

    var document = window.document;
    var $ = window[TYPE_JQUERY] || window.$ || {};
    var String = window[TYPE_STRING];
    var Object = window[TYPE_OBJECT];
    var Math = window[TYPE_MATH];
    var ShredzAPI = window[TYPE_SHREDZ_API];
    var Handlebars = window[TYPE_HANDLEBARS];
    var fitclubHandler = new fitclubHelper();
    var _templates = {};
    var _filters = [];

    /////////////////////
    //  H E L P E R S  //
    /////////////////////


    function fitclubHelper(){
        this.registerHandlebarsHelpers = function(){
            Handlebars.registerHelper('join', function(collection, delimiter) {
                delimiter = delimiter && delimiter.constructor.name === 'String' && delimiter || ' ';
                return collection.join(delimiter);
            });
            Handlebars.registerHelper('lcase', function(str) {
                return str.trim().toLowerCase();
            });
            Handlebars.registerHelper('sale', function(price, msrp) {
                return Math.floor((msrp - price) / msrp * 100);
            });
            Handlebars.registerHelper('in', function(collection, item, options) {
                if (collection[item] || collection.indexOf(item) + 1) {
                    return options.fn(this);
                }
            });
            Handlebars.registerHelper('if-gt', function(val1, val2, options) {
                if (val1 > val2) {
                    return options.fn(this);
                } else {
                    return options.inverse(this);
                }
            });
            Handlebars.registerHelper('limit', function(arr, limit) {
                if (!_.isArray(arr)) {
                    return [];
                } // remove this line if you don't want the lodash/underscore dependency
                return arr.slice(0, limit);
            });
            Handlebars.registerHelper('time-helper', function(duration){
                var minutes;
                var seconds;
                minutes = duration/60;
                seconds= duration%60;
                if(seconds < 10){
                    seconds = "0" + seconds;
                }
                var timeFormat = Math.floor(minutes) + ":" + seconds;
                return timeFormat; 
            });

            Handlebars.registerHelper('if-eq-array', function(item, arr) {
                var i = 0;
                var array = arr.split(',');
                for(i=0; i<item.length; i++){
                    if(array.indexOf(item) > -1){
                        return true;
                    } else{
                        return false;
                    }
                }
            });

            Handlebars.registerHelper('shuffle', function(array){
                var i = array.length, j, swap;
                    while( i ){
                        j = Math.floor( Math.random() * i-- );
                        swap = array[i];
                        array[i] = array[j];
                        array[j] = swap;
                    }
                return array;
            });
        
            Handlebars.registerHelper('limit', function(array, limit){
                var shuffledResults = array.slice(Math.max(array.length - limit, 1))
                return shuffledResults;
            });


            Handlebars.registerHelper('headTitle', function(title) {
                $('head').find('title').text(title + " - Fit Club");
            });

            Handlebars.registerHelper('headMeta', function(meta) {
                $("meta[name='description']").text(meta);
            });

        }
        this.loadTemplates = function(){
            $('script[type="text/x-handlebars-template"]').each(function() {
                var $this = $(this);
                _templates[$this.attr('name')] = Handlebars.compile($this.html());
            });
        }
        this.urlParser = function(){
            var currentHashUrl = getFiltersFromHash();
            var urlWithoutHash = currentHashUrl.slice(1);
            var allFilters = urlWithoutHash.split("+"); 
            return allFilters;     
        }
        this.showSideNavWithBodyPartSelected = function(selector, bodyPart){
            var baseSelector = selector;
            $(baseSelector).hide();
            $(baseSelector + ":first-child").show();
            $(baseSelector + "." + bodyPart).show();
        }
    }

    function loadTemplates() {
        $('script[type="text/x-handlebars-template"]').each(function() {
            var $this = $(this);
            _templates[$this.attr('name')] = Handlebars.compile($this.html());
        });
    }

    function setNavCategory() {
        var category = (_category && _category.length) ? _category : 'show-all';
        $('#fitclub-header .first-nav a h2').removeClass('active');
        $('#fitclub-header .first-nav a.' + category + ' h2').addClass('active');
    }

    $(".second-nav a").on("click", "h2", redirectToAllVideoWithSelectedBodyPart);
    $(".sidenav-wrapper ul li").on("click", "a", redirectToAllVideoWithSelectedMuscleGroup);

    $(".sidenav-wrapper .form-group #mobile-muscle-group").on("change", redirectToAllVideoWithSelectedMuscleGroup);



    function getFiltersFromHash() {
        return window.location.hash;
    }

    function showSideNavWithBodyPartSelected(bodyPart){
        $(".sidenav-wrapper .left-column ul li").hide();
        $(".sidenav-wrapper .left-column ul li:first-child").show();
        $(".sidenav-wrapper .left-column ul li." + bodyPart).show();
    }

    function redirectToAllVideoWithSelectedBodyPart(){
        $this = $(this);
        var bodyPart = $this.data("category");
        var url = $("meta[name='asset-base']").attr('content');
        window.location = url + "/fitclub#" + bodyPart;
    }

    function redirectToAllVideoWithSelectedMuscleGroup() {
        if($(window).width()<768){
            $this = $("#mobile-muscle-group option:selected");
        } else{
            $this = $(this);
        }

        var url = $("meta[name='asset-base']").attr('content');
        var muscleGroup = $this.data("category");
        var bodyPart = $(".second-nav a h2.active").data('category');
        // if($(".second-nav a h2").hasClass("active") == true){
        //     bodyPart = $(this).
        // }
        if(bodyPart && bodyPart.length > 0){
            window.location = url + "/fitclub#" + bodyPart + "+" + muscleGroup;
        } else{
            window.location = url + "/fitclub#" + muscleGroup;
        }
    }

    function checkIfBodyPartFilterIsActive(){
        if($(".second-nav h2.active").length == 0){
            return false;
        } else{
            return true;
        }
    }

    function addActiveClass(selector){
        $selector = $(selector);
        $selector.addClass("active");
    }


    function removeActiveClass(selector){
        $selector = $(selector);
        $selector.removeClass("active");
    }

     function showSpinner(){
        $("#overlay").fadeIn();
    }

    function hideSpinner(){
        $("#overlay").fadeOut();
    }

    function showPlayButton(){
        $this = $(this);
        $this.find(".play-button").fadeIn("slow");
    }

    function hidePlayButton(){
        $this = $(this);
        $this.find(".play-button").fadeOut("slow");
    }

    function setFilterWithHash(){
        var currentSearchUrl = window.location.search;
        var urlWithoutQuestion = currentSearchUrl.slice(1);
        var allFilters = urlWithoutQuestion.split("&"); 

        if(allFilters == ""){
            $(".sidenav-wrapper .left-column ul li").show();
        }
    }

    function highlightFilters(response){
        var primaryCategory;
        if(response.category.primary_muscle_group){
            primaryCategory = response.category.primary_muscle_group.toLowerCase();
            if(primaryCategory.length > 0){
                addActiveClass(".second-nav a." + primaryCategory.toLowerCase() + " h2");
            } 
        }
    }

    function loadVideoGrid(response) {  
        console.log(response);
        $('#current-video-grid')
            .html(_templates.videos({
                video: response
            }));
        $(".accessible").mouseover(function(){
            $this = $(this);
            $this.find(".play-button").show();
        });
         $(".accessible").mouseout(function(){
            $this = $(this);
            $this.find(".play-button").hide();
        });
        initLazyLoader();
        highlightFilters(response);
        hideSpinner();
        // setFilterWithHash();
    }

    function onVideosLoaded(response) {
        if(response['thumbnail'].length>0){
            var biggerThumbnail = response['thumbnail'].replace(/_295x166/, '_1280x720');
            response['thumbnail'] = biggerThumbnail;
        }
        loadVideoGrid(response);
    }

    function requestVideos() {
        var query = "/" + slug;
        return ShredzAPI
            .getVideos(query)
            .then(onVideosLoaded);
    }

    function initLazyLoader() {
        $("img.lazy").lazyload({
            effect: "fadeIn",
            threshold : 150,
        });
    }
    

    function onDocumentReady() {
        requestVideos();
    }   

    function bindEvents() {
        $(document).on('ready', onDocumentReady);
    }

    function boot() {
        fitclubHandler.registerHandlebarsHelpers();
        fitclubHandler.loadTemplates();
        showSpinner();
        bindEvents();
        setNavCategory();
    };

    boot();

// })(window);
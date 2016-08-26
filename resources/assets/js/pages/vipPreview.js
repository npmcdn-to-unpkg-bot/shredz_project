(function(window, undefined) {
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
    function fitclubHelper() {
        this.registerHandlebarsHelpers = function() {
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
            Handlebars.registerHelper('time-helper', function(duration) {
                var minutes;
                var seconds;
                minutes = duration / 60;
                seconds = duration % 60;
                if (seconds < 10) {
                    seconds = "0" + seconds;
                }
                var timeFormat = Math.floor(minutes) + ":" + seconds;
                return timeFormat;
            });
        }
        this.loadTemplates = function() {
            $('script[type="text/x-handlebars-template"]').each(function() {
                var $this = $(this);
                _templates[$this.attr('name')] = Handlebars.compile($this.html());
            });
        }
        this.urlParser = function() {
            var currentHashUrl = getFiltersFromHash();
            var urlWithoutHash = currentHashUrl.slice(1);
            var allFilters = urlWithoutHash.split("+");
            return allFilters;
        }
        this.showSideNavWithBodyPartSelected = function(selector, bodyPart) {
            var baseSelector = selector;
            $(baseSelector).hide();
            $(baseSelector + ":first-child").show();
            $(baseSelector + "." + bodyPart).show();
        }
    }


    function setNavCategory() {
        var category = (_category && _category.length) ? _category : 'show-all';
        removeActiveClass("#fitclub-header .first-nav a h2");
        addActiveClass('#fitclub-header .first-nav a.' + category + ' h2');
    }

    function getFiltersFromHash() {
        return window.location.hash;
    }


    function addActiveClass(selector) {
        $selector = $(selector);
        $selector.addClass("active");
    }


    function removeActiveClass(selector) {
        $selector = $(selector);
        $selector.removeClass("active");
    }


    function checkIfBodyPartFilterIsActive() {
        if ($(".second-nav h2.active").length == 0) {
            return false;
        } else {
            return true;
        }
    }

    function convertToMinAndSec(time) {
        var minutes;
        var seconds;
        minutes = time / 60;
        seconds = time % 60;
        var timeFormat = Math.floor(minutes) + ":" + seconds;
        return timeFormat;
    }
    ////////////////////////
    //  H A N D L E R S  //
    ///////////////////////


    $(".second-nav a").on("click", "h2", filterWithBodyPart);
    $(".sidenav-wrapper ul li").on("click", "a", filterWithMuscleGroup);
    $(".sidenav-wrapper .form-group #mobile-muscle-group").on("change", filterWithMuscleGroup);

    function hideAllVideos() {
        $("#videos-grid .test .col-flex").hide();
    }

    function showAllVideos() {
        $("#videos-grid .test .col-flex").show();
    }

    function checkIfTagExist(dataTags, bodyOrMuscleGroup) {
        if (dataTags.toLowerCase().indexOf(bodyOrMuscleGroup) >= 0) {
            return true;
        } else {
            return false;
        }
    }

    function showRelatedVideos(selector, bodyPart) {
        $(selector).each(function() {
            var $this = $(this);
            var dataTags = $this.data("tags");
            if (checkIfTagExist(dataTags, bodyPart)) {
                $(this).show();
            }
        });
    }

    /////////////////////
    //  A C T I O N S  //
    /////////////////////

    function filterWithBodyPart() {
        $this = $(this);
        removeActiveClass(".second-nav a h2");
        addActiveClass($this);
        var bodyPart = $this.data("category");
        window.location.hash = bodyPart;

        if(bodyPart == "total-body"){
            removeActiveClass(".sidenav-wrapper ul").hide(); 
        }
        else{
            removeActiveClass(".sidenav-wrapper ul li a");
            $("#mobile-muscle-group").val("All");
            addActiveClass(".sidenav-wrapper ul li a.show-all");
            fitclubHandler.showSideNavWithBodyPartSelected(".sidenav-wrapper .left-column ul li", bodyPart);
            fitclubHandler.showSideNavWithBodyPartSelected("#mobile-muscle-group option", bodyPart);
        }
        
        hideAllVideos();
        showRelatedVideos("#videos-grid .test .col-flex", bodyPart);
    }

    function filterWithMuscleGroup() {
        $this = $(this);
        removeActiveClass(".sidenav-wrapper ul li a");

        addActiveClass($this);

        var activeBodyPart = $(".second-nav h2.active").data("category");
        var muscleGroup = $this.data("category") || $('.form-group #mobile-muscle-group option:selected').data('category');

        var currentHashUrl = getFiltersFromHash();
        var splitUrl = currentHashUrl.split("+");

        if (!checkIfBodyPartFilterIsActive()) {
            window.location.hash = muscleGroup;
        } else {
            window.location.hash = splitUrl[0] + "+" + muscleGroup;
        }

        hideAllVideos();

        if (muscleGroup === "all-muscle-group" && activeBodyPart) {
            showRelatedVideos("#videos-grid .test .col-flex", activeBodyPart);
        } else if (muscleGroup === "all-muscle-group" && !activeBodyPart) {
            showAllVideos();
        } else {
            $("#videos-grid .test .col-flex").each(function() {
                var $this = $(this);
                var dataTags = $this.data("tags");
                if (checkIfTagExist(dataTags, activeBodyPart) && checkIfTagExist(dataTags, muscleGroup)) {
                    $(this).show();
                }
                if (!checkIfTagExist(dataTags, activeBodyPart) && checkIfTagExist(dataTags, muscleGroup)) {
                    $(this).show();
                }
            });
        }
    }

    function setFilterWithHash() {

        var allFilters = fitclubHandler.urlParser();
        if (allFilters == "") {
            $(".sidenav-wrapper .left-column ul li").show();
            addActiveClass(".sidenav-wrapper li a.show-all");

        } else if (allFilters.length > 1) {
            addActiveClass(".second-nav a." + allFilters[0] + " h2");
            removeActiveClass(".sidenav-wrapper li a");
            addActiveClass(".sidenav-wrapper li a[data-category=" + allFilters[1] + "");

            var value = $('#mobile-muscle-group option[data-category=' + allFilters[1] + '').val();
            $('#mobile-muscle-group').val(value);

            fitclubHandler.showSideNavWithBodyPartSelected(".sidenav-wrapper .left-column ul li", allFilters[0]);
            fitclubHandler.showSideNavWithBodyPartSelected("#mobile-muscle-group option", allFilters[0]);

            // showSideNavWithBodyPartSelected(allFilters[0]);

            hideAllVideos();

            $("#videos-grid .test .col-flex").each(function() {
                var $this = $(this);
                var dataTags = $this.data("tags");
                if (allFilters[1] == "all-muscle-group") {
                    addActiveClass(".sidenav-wrapper li a.show-all");
                    if (checkIfTagExist(dataTags, allFilters[0])) {
                        $(this).show();
                    }
                } else {
                    if (checkIfTagExist(dataTags, allFilters[0]) && checkIfTagExist(dataTags, allFilters[1])) {
                        $(this).show();
                    }
                }

            });
        } else {

            fitclubHandler.showSideNavWithBodyPartSelected(".sidenav-wrapper .left-column ul li", allFilters[0]);
            fitclubHandler.showSideNavWithBodyPartSelected("#mobile-muscle-group option", allFilters[0]);
            addActiveClass(".second-nav a." + allFilters[0] + " h2");
            removeActiveClass(".sidenav-wrapper li a");
            hideAllVideos();

            // var bodyPartArray = ['total-body', 'chest', 'arms', 'back', 'shoulders', 'legs', 'core'];
            var bodyPartArray = ['chest', 'arms', 'back', 'shoulders', 'legs', 'core'];

            if (bodyPartArray.indexOf(allFilters[0]) > -1) {
                // if(allFilters[0] == "total-body"){
                //     $(".sidenav-wrapper ul").hide();
                // } else{
                    addActiveClass(".sidenav-wrapper li a[data-category='all-muscle-group']");
                // }
                showRelatedVideos("#videos-grid .test .col-flex", allFilters[0]);
            } else {
                $(".sidenav-wrapper li").show();
                if (allFilters[0] == "all-muscle-group") {
                    addActiveClass(".sidenav-wrapper li a.show-all");
                    // addActiveClass(".sidenav-wrapper li a." + allFilters[0]);
                    showAllVideos();
                } else {
                    $('#mobile-muscle-group option').show();
                    var value = $('#mobile-muscle-group option[data-category=' + allFilters[0] + '').val();
                    $('#mobile-muscle-group').val(value);
                    addActiveClass(".sidenav-wrapper li a[data-category=" + allFilters[0] + "");
                    showRelatedVideos("#videos-grid .test .col-flex", allFilters[0]);
                }

            }
        }
    }

    function loadVideoGrid(response) {
        $('#videos-grid')
            .html(_templates.videos({
                response: response
            }));
        startInitialiazation();
    }

    function startInitialiazation(){
        initLazyLoader();
        hideSpinner();
        setFilterWithHash();
        $(".accessible").mouseover(function(){
            $this = $(this);
            $this.find(".play-button, .image-overlay").show();
        });
         $(".accessible").mouseout(function(){
            $this = $(this);
            $this.find(".play-button, .image-overlay").hide();
        });
        $("#sidenav-and-videos-wrapper .sidenav li, #fitclub-header .second-nav h2").on("click", function(){
            $(window).trigger("resize");
        })
    }

    function showSpinner() {
        $("#overlay").fadeIn();
    }

    function hideSpinner() {
        $("#overlay").fadeOut();
    }

    function onVideosLoaded(response) {
        // for(var i=0; i<response.length;i++){
        //     debugger;
        //     if(!response[i].category.primary_muscle_group){
        //         console.log(response[i]);
        //     }
        // }
        loadVideoGrid(response);
    }

    function requestVideos() {
        var category = (_category && _category.length) ? _category : '';
        var query = "?category=" + category;
        return ShredzAPI
            .getVideos(query)
            .then(onVideosLoaded);
    }

    function initLazyLoader() {
        $("img.lazy").lazyload({
            threshold : 200,
            effect : "fadeIn",
            failure_limit : 1000,
        });
    }


    function onDocumentReady() {
    }

    function bindEvents() {
        $(document).on('ready', onDocumentReady);
    }

    function boot() {
        fitclubHandler.registerHandlebarsHelpers();
        fitclubHandler.loadTemplates();
        showSpinner();
        requestVideos();
        bindEvents();
        setNavCategory();
    };

    boot();

})(window);
(function(window, undefined) {

    var $ = window.jQuery || window.$ || {};
    var document = window.document;
    var track = !$('meta[name="debug"]').length;
    var fbq = window.fbq || function() {};
    
	// UTILITY

    function createChart(elm, type, data, xAxisLabel, yAxisLabel, minValue, maxValue) {
    	var ctx = $(elm).get(0).getContext('2d');
		return new Chart(ctx, {
    		type: type,
    		data: data,
    		options: {
    			scales: {
    				xAxes: [{
    					ticks: {
		                    beginAtZero:true
		                },
	                    display: true,
		                scaleLabel: {
		                	display: true,
		                    labelString: xAxisLabel
		                }
	                }],
		            yAxes: [{
		                ticks: {
		            		min: minValue,
		            		max: maxValue
		                },
		                display: true,
		                scaleLabel: {
		                	display: true,
		                    labelString: yAxisLabel,

		                }
		            }]
		        }
		    }

    	});

    }


    var inViewFocus, inViewAttention, inViewAlertness = false;

	function isScrolledIntoView(elem)
	{
	    var docViewTop = $(window).scrollTop();
	    var docViewBottom = docViewTop + $(window).height();

	    var elemTop = $(elem).offset().top + 100;
	    var elemBottom = elemTop + $(elem).height() +100;
	    return ((elemTop <= docViewBottom) && (elemBottom >= docViewTop));
	}

    // INITIALIZATION
	function initializeFocusChart() {
		var focusDataOne = {
			labels: [""],
			datasets: [
				{
					label: "Placebo",
					// The properties below allow an array to be specified to change the value of the item at the given index
					// String  or array - the bar color
					backgroundColor: "rgba(220,220,220,0.2)",

					// String or array - bar stroke color
					borderColor: "rgba(220,220,220,1)",

					// Number or array - bar border width
					borderWidth: 1,
					data: [0.85],
				},
				{
					label: "Focus",
					backgroundColor: "rgba(151,187,205,0.8)",
					borderColor: "rgba(220,220,220,1)",
					borderWidth: 1,
					data: [0.885],
				}
			]
		};

		createChart(
			$('#focusGraphOne'),
			'bar',
			focusDataOne,
			'',
			'Hit Rate',
			0.8,
			0.9
		);

		var focusDataTwo = {
			labels: [""],
			datasets: [
				{
					label: "Placebo",
					// The properties below allow an array to be specified to change the value of the item at the given index
					// String  or array - the bar color
					backgroundColor: "rgba(220,220,220,0.2)",

					// String or array - bar stroke color
					borderColor: "rgba(220,220,220,1)",

					// Number or array - bar border width
					borderWidth: 1,

					// The actual data
					data: [2.225],
				},
				{
					label: "Focus",
					backgroundColor: "rgba(151,187,205,0.8)",
					borderColor: "rgba(220,220,220,1)",
					borderWidth: 1,
					// hoverBackgroundColor: "rgba(220,220,220,0.2)",
					// hoverBorderColor: "rgba(220,220,220,1)",
					data: [2.7],
				}
			]
		};

		createChart(
			$('#focusGraphTwo'),
			'bar',
			focusDataTwo,
			'',
			'Discriminability Index d',
			2.0,
			2.8
		);
	}

	function initializeAttentionChart() {
		var attentionData = {
			labels: ["25", "40", "50", "60", "72", "85", "98", "120", "130", "142", "155", "165", "178"],
			datasets: [
				{
					label: "Placebo",
					fill: false,
					backgroundColor: "rgba(220,220,220,0.2)",
					borderColor: "rgba(220,220,220,1)",
					pointBorderColor: "rgba(220,220,220,1)",
					pointBackgroundColor: "#fff",
					pointBorderWidth: 1,
					pointHoverRadius: 5,
					pointHoverBackgroundColor: "rgba(220,220,220,1)",
					pointHoverBorderColor: "rgba(220,220,220,1)",
					pointHoverBorderWidth: 2,
					// The actual data
					data: [0.02, 0.04, 0.055, 0.072, 0.068, 0.07, 0.06, 0.05, 0.11, 0.14, 0.145, 0.1, 0.088],
				},
				{
					label: "Focus",
					fill: false,
					backgroundColor: "rgba(151,187,205,0.8)",
					borderColor: "rgba(151,187,205,0.8)",
					pointBorderColor: "rgba(220,220,220,1)",
					pointBackgroundColor: "#fff",
					pointBorderWidth: 1,
					pointHoverRadius: 5,
					pointHoverBackgroundColor: "rgba(220,220,220,1)",
					pointHoverBorderColor: "rgba(220,220,220,1)",
					pointHoverBorderWidth: 2,
					data: [0.015, 0.02, 0.025, 0.025, 0.027, 0.03, 0.04, 0.032, 0.048, 0.05, 0.05, 0.07, 0.048]
				}
			]
		};

		createChart(
			$('#attentionGraph'),
			'line',
			attentionData,
			'Time Since Consumption (min)',
			'Errors (probability)'
		);
	}


	function initializeAlertnessChart() {
		var alertnessDataOne = {
			labels: ["20-50", "70-100"],
			datasets: [
				{
					label: "Placebo",
					// The properties below allow an array to be specified to change the value of the item at the given index
					// String  or array - the bar color
					backgroundColor: "rgba(220,220,220,0.2)",

					// String or array - bar stroke color
					borderColor: "rgba(220,220,220,1)",

					// Number or array - bar border width
					borderWidth: 1,

					// The actual data
					data: [93.2, 93.8],
				},
				{
					label: "Focus",
					backgroundColor: "rgba(151,187,205,0.8)",
					borderColor: "rgba(220,220,220,1)",
					borderWidth: 1,
					// hoverBackgroundColor: "rgba(220,220,220,0.2)",
					// hoverBorderColor: "rgba(220,220,220,1)",
					data: [94.3, 94.5],
				}
			]
		};

		createChart(
			$('#alertnessGraphOne'),
			'bar',
			alertnessDataOne,
			'Time after treatment (min)',
			'Accuracy (%)',
			92, 
			96
		);

		var alertnessDataTwo = {
			labels: ["20-50", "70-100"],
			datasets: [
				{
					label: "Placebo",
					// The properties below allow an array to be specified to change the value of the item at the given index
					// String  or array - the bar color
					backgroundColor: "rgba(220,220,220,0.2)",

					// String or array - bar stroke color
					borderColor: "rgba(220,220,220,1)",

					// Number or array - bar border width
					borderWidth: 1,

					// The actual data
					data: [4.5, 3],

				},
				{
					label: "Focus",
					backgroundColor: "rgba(151,187,205,0.8)",
					borderColor: "rgba(220,220,220,1)",
					borderWidth: 1,
					// hoverBackgroundColor: "rgba(220,220,220,0.2)",
					// hoverBorderColor: "rgba(220,220,220,1)",
					data: [10, 8],
				}
			]
		};

		createChart(
			$('#alertnessGraphTwo'),
			'bar',
			alertnessDataTwo,
			'Time after treatment (min)',
			'Change in alertness',
			0,
			14
		);

	}

	function initializeSlick() {
		$(".review-slider").slick();
	}

	function initializeFancyBox() {
    	$(".fancybox-images").fancybox({
    		//
        });
	}

	// EVENT HANDLER

    function onDocumentReady() {	
    	initializeFancyBox();
    	initializeSlick();

    	$(window).scroll(function() {
		    if (isScrolledIntoView('#focusGraphOne') && !inViewFocus) {
		        inViewFocus = true;
		        initializeFocusChart();
		    } 
		    if (isScrolledIntoView('#attentionGraph') && !inViewAttention) {
		        inViewAttention = true;
		        initializeAttentionChart();
		    }
		    if (isScrolledIntoView('#alertnessGraphOne') && !inViewAlertness) {
		        inViewAlertness = true;
		        initializeAlertnessChart();
		    }
		});


    	// $(".addToCart").on("click", onAddToCartButtonClick);
    	$(".dropdown-menu").on("click", "a.dropdown-item", onAddToCartButtonClick);
    	$("#lastAddToCart").on("click", function(){
    		if(!$("#get-focused").hasClass("add-margin")){	
    			$("#get-focused").addClass("add-margin");
    		}
    		else{
    			$("#get-focused").removeClass("add-margin");
    		}
    	})

    	$('.page-scroll').bind('click', function(event) {
	        var $anchor = $(this);
	        if($(window).width()<767){
	        	$('html, body').stop().animate({
		            scrollTop: $($anchor.attr('href')).offset().top-70
		        }, 500, 'easeInOutExpo');
	        }

	        else{
	        	$('html, body').stop().animate({
		            scrollTop: $($anchor.attr('href')).offset().top-90
		        }, 500, 'easeInOutExpo');
	        }
	        
	        event.preventDefault();
	    });

    }

    function triggerFacebookAddToCart (sku){
      track && fbq('track', 'AddToCart', {
        'content_type'  : 'product',
        'content_ids'   : [ sku ],
        'value'         : 40,
        'currency'      : 'USD'
      });
    }
    
    function onAddToCartButtonClick(evt){
    	$this = $(this);
    	var productSku = $this.data("sku");
    	
    	sendToCart(productSku);
    	triggerFacebookAddToCart (productSku)
    }

    
    // ACTIONS

	function sendToCart(sku) {
	
	    var cartFactory = ShredzAPI.CartFactory.make();

	    cartFactory
	    .addItem(sku)
	    .promise()
	    .then(function() {
	        var url = $("meta[name='api-base']").attr('content') + "/cart";
	        window.location = url;
	    });
	}

    function bindEvents() {
        $(document).on("ready", onDocumentReady);
    }
    
    function boot() {
    	bindEvents();
    };

    boot();

})(window);

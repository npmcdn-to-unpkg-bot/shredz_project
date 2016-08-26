///////////////////////////////////////////////////////////////////////////////////////
//  GLOBAL VARIABLES
///////////////////////////////////////////////////////////////////////////////////////

var documentHeight = $(document).height();
var allSupplements = [];
var allEbooks = [];
var allApparel = [];
var defaultData = {
    gender: null,
    goal: null,
    email: null,
    supplementFilter: 'stack', // single
    supplements: [],
    selectedSupplements: [],
    ebooks: [],
    selectedEbooks: [],
    apparelFilter: 'trending', // tops, bottoms, accessories
    apparel: [],
    selectedApparel: [],
    freeEbookTotal: null,
    freeApparelTotal: null
}
var data;
var _templates = {};
var productsCache = {};
var userSelectedEbooks = {};
var fetchProductInfo = {};
var cartSku = [];

var cartFactory = ShredzAPI.CartFactory.make();

function fetchProductFromAPI(id) {
    if (productsCache[id]) {
        // console.log('fetching cached product', productsCache[id]);
        return Promise.resolve(productsCache[id]);
    } else {
        return ShredzAPI.ProductFactory.make().fetch(id).promise().then(function(product) {
            productsCache[id] = product;
            // console.log('fetching new product', productsCache[id].data());

            return productsCache[id];
        });
    }
}

///////////////////////////////////////////////////////////////////////////////////////
//  build dom based on gender selected
///////////////////////////////////////////////////////////////////////////////////////

function getGender() {
    return data.gender;
}

var freeEbook = 0;
var freeApparel = 0;

function onEbookClick(e) {
    var $this = $(this).find('.plan');
    var productId = $this.data('product-id');
    if (data.selectedEbooks.indexOf(productId) + 1) {
        freeEbook = Math.round(freeEbook + $this.data('price'));
        if (freeEbook > 0) {
            $("#free-ebook").text(freeEbook);
        } else {
            $("#free-ebook").text("0");
        }
        data.selectedEbooks.splice(data.selectedEbooks.indexOf(productId), 1);
    } else {
        freeEbook = Math.round(freeEbook - $this.data('price'));
        if (freeEbook > 0) {
            $("#free-ebook").text(freeEbook);
        } else {
            $("#free-ebook").text("0");
        }
        data.selectedEbooks.push(productId);
    }
    saveDataToLocalStorage();
    activateSelectedEbooks();
}

function activateSelectedEbooks() {
    $('.plans .ebook-container').removeClass('active');
    var selector = $.map(data.selectedEbooks, function(pid) {
        return '.plans .plan[data-product-id="' + pid + '"]';
    }).join(',');
    $(selector).parents('.ebook-container').addClass('active');
}

$('.plans').on('click', '.ebook-container', onEbookClick);


function setGender(gender) {
    data.gender = gender;
    saveDataToLocalStorage();
    filterProductSets(gender, data.goal);
}

function uiSetGender(gender) {
    var $leftCol = $('.gender.left-col');
    var $rightCol = $('.gender.right-col');
    var $maleButton = $('.gender .male');
    var $femaleButton = $('.gender .female');
    if ('m' === gender.toLowerCase().charAt(0)) {
        $femaleButton.removeClass('active');
        $maleButton.addClass('active');
        $leftCol.addClass('active');
        $rightCol.removeClass('active');
    } else if ('f' === gender.toLowerCase().charAt(0)) {
        $maleButton.removeClass('active');
        $femaleButton.addClass('active');
        $rightCol.addClass('active');
        $leftCol.removeClass('active');
    }
}


///////////////////////////////////////////////////////////////////////////////////////
//  build dom based on goal selected
///////////////////////////////////////////////////////////////////////////////////////

function getGoal() {
    return data.goal;
}

function setGoal(goal) {
    data.goal = goal;
    saveDataToLocalStorage();
    filterProductSets(goal, data.gender);

    // setStackSlider(data.supplements);
    // setSingleSlider(data.supplements);
    // setTrendingSlider(data.supplements);
    // setTopsSlider(data.supplements);
    // setBottomsSlider(data.supplements);
    // setAccessoriesSlider(data.supplements);
}

function uiSetGoal(goal) {
    var $leftCol = $('.goal.left-col');
    var $rightCol = $('.goal.right-col');
    var $weightLoss = $('.goal .weight-loss');
    var $buildMuscle = $('.goal .build-muscle');
    if ('w' === goal.toLowerCase().charAt(0)) {
        $buildMuscle.removeClass('active');
        $weightLoss.addClass('active');
        $leftCol.addClass('active');
        $rightCol.removeClass('active');
    } else if ('b' === goal.toLowerCase().charAt(0)) {
        $weightLoss.removeClass('active');
        $buildMuscle.addClass('active');
        $rightCol.addClass('active');
        $leftCol.removeClass('active');
    }
}

///////////////////////////////////////////////////////////////////////////////////////
//  Floating label after email filled or on focus
///////////////////////////////////////////////////////////////////////////////////////
function floatingLabel() {
    var cartInput = $('#step1_email');
    var checkInput = function() {
        cartInput.each(
            function() {
                if (!getEmail()) {
                    $(this).removeClass('floating');
                } else if ($(this).val().length > 0) {
                    $(this).addClass('floating')
                }
            });
    }
    checkInput();
    cartInput.on('blur', function() {
        checkInput();
    });
}
///////////////////////////////////////////////////////////////////////////////////////
//  save email to local storage
///////////////////////////////////////////////////////////////////////////////////////

function getEmail() {
    return data.email;
}

function setEmail(email) {
    data.email = email;
    saveDataToLocalStorage();
    $("#step1_email").val(data.email);
}

function uiSetEmail(email) {
    var emailInput = $('#step1_email');
    $(emailInput).val(email);
}

///////////////////////////////////////////////////////////////////////////////////////
//  Manipulate dom based on previous selection
///////////////////////////////////////////////////////////////////////////////////////

function setPreviouslySelectedProducts(data) {
    var selectedSupplements = data && data.selectedSupplements;
    var selectedEbooks = data && data.selectedEbooks;
    var selectedApparel = data && data.selectedApparel;
    var apparel;
    var ebook;
    if (selectedSupplements && selectedSupplements.length > 0) {
        $.each(selectedSupplements, function(index, value) {
            var productId = selectedSupplements[index].product_id;
            var subscription = selectedSupplements[index].subscription;
            var findElementWithProductId = '*[data-product-id="' + productId + '"]';
            var selectedProductDiv = $("body").find(findElementWithProductId);

            if ($(selectedProductDiv).parents("#stack").length > 0) {
                // $(selectedProductDiv).find(".add-to-plan").text("ADDED!").addClass("added");
                // $(selectedProductDiv).find(".dummy-subscription-button").prop("disabled", true);       

                if (subscription === "subscribed") {
                    $(selectedProductDiv).find(".add-to-plan").text("Add to plan").removeClass("added");
                    $(selectedProductDiv).find(".dummy-subscription-button").text("Subcribed!").addClass("added");
                } else {
                    $(selectedProductDiv).find(".add-to-plan").text("ADDED to plan").addClass("added");
                    $(selectedProductDiv).find(".dummy-subscription-button").text("Subcribe & save");
                }

                fetchProductFromAPI(productId).then(function(product) {
                    $(selectedProductDiv).data('product', product);
                })
                    .then(function() {
                        apparel = $(selectedProductDiv).data("product").meta().creditapparel;
                        ebook = $(selectedProductDiv).data("product").meta().creditebook;
                        freeEbook = ebook;
                        freeApparel = apparel;
                        $("#free-ebook").text(ebook);
                        $("#free-apparel").text(apparel);
                        $("#ebook-credit, #apparel-credit").show();
                    })
                    .then(function() {
                        if (selectedEbooks.length > 0) {
                            $.each(selectedEbooks, function(index, value) {
                                fetchProductFromAPI(value).then(function(ebook) {
                                    var selectedEbookPrice = ebook.variant().price;
                                    freeEbook = Math.round(freeEbook - selectedEbookPrice);
                                    if (freeEbook > 0) {
                                        $("#free-ebook").text(freeEbook);
                                    } else {
                                        $("#free-ebook").text("0");
                                    }
                                })
                            })
                        }
                    })
                    .then(function() {
                        if (selectedApparel.length > 0) {
                            $.each(selectedApparel, function(index, value) {
                                var productId = selectedApparel[index].product_id;
                                var findElementWithProductId = '*[data-product-id="' + productId + '"]';
                                var selectedProductDiv = $("body").find(findElementWithProductId);
                                $(selectedProductDiv).addClass("added-product");
                                $.each(value.selected_options, function(key, value) {
                                    var $group = $(selectedProductDiv).find('[data-option-name="' + key + '"]');
                                    $group.find("li").addClass("li-disable");
                                    var $option = $group.find('[data-option-value="' + value + '"]');
                                    $option.addClass("active");
                                });

                                $(selectedProductDiv).find(".add-to-plan").text("Added to plan").addClass("added");
                                $(selectedProductDiv).find(".dummy-subscription-button");

                                fetchProductFromAPI(productId).then(function(apparel) {
                                    var selectedApparelPrice = apparel.variant().price;
                                    freeApparel = Math.round(freeApparel - selectedApparelPrice);
                                    if (freeApparel > 0) {
                                        $("#free-apparel").text(freeApparel);
                                    } else {
                                        $("#free-apparel").text("0");
                                    }
                                })
                            })
                        }
                    })
            } else {

                if (subscription === "subscribed") {
                    $(selectedProductDiv).find(".add-to-plan").text("Add to plan").removeClass("added");
                    $(selectedProductDiv).addClass("added-product");
                    $(selectedProductDiv).find(".dummy-subscription-button").text("Subcribed!").addClass("added");
                } else {
                    $(selectedProductDiv).addClass("added-product");
                    $(selectedProductDiv).find(".add-to-plan").text("Added to plan").addClass("added");
                    $(selectedProductDiv).find(".dummy-subscription-button").text("Subcribe & save");
                }

                // $(selectedProductDiv).find(".add-to-plan").text("Added to plan").addClass("added");
                // $(selectedProductDiv).find(".dummy-subscription-button");
            }
        })
    }
}

// }
///////////////////////////////////////////////////////////////////////////////////////
//  uiRefresh() will get rendered on page refresh
//  Filter the results/modify dom with locastorage data
///////////////////////////////////////////////////////////////////////////////////////

function uiRefresh() {
    if (loadDataFromLocalStorage().gender) {
        filterProductSets(data);
        uiSetGender(getGender());
        uiSetGoal(getGoal());
        uiSetEmail(getEmail());
        //uiSetStackSlider(getStackSlider());
        //uiSetSingleSlider(getSingleSlider());
        uiSetEbooks(getEbooks());
        activateSelectedEbooks();
        //uiSetApparelSlider(getApparelSlider());
        // uiSetTopsSlider(getTopsSlider());
        // uiSetBottomsSlider(getBottomsSlider());
        //uiSetAccessoriesSlider(getAccessoriesSlider());
        setTimeout(function() {
            setPreviouslySelectedProducts(loadDataFromLocalStorage());
        }, 1000);
    }

}

function enableNextButton() {
    if (data.selectedSupplements.length === 0) {
        $("#next").prop("disabled", true);
        $("#fakeNext").prop("disabled", true);
    } else {
        $("#next").prop("disabled", false);
        $("#fakeNext").prop("disabled", false);        
    }
}
///////////////////////////////////////////////////////////////////////////////////////
//  checkFooter()
///////////////////////////////////////////////////////////////////////////////////////

function checkFooter() {
    if ($("#step1").hasClass('current')) {
        $('.left-action').hide();
        $('.right-action').hide();

    } else {
        $('.left-action').show();
        $('.right-action').show();
    }
    if ($('#step4').hasClass('current')) {
        $(".left-action").show();
        $('.right-action').hide();
    }

    if ($("#step3").hasClass('current')) {
        $("#next").prop("disabled", false);
    }
    if ($("#step2").hasClass('current')) {
        if ($(".stack").hasClass('active')) {
            $('.product-footer').hide();
            $('.product-footer').removeClass('relative');
            $('.product-content').removeClass('has-footer');
        }
        if ($(".single").hasClass('active')) {
            $('.product-footer').show();

            // $('#next').prop('disabled', true);

            if (data.selectedSupplements.length === 0) {
                $("#fakeNext").prop("disabled", true);
            } else {
                $("#fakeNext").prop("disabled", false);
            }
            $('#next').hide();
            $('#fakeNext').show();
            $('.product-footer').addClass('relative');
        }

    } else {
        $("#next").show();
        $('#fakeNext').hide();
        $('.product-footer').show();
        $('.product-content').addClass('has-footer');
        $('.product-footer').removeClass('relative');

    }

    if ($('#step4').hasClass('current')) {
        $('#next').hide();
        
    }

}

///////////////////////////////////////////////////////////////////////////////////////
//  hashManager()
///////////////////////////////////////////////////////////////////////////////////////

function changeHash() {
    var currentHash = window.location.hash;
    scrollTop();
    //show current view
    $('.steps').hide();
    $('.steps').removeClass('current');
    $(currentHash).show();
    $(currentHash).addClass('current');

    //make current breadcrumb 'active'
    $('.breadcrumb li').removeClass('active');
    //First breadcrumb active by default
    $('.breadcrumb li:first-child').addClass('active');
    //current breadcrumb and all previous ones with same class
    $('.breadcrumb li a[data-href="' + currentHash + '"]').parents('li').addClass('active').prevAll().addClass('active');
    //making active and previous ones clickable(href)
    $('.breadcrumb .active a').each(function() {
        $(this).attr('href', $(this).attr('data-href'));
    });

    if (currentHash == "#step1") {
        $("#next").on("click", function() {
            if (getEmail() && getEmail().length > 0) {
                var email = getEmail();
                cartFactory.contact({
                    email: email
                }).addCoupon('30daystack').addCoupon('30daycomplete');
            }
        })
    }
    if (currentHash == "#step2") {
        $(".stack-slider .slick-prev").trigger("click");
        $(".single-slider .slick-prev").trigger("click");
        // $(window).trigger('resize');
    }
    if (currentHash == "#step4") {
        $(".apparel-slider .slick-prev").trigger("click");
        $(".accessories-slider .slick-prev").trigger("click");
        $("#next, #skip").hide();
        $("#checkout").show();
        // $(window).trigger('resize');
    } else {
        $("#next, #skip").show();
        $("#checkout").hide();
    }

    if (currentHash == "") {
        window.location.hash = "step1";
    }
    checkFooter()
}

$(window).on('hashchange', function() {
    changeHash();
})

///////////////////////////////////////////////////////////////////////////////////////
//  filterProductSets() will filter products based on selected gender and goal
///////////////////////////////////////////////////////////////////////////////////////

function filterProductSets() {
    var gender;
    if (data.gender) {
        gender = data.gender.toLowerCase().charAt(0);
    }
    var goal;
    if (data.goal) {
        goal = data.goal;
    }

    if (gender && goal) {
        data.supplements = $.map(allSupplements, function(product) {
            if (product.gender.toLowerCase().charAt(0) === 'u') {
                var currentProductFlags = product.flags;
                for (var i = 0; i < currentProductFlags.length; i++) {
                    if (currentProductFlags[i].toLowerCase().charAt(0) === goal.toLowerCase().charAt(0)) {
                        return product;
                    }
                }
            } else if (product.gender.toLowerCase().charAt(0) === gender) {
                var currentProductFlags = product.flags;
                for (var i = 0; i < currentProductFlags.length; i++) {
                    if (currentProductFlags[i].toLowerCase().charAt(0) === goal.toLowerCase().charAt(0)) {
                        return product;
                    }
                }
            } else {
                return null;
            }
        });

        data.ebooks = $.map(allEbooks, function(product) {
            if (product.gender.toLowerCase().charAt(0) === 'u') {
                return product;
            } else if (product.gender.toLowerCase().charAt(0) !== gender) {
                return null;
            } else {
                return product;
            }
        });

        data.apparel = $.map(allApparel, function(product) {
            if (product.gender.toLowerCase().charAt(0) === 'u') {
                return product;
            } else if (product.gender.toLowerCase().charAt(0) !== gender) {
                return null;
            } else {
                return product;
            }
        });
    }

    setStackSlider(data.supplements);
    setSingleSlider(data.supplements);
    setEbooks(data.ebooks);
    setApparelSlider(data.apparel);
    setAccessoriesSlider(data.apparel);

}

///////////////////////////////////////////////////////////////////////////////////////
//  loadDataFromLocalStorage()-> load localstorage data if set
///////////////////////////////////////////////////////////////////////////////////////

function loadDataFromLocalStorage() {
    try {
        data = JSON.parse(localStorage['__shredz_product_builder__']);
    } catch (e) {
        data = $.extend({}, defaultData);
    }

    return data;
}

///////////////////////////////////////////////////////////////////////////////////////
//  saveDataToLocalStorage()-> save localstorage data
///////////////////////////////////////////////////////////////////////////////////////

function saveDataToLocalStorage() {
    try {
        if (localStorage) {
            localStorage['__shredz_product_builder__'] = JSON.stringify(data);
        }
    } catch (e) {
        // DO NOTHING
    }
}

///////////////////////////////////////////////////////////////////////////////////////
//  fetchApiData()-> fetch api data based on productSetId
///////////////////////////////////////////////////////////////////////////////////////

function fetchApiData() {
    var supplements = ShredzAPI.getProducts({
        productSetId: 159
    });
    var ebooks = ShredzAPI.getProducts({
        productSetId: 157
    });
    var apparel = ShredzAPI.getProducts({
        productSetId: 158
    });
    supplements
        .then(function(res) {
            return allSupplements = res.data;
        });
    ebooks
        .then(function(res) {
            return allEbooks = res.data;
        });
    apparel
        .then(function(res) {
            return allApparel = res.data;
        });
    return Promise.all([
        supplements,
        ebooks,
        apparel
    ]);
}

///////////////////////////////////////////////////////////////////////////////////////
//  Handlebar Helper
///////////////////////////////////////////////////////////////////////////////////////

function loadTemplates() {
    $('script[type="text/x-handlebars-template"]').each(function() {
        var $this = $(this);
        _templates[$this.attr('name')] = Handlebars.compile($this.html());
    });
}

function registerHandlebarsHelpers() {
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
}

var slickOptions = {
    draggable: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: false,
    responsive: [{
        breakpoint: 5000,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
        }
    }, ]
}

var slickOptionsAccessories = {
    draggable: false,
    slidesToShow: 2,
    slidesToScroll: 2,
    infinite: false,
    responsive: [{
        breakpoint: 5000,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
        }
    }, ]
}

///////////////////////////////////////////////////////////////////////////////////////
//  Compile handlbar templates for slider and ebooks
///////////////////////////////////////////////////////////////////////////////////////

//STACK
function getStackSlider() {
    var filteredStackProducts = [];
    var copiedData = data.supplements;
    for (var i = 0; i < copiedData.length; i++) {
        if (copiedData[i].categories.indexOf('stack') !== -1) {
            filteredStackProducts.push(copiedData[i]);
        }
    }
    // return data.supplements;
    return filteredStackProducts;
}

function setStackSlider(stackSlider) {
    var filteredStackProducts = [];
    data.supplements = stackSlider;
    var objectLength = stackSlider.length;
    for (var i = 0; i < objectLength; i++) {
        if (stackSlider[i].categories.indexOf('stack') !== -1) {
            filteredStackProducts.push(stackSlider[i]);
        }
    }
    uiSetStackSlider(filteredStackProducts);
}

function uiSetStackSlider(data) {
    var $stackSlider = $('.stack-slider');

    if ($stackSlider.data('initialized')) {
        $stackSlider.slick('unslick');
    }

    $stackSlider
        .html(_templates.stackSingleSlider({
            data: data
        }))
        .data('initialized', true)
        .slick(slickOptions)
        .slick("prev");
}


//SINGLE
function getSingleSlider() {
    var filteredSingleProducts = [];
    var copiedData = data.supplements;
    for (var i = 0; i < copiedData.length; i++) {
        if (copiedData[i].categories.indexOf('single') !== -1) {
            filteredSingleProducts.push(copiedData[i]);
        }
    }
    return filteredSingleProducts;
}

function setSingleSlider(singleSlider) {
    var filteredSingleProducts = [];
    data.supplements = singleSlider;
    var objectLength = singleSlider.length;
    for (var i = 0; i < objectLength; i++) {
        if (singleSlider[i].categories.indexOf('single') !== -1) {
            filteredSingleProducts.push(singleSlider[i]);
        }
    }
    uiSetSingleSlider(filteredSingleProducts);
}

function uiSetSingleSlider(data) {
    var $singleSlider = $('.single-slider');
    if ($singleSlider.data('initialized')) {
        $singleSlider.slick('unslick');
    }

    if (data.length > 3) {
        $singleSlider
            .html(_templates.stackSingleSlider({
                data: data
            }))
            .data('initialized', true)
            .slick(slickOptions)
            .slick("prev");
    } else {
        $singleSlider
            .html(_templates.stackSingleSlider({
                data: data
            }))
            .data('initialized', true)
            .slick({
                draggable: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                responsive: [{
                    breakpoint: 5000,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }, ]
            }).slick("prev");
        $("#single .slick-slide img").css({
            "max-width": "300px"
        });
    }
}

//EBOOKS
function getEbooks() {
    return data.ebooks;
}

function setEbooks(ebooks) {
    data.ebooks = ebooks;
    uiSetEbooks(ebooks);
    $.each(ebooks, function() {
        var productId = this.id;
        var findElementWithProductId = '[data-product-id="' + productId + '"]';
        if (!$(".desktop-benefits ul" + findElementWithProductId).hasClass("initialized")) {
            $('.desktop-benefits ul' + findElementWithProductId).addClass("initialized");
            fetchProductFromAPI(productId).then(function(ebook) {
                var ebookMeta = ebook.meta();
                $.each(ebookMeta, function(key, value) {
                    if (key.indexOf("p") == 0) {
                        $('.desktop-benefits ul' + findElementWithProductId).append("<li><i class='fa fa-check'></i>&nbsp;" + value + "</li>");
                    }
                });
            })
        }
    })
}

function uiSetEbooks(ebooks) {
    $('.plans')
        .html(_templates.ebooks({
            ebooks: ebooks
        }));
}

//APPAREL
function getApparelSlider() {
    var filteredApparelProducts = [];
    var copiedData = data.apparel;
    for (var i = 0; i < copiedData.length; i++) {
        if (copiedData[i].categories.indexOf('apparel') !== -1) {
            filteredApparelProducts.push(copiedData[i]);
        }
    }
    return filteredApparelProducts;
}

function setApparelSlider(apparelSlider) {
    var filteredApparelProducts = [];
    data.apparel = apparelSlider;
    var objectLength = apparelSlider.length;
    for (var i = 0; i < objectLength; i++) {
        if (apparelSlider[i].categories.indexOf('apparel') !== -1) {
            filteredApparelProducts.push(apparelSlider[i]);
        }
    }
    uiSetApparelSlider(filteredApparelProducts);
}

function uiSetApparelSlider(data) {
    var $apparelSlider = $('.apparel-slider');
    if ($apparelSlider.data('initialized')) {
        $apparelSlider.slick('unslick');
    }

    if (data.length > 3) {
        $apparelSlider
            .html(_templates.apparelAccessoriesSlider({
                data: data
            }))
            .data('initialized', true)
            .slick(slickOptions)
            .slick("prev");
    } else {
        $apparelSlider
            .html(_templates.apparelAccessoriesSlider({
                data: data
            }))
            .data('initialized', true)
            .slick({
                draggable: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                responsive: [{
                    breakpoint: 5000,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }, ]
            }).slick("prev");
    }
}

//ACCESSORIES

function getAccessoriesSlider() {
    var filteredAccessoriesProducts = [];
    var copiedData = data.apparel;
    for (var i = 0; i < copiedData.length; i++) {
        if (copiedData[i].categories.indexOf('accessories') !== -1) {
            filteredAccessoriesProducts.push(copiedData[i]);
        }
    }
    return filteredAccessoriesProducts;
}

function setAccessoriesSlider(accessoriesSlider) {
    var filteredAccessoriesProducts = [];
    data.apparel = accessoriesSlider;
    var objectLength = accessoriesSlider.length;
    for (var i = 0; i < objectLength; i++) {
        if (accessoriesSlider[i].categories.indexOf('accessories') !== -1) {
            filteredAccessoriesProducts.push(accessoriesSlider[i]);
        }
    }
    uiSetAccessoriesSlider(filteredAccessoriesProducts);
}




function uiSetAccessoriesSlider(data) {
    var $accessoriesSlider = $('.accessories-slider');
    if ($accessoriesSlider.data('initialized')) {
        $accessoriesSlider.slick('unslick');
    }
    if (data.length > 3) {
        $accessoriesSlider
            .html(_templates.apparelAccessoriesSlider({
                data: data
            }))
            .data('initialized', true)
            .slick(slickOptionsAccessories)
            .slick("prev");
    } else {
        $accessoriesSlider
            .html(_templates.apparelAccessoriesSlider({
                data: data
            }))
            .data('initialized', true)
            .slick({
                draggable: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                responsive: [{
                    breakpoint: 5000,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }, ]
            }).slick("prev");
    }
}

///////////////////////////////////////////////////////////////////////////////////////
//  Initialze functions
///////////////////////////////////////////////////////////////////////////////////////

function init() {
    Promise.all([
        fetchApiData(),
        loadDataFromLocalStorage(),
    ])
        .then(function() {
            // pull selected details
        })
        .then(function() {
            uiRefresh();
        });
}


function boot() {
    loadTemplates();
    registerHandlebarsHelpers();
    init();
}

boot();

///////////////////////////////////////////////////////////////////////////////////////
//  DOCUMENT ON READY
///////////////////////////////////////////////////////////////////////////////////////

$(function() {
    onDocumentReady();
});

///////////////////////////////////////////////////////////////////////////////////////
//  scrollTop() scrolls to top
///////////////////////////////////////////////////////////////////////////////////////
function scrollTop() {
    $("html, body").animate({
        scrollTop: 0
    }, "slow");
}

///////////////////////////////////////////////////////////////////////////////////////
//  onDocumentReady() fires after document load
///////////////////////////////////////////////////////////////////////////////////////

function onDocumentReady() {
    if (!window.localStorage.getItem("__shredz_product_builder__")) {
        window.location.hash = '';
    }

    if (getEmail() && getEmail().length > 0) {
        $("#step1_email").addClass("floating");
    }

    // document.body.scrollTop = document.documentElement.scrollTop = 0;
    scrollTop();
    stepsManager();
    changeHash();
    floatingLabel();
    gaEventListeners();

    $('#step2 a.single').on('click', function() {
        $('.product-footer').show();
        $('.product-footer').addClass('relative');
        $('.product-footer').addClass('has-footer');
    })

    if (data.gender) {
        $('#step1').removeClass('show-gender');
        checkGender();
    }

    if (data.gender && data.goal) {
        $('#step1').removeClass('show-gender');
        $('#step1').addClass('show-gender-goal-email');
        $("#next").prop("disabled", false);
    }
    $(".main-content").addClass(data.gender);
    $(".gender a").on("click", onGenderButtonClick);
    $(".goal a").on("click", {
        "selector": "goal"
    }, onGoalButtonClick);

    $("#step1_email").on("change paste keyup", onEmailFormChange);

    $('#email_form').submit(function(event) {
        event.preventDefault();
        event.returnValue = false;
        $("#next").click();    
    });   

    // $(".goal a").on("click", {"selector" : "goal"},  addActiveClass);
    $(".menu-selector ul li a").on("click", {
        "selector": "menu-selector li"
    }, addActiveClass);
    $(".apparel-menu-selector ul li a").on("click", {
        "selector": "apparel-menu-selector li"
    }, addActiveClass);

    // $(".choose-plan .plan").on("click", function(){
    //     $(this).toggleClass("active");
    // });

    //initialize first tab slider 
    // initSlickSlider();

    //Add male/female class on top level
    $(".gender a.male").click(function() {
        $(".main-content").removeClass("female").addClass("male");
    });

    $(".gender a.female").click(function() {
        $(".main-content").removeClass("male").addClass("female");
    });

    //  Add/Remove Slick Slider
    $(".menu-selector ul li a").on("click", {
        "selector": ".menu-selector li"
    }, whichMenu);
    $(".apparel-menu-selector ul li a").on("click", {
        "selector": ".apparel-menu-selector li"
    }, whichMenu);

}

function checkGender() {
    if (data.gender == 'female') {
        $('.build-muscle').html('<i class="circle icon-shape_filled"></i><span class="text">Shape <span>& Tone</span></span>')
        $('.weight-loss').html('<i class="circle icon-female_weight"></i><span class="text">Weight <span>Loss</span></span>')
    } else {
        $('.weight-loss').html('<i class="circle icon-male-weightloss"></i><span class="text">Weight <span>Loss</span></span>')
        $('.build-muscle').html('<i class="circle icon-muscle"></i><span class="text">Build <span>Muscle</span></span>')
    }
}


var total = 0;
var totalEbookPrice = 0;
var totalApparelPrice = 0;
var subtotal = 0;

$("#summary").on("click", function() {
    total = 0;
    totalEbookPrice = 0;
    totalApparelPrice = 0;
    subtotal = 0;
    $("#modalSummary .modal-total").text("");
    $("#modalSummary .modal-body").html("");
    var selectedSupplements = loadDataFromLocalStorage().selectedSupplements;
    var selectedSupplements = loadDataFromLocalStorage().selectedSupplements;
    var selectedEbooks = loadDataFromLocalStorage().selectedEbooks;
    var selectedApparel = loadDataFromLocalStorage().selectedApparel;
    var freeEbookCredit = loadDataFromLocalStorage().freeEbookTotal;
    var freeApparelCredit = loadDataFromLocalStorage().freeApparelTotal;

    var promises = [];

    if (selectedSupplements.length > 0) {
        $.each(selectedSupplements, function(index, value) {
            var productId = selectedSupplements[index].product_id;
            promises.push(
                fetchProductFromAPI(productId).then(function(product) {
                    if (selectedSupplements[index].subscription === "subscribed") {
                        var productName = product.data().name;
                        var productPrice = product.subscriptionVariant().price;
                        total = total + productPrice;
                        subtotal = subtotal + productPrice;
                        var assetLocation = product.variant().asset_location;
                        var productThumb = assetLocation + "primaryimage_new.png";
                        $("#modalSummary .modal-body").append("<div class='row'><div class='col-xs-8 name'><img src=" + productThumb + ">" + productName + "</div><div class='col-xs-4 price'>$" + productPrice + "</div></div>");
                        // $(".modal-body").append("<p> $"+ productPrice +"</p>");
                    } else {
                        var productName = product.data().name;
                        var productPrice = product.variant().price;
                        total = total + productPrice;
                        subtotal = subtotal + productPrice;
                        var assetLocation = product.variant().asset_location;
                        var productThumb = assetLocation + "primaryimage_new.png";
                        $("#modalSummary .modal-body").append("<div class='row'><div class='col-xs-8 name'><img src=" + productThumb + ">" + productName + "</div><div class='col-xs-4 price'>$" + productPrice + "</div></div>");
                        // $(".modal-body").append("<p> $"+ productPrice +"</p>");
                    }
                })
            )
        })
    }
    if (selectedEbooks.length > 0) {
        $.each(selectedEbooks, function(index, value) {
            promises.push(
                fetchProductFromAPI(value).then(function(ebook) {
                    var selectedEbookName = ebook.variant().name;
                    var selectedEbookPrice = ebook.variant().price;
                    var assetLocation = ebook.variant().asset_location;
                    totalEbookPrice = totalEbookPrice + selectedEbookPrice;
                    // total = total + selectedEbookPrice;
                    subtotal = subtotal + selectedEbookPrice;
                    var ebookThumb = assetLocation + "primaryimage_new.png";
                    // var applicableCredit = (ebookCredit - ebookRedeemedValue); // remaining credit per iteration
                    // var appliedCredit = 0;
                    $("#modalSummary .modal-body").append("<div class='row'><div class='col-xs-8 name'><img src=" + ebookThumb + ">" + selectedEbookName + "</div><div class='col-xs-4 price'>$" + selectedEbookPrice.toFixed(2) + "</div></div>");

                })
            )
        })
    }
    if (selectedApparel.length > 0) {
        $.each(selectedApparel, function(index, value) {
            promises.push(
                fetchProductFromAPI(value.product_id).then(function(apparel) {
                    var selectedApparelName = apparel.variant().name;
                    var selectedApparelPrice = apparel.variant().price;
                    var assetLocation = apparel.variant().asset_location;
                    var apparelThumb = assetLocation + apparel.variant().assets[0];
                    totalApparelPrice = totalApparelPrice + selectedApparelPrice;
                    subtotal = subtotal + selectedApparelPrice;
                    // total = total + selectedApparelPrice;                    
                    $("#modalSummary .modal-body").append("<div class='row'><div class='col-xs-8 name'><img src=" + apparelThumb + ">" + selectedApparelName + "</div><div class='col-xs-4 price'>$" + selectedApparelPrice.toFixed(2) + "</div></div>");
                })
            )
        })
    }

    Promise.all(promises).then(function() {
        $("#modalSummary .modal-total").append("<div class='totals'><div class='col-xs-8 name'>Sub Total</div> <div class='col-xs-4 price text-right'> $" + Math.round(subtotal * 100) / 100 + "</div></div>");

        if (totalEbookPrice == 0) {
            if (freeEbookCredit > 0) {
                $("#modalSummary .modal-total").append("<div class='unreedemed'><div class='col-xs-8 name'>Unreedemed Ebook Credit</div> <div class='col-xs-4 price text-right'> $" + Math.round(freeEbookCredit * 100) / 100 + "</div></div>");
            }
        } else if (totalEbookPrice < freeEbookCredit) {
            total = total - totalEbookPrice;
            // $(".modal-total").append("<div class=''><div class='col-xs-8 name'>Ebook Total</div> <div class='col-xs-4 price text-right'>- $" + Math.round(totalEbookPrice*100)/100 + "</div></div>");
            var unreedemedCredit = Math.round(parseInt(freeEbookCredit) - parseInt(totalEbookPrice));
            $("#modalSummary .modal-total").append("<div class='unreedemed'><div class='col-xs-8 name'>Unreedemed Ebook Credit</div> <div class='col-xs-4 price text-right'>$" + unreedemedCredit + "</div></div>");

        } else {
            total = total - freeEbookCredit + totalEbookPrice;
            if (freeEbookCredit > 0) {
                $("#modalSummary .modal-total").append("<div class=''><div class='col-xs-8 name'>Applied Ebook Credit</div> <div class='col-xs-4 price text-right'>- $" + freeEbookCredit + "</div></div>");
            }
        }

        if (totalApparelPrice == 0) {
            if (freeApparelCredit > 0) {
                $("#modalSummary .modal-total").append("<div class='unreedemed'><div class='col-xs-8 name'>Unreedemed Apparel Credit</div> <div class='col-xs-4 price text-right'> $" + Math.round(freeApparelCredit * 100) / 100 + "</div></div>");
            }
        } else if (totalApparelPrice < freeApparelCredit) {
            total = total - totalApparelPrice;
            $("#modalSummary .modal-total").append("<div class=''><div class='col-xs-8 name'>Free Apparel</div> <div class='col-xs-4 price text-right'>- $" + totalApparelPrice + "</div></div>");
            var unreedemedCredit = Math.round(parseInt(freeApparelCredit) - parseInt(totalApparelPrice));
            $("#modalSummary .modal-total").append("<div class='unreedemed'><div class='col-xs-8 name '>Unreedemed Apparel Credit</div> <div class='col-xs-4 price text-right'>$" + unreedemedCredit + "</div></div>");

        } else {
            total = total - freeApparelCredit + totalApparelPrice;
            // $(".modal-total").append("<div class=''><div class='col-xs-8 name'>Apparel Total</div> <div class='col-xs-4 price text-right'>$" + Math.round(totalApparelPrice*100)/100 + "</div></div>");
            if (freeApparelCredit > 0) {
                $("#modalSummary .modal-total").append("<div class=''><div class='col-xs-8 name'>Applied Apparel Credit</div> <div class='col-xs-4 price text-right'>- $" + freeApparelCredit + "</div></div>");
            }
        }
        total = Math.round(total * 100) / 100;
        $("#modalSummary .modal-total").append("<div class='totals'><div class='col-xs-8 name'>Total</div> <div class='col-xs-4 price text-right'> $" + total + "</div></div>");

    })
})

$('.goNext').on('click', function(){
    $('#modalNotQualify').modal('hide');
    $('#modalQualify').modal('hide');
    $("#fakeNext").hide();
    $("#next").trigger('click');
});

$(".goCheckout").on("click", function() {
    $('#modalNotQualify').modal('hide');
    $('#modalQualify').modal('hide');
    $("#overlay").fadeIn();
    cartSku = [];
    var selectedSupplements = loadDataFromLocalStorage().selectedSupplements;
    var selectedEbooks = loadDataFromLocalStorage().selectedEbooks;
    var selectedApparel = loadDataFromLocalStorage().selectedApparel;
    var promises = [];

    if (selectedSupplements.length > 0) {
        $.each(selectedSupplements, function(index, value) {
            var productId = selectedSupplements[index].product_id;
            cartSku.push(selectedSupplements[index].sku);
        })
    }

    if (selectedEbooks.length > 0) {
        $.each(selectedEbooks, function(index, value) {
            promises.push(
                fetchProductFromAPI(value).then(function(ebook) {
                    var selectedEbookName = ebook.variant().name;
                    var selectedEbookSku = ebook.variant().sku;
                    cartSku.push(selectedEbookSku);
                })
            );
        })
    }
    if (selectedApparel.length > 0) {
        $.each(selectedApparel, function(index, value) {
            cartSku.push(selectedApparel[index].sku);
        })
    }

    Promise.all(promises)
        .then(sendToCart);

})

function sendToCart() {
    var promises = [];
    var coupons = [
        '30daycomplete',
        '30dayebook30',
        '30dayappacc20',
        '30daystack',
        '30dayebook25',
        '30dayappacc5',
        '30dayfreeship'
    ];

    cartFactory
        .removeItem()
        .promise()
        .then(function() {
            console.log("Cart Sku is ", cartSku);
            $.each(coupons, function(index, code) {
                console.log("Attaching Coupon", code);
                promises.push(cartFactory.addCoupon(code).promise());
            });
            $.each(cartSku, function(index, value) {
                console.log("Attaching Item", value);
                promises.push(cartFactory.addItem(value).promise());
            });

            return Promise.all(promises);
        })
        .then(function(resolves) {
            console.log("Resolving Promises ", resolves);
            localStorage.removeItem('__shredz_product_builder__');
            var url = $("meta[name='api-base']").attr('content') + "/cart";
            window.location = url;
        });
}

///////////////////////////////////////////////////////////////////////////////////////
//  Find Which menu is being triggered
///////////////////////////////////////////////////////////////////////////////////////
var singleSlickNext, singleSlickAccessories = false;

function whichMenu(evt) {
    var getClassAttr = $(this).attr("class");
    var classIdentifier = getClassAttr.split(" ")[0];
    console.log(classIdentifier);
    $("." + classIdentifier + "-slider .slick-prev").trigger("click");

    if (classIdentifier == "single" && !singleSlickNext) {
        // $("." + classIdentifier + "-slider").slick("prev");
        singleSlickNext = true;
        checkFooter();
    }
    if (classIdentifier == "stack") {
        checkFooter();
    }
    if (classIdentifier == "accessories" && !singleSlickAccessories) {
        // $("." + classIdentifier + "-slider").slick("prev");
        singleSlickAccessories = true;
    }
    $(evt.data.selector).each(function() {
        if (!$(this).find("a").hasClass("active")) {
            var hideInactiveSlider = $(this).find("a").attr("class");
            $("#" + hideInactiveSlider).hide();
        }
    });
    hideShowSlider(classIdentifier);
}

function checkSubscription(selector) {
    $(selector).find(".subscribe-container").show();
}

function calculatePercentage(basePrice, subscriptionPrice) {
    var result = (subscriptionPrice / basePrice) * 10;
    return Math.round(result);
}

function expandSliders(sliders, classIdentifier) {
    var promises = [];
    var $sliders = $(sliders);
    // var $spinners = $sliders.find('.spinner');
    var $overlay = $("#overlay");


    var $slickNext = $sliders.parent().parent().parent().find(".slick-next");
    var $slickPrev = $sliders.parent().parent().parent().find(".slick-prev");

    var $productInfo = $sliders.find('.product-info');

    // $spinners
    // .show();
    if (!$("#step1").hasClass('current')) {
        $overlay
            .show();
    }

    $slickNext
        .hide();

    $slickPrev
        .hide();

    $productInfo
        .hide();

    $sliders
        .each(function() {
            var slider = this;
            var productId = $(this).data('product-id');
            promises.push(
                fetchProductFromAPI(productId)
                .then(function(product) {
                    initializeSlider(slider, classIdentifier, product);
                })
            );
        });

    Promise
        .all(promises)
        .then(function() {
            $productInfo.show();
            // $spinners.hide();
            $overlay.hide();
            $slickNext.show();
            $slickPrev.show();
        });
}

function initializeSlider(slider, classIdentifier, product) {
    var getCurrentSlider = $(slider);

    if (!getCurrentSlider.hasClass("initialized")) {
        getCurrentSlider.addClass("initialized")
        getCurrentSlider.data('product', product);
        var productSubscription = product.subscriptionVariant();
        var productMetas = product.meta();

        if (!$.isEmptyObject(productSubscription)) {

            var basePrice = $(getCurrentSlider).find(".base-price").text();
            var subscriptionPrice = productSubscription.price;
            var subscriptionPriceInPercentage = calculatePercentage(basePrice, subscriptionPrice);
            $(getCurrentSlider).find(".subscription-price").text("$" + subscriptionPrice)
            $(getCurrentSlider).find(".subsription-percentage").text(subscriptionPriceInPercentage + "%");
            checkSubscription(getCurrentSlider);
            // $(getCurrentSlider).find(".subscription-price").text("$" + productSubscription.price);
            // checkSubscription(getCurrentSlider);
        }

        $.each(productMetas, function(key, value) {
            if (key == "summary") {
                $(getCurrentSlider).find(".prod-pitch").text(value);
            }
            if (key == "nutritionfacts") {
                $(getCurrentSlider).find(".nutrition-info").attr("href", value);
            }
            if (key == "creditapparel") {
                $(getCurrentSlider).find(".benefits ul").append("<li class='free-benefit'><i class='fa fa-plus-circle'></i>&nbsp;Free Apparel Worth $" + value + "</li>");
            }
            if (key == "creditebook") {
                $(getCurrentSlider).find(".benefits ul").append("<li class='free-benefit'><i class='fa fa-plus-circle'></i>&nbsp;Free Ebooks Worth $" + value + "</li>");
            }
            if (key.indexOf("p") == 0) {
                $(getCurrentSlider).find(".benefits ul").append("<li><i class='fa fa-check'></i>&nbsp;" + value + "</li>");
            }
        });

        if ($.isEmptyObject(product.data.options)) {
            $("#" + classIdentifier + " .slick-prev").show();
            $("#" + classIdentifier + " .slick-next").show();
        }

        $.each(product.data().options, function(key, option) {
            if (key.toLowerCase() !== "supply") {
                var div = document.createElement("div");
                var productId = $(getCurrentSlider).data('product-id');
                var hash = (productId + key).hashCode(36);
                $(div).addClass(hash);
                $(div).append("<h2>" + key + "</h2>");
                if (classIdentifier.toLowerCase() === "apparel" || classIdentifier.toLowerCase() === "accessories") {
                    $(div).append("<ul class='tshirt-size'></ul>");
                    $(div).find('ul').attr('data-option-name', key);
                    $(getCurrentSlider).find(".variant-options").append(div);
                    if (option.length === 1) {
                        $("#" + classIdentifier + " .slick-prev").hide();
                        $("#" + classIdentifier + " .slick-next").hide();

                        // $(getCurrentSlider = " ." + hash + " ul").find('li').remove();

                        $.each(option, function(index, value) {
                            if (value.charAt(0) == "2" || value.toLowerCase().charAt(0) == "x") {
                                $("#" + classIdentifier + " ." + hash + " ul")
                                    .append('<li data-option-value="' + value.replace('"', '&quot;') + '">' + value.charAt(0) + value.charAt(1) + '</li>');
                            } else {
                                $("#" + classIdentifier + " ." + hash + " ul")
                                    .append('<li data-option-value="' + value.replace('"', '&quot;') + '">' + value.charAt(0) + '</li>');
                            }
                        });

                        $("#" + classIdentifier + " .slick-prev").show();
                        $("#" + classIdentifier + " .slick-next").show();
                    } else if (option.length > 1) {
                        $("#" + classIdentifier + " .slick-prev").hide();
                        $("#" + classIdentifier + " .slick-next").hide();
                        $(getCurrentSlider).addClass("variant-exist");

                        // $(getCurrentSlider = " ." + hash + " ul").find('li').remove();

                        $.each(option, function(index, value) {
                            if (value.charAt(0) == "2" || value.toLowerCase().charAt(0) == "x") {
                                $("#" + classIdentifier + " ." + hash + " ul")
                                    .append('<li data-option-value="' + value.replace('"', '&quot;') + '">' + value.charAt(0) + value.charAt(1) + '</li>');
                            } else {
                                $("#" + classIdentifier + " ." + hash + " ul")
                                    .append('<li data-option-value="' + value.replace('"', '&quot;') + '">' + value.charAt(0) + '</li>');
                            }
                        });

                        $("#" + classIdentifier + " .slick-prev").show();
                        $("#" + classIdentifier + " .slick-next").show();
                    } else {
                        $("#" + classIdentifier + " .slick-prev").show();
                        $("#" + classIdentifier + " .slick-next").show();
                        return;
                    }
                } else {
                    $(div).append("<div class='select-wrapper'><select class='form-control'></select></div>");
                    $(div).find('select').attr('data-option-name', key);
                    $(getCurrentSlider).find(".variant-options").append(div);

                    if (option.length == 1) {
                        $("#" + classIdentifier + " .slick-prev").hide();
                        $("#" + classIdentifier + " .slick-next").hide();
                        $(getCurrentSlider = " ." + hash + " select").find('option').remove();
                        $(getCurrentSlider = " ." + hash + " .gender").text("");
                        $.each(option, function(index, value) {
                            $(getCurrentSlider = " ." + hash).append("<div class='text-center gender'>" + value + "</div>");
                            $(getCurrentSlider = " ." + hash + " select")
                                .append('<option  data-option-value="' + value + '">' + value + '</option>');
                        });
                        $(getCurrentSlider = " ." + hash + " .select-wrapper").hide();
                        $("#" + classIdentifier + " .slick-prev").show();
                        $("#" + classIdentifier + " .slick-next").show();
                    } else if (option.length > 1) {
                        $("#" + classIdentifier + " .slick-prev").hide();
                        $("#" + classIdentifier + " .slick-next").hide();
                        $(getCurrentSlider).addClass("variant-exist");

                        $(getCurrentSlider = " ." + hash + " select").find('option').remove();
                        $.each(option, function(index, value) {
                            $(getCurrentSlider = " ." + hash + " select")
                                .append('<option  data-option-value="' + value + '">' + value + '</option>');
                        });
                        $("#" + classIdentifier + " .slick-prev").show();
                        $("#" + classIdentifier + " .slick-next").show();
                    } else {
                        $("#" + classIdentifier + " .slick-prev").show();
                        $("#" + classIdentifier + " .slick-next").show();
                        return;
                    }
                }
            }
        });
    }
}

var ifVariantExists;

function getCurrentSliderProductInfo(classIdentifier) {
    var currentSliders = $("#" + classIdentifier + " .slick-active");
    expandSliders(currentSliders, classIdentifier);
}

var selectedItem = {};
var selectedSubscriptionItem = {};


$("#stack").on("change", ".slick-active .variant-options select", function(evt) {
    selectedItems($(this));
});

$("#stack").on("click", ".slick-active .add-to-plan, .slick-active .subscribe-button", function(evt) {
    selectedItems($(this));
});

$("#stack, #single").on("click", ".slick-active .dummy-subscription-button", function(evt) {
    $(this).parents('.slick-active').find(".subscribe-button").trigger('click');
});

$("#single").on("change", ".slick-active .variant-options select", function(evt) {
    selectedItems($(this));
});


$("#single").on("click", ".slick-active .variant-options select, .slick-active .add-to-plan, .slick-active .subscribe-button", function(evt) {
    selectedItems($(this));
});

// $("#apparel").on("change", ".slick-current .variant-options ul", function(evt){
//     selectedItems($(this));
// });


$("#apparel").on("click", ".slick-active .variant-options ul li, .slick-active .add-to-plan", function(evt) {
    selectedItems($(this));
});


$("#accessories").on("click", ".slick-active .variant-options ul li, .slick-active .add-to-plan", function() {
    selectedItems($(this));
});

function selectedItems(selector) {
    if (!$(selector).hasClass("add-to-plan") && !$(selector).hasClass("subscribe-button")) {
        if ($(selector).parents('#apparel').length > 0 || $(selector).parents('#accessories').length > 0) {
            var optionValue = $(selector).data('option-value');
            var optionKey = $(selector).parent().data("option-name");
        } else {
            var optionKey = $(selector).data('option-name');
            var optionValue = $(selector).find(":selected").data("option-value");
        }

        var variantOption = {};
        variantOption[optionKey] = optionValue;
        var currentProductVariantionInfo = $(selector).closest(".slick-active").data('product').withoutFallback().variant(variantOption);

        if (currentProductVariantionInfo) {
            var currentSubscriptionProductVariantionInfo = $(selector).closest(".slick-active").data('product');
            var $selectParentSlide = $(selector).parents(".slick-active");
            var selectImage = $selectParentSlide.find(".main-image");
            selectImage.attr('src', currentProductVariantionInfo.asset_location + "primaryimage_new.png");
            var selectPrice = $selectParentSlide.find(".base-price");
            var selectedOption = currentProductVariantionInfo.selected_options;
            $(selector).parents('.slick-current').find('li').removeClass('active');

            $.each(selectedOption, function(key, value) {
                var $group = $selectParentSlide.find('[data-option-name="' + key + '"]');
                var $option = $group.find('[data-option-value="' + value + '"]');
                $option.addClass('active');
            });
            selectPrice.text(currentProductVariantionInfo.price);
            selectedItem = currentProductVariantionInfo;
            selectedSubscriptionItem = currentSubscriptionProductVariantionInfo;
        }
    } else {
        if ($(selector).hasClass("add-to-plan")) {
            if ($(selector).parent().hasClass('variant-exist') && !$.isEmptyObject(selectedItem)) {
                // var selectedProductId = {};
                // var ifSubscribtion = {};
                // selectedProductId['product_id'] = $(selector).parent().data("product-id");
                var saveProductInfo = {};
                // ifSubscribtion['subscription'] = 'not-subscribed';
                // data.selectedSupplements.push()
                saveProductInfo['subscription'] = 'not-subscribed';

                saveProductInfo['sku'] = selectedItem.sku;
                saveProductInfo['product_id'] = $(selector).parent().data("product-id");
                saveProductInfo['selected_options'] = selectedItem.selected_options;
                // saveProductInfo.push(selectedProductId);
                // saveProductInfo.push(selectedItem);

                if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#stack').length > 0) {
                    var a = data.selectedSupplements;
                    var foundAt = -1;
                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];
                        if (id === p['product_id'] && p["subscription"] === "not-subscribed") {
                            foundAt = i;
                            break;
                        }
                    }
                    if (foundAt + 1) {
                        data.selectedSupplements.splice(0);
                        $(selector).text("Add to plan").removeClass("added");
                        data.selectedEbooks = [];
                        $('.plans .ebook-container').removeClass('active');
                        data.selectedApparel = [];
                        $("#apparel, #accessories, #single").find(".add-to-plan").text("Add to Plan");
                        $("#ebook-credit").hide();
                        $("#apparel-credit").hide();
                    } else {
                        $(selector).parents("#stack").find('.dummy-subscription-button').text("Subscribe & save").removeClass("added");
                        $(selector).parents("#stack").find(".add-to-plan").text("Add to plan").removeClass("added");
                        $(selector).text("Added to plan").addClass("added");
                        $(selector).parent().addClass("added-product");
                        data.selectedEbooks = [];
                        $('.plans .ebook-container').removeClass('active');
                        data.selectedApparel = [];
                        $("#apparel, #accessories, #single").find(".add-to-plan").text("Add to Plan").removeClass("added");
                        data.selectedSupplements.splice(0);
                        $("#ebook-credit").show();
                        $("#apparel-credit").show();
                        selector.parents().find(".add-to-plan").text("Add to plan").prop("disabled", false);
                        selector.parents().find(".dummy-subscription-button").text("Subscribe & Save");
                        $(selector).text("Added To plan").addClass("added");
                        data.selectedSupplements.push(saveProductInfo);
                        var freeApparelForThisProduct = $(selector).parent().data("product").meta().creditapparel;
                        var freeEbooksForThisProduct = $(selector).parent().data("product").meta().creditebook;
                        freeEbookTotal = freeEbooksForThisProduct;
                        data.freeEbookTotal = freeEbookTotal;
                        freeApparelTotal = freeApparelForThisProduct;
                        data.freeApparelTotal = freeApparelTotal;
                        saveDataToLocalStorage();
                        freeEbook = freeEbooksForThisProduct;
                        $("#free-ebook").text(freeEbooksForThisProduct);
                        $("#free-ebook").addClass("applied");
                        freeApparel = freeApparelForThisProduct;
                        $("#free-apparel").text(freeApparelForThisProduct);
                        $("#free-apparel").addClass("applied");
                        //1
                        $('.ebookfree').text(freeEbooksForThisProduct)
                        $('.apparelfree').text(freeApparelForThisProduct)
                        $('#modalQualify').modal('show');
                        // $("#next").trigger("click");
                    }
                }
                if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#single').length > 0) {
                    var a = data.selectedSupplements;
                    var foundAt = -1;


                    var subscriptionFoundAt = -1;

                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];

                        if (id === p['product_id'] && p['subscription'] === "subscribed") {
                            subscriptionFoundAt = i;
                            break;
                        }

                        if (id === p['product_id'] && p['subscription'] === "not-subscribed") {
                            foundAt = i;
                            break;
                        }
                    }

                    if (subscriptionFoundAt + 1) {
                        data.selectedSupplements.splice(subscriptionFoundAt, 1);
                        $(selector).text("Added to plan").addClass("added");
                        $(selector).parent().find('.dummy-subscription-button').text("Subscribe & Save").removeClass("added");
                        data.selectedSupplements.push(saveProductInfo);
                    } else if (foundAt + 1) {
                        data.selectedSupplements.splice(foundAt, 1);
                        $(selector).text("Add to plan").removeClass("added");
                        $(selector).parent().removeClass("added-product");
                    } else {
                        $(selector).text("Added to plan").addClass("added");
                        $(selector).text("Add to plan").addClass("added-product");
                        // $(selector).parent().find('.dummy-subscription-button');
                        data.selectedSupplements.push(saveProductInfo);
                    }
                    saveDataToLocalStorage();
                    enableNextButton();
                }

                if ($(selector).hasClass("apparelIdentifier")) {
                    var a = data.selectedApparel;
                    var foundAt = -1;
                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];
                        if (id === p['product_id']) {
                            foundAt = i;
                            break;
                        }
                    }
                    if (foundAt + 1) {
                        data.selectedApparel.splice(foundAt, 1);
                        $(selector).text("Add to plan").removeClass("added");
                        $(selector).parent().find("ul li").removeClass("active");
                        // $(selector).parent().find('.subscribe-button').prop("disabled", false);

                    } else {
                        $(selector).text("Added to plan").addClass("added");
                        $(selector).parent().find("ul li").addClass("li-disable");
                        $(selector).parent().addClass("added-product");
                        data.selectedApparel.push(saveProductInfo);
                    }
                    saveDataToLocalStorage();

                    var price = selectedItem.price;
                    freeApparel = freeApparel - price;
                    if (freeApparel > 0) {
                        $("#free-apparel").text(freeApparel);
                    } else {
                        $("#free-apparel").text("0");
                    }
                }

                selectedItem = {};
            } else if ($(selector).parent().hasClass('variant-exist') && $(selector).parent().hasClass('added-product')) {
                var saveProductInfo = {};
                // ifSubscribtion['subscription'] = 'not-subscribed';
                // data.selectedSupplements.push()
                saveProductInfo['subscription'] = 'not-subscribed';

                saveProductInfo['sku'] = selectedItem.sku;
                saveProductInfo['product_id'] = $(selector).parent().data("product-id");

                if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#stack').length > 0) {
                    var a = data.selectedSupplements;
                    var foundAt = -1;
                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];
                        if (id === p['product_id'] && p['subscription'] === "not-subscribed") {
                            foundAt = i;
                            break;
                        }
                    }
                    if (foundAt + 1) {
                        data.selectedSupplements.splice(0);
                        $(selector).text("Add to plan").removeClass("added");
                        data.selectedEbooks = [];
                        $('.plans .col-flex').removeClass('active');
                        data.selectedApparel = [];
                        $("#apparel, #accessories, #single").find(".add-to-plan").text("Add to Plan");
                        $("#ebook-credit").hide();
                        $("#apparel-credit").hide();
                        $(selector).parent().removeClass("added-product");
                    } else {
                        $(selector).text("Added to plan").addClass("added");
                        $(selector).parent().addClass("added-product");
                        data.selectedSupplements.push(saveProductInfo);
                    }
                    saveDataToLocalStorage();
                    enableNextButton();

                    var price = selectedItem.price;
                    freeApparel = freeApparel - price;
                    if (freeApparel > 0) {
                        $("#free-apparel").text(freeApparel);
                    } else {
                        $("#free-apparel").text("0");
                    }
                }

                if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#single').length > 0) {
                    var a = data.selectedSupplements;
                    var foundAt = -1;

                    var subscriptionFoundAt = -1;

                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];

                        if (id === p['product_id'] && p['subscription'] === "subscribed") {
                            subscriptionFoundAt = i;
                            break;
                        }

                        if (id === p['product_id'] && p['subscription'] === "not-subscribed") {
                            foundAt = i;
                            break;
                        }
                    }

                    if (subscriptionFoundAt + 1) {
                        saveProductInfo['sku'] = $(selector).parent().data('product').variant().sku;
                        data.selectedSupplements.splice(subscriptionFoundAt, 1);
                        $(selector).text("Added to plan").addClass("added");
                        $(selector).parent().find('.dummy-subscription-button').text("Subscribe & Save").removeClass("added");
                        data.selectedSupplements.push(saveProductInfo);
                    } else if (foundAt + 1) {
                        data.selectedSupplements.splice(foundAt, 1);
                        $(selector).text("Add to plan").removeClass("added");
                        $(selector).parent().find('.dummy-subscription-button');
                        $(selector).parent().removeClass("added-product");
                    } else {
                        $(selector).text("Added to plan").addClass("added");
                        // $(selector).parent().find('.dummy-subscription-button');
                        data.selectedSupplements.push(saveProductInfo);
                    }

                    saveDataToLocalStorage();
                    enableNextButton();
                }


                if ($(selector).hasClass("apparelIdentifier")) {
                    var a = data.selectedApparel;
                    var foundAt = -1;
                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];
                        if (id === p['product_id']) {
                            foundAt = i;
                            break;
                        }
                    }
                    if (foundAt + 1) {
                        data.selectedApparel.splice(foundAt, 1);
                        $(selector).text("Add to plan").removeClass("added");
                        $(selector).parent().find("ul li").removeClass("li-disable");
                        $(selector).parent().find("ul li").removeClass("active");
                        $(selector).parent().removeClass("added-product");
                        // $(selector).parent().find('.subscribe-button').prop("disabled", false);
                    } else {
                        $(selector).text("Added to plan").addClass("added");
                        $(selector).parent().addClass("added-product");
                        data.selectedApparel.push(saveProductInfo);
                    }
                    saveDataToLocalStorage();

                    var price = selectedItem.price;
                    freeApparel = freeApparel - price;
                    if (freeApparel > 0) {
                        $("#free-apparel").text(freeApparel);
                    } else {
                        $("#free-apparel").text("0");
                    }
                    // data.selectedApparel.push(saveProductInfo);
                }
            } else if (!$(selector).parent().hasClass('variant-exist')) {
                var saveProductInfo = {};

                saveProductInfo['subscription'] = 'not-subscribed';
                saveProductInfo['product_id'] = $(selector).parent().data("product-id");
                var promises = [];
                if ($.isEmptyObject(selectedItem)) {
                    promises.push(
                        fetchProductFromAPI(saveProductInfo['product_id']).then(function(product) {
                            saveProductInfo['sku'] = product.variant().sku;
                            saveDataToLocalStorage();
                        })
                    )

                } else {
                    saveProductInfo['sku'] = selectedItem.sku;
                }

                Promise.all(promises).then(function() {
                    if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#stack').length > 0) {
                        var a = data.selectedSupplements;
                        var foundAt = -1;
                        for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                            p = a[i];
                            if (id === p['product_id'] && p["subscription"] === "not-subscribed") {
                                foundAt = i;
                                break;
                            }
                        }
                        if (foundAt + 1) {
                            data.selectedSupplements.splice(0);
                            $(selector).text("Add to plan").removeClass("added");
                            data.selectedEbooks = [];
                            data.freeApparelTotal = 0;
                            data.freeEbookTotal = 0;
                            $('.plans .ebook-container').removeClass('active');
                            data.selectedApparel = [];
                            $("#apparel, #accessories, #single").find(".add-to-plan").text("Add to Plan").removeClass("added");
                            $("#ebook-credit").hide();
                            $("#apparel-credit").hide();
                        } else {
                            $(selector).parents("#stack").find('.dummy-subscription-button').text("Subscribe & save").removeClass("added");
                            $(selector).parents("#stack").find(".add-to-plan").text("Add to plan").removeClass("added");
                            $(selector).text("Added to plan").addClass("added");
                            data.selectedEbooks = [];
                            $('.plans .ebook-container').removeClass('active');
                            data.selectedApparel = [];
                            $("#apparel, #accessories, #single").find(".add-to-plan").text("Add to Plan").removeClass("added");
                            data.selectedSupplements.splice(0);
                            $("#ebook-credit").show();
                            $("#apparel-credit").show();
                            selector.parents().find(".add-to-plan").text("Add to plan");
                            selector.parents().find(".dummy-subscription-button").text("Subscribe & Save");
                            $(selector).text("Added To plan").addClass("added");
                            data.selectedSupplements.push(saveProductInfo);
                            var freeApparelForThisProduct = $(selector).parent().data("product").meta().creditapparel;
                            var freeEbooksForThisProduct = $(selector).parent().data("product").meta().creditebook;
                            freeEbookTotal = freeEbooksForThisProduct;
                            data.freeEbookTotal = freeEbookTotal;
                            freeApparelTotal = freeApparelForThisProduct;
                            data.freeApparelTotal = freeApparelTotal;
                            saveDataToLocalStorage();
                            freeEbook = freeEbooksForThisProduct;
                            $("#free-ebook").text(freeEbooksForThisProduct);
                            $("#free-ebook").addClass("applied");
                            freeApparel = freeApparelForThisProduct;
                            $("#free-apparel").text(freeApparelForThisProduct);
                            $("#free-apparel").addClass("applied");
                            // 2
                            $('.ebookfree').text(freeEbooksForThisProduct)
                            $('.apparelfree').text(freeApparelForThisProduct)
                            $('#modalQualify').modal('show');
                            // $("#next").trigger("click");
                        }
                    }

                    if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#single').length > 0) {
                        // $(selector).parent().parent().find(".add-to-plan").text("Add to Plan!").prop("disabled", false);
                        // data.selectedSupplements.push(saveProductInfo);
                        var a = data.selectedSupplements;
                        var foundAt = -1;


                        var subscriptionFoundAt = -1;

                        for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                            p = a[i];

                            if (id === p['product_id'] && p['subscription'] === "subscribed") {
                                subscriptionFoundAt = i;
                                break;
                            }

                            if (id === p['product_id'] && p['subscription'] === "not-subscribed") {
                                foundAt = i;
                                break;
                            }
                        }

                        if (subscriptionFoundAt + 1) {
                            data.selectedSupplements.splice(subscriptionFoundAt, 1);
                            $(selector).text("Added to plan").addClass("added");
                            $(selector).parent().find('.dummy-subscription-button').text("Subscribe & Save").removeClass("added");
                            data.selectedSupplements.push(saveProductInfo);
                        } else if (foundAt + 1) {
                            data.selectedSupplements.splice(foundAt, 1);
                            $(selector).text("Add to plan").removeClass("added");
                            $(selector).parent().find('.dummy-subscription-button');
                        } else {
                            $(selector).text("Added to plan").addClass("added");
                            // $(selector).parent().find('.dummy-subscription-button');
                            data.selectedSupplements.push(saveProductInfo);
                        }
                        saveDataToLocalStorage();
                        enableNextButton();
                    }

                    if ($(selector).hasClass("apparelIdentifier")) {
                        var a = data.selectedApparel;
                        var foundAt = -1;
                        for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                            p = a[i];
                            if (id === p['product_id']) {
                                foundAt = i;
                                break;
                            }
                        }
                        if (foundAt + 1) {
                            data.selectedApparel.splice(foundAt, 1);
                            $(selector).text("Add to plan").removeClass("added");
                            $(selector).parent().find("ul li").removeClass("li-disable");
                            $(selector).parent().find("ul li").removeClass("active");
                            $(selector).parent().removeClass("added-product");
                            // $(selector).parent().find('.subscribe-button').prop("disabled", false);
                        } else {
                            $(selector).text("Added to plan").addClass("added");
                            // $(selector).parent().find('.subscribe-button').prop("disabled", true);
                            data.selectedApparel.push(saveProductInfo);
                        }
                        saveDataToLocalStorage();

                        var price = $(selector).parent().data("product").variant().price;
                        freeApparel = freeApparel - price;
                        if (freeApparel > 0) {
                            $("#free-apparel").text(freeApparel);
                        } else {
                            $("#free-apparel").text("0");
                        }
                        // data.selectedApparel.push(saveProductInfo);
                    }
                    selectedItem = {};
                });
            } else {
                // $('.form-control').addClass('shake');
                setTimeout(function() {
                    $(selector).parent().find('.variant-options').addClass('shake');
                }, 40);
                $(selector).parent().find('.variant-options').removeClass('shake');

                saveDataToLocalStorage();
            }
        } else if ($(selector).hasClass("subscribe-button")) {

            if ($(selector).parent().hasClass('variant-exist') && !$.isEmptyObject(selectedSubscriptionItem)) {
                var saveProductInfo = {};
                saveProductInfo['subscription'] = 'subscribed';

                saveProductInfo['sku'] = selectedSubscriptionItem.subscriptionVariant().sku;
                saveProductInfo['product_id'] = $(selector).parent().data("product-id");
                saveProductInfo['selected_options'] = selectedItem.selected_options;

                if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#stack').length > 0) {

                    var a = data.selectedSupplements;
                    var foundAt = -1;
                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];
                        if (id === p['product_id'] && p["subscription"] === "subscribed") {
                            foundAt = i;
                            break;
                        }
                    }
                    if (foundAt + 1) {
                        // data.selectedSupplements.splice(foundAt, 1);
                        data.selectedSupplements.splice(0);
                        $(selector).parent().find(".dummy-subscription-button").text("Subscribe & save").removeClass("added");
                        data.selectedEbooks = [];
                        data.freeApparelTotal = 0;
                        data.freeEbookTotal = 0;
                        $('.plans .ebook-container').removeClass('active');
                        data.selectedApparel = [];
                        $("#apparel, #accessories, #single").find(".add-to-plan").text("Add to Plan").removeClass("added");
                        $("#ebook-credit").hide();
                        $("#apparel-credit").hide();
                        // $(selector).parent().find('.dummy-subscription-button').prop("disabled", false);
                    } else {
                        $(selector).parents("#stack").find(".add-to-plan").text("Add to plan").removeClass("added");
                        $(selector).parents("#stack").find(".dummy-subscription-button").text("Subscribe & save").removeClass("added");
                        $(selector).parent().find(".dummy-subscription-button").text("subscribed!").addClass("added");
                        // $(selector).parent().find('.dummy-subscription-button').prop("disabled", true);
                        // data.selectedSupplements.push(saveProductInfo);
                        $(selector).parent().addClass("added-product");
                        data.selectedEbooks = [];
                        $('.plans .ebook-container').removeClass('active');
                        data.selectedApparel = [];
                        $("#apparel, #accessories, #single").find(".dummy-subscription-button").text("Subscribe & save").removeClass("added");
                        data.selectedSupplements.splice(0);
                        $("#ebook-credit").show();
                        $("#apparel-credit").show();
                        // $(selector).parent().parent().find(".add-to-plan").text("Add to Plan!").prop("disabled", false);
                        // selector.parents().find(".add-to-plan").text("Add to plan").prop("disabled", false);
                        // selector.parents().find(".dummy-subscription-button").text("Subscribe & Save").prop("disabled", false);
                        // $(selector).parent().find(".dummy-subscription-button").text("Subscribe & Save").prop("disabled", false);
                        data.selectedSupplements.push(saveProductInfo);
                        var freeApparelForThisProduct = $(selector).parent().data("product").meta().creditapparel;
                        var freeEbooksForThisProduct = $(selector).parent().data("product").meta().creditebook;
                        freeEbookTotal = freeEbooksForThisProduct;
                        data.freeEbookTotal = freeEbookTotal;
                        freeApparelTotal = freeApparelForThisProduct;
                        data.freeApparelTotal = freeApparelTotal;
                        saveDataToLocalStorage();
                        // if(!$("#free-ebook").hasClass("applied")){
                        freeEbook = freeEbooksForThisProduct;
                        $("#free-ebook").text(freeEbooksForThisProduct);
                        $("#free-ebook").addClass("applied");

                        freeApparel = freeApparelForThisProduct;
                        $("#free-apparel").text(freeApparelForThisProduct);
                        $("#free-apparel").addClass("applied");
                        // 5
                        $('.ebookfree').text(freeEbooksForThisProduct)
                        $('.apparelfree').text(freeApparelForThisProduct)
                        $('#modalQualify').modal('show');
                        // }                

                        // $("#next").trigger("click");
                    }

                }

                if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#single').length > 0) {
                    // $(selector).parent().parent().find(".add-to-plan").text("Add to Plan!").prop("disabled", false);

                    var a = data.selectedSupplements;

                    var foundAt = -1;

                    var noSubscriptionFoundAt = -1;


                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];

                        if (id === p['product_id'] && p['subscription'] === "not-subscribed") {
                            noSubscriptionFoundAt = i;
                            break;
                        }

                        if (id === p['product_id'] && p['subscription'] === "subscribed") {
                            foundAt = i;
                            break;
                        }
                    }

                    if (noSubscriptionFoundAt + 1) {
                        data.selectedSupplements.splice(foundAt, 1);
                        $(selector).parent().addClass("added-product");

                        $(selector).parent().find('.dummy-subscription-button').text("Subscribed!").addClass("added");
                        $(selector).parent().find(".add-to-plan").text("Add to plan").removeClass("added");
                        data.selectedSupplements.push(saveProductInfo);
                    } else if (foundAt + 1) {
                        data.selectedSupplements.splice(foundAt, 1);
                        $(selector).parent().removeClass("added-product");

                        $(selector).parent().find('.dummy-subscription-button').text("Subscribe & Save").removeClass("added");
                        $(selector).parent().find(".add-to-plan");
                    } else {
                        $(selector).parent().find('.dummy-subscription-button').text("Subscribed!").addClass("added");
                        $(selector).parent().find(".add-to-plan");
                        $(selector).parent().addClass("added-product");
                        data.selectedSupplements.push(saveProductInfo);
                    }

                    saveDataToLocalStorage();
                    enableNextButton();
                }

                if ($(selector).hasClass("apparelIdentifier")) {
                    var price = selectedItem.price;
                    freeApparel = freeApparel - price;
                    if (freeApparel > 0) {
                        $("#free-apparel").text(freeApparel);
                    } else {
                        $("#free-apparel").text("0");
                    }
                    data.selectedApparel.push(saveProductInfo);
                }
                saveDataToLocalStorage();
                selectedSubscriptionItem = {};
            } else if ($(selector).parent().hasClass('variant-exist') && $(selector).parent().hasClass('added-product')) {
                var saveProductInfo = {};

                saveProductInfo['subscription'] = 'not-subscribed';

                saveProductInfo['sku'] = selectedItem.sku;
                saveProductInfo['product_id'] = $(selector).parent().data("product-id");

                if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#stack').length > 0) {
                    var a = data.selectedSupplements;
                    var foundAt = -1;
                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];
                        if (id === p['product_id'] && p['subscription'] === "not-subscribed") {
                            foundAt = i;
                            break;
                        }
                    }
                    if (foundAt + 1) {
                        data.selectedSupplements.splice(0);
                        $(selector).text("Add to plan").removeClass("added");
                        data.selectedEbooks = [];
                        $('.plans .col-flex').removeClass('active');
                        data.selectedApparel = [];
                        $("#apparel, #accessories, #single").find(".add-to-plan").text("Add to Plan");
                        $("#ebook-credit").hide();
                        $("#apparel-credit").hide();
                        $(selector).parent().removeClass("added-product");
                    } else {
                        $(selector).text("Added to plan").addClass("added");
                        $(selector).parent().addClass("added-product");
                        data.selectedSupplements.push(saveProductInfo);
                    }
                    saveDataToLocalStorage();
                    enableNextButton();

                    var price = selectedItem.price;
                    freeApparel = freeApparel - price;
                    if (freeApparel > 0) {
                        $("#free-apparel").text(freeApparel);
                    } else {
                        $("#free-apparel").text("0");
                    }
                }

                if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#single').length > 0) {
                    var a = data.selectedSupplements;
                    var foundAt = -1;

                    var noSubscriptionFoundAt = -1;

                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];

                        if (id === p['product_id'] && p['subscription'] === "not-subscribed") {
                            noSubscriptionFoundAt = i;
                            break;
                        }

                        if (id === p['product_id'] && p['subscription'] === "subscribed") {
                            foundAt = i;
                            break;
                        }
                    }

                    if (noSubscriptionFoundAt + 1) {
                        saveProductInfo['sku'] = $(selector).parent().data('product').variant().sku;
                        data.selectedSupplements.splice(noSubscriptionFoundAt, 1);
                        $(selector).parent().addClass("added-product");
                        $(selector).parent().find(".add-to-plan").text("Add to plan").removeClass("added");
                        $(selector).parent().find('.dummy-subscription-button').text("Subscribed").addClass("added");
                        data.selectedSupplements.push(saveProductInfo);
                    } else if (foundAt + 1) {
                        data.selectedSupplements.splice(foundAt, 1);
                        $(selector).parent().find(".add-to-plan").text("Add to plan").removeClass("added");
                        $(selector).parent().find('.dummy-subscription-button').text("Subscribe & save").removeClass("added");
                        $(selector).parent().removeClass("added-product");
                    } else {
                        $(selector).parent().find('.dummy-subscription-button').text("Subscribed").addClass("added");
                        $(selector).parent().find(".add-to-plan").text("Add to plan").removeClass("added");
                        $(selector).parent().addClass("added-product");

                        // $(selector).parent().find('.dummy-subscription-button');
                        data.selectedSupplements.push(saveProductInfo);
                    }

                    saveDataToLocalStorage();
                    enableNextButton();
                }



                if ($(selector).hasClass("apparelIdentifier")) {
                    var a = data.selectedApparel;
                    var foundAt = -1;
                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];
                        if (id === p['product_id']) {
                            foundAt = i;
                            break;
                        }
                    }
                    if (foundAt + 1) {
                        data.selectedApparel.splice(foundAt, 1);
                        $(selector).text("Add to plan").removeClass("added");
                        $(selector).parent().find("ul li").removeClass("li-disable");
                        $(selector).parent().find("ul li").removeClass("active");
                        $(selector).parent().removeClass("added-product");
                        // $(selector).parent().find('.subscribe-button').prop("disabled", false);
                    } else {
                        $(selector).text("Added to plan").addClass("added");
                        $(selector).parent().addClass("added-product");
                        data.selectedApparel.push(saveProductInfo);
                    }
                    saveDataToLocalStorage();

                    var price = selectedItem.price;
                    freeApparel = freeApparel - price;
                    if (freeApparel > 0) {
                        $("#free-apparel").text(freeApparel);
                    } else {
                        $("#free-apparel").text("0");
                    }
                    // data.selectedApparel.push(saveProductInfo);
                }
            } else if (!$(selector).parent().hasClass('variant-exist')) {
                // var selectedProductId = {};
                // selectedProductId['product_id'] = $(selector).parent().data("product-id");
                var saveProductInfo = {};

                saveProductInfo['subscription'] = 'subscribed';
                saveProductInfo['product_id'] = $(selector).parent().data("product-id");
                saveProductInfo['sku'] = $(selector).parent().data("product").subscriptionVariant().sku;

                if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#stack').length > 0) {

                    var a = data.selectedSupplements;
                    var foundAt = -1;
                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];
                        if (id === p['product_id'] && p['subscription'] === "subscribed") {
                            foundAt = i;
                            break;
                        }
                    }
                    if (foundAt + 1) {
                        // data.selectedSupplements.splice(foundAt, 1);
                        data.selectedSupplements.splice(0);
                        $(selector).parent().find(".dummy-subscription-button").text("Subscribe & save").removeClass("added");
                        data.selectedEbooks = [];
                        $('.plans .ebook-container').removeClass('active');
                        data.selectedApparel = [];
                        $("#apparel, #accessories, #single").find(".add-to-plan").text("Add to Plan");
                        $("#ebook-credit").hide();
                        $("#apparel-credit").hide();
                        // $(selector).parent().find('.dummy-subscription-button').prop("disabled", false);
                    } else {
                        $(selector).parents("#stack").find(".add-to-plan").text("Add to plan").removeClass("added");
                        $(selector).parents("#stack").find(".dummy-subscription-button").text("Subscribe & save").removeClass("added");
                        $(selector).parent().find(".dummy-subscription-button").text("subscribed!").addClass("added");
                        // $(selector).parent().find('.dummy-subscription-button').prop("disabled", true);
                        // data.selectedSupplements.push(saveProductInfo);

                        data.selectedEbooks = [];
                        $('.plans .ebook-container').removeClass('active');
                        data.selectedApparel = [];
                        $("#apparel, #accessories, #single").find(".dummy-subscription-button").text("Subscribe & save");
                        data.selectedSupplements.splice(0);
                        $("#ebook-credit").show();
                        $("#apparel-credit").show();
                        // $(selector).parent().parent().find(".add-to-plan").text("Add to Plan!").prop("disabled", false);
                        // selector.parents().find(".add-to-plan").text("Add to plan").prop("disabled", false);
                        // selector.parents().find(".dummy-subscription-button").text("Subscribe & Save").prop("disabled", false);

                        // $(selector).parent().find(".dummy-subscription-button").text("Subscribe & Save").prop("disabled", false);
                        data.selectedSupplements.push(saveProductInfo);

                        var freeApparelForThisProduct = $(selector).parent().data("product").meta().creditapparel;
                        var freeEbooksForThisProduct = $(selector).parent().data("product").meta().creditebook;
                        freeEbookTotal = freeEbooksForThisProduct;
                        data.freeEbookTotal = freeEbookTotal;
                        freeApparelTotal = freeApparelForThisProduct;

                        data.freeApparelTotal = freeApparelTotal;
                        saveDataToLocalStorage();
                        // if(!$("#free-ebook").hasClass("applied")){
                        freeEbook = freeEbooksForThisProduct;
                        $("#free-ebook").text(freeEbooksForThisProduct);
                        $("#free-ebook").addClass("applied");

                        freeApparel = freeApparelForThisProduct;
                        $("#free-apparel").text(freeApparelForThisProduct);
                        $("#free-apparel").addClass("applied");
                        // 1
                        $('.ebookfree').text(freeEbooksForThisProduct)
                        $('.apparelfree').text(freeApparelForThisProduct)
                        $('#modalQualify').modal('show');
                        // $("#next").trigger("click");
                    }

                }

                if ($(selector).hasClass("supplementsIdentifier") && $(selector).parents('#single').length > 0) {
                    // $(selector).parent().parent().find(".add-to-plan").text("Add to Plan!").prop("disabled", false);

                    var a = data.selectedSupplements;

                    var foundAt = -1;

                    var noSubscriptionFoundAt = -1;


                    for (var p, id = saveProductInfo['product_id'], i = 0, l = a.length; i < l; i++) {
                        p = a[i];

                        if (id === p['product_id'] && p['subscription'] === "not-subscribed") {
                            noSubscriptionFoundAt = i;
                            break;
                        }

                        if (id === p['product_id'] && p['subscription'] === "subscribed") {
                            foundAt = i;
                            break;
                        }
                    }

                    if (noSubscriptionFoundAt + 1) {
                        data.selectedSupplements.splice(foundAt, 1);
                        $(selector).parent().find('.dummy-subscription-button').text("Subscribed!").addClass("added");
                        $(selector).parent().addClass("added-product");
                        $(selector).parent().find(".add-to-plan").text("Add to plan").removeClass("added");
                        data.selectedSupplements.push(saveProductInfo);
                    } else if (foundAt + 1) {
                        data.selectedSupplements.splice(foundAt, 1);
                        $(selector).parent().removeClass("added-product");

                        $(selector).parent().find('.dummy-subscription-button').text("Subscribe & Save").removeClass("added");
                        $(selector).parent().find(".add-to-plan");
                    } else {
                        $(selector).parent().find('.dummy-subscription-button').text("Subscribed!").addClass("added");
                        $(selector).parent().addClass("added-product");

                        $(selector).parent().find(".add-to-plan");
                        data.selectedSupplements.push(saveProductInfo);
                    }

                    saveDataToLocalStorage();
                    enableNextButton();
                }

                if ($(selector).hasClass("apparelIdentifier")) {
                    freeApparel = freeApparel - price;
                    if (freeApparel > 0) {
                        $("#free-apparel").text(freeApparel);
                    } else {
                        $("#free-apparel").text("0");
                    }
                    data.selectedApparel.push(saveProductInfo);
                }
                saveDataToLocalStorage();
                selectedSubscriptionItem = {};
            } else {
                setTimeout(function() {
                    $('.variant-options').addClass('shake');
                }, 40);
                $('.variant-options').removeClass('shake');
                saveDataToLocalStorage();
                // alert("please choose variants");
            }
        } else {
            return;
        }

    }
}

$(".stack-slider").on("afterChange", function(evt) {
    slickNext("stack");
});

$(".single-slider").on("afterChange", function(evt) {
    slickNext("single");
});

// $(".tops-slider").on("afterChange", function(evt){
//     slickNext("tops");
// });

$(".accessories-slider").on("afterChange", function(evt) {
    slickNext("accessories");
});

// $(".bottoms-slider").on("afterChange", function(evt){
//     slickNext("bottoms");
// });

$(".apparel-slider").on("afterChange", function(evt) {
    slickNext("apparel");
});

function slickNext(selector) {
    setPreviouslySelectedProducts(loadDataFromLocalStorage());
    getCurrentSliderProductInfo(selector);

}

///////////////////////////////////////////////////////////////////////////////////////
//  Show and initializes Slick Slider
///////////////////////////////////////////////////////////////////////////////////////

function hideShowSlider(selector) {
    $("#" + selector).show();
    setTimeout(function() {
        // $(".single-slider, .accessories-slider").slick('next');
    }, 0);
}
///////////////////////////////////////////////////////////////////////////////////////
//  onWindowScroll() fires on window scroll
///////////////////////////////////////////////////////////////////////////////////////

function onWindowScroll() {
    // $(window).on("scroll", );

}

///////////////////////////////////////////////////////////////////////////////////////
//  onWindowResize() fires on window resize
///////////////////////////////////////////////////////////////////////////////////////
function onWindowResize() {
    // $(window).on("resize", );
}


///////////////////////////////////////////////////////////////////////////////////////
//  addActiveClass() -> add active class to $this and remove active 
//  class from other $this
///////////////////////////////////////////////////////////////////////////////////////

function addActiveClass(evt) {
    var $this = $(this);
    evt.preventDefault();
    var selector = evt.data.selector;
    $("." + selector + " a").removeClass("active");
    $(this).addClass("active");
}

///////////////////////////////////////////////////////////////////////////////////////
//  Steps manager
///////////////////////////////////////////////////////////////////////////////////////
function stepsManager() {
    var activeStep = '.current';
    var $activeStep = $(activeStep);
    var nextStep = $activeStep.next();
    var nextButton = '#next';

    var currentHash = window.location.hash;
    checkFooter()

    $(nextButton).click(function() {

        var activeStep = $('.steps.current');
        window.location.hash = activeStep.next().attr('id');
        window.scrollTo(0, 0);
        if (($activeStep).next().attr("id") == "step2") {
            $(window).trigger("resize");
            // slickNext("stack");
        }

        if (($activeStep).next().attr("id") == "step4") {
            $(window).trigger("resize");
            // slickNext("apparel");

        }

        $(activeStep).removeClass('current').hide()
            .next().show().addClass('current');

        if ($(activeStep).hasClass('last')) {
            // nextStep.attr('disabled', true);
            // $(nextButton).hide();
        }


        setTimeout(function() {
            $(window).resize();
            // $(".trending-slider, .stack-slider").slick("next");
        }, 0);

    });
    checkFooter()

}

///////////////////////////////////////////////////////////////////////////////////////
//  Show and initializes Slick Slider
///////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////
//  onGenderButtonClick() -> fires on gender button clicked
///////////////////////////////////////////////////////////////////////////////////////

function onGenderButtonClick(evt) {
    localStorage.removeItem('__shredz_product_builder__');
    var $this = $(this);
    evt.preventDefault();
    setGender($this.data('gender'));
    uiSetGender(getGender());
    $('#step1').removeClass('show-gender');
    $('#step1').addClass('show-gender-goal');
    checkGender();
    $('html, body').animate({
        scrollTop: $("#row-goal").offset().top
    }, 500);

}

///////////////////////////////////////////////////////////////////////////////////////
//  onGoalButtonClick() -> fires on goal button clicked
///////////////////////////////////////////////////////////////////////////////////////

function onGoalButtonClick(evt) {
    localStorage.removeItem('__shredz_product_builder__');
    var $this = $(this);
    evt.preventDefault();
    setGoal($this.data('goal'));
    uiSetGoal(getGoal());
    $("#next").prop("disabled", false);
    $('#step1').removeClass('show-gender-goal');
    $('#step1').addClass('show-gender-goal-email');
    $('html, body').animate({
        scrollTop: $("#row-email").offset().top
    }, 500);
}

///////////////////////////////////////////////////////////////////////////////////////
//  onEmailFormChange() -> fires when email form changes
///////////////////////////////////////////////////////////////////////////////////////
function onEmailFormChange(evt) {
    var $this = $(this);
    evt.preventDefault();
    setEmail($this.val());
}

///////////////////////////////////////////////////////////////////////////////////////
//  returns true if <768, else returns false
///////////////////////////////////////////////////////////////////////////////////////

function firesOnMobile() {
    if ($(window).width() < 768) {
        return true;
    } else {
        return false;
    }
}

///////////////////////////////////////////////////////////////////////////////////////
//  initSlickSlider() -> initializes slick slider
///////////////////////////////////////////////////////////////////////////////////////

function initSlickSlider() {
    if (firesOnMobile()) {
        $(".slider-stack-product, .apparel-slider").slick({
            slideToShow: 3,
            slideToScroll: 3,
            centerMode: true,
            centerPadding: "40px",
        });
    }
}

///////////////////////////////////////////////////////////////////////////////////////
//  GA EVENT LISTENERS
///////////////////////////////////////////////////////////////////////////////////////
function gaEventListeners() {
    function checkStep() {
        if ($("#step2").hasClass('current')) {
            ga('send', 'event', 'show', 'step2', 'Show Step2');
            ga('send', 'event', 'show', 'stack', 'Show Stack Supplements');
        }
        if ($("#step3").hasClass('current')) {
            ga('send', 'event', 'show', 'step3', 'Show Step3');
        }
        if ($("#step4").hasClass('current')) {
            ga('send', 'event', 'show', 'step4', 'Show Step4');

        }
    }
    checkStep();
    $("#next").on('click', function() {
        checkStep();
    });
    // SKIP CHECKOUT
    $('#skip').click(function() {
        ga('send', 'event', 'click', 'skip', 'Click Skip Checkout');

    })
    // FINAL CHECKOUT
    $('#checkout').click(function() {
        ga('send', 'event', 'click', 'checkout', 'Click Final Checkout');
    })
    // SUMMARY
    $('#summary').click(function() {
        ga('send', 'event', 'click', 'summary', 'Click Summary');
    })

    //  STEP 1
    if ($("#step1").hasClass('current')) {
        ga('send', 'event', 'show', 'step1', 'Show Step1');
    }
    // Male
    $('#step1_male').click(function() {
        ga('send', 'event', 'click', 'male', 'Click Male');
    })
    // Female
    $('#step1_female').click(function() {
        ga('send', 'event', 'click', 'female', 'Click Female');
    });
    // Weight Loss
    $('#step1_weightloss').click(function() {
        ga('send', 'event', 'click', 'weightloss', 'Click Weight Loss');

    });
    // Build Muscle
    $('#step1_buildmuscle').click(function() {
        ga('send', 'event', 'click', 'buildmuscle', 'Click Build Muscle');
    });
    // Email
    $('#step1_email').click(function() {
        ga('send', 'event', 'click', 'email', 'Click Email');
    })
    //  STEP 2
    //Show stack
    $("#step2_showstack").click(function() {
        ga('send', 'event', 'click', 'stack', 'Click Stack Supplements');
    });
    // Show single
    $("#step2_showsingle").click(function() {
        ga('send', 'event', 'click', 'single', 'Click Single Supplements');
    });
}

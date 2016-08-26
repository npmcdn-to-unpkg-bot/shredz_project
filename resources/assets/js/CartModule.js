var CartModule = function()
{
    //config
    this.domain = $('meta[name="api-base"]').attr('content');
    this.site = document.location.origin;
    //different api
    this.getTokenUrl = "/auth/token";
    this.validateTokenUrl = "/v1/auth/tokens/validate";
    this.getCartUrl = "/v1/cart";
    this.addToCartURL = "/v1/cart/items";
    this.removeFromCartUrl = "/v1/cart/items";
    this.updateCartUrl = "/v1/cart/items";
    this.applyDiscountUrl = "/v1/cart/discounts";
    this.updateDetailsUrl = "/v1/cart/details";
    this.getPayTokenUrl = "/v1/cart/checkout";
    this.sendPaymentUrl = "/v1/cart/checkout";
    this.paypalReturnUrl = this.site + "/paypal-success";
    this.paypalErrorUrl = this.site + "/paypal-error";
    this.bannerUrl = this.domain + "/v1/store";
    this.thanksUrl = this.domain + "/v1/orders/";
    //vars
    this.authToken = $('meta[name="api-token"]').attr('content');
    this.csrfToken = $('meta[name="csrf-token"]').attr('content');
    //number of items in the cart
    this.itemCount = 0;
    this.getCount = [];

    //sends a call to this.getTokenUrl only which calls to a different api that
    //runs the entire token generation process on the server
    this.init = function(callbacks){

        var self = this;

        var waitForToken = setInterval(function(){

            if(self.csrfToken)
            {
                clearInterval(waitForToken);
                $.ajax({
                    headers : {
                        "X-CSRF-TOKEN" : self.csrfToken
                    },
                    url : self.getTokenUrl,
                    success : function(data) {
                        self.authToken = data.data;
                        self.getCart({
                            success : function(res) {
                                self.itemCount = res.data.item_count;
                                for(var i = 0;i < self.getCount.length;i++)
                                {
                                    $(self.getCount[i]).html(self.itemCount);
                                }
                            },
                            error : function(err) {

                            }
                        });

                        if(callbacks && callbacks['success'] instanceof Function) {
                            callbacks["success"]();
                        }
                    },//success
                    error : function(err) {
                        if(callbacks && callbacks['error'] instanceof Function) {
                            callbacks["error"]();
                        }
                    }//error
                });//ajax
            }
            else{
                if($("#token").length > 0)
                {
                    $("#token").append($("#token").attr("value"));
                    self.csrfToken = $("#token input").attr("value");
                }
            }

        }, 100);
    };//init

    this.getCart = function(callbacks) {
        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            crossDomain : true,
            url : this.domain + this.getCartUrl,
            success : function(data) {
                callbacks["success"](data);
            },//success
            error : function(err) {
                callbacks["error"](err);
            }//error
        });//ajax
    };//get cart

    this.addToCart = function(args, callbacks) {
        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            crossDomain : true,
            url : this.domain + this.addToCartURL,
            type : "post",
            contentType : "application/json",
            dataType : "json",
            data : JSON.stringify(args),
            success : function(data) {
                callbacks["success"](data);
            },//success
            error : function(err) {
                callbacks["error"](err);
            }//error
        });//ajax /cart/items post
    };//add to cart

    this.removeFromCart = function(args, callbacks) {

        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            crossDomain : true,
            type : "delete",
            url : this.domain + this.removeFromCartUrl,
            data : JSON.stringify(args),
            success : function(data) {
                if(args["toDelete"])
                {
                    args["toDelete"].remove();
                }

                callbacks["success"](data);
            },//success
            error : function(err) {
                callbacks["error"](err);
            }//error
        });//ajax
    };//remove from cart

    this.updateCart = function(args, callbacks) {
        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            crossDomain : true,
            type : "put",
            url : this.domain + this.updateCartUrl,
            data : JSON.stringify(args),
            success : function(data) {
                callbacks["success"](data);
            },//success
            error : function(err) {
                callbacks["error"](err);
            }//error
        });//ajax
    };//update cart

    this.updateDetails = function(args, callbacks) {
        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            crossDomain : true,
            type : "post",
            url : this.domain + this.updateDetailsUrl,
            data : JSON.stringify(args),
            success : function(data) {
                callbacks["success"](data);
            },//success
            error : function(err) {
                callbacks["error"](err);
            }//error
        });//ajax
    };//update details

    this.getPayToken = function(args, callbacks) {
        var self = this;

        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            crossDomain : true,
            type : "get",
            url : this.domain + this.getPayTokenUrl,
            data : JSON.stringify(args),
            success : function(data) {
                callbacks["success"](data);
                args.token = data.data.token;

                /*information and send payment callbacks sent here*/
                //self.sendPayment(args.args, args.callbacks);
            },//success
            error : function(err) {
                callbacks["error"](err);
            }//error
        });//ajax
    };//get payment token

    this.sendPayment = function(args, callbacks){
        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            contentType : "application/json",
            crossDomain : true,
            type : "post",
            url : this.domain + this.sendPaymentUrl,
            data : JSON.stringify(args),
            success : function(data) {
                callbacks["success"](data);
            },//success
            error : function(err) {
                callbacks["error"](err);
            }//error
        });//ajax
    };//send payment

    this.applyDiscount = function(args, callbacks) {
        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            crossDomain : true,
            type : "post",
            url : this.domain + this.applyDiscountUrl,
            data : JSON.stringify(args),
            success : function(data) {
                callbacks["success"](data);
            },
            error : function(err) {
                callbacks["error"](err);
            }
        });
    };//apply discount

    this.payPal = function(callbacks)
    {
        var self = this;

        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            crossDomain : true,
            url : this.domain + this.getPayTokenUrl + "?type=paypal&return_url="+ self.paypalReturnUrl + "&cancel_url="+self.paypalErrorUrl,
            success : function(data) {
                callbacks["success"](data);
            },
            error : function(data) {
                callbacks["error"](data);
            }
        });
    };//paypal

    this.thanks = function(args, callbacks) {
        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            crossDomain : true,
            url : this.thanksUrl + args["order"],
            success : function(data) {
                callbacks["success"](data);
            },//success
            error : function(err) {
                callbacks["error"](err);
            }//error
        });//ajax
    };//thanks

    this.getBanner = function(callbacks){
        $.ajax({
            headers : {
                Authorization : "Bearer " + this.authToken
            },
            xhrFields : {
                withCredentials : true
            },
            crossDomain : true,
            url : this.bannerUrl,
            success : function(res) {
                callbacks["success"](res);
            },
            error : function(err) {
                callback["error"](err);
            }
        });
    };
};//cart class
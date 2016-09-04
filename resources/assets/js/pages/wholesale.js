jQuery(document).ready(function(){
  initFocusClass();
});

// add class when element is in focus
function initFocusClass() {
  jQuery('.wholesale-form .form-field').addFocusClass({
    focusClass: 'input-focused'
  });
  jQuery('.profile-editor-form .form-field').addFocusClass({
    focusClass: 'input-focused'
  });
}

/*
 * Add Class on focus
 */
;(function($) {
  function AddFocusClass(options) {
    this.options = $.extend({
      container: null,
      element: ':input',
      focusClass: 'focus'
    }, options);
    this.initStructure();
    this.attachEvents();
  }
  AddFocusClass.prototype = {
    initStructure: function() {
      this.container = $(this.options.container);
      this.element = this.container.find(this.options.element);
    },
    attachEvents: function() {
      var self = this;
      this.focusHandler = function() {
        if(! self.container.hasClass(self.options.focusClass)) {
          self.container.addClass(self.options.focusClass);
        }
      };
      this.blurHandler = function() {
        if(! self.element.val()) {
          self.container.removeClass(self.options.focusClass);
        }
      };
      this.element.on({
        focus: this.focusHandler,
        blur: this.blurHandler
      });

      if(this.element.val()) {
        self.container.addClass(self.options.focusClass);
      }
    },
    destroy: function() {
      this.container.removeClass(this.options.focusClass);
      this.element.off({
        focus: this.focusHandler,
        blur: this.blurHandler
      });
    }
  };

  $.fn.addFocusClass = function(options) {
    return this.each(function() {
      var params = $.extend({}, options, {container: this}),
        instance = new AddFocusClass(params);
      $.data(this, 'AddFocusClass', instance);
    });
  };
}(jQuery));
(function(simply) {
    
    simply.views.seatMap = Backbone.View.extend({
    
        
        initialize: function(options) {
            var el = this.make("div", { "class": "seatMap"});
            this.setElement(el);
        },
        
        show: function() {
            this.$el.slideDown('fast');  
        },
        
        render: function() {
            return this.el;
        }
        
    });
    
})(window.simply);
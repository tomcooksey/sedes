(function(simply) {
    simply.views.progressStage = Backbone.View.extend({
        
        last: false,
        
        initialize: function(options) {
            this.last = this.model.get('number') === 4;
            this.model.bind('change', this.adapt, this);
            this.el = $(this.make('li', {}, this.model.get('title')));
            
            //Return this to allow chaining
            return this;
        },
        
        render: function() {
            if(this.last) {
                this.el.addClass('end');
            }
            this.adapt();
            return this.el;
        },
        
        adapt: function() {
            var self = this;
            setTimeout(function() {
                self.model.get('completed') ? self.el.addClass('complete') : false;
            }, 500);
            
            !self.model.get('completed') ? self.el.removeClass('complete') : false;
            !self.model.get('current') ? self.el.removeClass('current') : self.el.addClass('current');
        
        }
        
    });
    
})(window.simply);
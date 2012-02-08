(function(simply) {
    
    simply.views.seat = Backbone.View.extend({
        
        initialize: function(options) {
            this.setElement(this.make('div', {"class" : "seat"}, this.model.get('number')));
         
        },
        
        render: function() {
            
            if(!this.model.get('forSale')) {
                this.$el.addClass('notForSale');
            }
            
            if(this.model.get('noSeat')) {
                this.$el.addClass('noSeat');
            }
            
            return this.$el;
        }
    });
    
})(window.simply);
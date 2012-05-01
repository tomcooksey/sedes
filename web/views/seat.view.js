(function(simply) {
    
    simply.views.seat = Backbone.View.extend({
        
        initialize: function(options) {
            this.setElement(this.make('div', {"class" : "seat"}, this.model.get('number')));
            
            _.bindAll(this, 'clickEvent');
            
            this.model.on('change:selected', this.selectedChange, this);
            
            
        },
        
        events: {
            "click": "clickEvent"
        },
        
        clickEvent: function(event) {
            
            if(this.options.readonly) return;
            
            event.preventDefault();
            
            if(this.model.get('booked') || !this.model.get('forSale') || this.model.get('noSeat')) return;
            
            if(this.collection.getTotalSelected() < simply.ticketTypes.getTotalTickets() || this.model.get('selected')) {
                 this.model.save({selected: !this.model.get('selected')});
            }else{
                 //Create error
            }

        },
        
        selectedChange: function() {
            
            this.model.get('selected') ? this.$el.addClass('selectedSeat') : this.$el.removeClass('selectedSeat');
            
        },
        
        render: function() {
            
            if(!this.model.get('forSale')) {
                this.$el.addClass('notForSale');
            }
            
            if(this.model.get('noSeat')) {
                this.$el.addClass('noSeat');
            }
            
            if(this.model.get('booked')) {
                this.$el.addClass('takenSeat');
            }
            
            if(this.model.get('selected')) {
                this.$el.addClass('selectedSeat');
            }
            
            return this.$el;
        }
    });
    
})(window.simply);
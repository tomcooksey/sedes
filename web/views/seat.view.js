(function(simply) {
    
    simply.views.seat = Backbone.View.extend({
        
        initialize: function(options) {
            this.setElement(this.make('div', {"class" : "seat"}, this.model.get('number')));
            
            this.seatMap = options.seatMap;
            
            
            
            _.bindAll(this);
            
            this.model.on('change:selected', this.selectedChange, this);
            //this.model.on('change:selected', this.checkOrder, this);
            this.model.on('change:forSale', this.forSaleChange, this);
            
        },
        
        events: {
            "click": "clickEvent"
        },
        
        
        clickEvent: function(event) {
            
            event.preventDefault();
            
            if(simply.admin && !simply.session.get('manual')) {
                
                if(this.model.get('booked')) {
                    alert('Sorry, this seat has been sold');
                    return;
                }
                
                this.model.save({forSale: !this.model.get('forSale'), wait: true});
            }else{
                if(this.options.readonly) return;
            
                
                
                if(this.model.get('booked') || !this.model.get('forSale') || this.model.get('noSeat')) return;
                
                if(this.collection.getTotalSelected() < simply.ticketTypes.getTotalTickets() || this.model.get('selected')) {
                     this.model.save({selected: !this.model.get('selected'), wait: true});
                }else{
                     //Create error
                }
            }
            
            
            
        },
        
        forSaleChange: function() {
  
            this.model.get('forSale') ? this.$el.removeClass('notForSale') : this.$el.addClass('notForSale');
        },
        
        
        handleOrder: function(data) {
            this.seatMap.clock(data.timestamp);
            simply.session.save({"order_id" : data.order_id});
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
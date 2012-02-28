(function(simply) {
    
    simply.collections.seats = Backbone.Collection.extend({
        
        model: simply.models.seat,
        
        url: "/api.php/seats",
        
        convertToRows: function() {
            
            var rows = {};
            
            this.each(function(seat) {
                
                if(!rows.hasOwnProperty(seat.get('row'))) {
                    
                    rows[seat.get('row')] = [];
                }
                
                rows[seat.get('row')].push(seat);
                
            }, this);
            
            return rows;
        },
        
         getTotalSelected: function() {
            
            var totalCount = 0;
            
            this.each(function(seat) {
                if(seat.get('selected')) {
                    totalCount +=1;
                }
            });

            return totalCount;
            
        },
        
        getSelectedSeats: function() {
            var selectedSeats = [];
            
            this.each(function(seat) {
                
                if(seat.get('selected')) {
                    selectedSeats.push(seat);
                }
            });
            
            return selectedSeats;
        },
        
        removeSeats: function(count) {
            var selSeats = this.getSelectedSeats();

            //Though infinitly more complex, remove from the right
            //rather than left as it makes more sense to western
            //language users (ie writing left to right)
            for(var x=selSeats.length - 1; x>=selSeats.length - count ; x-=1) {
                selSeats[x].save('selected', false);
            }
        },
        
        
        //This method will look at the seats a user has selected and work out
        //whether they have added in any single seat gaps within their own
        //selection and between another order.  This will only have row scope,
        //ie it won't check multiple rows
        hasGaps: function() {
            
            var selected = this.getSelectedSeats();

            //If selection is 1 or less don't validate the booking gap because
            //we can't.  We will simply skip to see if the 
            if(selected.length > 1) {
                var difference = (selected[selected.length -1].get('number') - selected[0].get('number')) + 1;
                
                if(difference !== this.getTotalSelected()) return true;
            }
            
            return false;
            
        },
        
        valid: function() {
            
            var errors = [];
            
            if(this.getTotalSelected() !== simply.ticketTypes.getTotalTickets()) {
                errors.push("You haven't selected enough seats");
            }
            
            if(this.hasGaps()) {
                errors.push("Please don't leave any gaps");
            }
            
            if(simply.ticketTypes.getTotalTickets() === 0) {
                errors.push('You haven\'t selected any seats');
            }
            
            //...
            
            if(errors.length === 0) {
                return true;
            }else{
                return errors;
            }
        }
        
    });
    
})(window.simply);
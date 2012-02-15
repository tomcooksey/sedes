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
            console.log('TC', totalCount);
            return totalCount;
            
        }
        
    });
    
})(window.simply);
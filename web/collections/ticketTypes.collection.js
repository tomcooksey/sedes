(function(simply) {
    
    simply.collections.ticketTypes = Backbone.Collection.extend({
        
        model: simply.models.ticketType,
        
        url: "/api.php/ticketTypes",
        
        getTotalTickets: function() {
            
            var totalCount = 0;
            
            this.each(function(type) {
                totalCount += parseInt(type.get('quantity'));
            });
            
            return totalCount;
            
        },
        
        getOrderedTickets: function() {
        
            var ordered = [];
            
            this.each(function(type) {
                if(type.get('quantity') > 0) {
                    ordered.push(type);
                }
            });
            
            return ordered;
            
        }
            
         
    });
    
})(window.simply);
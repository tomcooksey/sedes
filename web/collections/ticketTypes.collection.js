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
            
        }
            
         
    });
    
})(window.simply);
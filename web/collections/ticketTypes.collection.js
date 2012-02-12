(function(simply) {
    
    simply.collections.ticketTypes = Backbone.Collection.extend({
        
        model: simply.models.ticketType,
        
        url: "/api.php/ticketTypes",
        
        initialize: function(options) {
            //Add some dummy data in for now
            /*this.add([
                {
                    id: 1,
                    name: 'Adults (14 and over)',
                    price: 14.5,
                    quantity: 0
                },
                
                 {
                    id: 2,
                    name: 'Children (14 and under)',
                    price: 12.0,
                    quantity: 0
                },
                
                 {
                    id: 3,
                    name: 'Concessions',
                    price: 12.5,
                    quantity: 0
                }
            ]);*/
        },
        
        getTotalTickets: function() {
            
            var totalCount = 0;
            
            this.each(function(type) {
                totalCount += parseInt(type.get('quantity'));
            });
            
            return totalCount;
            
        }
            
         
    });
    
})(window.simply);
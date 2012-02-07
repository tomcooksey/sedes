(function(simply) {
    
    simply.collections.ticketTypes = Backbone.Collection.extend({
        
        model: simply.models.ticketType,
        
        initialize: function(options) {
            //Add some dummy data in for now
            this.add([
                {
                    id: 1,
                    name: 'Adults (14 and over)',
                    price: 14.5
                }
            ]);
        }
            
         
    });
    
})(window.simply);
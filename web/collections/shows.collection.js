(function(simply) {
    
    simply.collections.shows = Backbone.Collection.extend({
        //TO DO - self filling with models at the moment, this
        //needs to come from the server depending on company_id
        
        model: simply.models.show,
        
        initialize: function() {
            
        }
    });
    
})(window.simply);
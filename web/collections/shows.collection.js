(function(simply) {
    
    simply.collections.shows = Backbone.Collection.extend({
        
        model: simply.models.show,
        
        initialize: function() {
            
        }
    });
    
})(window.simply);
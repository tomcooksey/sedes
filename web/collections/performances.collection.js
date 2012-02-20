(function(simply) {
    
    simply.collections.performances = Backbone.Collection.extend({

        model: simply.models.performance,
        
        url: '/api.php/performances',
        
        initialize: function() {
            
        }
    });
    
})(window.simply);
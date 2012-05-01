(function(simply) {
    
    simply.collections.performances = Backbone.Collection.extend({

        model: simply.models.performance,
        
        url: '/api.php/performances',
        
        initialize: function() {
            
        },
        
        getSelectedPerformance: function() {
            
            return this.get(simply.session.get('performance_id'));
        }
    });
    
})(window.simply);
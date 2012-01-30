(function(simply) {
    
    simply.models.session = Backbone.Model.extend({
        
        defaults: {
            order_id: null,
            current_stage: 1
        }
        
    });
    
})(window.simply);
(function(simply) {
    
    simply.models.session = Backbone.Model.extend({
        
        binds: {},
        url: "/api.php/session",
        
        defaults: {
            id: 1,
            order_id: 0,
            current_stage: 1,
            show_id: 0,
            performance_id: 0
        }
        
    });
    
})(window.simply);
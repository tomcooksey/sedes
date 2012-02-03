(function(simply) {
    
    simply.models.session = Backbone.Model.extend({
        
        defaults: {
            //TO DO this order_id should come from the server and be
            //a protected attribute..is this possible?
            order_id: 1,
            current_stage: 1,
            show_id: 0,
            performance_id: 0
        }
        
    });
    
})(window.simply);
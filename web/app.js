(function($) {
    
    window.simply = {
        views: {},
        models: {},
        routers: {},
        collections: {},
        forms: {},
        fields: {}
    };
    
    $(document).ready(function() {
        //Start the router and navigation
        
        
        simply.session = new simply.models.session();
        
        //Boot strap the content of session from the server so
        //we can maintain state
        simply.session.fetch({"success" : function(model, response) {
            console.log('bootstrap complete');
            var bootstrap = new simply.routers.main();
            Backbone.history.start();
        }});  
        
        
    });
    
    
})(jQuery);
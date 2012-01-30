(function($) {
    
    window.simply = {
        views: {},
        models: {},
        routers: {},
        collections: {}
    };
    
    $(document).ready(function() {
        //Start the router and navigation
        var bootstrap = new simply.routers.main();
        Backbone.history.start();
    });
    
    
})(jQuery);
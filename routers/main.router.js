(function(simply) {
    simply.routers.main = Backbone.Router.extend({
        
        routes: {
            "" : "choosePerformance",
            "choose-seats" : "chooseSeats",
            "your-info" : "yourInfo",
            "payment" : "payment",
            "thanks" : "thanks"
        },
        
        views: {},
        viewport: null,
        collections: {},
        models: {},
        
        //Will be part of session model
        stage: 1,
        
        //Sets up page furniture etc
        initialize: function() {
            
            //Put session in the global namespace
            simply.session = new simply.models.session();
            
            //TODO Update from the server
            //simply.session.fetch();

            //Setup the viewport
            this.viewport = new simply.views.viewport().render();
        },
        
        setProgress: function(stage) {
            simply.session.set({current_stage: stage});
            //TODO Save to server to maintain state
        },
        
        //Stage 1
        choosePerformance: function() {
            this.setProgress(1);
        },
        
        //Stage 2
        chooseSeats: function() {
            this.setProgress(2);
        },
        
        //Stage 3
        yourInfo: function() {
            this.setProgress(3);
        },
        
        //Stage 4
        payment: function() {
            this.setProgress(4);
        },
        
        //Stage 5
        thanks: function() {
            this.setProgress(5);
        }
        
    });
    
})(window.simply);
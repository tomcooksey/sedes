(function(simply) {
    simply.routers.main = Backbone.Router.extend({
        
        routes: {
            "" : "choosePerformance",
            "choose-show" : "chooseShow",
            "seat-options" : "seatOptions",
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
            //Put shows in global namespace for ease of use
            //TO DO - sync from server instead of hardcoded
            simply.shows = new simply.collections.shows();
            //simply.shows.fetch();
            
            //TODO Update from the server
            //simply.session.fetch();

            //Setup the viewport
            this.viewport = new simply.views.viewport();
            this.viewport.render();

        },
        
        setProgress: function(stage) {
            simply.session.set({current_stage: stage});
            //TODO Save to server to maintain state
        },
        
        //Stage 1a
        choosePerformance: function() {
            this.viewport.clean();
            this.setProgress(1);
            //TO DO error handling of no shows
            if(simply.shows.length === 1) {
                simply.session.set({show_id : simply.shows.at(0).get('show_id')});
            }
            
            if(simply.shows.length > 1 && !simply.session.get('show_id')) {
                location.hash = 'choose-show';
            }else{
                this.viewport.addView(new simply.forms.choosePerformance());
            }
        },
        
        //Stabe 1b - for the cases there is more than one show
        chooseShow: function() {
            this.viewport.clean();
            this.setProgress(1);
            this.viewport.addView(new simply.forms.chooseShow());
        },
        
        //Stage 2a
        seatOptions: function() {
            this.viewport.clean();
            this.setProgress(2);
            
            this.viewport.addView(new simply.forms.seats());
        },
        
        //Stage 2b
        chooseSeats: function() {
            this.viewport.clean();
            this.setProgress(2);
            
            
        },
        
        //Stage 3
        yourInfo: function() {
            this.viewport.clean();
            this.setProgress(3);
        },
        
        //Stage 4
        payment: function() {
            this.viewport.clean();
            this.setProgress(4);
        },
        
        //Stage 5
        thanks: function() {
            this.viewport.clean();
            this.setProgress(5);
        }
        
    });
    
})(window.simply);
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
            
            simply.globalChanging = false;

            //Put session in the global namespace
            
            
            /*simply.session.set({
                id: 1,
                order_id: 0,
                current_stage: 1,
                show_id: 0,
                performance_id: 0 
            }, {silent: true});*/
            
            
            
            //Put shows in global namespace for ease of use
            //TO DO - sync from server instead of hardcoded
            simply.shows = new simply.collections.shows();
            
            //simply.shows.fetch();
            simply.ticketTypes = new simply.collections.ticketTypes();
            
            //TODO Update from the server
            
            
            
            //Setup the viewport
            this.viewport = new simply.views.viewport();
            this.viewport.render();
            
        },
        
        setProgress: function(stage) {
            
            console.log('show_id', simply.session.get('show_id'));
            simply.session.save({current_stage: stage});
        },
        
        //Stage 1a
        choosePerformance: function() {
            this.viewport.clean();
            
            
            //TO DO error handling of no shows
            if(simply.shows.length === 1) {
                simply.session.save({show_id : simply.shows.at(0).get('show_id')});
            }
            this.setProgress(1);
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
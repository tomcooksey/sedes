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

            //Setup the viewport
            this.viewport = new simply.views.viewport();
            this.viewport.render();
            
            this.viewport.setShowName();
            this.viewport.setPerformanceName();
  
            
        },
        
        setProgress: function(stage) {  
            simply.session.save({current_stage: stage}, {wait: true});
        },
        
        //Stage 1a
        choosePerformance: function() {
     
            this.viewport.clean();
            if(simply.shows.length > 1 && !simply.session.get('show_id')) {
                location.hash = 'choose-show';
            }else{
                this.setProgress(1);
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
            
            this.viewport.addView(new simply.forms.personalDetails());
        },
        
        //Stage 4
        payment: function() {
            this.viewport.clean();
            this.setProgress(4);
            
            this.viewport.addView(new simply.views.checkout());
        },
        
        //Stage 5
        thanks: function() {
            this.viewport.clean();
            this.setProgress(5);
        }
        
    });
    
})(window.simply);
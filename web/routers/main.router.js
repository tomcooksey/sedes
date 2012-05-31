(function(simply) {
    simply.routers.main = Backbone.Router.extend({
        
        routes: {
            "" : "choosePerformance",
            "choose-show" : "chooseShow",
            "seat-options" : "seatOptions",
            "choose-seats" : "chooseSeats",
            "your-info" : "yourInfo",
            "payment" : "payment",
            "complete" : "complete"
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
            simply.viewport = this.viewport;
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
            
            var that = this;
            
            //Make the booking
            $.ajax({
                url: '/api.php/order',
                error: function() { alert('unable to process order, please try again later');},
                success: function(response) { that.viewport.addView(new simply.forms.personalDetails()); simply.session.set('order_id', response.order_id);  },
                dataType: 'json'
            }); 
            
            
        },
        
        //Stage 4
        payment: function() {
            this.viewport.clean();
            this.setProgress(4);
            
            this.viewport.addView(new simply.views.checkout());
        },
        
        //Stage 5
        complete: function() {
            console.log('here');
            this.viewport.clean();
            this.setProgress(5);
            
            this.viewport.addView(new simply.views.complete());
        }
        
    });
    
})(window.simply);
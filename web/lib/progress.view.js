(function(simply) {
    simply.views.progress = Backbone.View.extend({
        
        positionMap: {
            "1": "966",
            "2" : "714",
            "3": "467",
            "4" : "222",
            "5" : "-28"
        },
        
        initialize: function(options) {
            this.holder = $('.steps');
            this.bar = $('.bar');
            
            //Bind to the collection
            this.collection.on('stageChange', this.setProgress, this);
        
        },
        
        setProgress: function(stage) {
            var obj = this;
            this.bar.animate({
                right : this.positionMap[stage] + 'px'
            }, 500, 'swing');
        },
        
        render: function() {
            //Traverse the collection and print it out
           this.collection.each(function(stage) {
                //Create a new view passing the model
                this.holder.append(new simply.views.progressStage({ model: stage }).render());
           }, this);
        }
        
    });
    
})(window.simply);
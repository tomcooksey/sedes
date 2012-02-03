(function(simply) {
    
    simply.collections.performances = Backbone.Collection.extend({
        //TO DO - self filling with models at the moment, this
        //needs to come from the server depending on company_id
        
        model: simply.models.performance,
        
        initialize: function() {
            this.add([
                {
                    performance_id: 1,
                    title: "Thursday 5th March 2012, 19:30"
                },
                {
                    performance_id: 2,
                    name: "Friday 6th March 2012, 19:30"
                }
            ]);
        }
    });
    
})(window.simply);
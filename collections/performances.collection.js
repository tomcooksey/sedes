(function(simply) {
    
    simply.collections.performances = Backbone.Collection.extend({
        //TO DO - self filling with models at the moment, this
        //needs to come from the server depending on company_id
        
        model: simply.models.show,
        
        initialize: function() {
            this.add([
                {
                    show_id: 1,
                    name: "Street car named desire"
                },
                {
                    show_id: 2,
                    name: "Little shop of horrors"
                }
            ]);
        }
    });
    
})(window.simply);
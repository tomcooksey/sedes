(function(simply) {
    
    simply.collections.shows = Backbone.Collection.extend({
        
        model: simply.models.show,
        
        initialize: function() {
            
        },
        
        getSelectedShow: function() {
            return this.get(simply.session.get('show_id'));
            
        }
    });
    
})(window.simply);
(function(simply) {

    simply.adminMenu = Backbone.View.extend({
        
        
        initialize: function(options) {
            
            this.setElement(this.make('ul', {"class" : "adminMenu"}));
            
            //this.$el.append(this.make('li', {}, this.make('a', { "href" : "#"));
            
        },
        
        render: function() {
            
            return this.$el;
        }
    });
    
})(window.simply);
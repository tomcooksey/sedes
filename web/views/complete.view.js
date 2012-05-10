(function(simply) {
    
    simply.views.complete = Backbone.View.extend({
        
        initialize: function(options) {
            this.setElement(this.make('div', {"class" : "complete"}));
            
            
            _.bindAll(this);
            
        },
        
        render: function() {
            
            this.$el.append(this.make('h2', {}, 'Thanks!'));
            this.$el.append(this.make('p', {}, "Thanks for your order, you should recieve an email shortly in confirmation."));
            this.$el.append(this.make('p', {}, "Please check your Spam folders for emails from noreply@simplytheatre.net if you haven't recieved it within the next 5 minutes."));
            this.$el.append(this.make('p', {}, "Thank you again, and enjoy the show!"));
            
            return this.$el;
        }
    });
    
})(window.simply);
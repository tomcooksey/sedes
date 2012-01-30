(function(simply) {

    simply.forms.seats = Backbone.View.extend({
        
        form: null,
        
        initialize: function() {
            
            this.form = new simply.form({
                name: 'seats'
            });
            
            this.form.addField( new simply.field({
                label: "Adult Tickets",
                id: "adult_tickets",
                form: this.form
            }));
            
        },
        
        render: function() {
            return this.form.render();
        }
    });


})(window.simply);
(function(simply) {

    simply.forms.seats = Backbone.View.extend({
        
        form: null,
        collections: {},
        
        initialize: function() {
            
            this.seatOptions = _.memoize(function() {
                var obj, options = [];
                
                for(var x=0; x<10; x+=1) {
                    obj = {
                        value: x,
                        //Stringify otherwise 0 doesn't show
                        text: x + ''
                    }
                    
                    options.push(obj);
                }
                
                return options;
            });
            
            this.forms = [];
        },
        

        render: function() {
            
            simply.ticketTypes.each(function(ticket) {
                var form, self = this;

                form = new simply.form({
                    name: 'form_seats_' + ticket.get('id'),
                    action: 'seat-map',
                    model: ticket,
                    noWait: true
                });
                
                form.addField( new simply.fields.select({
                    label: ticket.get('name') + ":",
                    note: "( &pound;" + ticket.get('price').toFixed(2) + ")",
                    id: "field_seats_" + ticket.get('id'),
                    form: form,
                    modelField: 'quantity',
                    choices: this.seatOptions(),
                    onValid: function() {
                        self.seatMap.show();
                        self.seatMap.adjustBookedSeats();
                    }
                }));
                
                this.forms.push(form);
                
            }, this);
                        
            simply.seats.hasGaps();
            
            this.seatMap = new simply.views.seatMap({ collection: simply.seats });
            
            var buildUp;
            
            buildUp = $(this.make('div'));
            
            _.each(this.forms, function(form) {
                buildUp.append(form.render());
            });
            
            buildUp.append(this.seatMap.render());
            
            var self = this;
            
            setTimeout(function() {
                if(simply.ticketTypes.getTotalTickets()) {
                    self.seatMap.show();
                }
            }, 100);
            
            return buildUp;
            
        }
    });


})(window.simply);
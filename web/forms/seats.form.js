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
                    model: ticket
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
                    }
                }));
                
                this.forms.push(form);
                
            }, this);
            
            this.collections.seatMap = new simply.collections.seats();
            
            this.seatMap = new simply.views.seatMap({ collection: this.collections.seatMap });
            
            var buildUp;
            
            buildUp = $(this.make('div'));
            
            _.each(this.forms, function(form) {
                buildUp.append(form.render());
            });
            
            buildUp.append(this.seatMap.render());
            
            return buildUp;
            
        }
    });


})(window.simply);
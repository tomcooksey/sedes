(function(simply) {

    simply.forms.seats = Backbone.View.extend({
        
        form: null,
        
        initialize: function() {
            
            this.form = new simply.form({
                name: 'seats'
            });
            
            this.form.addField( new simply.fields.select({
                label: "Adults:",
                id: "adult_tickets",
                form: this.form,
                choices: [
                    {
                        value: "0",
                        text: "0"
                    },
                    
                    {
                        value: "1",
                        text: "1"
                    },
                    
                    {
                        value: "2",
                        text: "2"
                    },
                    
                    {
                        value: "3",
                        text: "3"
                    },
                    
                    {
                        value: "4",
                        text: "4"
                    }
                ]
            }));
            
            this.form.addField( new simply.fields.select({
                label: "Children:",
                id: "child_tickets",
                form: this.form,
                choices: [
                    {
                        value: "0",
                        text: "0"
                    },
                    
                    {
                        value: "1",
                        text: "1"
                    },
                    
                    {
                        value: "2",
                        text: "2"
                    },
                    
                    {
                        value: "3",
                        text: "3"
                    },
                    
                    {
                        value: "4",
                        text: "4"
                    }
                ]
            }));
            
            this.form.addField( new simply.fields.select({
                label: "Concessions",
                id: "concession_tickets",
                form: this.form,
                choices: [
                    {
                        value: "0",
                        text: "0"
                    },
                    
                    {
                        value: "1",
                        text: "1"
                    },
                    
                    {
                        value: "2",
                        text: "2"
                    },
                    
                    {
                        value: "3",
                        text: "3"
                    },
                    
                    {
                        value: "4",
                        text: "4"
                    }
                ]
            }));
            
        },
        
        render: function() {
            return this.form.render();
        }
    });


})(window.simply);
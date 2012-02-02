(function(simply) {

    simply.forms.seats = Backbone.View.extend({
        
        form: null,
        
        initialize: function() {
            
            this.form = new simply.form({
                name: 'seats',
                action: 'choose-seats'
            });
            
            //TO DO this will be auto generated once it's database driven,
            //until then we're giving it arbitary IDs
            this.form.addField( new simply.fields.select({
                label: "Adults:",
                id: "adult_tickets",
                form: this.form,
                choices: [
                    {
                        value: 0,
                        text: "0"
                    },
                    
                    {
                        value: 1,
                        text: "1"
                    },
                    
                    {
                        value: 2,
                        text: "2"
                    },
                    
                    {
                        value: 3,
                        text: "3"
                    },
                    
                    {
                        value: 4,
                        text: "4"
                    }
                ],
                validation: [
                    {
                        type: function() {
                            return this.getVal() > 0;
                        },
                        msg: "Please select a value"
                    }
                ]
            }));
            
            this.form.addField( new simply.fields.select({
                label: "Children:",
                id: "child_tickets",
                form: this.form,
                choices: [
                    {
                        value: 0,
                        text: "0"
                    },
                    
                    {
                        value: 1,
                        text: "1"
                    },
                    
                    {
                        value: 2,
                        text: "2"
                    },
                    
                    {
                        value: 3,
                        text: "3"
                    },
                    
                    {
                        value: 4,
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
                        value: 0,
                        text: "0"
                    },
                    
                    {
                        value: 1,
                        text: "1"
                    },
                    
                    {
                        value: 2,
                        text: "2"
                    },
                    
                    {
                        value: 3,
                        text: "3"
                    },
                    
                    {
                        value: 4,
                        text: "4"
                    }
                ]
            }));
            
            this.form.addField( new simply.fields.button({
                label: "Next",
                buttonClass: "test",
                id: 'next_button',
                form: this.form,
                action: "submit"
            }));
            
        },
        
        
        
        render: function() {
            return this.form.render();
        }
    });


})(window.simply);
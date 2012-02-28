(function(simply) {
    //TO DO validation
    simply.forms.personalDetails = Backbone.View.extend({
        
        initialize: function() {
            
            this.form = new simply.form({
                name: 'yourInfo',
                action: 'payment',
                model: simply.personalDetails
            });
            
            this.form.addField( new simply.field({
                label: "Your Full Name:",
                id: "full_name",
                form: this.form,
                modelField: 'name',
                validation: [
                    {
                        type: "required",
                        msg: "Please enter your full name"
                    }
                ]
            }));
            
            this.form.addField( new simply.field({
                label: "Your Email Address:",
                id: "email",
                form: this.form,
                modelField: 'email',
                validation: [
                    {
                        type: "required",
                        msg: "Please enter your email address"
                    }
                ]
            }));
            
            this.form.addField( new simply.field({
                label: "Contact Phone Number:",
                id: "phone",
                form: this.form,
                modelField: 'phone',
                validation: [
                    {
                        type: "required",
                        msg: "Please enter your phone number"
                    }
                ]
            }));
            
            
            
            this.form.addField( new simply.fields.button({
                label: "Next",
                class: "nextButton",
                form: this.form,
                action: "submit",
                id: "next"
            }));
            
        },
        
        render: function() {
            return this.form.render();
        }
    });
    
})(window.simply);
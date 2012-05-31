(function(simply) {
    //TO DO validation
    simply.forms.personalDetails = Backbone.View.extend({
        
        initialize: function() {
            
            var fieldType = simply.viewport.mode === 'mobile' ? simply.fields.touchField : simply.field
            
            
            this.form = new simply.form({
                name: 'yourInfo',
                action: 'payment',
                model: simply.personalDetails
            });
            
            this.form.addField( new fieldType({
                label: "Your Full Name",
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
            
            this.form.addField( new fieldType({
                label: "Your Email Address",
                id: "email",
                form: this.form,
                modelField: 'email',
                tagType: 'email',
                validation: [
                    {
                        type: "required",
                        msg: "Please enter your email address"
                    },
                    {
                        type: "email",
                        msg: "Please enter a valid email address"
                    }
                ]
            }));
            
            this.form.addField( new fieldType({
                label: "Contact Phone Number",
                id: "phone",
                form: this.form,
                modelField: 'phone',
                tagType: 'tel',
                validation: [
                    {
                        type: "required",
                        msg: "Please enter your phone number"
                    },
                    {
                        type: "phone",
                        msg: "Please enter a valid phone number"
                    }
                ]
            }));
            
            
            
            this.form.addField( new simply.fields.button({
                label: "Next",
                "className": "nextButton",
                form: this.form,
                action: "submit",
                id: "next"
            }));
            
            this.form.addField( new simply.fields.button({
                label: "Back",
                "className": "previousButton",
                form: this.form,
                action: function() { location.hash = 'seat-options'; },
                id: "previous"
            }));
            
        },
        
        render: function() {
            this.setElement(this.form.render());
            
            return this.$el; 
        }
    });
    
})(window.simply);
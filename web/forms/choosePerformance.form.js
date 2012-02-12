(function(simply) {

    simply.forms.choosePerformance = Backbone.View.extend({
        
        form: null,
        
        initialize: function() {
            
            this.form = new simply.form({
                name: 'choosePerformance',
                action: 'seat-options',
                model: simply.session
            });
            
           
           
            this.form.addField( new simply.fields.radio({
                label: "Choose Performance:",
                id: "performance_choice",
                form: this.form,
                modelField: 'performance_id',
                choices: [
                    {
                        value: 1,
                        text: "Thursday 5th March 2012 - 19:00"
                    },
                    
                    {
                        value: 2,
                        text: "Friday 6th March 2012 - 19:00"
                    },
                    
                    {
                        value: 3,
                        text: "Saturday 7th March 2012 - 14:00"
                    },
                    
                    {
                        value: 4,
                        text: "Saturday 7th March 2012 - 19:00"
                    }
                ],
                validation: [
                    {
                        type: "required",
                        msg: "This field is required"
                    }
                ]
            }));
            
            this.form.addField( new simply.fields.button({
                label: "Next",
                buttonClass: "test",
                form: this.form,
                action: "submit"
            }));
            
        },
        
        render: function() {
            return this.form.render();
        }
    });


})(window.simply);
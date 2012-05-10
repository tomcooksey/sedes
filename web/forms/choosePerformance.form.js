(function(simply) {

    simply.forms.choosePerformance = Backbone.View.extend({
        
        form: null,
        
        initialize: function() {
            
            this.form = new simply.form({
                name: 'choosePerformance',
                action: 'seat-options',
                model: simply.session
            });
            
            var choices = [], obj;
            
            simply.performances.each(function(performance) {
                

                
                obj = {
                    value: performance.get('id'),
                    text: performance.get('name')
                };
                
                choices.push(obj);
                
            }, this);
            
            

           
            this.form.addField( new simply.fields.performance({
                label: "Choose Performance:",
                id: "performance_choice",
                form: this.form,
                modelField: 'performance_id',
                choices: choices,
                validation: [
                    {
                        type: "required",
                        msg: "Please choose a performance!"
                    }
                ]
            }));
            
            this.form.addField( new simply.fields.button({
                label: "Next",
                className: "nextButton",
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
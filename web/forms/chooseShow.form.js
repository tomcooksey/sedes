(function(simply) {
    
    simply.forms.chooseShow = simply.form.extend({
        
        initialize: function() {
            
            this.form = new simply.form({
                name: 'chooseShow',
                action: " ",
                model: simply.session
            });
            
            //Dynamically create the options list from the collection
            var choices = [], obj;
            simply.shows.each(function(show) {
                obj = {
                    value: show.get('id'),
                    text: show.get('name')
                };
                
                choices.push(obj);
                
            }, this);
            
            this.form.addField( new simply.fields.radio({
                label: "Choose show",
                form: this.form,
                choices: choices,
                modelField: 'show_id'
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
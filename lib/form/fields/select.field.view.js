(function(simply) {
    
    simply.fields.select = simply.field.extend({
        
        tagName: 'select',
        
        events: {
            'change': 'checkField' 
        },
        
        renderOption: function(choice) {
            return $(this.make('option', {value: choice.value}, choice.text))
        },
        
        renderField: function() {
            this.el = $(this.make(this.tagName, {name: this.fieldName, id: this.fieldName}));
        
            for(var x in this.options.choices) {
                this.el.append(this.renderOption(this.options.choices[x]));   
            }
            
            return this.el;
        }
    });
    
})(window.simply);
(function(simply) {
    
    simply.fields.select = simply.field.extend({
        
        tagName: 'select',
        
        renderField: function() {
            this.el = $(this.make(this.tagName, {name: this.fieldName, id: this.fieldName}));
        
            for(var x in this.choices) {
                this.el.append($(this.make('option', {value: this.choices[x].value}, this.choices[x].text)));   
            }
            
            return this.el;
        }
    });
    
})(window.simply);
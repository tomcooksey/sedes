(function(simply) {
    
    simply.fields.radio = simply.field.extend({
    
        labelTagName: 'legend',
        wrapperTagName: 'fieldset',
        
        
        events: {
            "click input:radio" : "checkField"
        },
        
        createOptionId: function(choice) {
            return this.fieldName + '_' + choice.value; 
        },
        
        renderOption: function(choice) {
            var row, label, radio;
            
            //Create the wrapper
            row = $(this.make('div', {"class" : "radioRow"}));
            //Create the label
            label = $(this.make('label', {"for" : this.createOptionId(choice)}, choice.text));
            //Create the radio
            radio = $(this.make(this.tagName, {"name": this.fieldName, "id": this.createOptionId(choice), "type": "radio", "value": choice.value}));
            
            row.append(radio);
            row.append(label);
            
            return row;
        },
        
        renderField: function() {
            this.setElement(this.make('div', { "class": "radioGroup", "id": this.options.form.name + '_group'}));
            
            for(var x in this.options.choices) {
                this.$el.append(this.renderOption(this.options.choices[x]));   
            }
          
        },
        
        getVal: function(setter) {

            if(setter !== undefined) {
                //set the value
                
                this.validate();
            }
            
            var val = parseInt($('input[name=' + this.fieldName + ']:checked').val());
            
            if(isNaN(val)) val = undefined;

            return val;
        },
        
        getChoiceFromVal: function(val) {
            for(var x in this.options.choices) {
                if(this.options.choices[x].value == val) {
                    return this.options.choices[x];
                }
            }
            return false;
        },
        
        setVal: function(val) {
            this.$el.find('#' + this.createOptionId(this.getChoiceFromVal(val))).attr('checked', true);
        }
    
    });
    
})(window.simply);
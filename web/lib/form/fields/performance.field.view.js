(function(simply) {
    
    simply.fields.performance = simply.field.extend({
        
        labelTagName: 'h3',
        tagName: 'div',
        wrapperClass: 'performanceWrapper',
        optionItems: [],
        
        renderField: function() {
            
            this.setElement(this.make('div', {"class": 'choosePerformance'}));  
        },
        
        events: {
            'click .performanceRow': 'rowClick'  
        },
        
        rowClick: function(event) {
            this.setVal($(event.currentTarget).data('value'));
            this.checkField();
        },
        
        renderOption: function(choice) {
            var row, label, radio;
            
            //Create the wrapper
            row = $(this.make('div', {"class" : "performanceRow", "data-value" : choice.value}));
            //Create the label
            label = $(this.make('div', {}, choice.text));

            row.append(label);
            
            this.optionItems.push(row);
            
            return row;
        },
        
        renderField: function() {
            for(var x in this.options.choices) {
                this.$el.append(this.renderOption(this.options.choices[x]));   
            }
        },
        
        setVal: function(val) {
            
            for(var x=0; x<this.optionItems.length; x+=1) {
                this.optionItems[x].removeClass('selected');
                
                if(this.optionItems[x].data('value') == val) {
                    this.optionItems[x].addClass('selected');
                    this.val = val;
                }
                
            }
            
        },
        
        getVal: function() {
            return this.val;
        }
    });
    
})(window.simply);
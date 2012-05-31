(function(simply) {
    
    simply.fields.touchField = simply.field.extend({
        
        wrapperClass: "fieldWrapper",
        tagName: 'input',
        
        events: {
            "focus" : "focus",
            "blur"  : "blur"
        },
        
        //Make a blank label
        makeLabel: function() {
            this.label = '';
        },
        
        focus: function(event) {
            
            if(this.getVal() === this.options.label) {
                this.$el.val('');
                this.$el.removeClass('defaultVal');
            }
            
        },
        
        blur: function(noCheck) {
            if((typeof noCheck) !== 'boolean') {
                this.checkField();
            }
            
            if(this.getVal() === '') {
                
                this.$el.val(this.options.label);
                this.$el.addClass('defaultVal');
                
            }
        },
        
        render: function() {
            
            this.options.label = this.options.label.replace(':', '');
            
            this.makeWrapper();
            
            this.wrapper.append(this.$el);
            
            this.renderActions();
            
            this.blur(false);
            
            return this.wrapper;
        }
        

        
    });
    
})(window.simply);
(function(simply) {

    simply.form = Backbone.View.extend({
        
        name: null,
        valid: false,
        action: null,
        
        initialize: function(options) {
            
            if(!options.name) throw new Error ('A form must have a NAME specified');
            
            var modelUpdate;
            
            this.options = options;
            
            this.fields = [];
            this.name = options.name;
            this.action = options.action || null;
            
            this.setElement(this.make('form', {id: this.name, name: this.name}));
            
        },
        
        addField: function(field) {
            field.options.form = this;
            this.fields.push(field);
            
            this.$el.append(field.render());
        },
        //TO DO Create self submitting forms
        submit: function() {

            this.validate();
            
            if(this.valid) {
                if(typeof this.action !== 'function') {
                    location.hash = this.action;
                }else{
                    this.action.apply(this);
                }
            }
        },
        
        validate: function() {
            var validCount = 0;
            
            var errors = [];
            
            for(var x=0; x< this.fields.length; x+=1) {
                if(this.fields[x].validate()) {
                    validCount+=1;
                }else{
                    errors = errors.concat(this.fields[x].errors);
                }
            }

            this.valid = validCount === this.fields.length;
            
            if(!this.valid) {
                simply.errors.addErrors(errors);
            }
        },
        
        removeField: function(field) {
              
        },
        
        render: function() {
            
            return this.$el;
        }
    });
    
})(window.simply);
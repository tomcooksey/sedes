(function(simply) {
    //TO DO Next we need to tie forms to models!
    simply.form = Backbone.View.extend({
        
        name: null,
        valid: false,
        action: null,
        
        initialize: function(options) {
            var modelUpdate;
            
            this.fields = [];
            this.name = options.name;
            this.action = options.action || null;
            
            this.setElement(this.make('form', {id: this.name, name: this.name}));
            
            //Bind to the model changing
            /*if(this.options.model) {
                this.options.model.bind('change', function() {
                    console.log('changing');
                    for(var x in this.fields ) {
                        if(this.fields[x].options.hasOwnProperty('modelField')) {
                            modelUpdate = {};
                            modelUpdate[this.fields[x].options.modelField] = this.fields[x].getVal();
                            this.model.set(modelUpdate);
                        }
                    }
                }, this);
            }*/
            
        },
        
        addField: function(field) {
            field.options.form = this;
            this.fields.push(field);
            
            this.$el.append(field.render());
        },
        //TO DO Create self submitting forms
        submit: function() {

            var validCount = 0;
            
            if(!this.valid) {
                for(var x=0; x< this.fields.length; x+=1) {
                    if(this.fields[x].validate()) {
                        validCount+=1;
                    }
                }

                this.valid = validCount === this.fields.length;
            }
            
            if(this.valid) {
                if(typeof this.action !== 'function') {
                    location.hash = this.action;
                }else{
                    this.action.apply(this);
                }
            }
        },
        
        removeField: function(field) {
              
        },
        
        render: function() {
            
            return this.$el;
        }
    });
    
})(window.simply);
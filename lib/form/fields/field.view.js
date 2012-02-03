(function(simply) {
    
    simply.field = Backbone.View.extend({
        
        tagName: 'input',
        tagType: 'text',
        labelTagName: 'label',
        wrapperTagName: 'div',
        wrapperClass: 'fieldWrapper',
        label: null,
        fieldName: null,
        valid: false,
        wrapper: null,
        options: {},
        doNotValidate: false,
        
        initialize: function(options) {
            
            this.options = options;
            this.options.validation = options.validation || [];
            
            this.makeName();
            this.makeLabel();
            this.renderField();
            console.log(this.events);
            this.delegateEvents();
        },
        
        events: {
            'blur': 'checkField' 
        },
        
        checkField: function() {
            this.validate(false);
        },
        
        makeName: function() {
            this.fieldName = this.options.form.name + '_' + this.options.id;
        },
        
        makeLabel: function() {
            this.label = this.make(this.labelTagName, {"for": this.fieldName}, this.options.label);
        },
        
        render: function() {
            this.wrapper = $(this.make(this.wrapperTagName, { "id": this.fieldName + '_wrapper', "class": this.wrapperClass}));
            
            this.wrapper.append(this.label);
            this.wrapper.append(this.$el);
            
            //Grab associated model value and set it
            if(this.options.form.model && this.options.modelField) {
                console.log('stored val', this.options.form.model.get(this.options.modelField));
                this.setVal(this.options.form.model.get(this.options.modelField));
            }
            
            return this.wrapper;
        },
        
        renderField: function() {
            this.setElement(this.make(this.tagName, { "type": this.tagType, "id" : this.fieldName, "name": this.fieldName}));
            
            return this.$el;
        },
        
        getVal: function() {
            return this.$el.val();
        },
        
        setVal: function(val) {
            this.$el.val(val);
        },
        
        validate: function(silent) {
        
            if(this.doNotValidate) {
                this.valid = true;
                return true;
            }
            
            var validCount, modelUpdate;
            
            this.valid = false;
            this.wrapper.removeClass('valid').removeClass('invalid');
            
            if(this.options.validation.length === 0) {
                this.valid = true;
            }else{
                
                validCount = 0;
                
                _.each(this.options.validation, function (rule) {
                    if(typeof rule.type === 'function') {
                        //evaluate the func
                        if(rule.type.apply(this)) {
                            validCount +=1;
                        }
                    }else{
                        //Switch through some defaults
                        switch (rule.type) {
                            case "required":
                                if(this.getVal() !== undefined) {
                                    validCount +=1;
                                }
                                break; 
                        }
                    }
                }, this);
                
                this.valid = validCount === this.options.validation.length;
            }
            
            if(this.valid) {
                this.wrapper.addClass('valid');
                
                //Set associated model attribute
                if(this.options.form.model && this.options.modelField) {
                    modelUpdate = {};
                    modelUpdate[this.options.modelField] = this.getVal();
                    this.options.form.model.set(modelUpdate, {silent: true});
                    console.log(this.options.form.model);
                }
                
            }else{
                if(!silent) {
                    this.wrapper.addClass('invalid');
                }
            }
            
            return this.valid;            
        }
    });
    
})(window.simply);
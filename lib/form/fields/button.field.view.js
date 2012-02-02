(function(simply) {
    
    simply.fields.button = simply.field.extend({
        
        wrapperClass: "buttonWrapper",
        doNotValidate: true,
            
        
        events: {
            "click" : "press"
        },
        
        //Make a blank label
        makeLabel: function() {
            this.label = $();
        },
        
        getDefaultEvent: function(eventType) {
            switch(eventType) {
                case "submit":
                    return function() {
                        this.options.form.submit();  
                    }
                    break;
            }
            
            throw new Error("Trying to retrieve default event: " + eventType + " that does not exist")
        },
        
        press: function(event) {
            var action;
            event.preventDefault();
            
            action = this.options.action;

            if(typeof action !== 'function') {
                //Get the correct function and overwrite action
                action = this.getDefaultEvent(action);
            }
            //Apply the action in the context of the field
            action.apply(this);
        },
        
        renderField: function() {
            this.el = $(this.make('button', { "class": "button " + this.options.buttonClass }, this.options.label ));
            return this.el;
        },
        

        
    });
    
})(window.simply);
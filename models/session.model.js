(function(simply) {
    
    simply.models.session = Backbone.Model.extend({
        
        binds: {},
        
        initialize: function() {
            this.binds = {};
            
            this.on('change', this.globalChange, this);
        },
        
        globalChange: function() {
            
            simply.globalChanging = true;
            
            var asyncCalls = 0, completedASyncCalls = 0;
            
            function incrementCompleted() {
                completedASyncCalls +=1;
            }
            
            _.each(this.changedAttributes(), function(x, field) {
                if(this.binds.hasOwnProperty(field)) {
                    //If we don't need to wait before getting
                    //a response (ie no server interaction is involved),
                    //then we can just call the function and forget
                    //about it
                    for(var y=0; y< this.binds[field].length; y+=1) {
                        var bind = this.binds[field][y];
                        if(!bind.async) {
                            bind.fn.apply(bind.context);
                        }else{
                            asyncCalls +=1;
                            bind.fn.apply(bind.context);
                        }
                    }
                    
                }
                
            }, this);
            
            //Set a timeout to check completedASyncCalls
            setTimeout(function() {
                if(asyncCalls !== completedASyncCalls) {
                    setTimeout(function() {
                        this.apply()
                    }, 100);
                }else{
                    
                }
            }, 100);
        },
        
        defaults: {
            //TO DO this order_id should come from the server and be
            //a protected attribute..is this possible?
            order_id: 1,
            current_stage: 1,
            show_id: 0,
            performance_id: 0
        },
        
        //We are going to bind change events to this model
        //from within it self because one event needs to
        //sometimes trigger several responses, which isn't
        //possible out of the box with Backbone without
        //setting up multiple events which isn't desireable.
        addChangeBind: function(field, fn, context, async) {
            
            if(!this.has(field)) {
                throw new Error('Unknown field in session: ' + field); 
            };
            
            if(!this.binds.hasOwnProperty(field)) {
                this.binds[field] = [];
            }
            
            var bind = {
                fn: fn,
                context: context,
                async: async
            }
            
            this.binds[field].push(bind);
        }
        
    });
    
})(window.simply);
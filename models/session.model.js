(function(simply) {
    
    simply.models.session = Backbone.Model.extend({
        
        binds: {},
        
        //We need to override set so that we can cache any requests that come in
        set: function(attributes, options) {
            console.log('calling my setter');
            var self = this;
            
           
            
            var caller = function() {
                if(!simply.globalChanging) {
                    Backbone.Model.prototype.set.call(self, attributes, options);
                }else{
                    setTimeout(function() {
                        caller.apply();
                    }, 100);
                }
            }
            
            caller.apply();
            
            return true;
        },
        
        initialize: function() {
            this.binds = {};
            
            this.on('change', this.globalChange, this);
        },
        
        cachedRequests: {},
        
        globalChange: function() {
            
            if(simply.globalChanging) return;
            
            simply.globalChanging = true;
            
            var asyncCalls = 0, completedASyncCalls = 0;
            
            function incrementCompleted() {
                console.log('recieving completion');
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
                            bind.fn.apply(bind.context, [incrementCompleted]);
                        }
                    }
                    
                }
                
            }, this);
            
            timeoutFunc = function() {
                if(asyncCalls !== completedASyncCalls) {
                    
                    console.log('asc', asyncCalls);
                    console.log('cac', completedASyncCalls);
                    
                    setTimeout(function() {
                        console.log('Not completed, check again');
                        timeoutFunc.apply()
                    }, 100);
                }else{
                    
                    console.log('asc', asyncCalls);
                    console.log('cac', completedASyncCalls);
                    
                    simply.globalChanging = false;
                    console.log('all completed', simply.globalChanging);
                }
            }
            
            //Set a timeout to check completedASyncCalls
            setTimeout(function() {
                timeoutFunc.apply();
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
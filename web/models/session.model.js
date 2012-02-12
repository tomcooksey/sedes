(function(simply) {
    
    simply.models.session = Backbone.Model.extend({
        
        binds: {},
        url: "/api.php/session",
        
        //We need to override set so that we can cache any requests that come in
        myset: function(attributes, options) {

            console.log('something calling set');
            console.log(attributes);
            var self = this;
            
            var caller = function() {
                if(!simply.globalChanging) {
                    Backbone.Model.prototype.set.call(self, attributes, options);
                }else{
                    console.log('change in progress');
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
            
            //this.on('change', this.globalChange, this);
        },
        
        saveCopy: function(callback) {
            
            var self = this;
            //callback.apply(self);
            //return;
            setTimeout(function() {
                callback.apply(self);
            }, 1000);
            
            
                
        },
        
        
        globalChange: function() {
            
            console.log('attempting global change');
            console.log(this.changedAttributes());
            console.log(simply.globalChanging);
            if(simply.globalChanging) return;
            
            //TO DO - This needs to be on save and the rest should be
            //run during a callback..otherwise it won't
            //send back any new data, it'll be the old
            //stuff!
            simply.globalChanging = true;
            
            //Cache the changed attributes because otherwise when we get into the callback
            //they are no longer considered new 
            var self = this, changedAttributes = this.changedAttributes();
            
            console.log('about to try save session');
            
            this.save([], {"success" : function() {
                console.log('session save complete');
                var asyncCalls = 0, completedASyncCalls = 0;
            
                function incrementCompleted() {
                    completedASyncCalls +=1;
                }
                
                
                _.each(changedAttributes, function(x, field) {
                    if(self.binds.hasOwnProperty(field)) {
                        //If we don't need to wait before getting
                        //a response (ie no server interaction is involved),
                        //then we can just call the function and forget
                        //about it
                        for(var y=0; y< self.binds[field].length; y+=1) {
                            var bind = self.binds[field][y];
                            if(!bind.async) {
                                bind.fn.apply(bind.context);
                            }else{
                                asyncCalls +=1;
                                bind.fn.apply(bind.context, [incrementCompleted]);
                            }
                        }
                        
                    }
                    
                }, self);
                
                timeoutFunc = function() {
                    if(asyncCalls !== completedASyncCalls) {
                        
                        setTimeout(function() {
                            timeoutFunc.apply()
                        }, 100);
                    }else{     
                        simply.globalChanging = false;
                    }
                }
                
                //Set a timeout to check completedASyncCalls
                setTimeout(function() {
                    timeoutFunc.apply();
                }, 100);
            }, error: function(stuff) {
                alert(stuff);
            }});
            
            
        },
        
        defaults: {
            id: 1,
            order_id: 0,
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
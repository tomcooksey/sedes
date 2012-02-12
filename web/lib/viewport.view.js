(function(simply) {
    simply.views.viewport = Backbone.View.extend({
    
        progressBar: null,
        collections: {},
        views: {},
        el: '#activeSpace',
        
        initialize: function(options) {

            this.collections.progress = new simply.collections.stages();
            
            //Create our bindings to the session object
            simply.session.on('change:current_stage', this.collections.progress.changeStage, this.collections.progress);
            simply.session.on('change:show_id', this.showChange, this);
            simply.session.on('change:performance_id', this.performanceChange, this);
            
            simply.session.on('beforeSave:current_stage', this.dummy, this);
            
            //Trigger a change on the session so that we get the first bits done
            
            this.progressBar = new simply.views.progress({
                collection: this.collections.progress    
            });
            
            this.loadingOverlay = $('#loading');
            this.window = $(window);
            
            //Return this for chaining
            return this;
        },
        
        dummy: function() {
            console.log('about to make request');  
        },
        
        //This should be an overwrite of reset()
        showChange: function() {
            console.log('here I would update the performances');
            
           
        },
        
        performanceChange: function() {
            console.log('here I would update the ticket types and prices');
            
           
        },
        
        render: function() {
            //Added here because it's common to all views
            this.progressBar.render();
        },
        
        addView: function(el, ref) {
            var self = this;
            
            this.loadingOverlay.height(this.window.height());
            this.loadingOverlay.width(this.window.width());
            this.loadingOverlay.fadeIn('fast');
            
            setter = function() {
                if(simply.globalChanging) {
                    setTimeout(function() {
                        setter.apply();
                    }, 100);
                }else{
                    self.loadingOverlay.fadeOut('fast');
                    self.views[ref] = el;
                    self.$el.append(el.render());
                }
            }
            
            //Timed out to our animation time in initial call
            setTimeout(function() {
                setter.apply();
            }, 500);  
        },
        
        removeElement: function(selector) {
            $(selector, this.$el).remove();
        },
        
        clean: function() {
            
            //Destroy the views
            for(var x in this.views) {
                this.views[x].off();
                this.views[x].off();
            }
            
            this.$el.html('');
        }
        
    });
    
})(window.simply);
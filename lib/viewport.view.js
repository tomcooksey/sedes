(function(simply) {
    simply.views.viewport = Backbone.View.extend({
    
        progressBar: null,
        collections: {},
        views: {},
        el: '#activeSpace',
        
        initialize: function(options) {

            this.collections.progress = new simply.collections.stages();
            
            //Create our bindings to the session object
            simply.session.addChangeBind('current_stage', this.collections.progress.changeStage, this.collections.progress, false);
            simply.session.addChangeBind('show_id', this.showChange, this, true);
            simply.session.addChangeBind('performance_id', this.performanceChange, this, true);
            
            this.progressBar = new simply.views.progress({
                collection: this.collections.progress    
            });
            
            this.loadingOverlay = $('#loading');
            this.window = $(window);
            
            //Return this for chaining
            return this;
        },
        
        showChange: function(callback) {
            console.log('here I would update the performances');
            
            //This will actually send to fetch etc
            window.setTimeout(function() {
                console.log('performances updated');
                callback.apply();
            }, 2000);
        },
        
        performanceChange: function(callback) {
            console.log('here I would update the ticket types and prices');
            
            //This will actually send to fetch etc
            window.setTimeout(function() {
                console.log('tickets updated');
                callback.apply();
            }, 2000);
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
            
            console.log('GC:', simply.globalChanging);
            
            setter = function() {
                if(simply.globalChanging) {
                    console.log('async calls still taking place');
                    setTimeout(function() {
                        setter.apply();
                    }, 100);
                }else{
                    
                    console.log('async calls complete..continuing with program', simply.globalChanging);
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
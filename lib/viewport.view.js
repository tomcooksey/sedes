(function(simply) {
    simply.views.viewport = Backbone.View.extend({
    
        progressBar: null,
        collections: {},
        views: {},
        el: '#activeSpace',
        
        initialize: function(options) {

            this.collections.progress = new simply.collections.stages();
            
            simply.session.on('change:current_stage', this.collections.progress.changeStage, this.collections.progress);
            
            console.log('sid', simply.session.get('show_id'));
            simply.session.on('change:stage_id', this.showChange, this);
            
            this.progressBar = new simply.views.progress({
                collection: this.collections.progress    
            });
            
            //Return this for chaining
            return this;
        },
        
        showChange: function() {
            console.log('show changed');
            console.log('sid', simply.session.get('show_id'))
        },
        
        render: function() {
            //Added here because it's common to all views
            this.progressBar.render();
        },
        
        addView: function(el, ref) {
            var self = this;
            
            setTimeout(function() {
                self.views[ref] = el;
                self.$el.append(el.render());
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
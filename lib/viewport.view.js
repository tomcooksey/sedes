(function(simply) {
    simply.views.viewport = Backbone.View.extend({
    
        progressBar: null,
        collections: {},
        views: {},
        
        initialize: function(options) {

            this.collections.progress = new simply.collections.stages();
            
            simply.session.bind('change:current_stage', this.collections.progress.changeStage, this.collections.progress);
            
            //TO DO - bind to the show_id changing to update the performances collection
            //simply.session.bind('change:show_id', this.collections.progress.changeStage, this.collections.progress);
            
            this.el = $('#activeSpace');

            
            this.progressBar = new simply.views.progress({
                collection: this.collections.progress    
            });
            
            //Return this for chaining
            return this;
        },
        
        render: function() {
            //Added here because it's common to all views
            this.progressBar.render();
        },
        
        addView: function(el, ref) {
            var self = this;
            
            setTimeout(function() {
                self.views[ref] = el;
                self.el.append(el.render());
            }, 500);
            
        },
        
        removeElement: function(selector) {
            $(selector, this.el).remove();
        },
        
        clean: function() {
            
            //Destroy the views
            for(var x in this.views) {
                this.views[x].unbind();
                this.views[x].remove();
            }
            
            this.el.html('');
        }
        
    });
    
})(window.simply);
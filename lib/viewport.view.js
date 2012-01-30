(function(simply) {
    simply.views.viewport = Backbone.View.extend({
    
        progressBar: null,
        collections: {},
        
        initialize: function(options) {
            
            this.collections.progress = new simply.collections.stages();
            
            simply.session.bind('change:current_stage', this.collections.progress.changeStage, this.collections.progress);
            
            this.el = $('.activeSpace');
            
            this.progressBar = new simply.views.progress({
                collection: this.collections.progress    
            });
            
            //Return this for chaining
            return this;
        },
        
        render: function() {
            this.progressBar.render();
        }
        
    });
    
})(window.simply);
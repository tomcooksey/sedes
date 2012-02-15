(function(simply) {
    
    simply.views.seatMap = Backbone.View.extend({
    
        
        initialize: function(options) {
            
            _.bindAll(this, 'renderSeats');
            //These can lazy load because we don't need them yet
            this.collection.fetch({success: this.renderSeats});
            var el = this.make("div", { "class": "seatMap"});
            this.setElement(el);
            
            this.addLoading();
        },
        
        addLoading: function() {
            this.loadingDiv = $(this.make('div', { "class" : "loadingSeatmap" }, "Loading seat map, please wait..."));
            this.$el.append(this.loadingDiv);
        },
        
        removeLoading: function(callback) {
            var self = this;
            this.loadingDiv.fadeOut('fast', function() {
                self.loadingDiv.remove();
                callback.apply(self);
            });
        },
        
        renderSeats: function() {
            this.removeLoading(function() {
                
                var rowsHolder = $(this.make('div',{ "class" : "rowsHolder"}));
            
                var rows = this.collection.convertToRows(), row, rowContainer, rowView;
                
                for(row in rows) {
                    rowContainer = $(this.make('div', {"class" : "row"}));
                    
                    rowContainer.append(this.make('div', {"class" : "rowId"}, row));
                    
                    for(seat in rows[row]) {
                        rowView = new simply.views.seat({model: rows[row][seat], collection: this.collection});
                        rowContainer.append(rowView.render());
                    }
                    
                    rowsHolder.append(rowContainer);
                }
                
                this.$el.append(rowsHolder);
                
                this.renderStage();
                this.renderKey();
                this.renderButtons();
            
            });
        },
        
        renderStage: function() {
            var stage = $(this.make('div', {"class": "mapStage"}, "Stage"));
            
            this.$el.append(stage);
            
        },
        
        renderKey: function() {
            //This should really be a template
            var key = $(this.make('div', {"class": "key"}));
            key.append(simply.templates.mapKey());
            
            this.$el.append(key);
        },
        
        renderButtons: function() {
            var nextWrapper = $(this.make('div', {class: "buttonWrapper nextButton"}));
            this.nextButton = $(this.make('button', {}, 'Next'));
            
            nextWrapper.append(this.nextButton);
            
            this.$el.append(nextWrapper);
        },
        
        show: function() {
            this.$el.slideDown('fast');  
        },
        
        render: function() {
            return this.el;
        }
        
    });
    
})(window.simply);
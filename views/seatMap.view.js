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
            
                var rows = this.collection.convertToRows(), row, rowContainer, rowView;
                
                for(row in rows) {
                    rowContainer = $(this.make('div', {"class" : "row"}));
                    
                    rowContainer.append(this.make('div', {"class" : "rowId"}, row));
                    
                    
                    
                    for(seat in rows[row]) {
                        rowView = new simply.views.seat({model: rows[row][seat]});
                        rowContainer.append(rowView.render());
                    }
                    
                    this.$el.append(rowContainer);
                }
                
                
            
            });
        },
        
        show: function() {
            this.$el.slideDown('fast');  
        },
        
        render: function() {
            return this.el;
        }
        
    });
    
})(window.simply);
(function(simply) {
    
    simply.views.seatMap = Backbone.View.extend({
    
        
        initialize: function(options) {
            
            _.bindAll(this, 'renderSeats');
            //These can lazy load because we don't need them yet
            this.collection.fetch({success: this.renderSeats});
            this.seatMap = $(this.make("div", { "class": "seatMap"}));
            
            var el = this.make('div', {class: "seatMapHolder"});
            
            this.setElement(el);
            
            this.$el.append(this.seatMap);
            
            this.addLoading();
        },
        
        addLoading: function() {
            this.loadingDiv = $(this.make('div', { "class" : "loadingSeatmap" }, "Loading seat map, please wait..."));
            this.seatMap.append(this.loadingDiv);
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
                
                this.seatMap.append(rowsHolder);
                
                this.renderStage();
                this.renderKey();
                this.renderButtons();
            
            });
        },
        
        renderStage: function() {
            var stage = $(this.make('div', {"class": "mapStage"}, "Stage"));
            
            this.seatMap.append(stage);
            
        },
        
        renderKey: function() {
            //This should really be a template
            var key = $(this.make('div', {"class": "key"}));
            key.append(simply.templates.mapKey());
            
            this.seatMap.append(key);
        },
        
        renderButtons: function() {
            
            var buttonTypes = ['next', 'previous'];
            var wrapper, label;
            
            for(var el in buttonTypes) {
                btn = buttonTypes[el];
                label = btn === "next" ? "Next" : "Back";
                wrapper = $(this.make('div', {class: "buttonWrapper " + btn + "Button"}));
                this[btn + "Button"] = $(this.make('button', {}, label));
                
                wrapper.append(this[btn + "Button"]);
                this.$el.append(wrapper);
            }
            
            
        },
        
        show: function() {
            this.$el.slideDown('fast');  
        },
        
        render: function() {
            
            return this.el;
        },
        
        //This function removes any amount of seats over the amount allowed
        adjustBookedSeats: function() {
            var totalAllowed = simply.ticketTypes.getTotalTickets()
            var totalSelected = this.collection.getTotalSelected();
            
            console.log(totalAllowed);
            console.log(totalSelected); 
            
            console.log('here');
            if(totalSelected > totalAllowed) {
                console.log('will remove seats');
            }
        }
        
    });
    
})(window.simply);
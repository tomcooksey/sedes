(function(simply) {
    
    simply.views.seatMap = Backbone.View.extend({
    
        
        initialize: function(options) {
            
            _.bindAll(this);
            //These can lazy load because we don't need them yet
            this.collection.fetch({success: this.renderSeats});
            this.seatMap = $(this.make("div", { "class": "seatMap"}));
            
            var el = this.make('div', {"class": "seatMapHolder"});
            
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
                        rowView = new simply.views.seat({model: rows[row][seat], collection: this.collection, seatMap: this});
                        rowContainer.append(rowView.render());
                    }
                    
                    rowsHolder.append(rowContainer);
                }
                
                this.seatMap.append(rowsHolder);
                
                this.renderStage();
                this.renderKey();
                this.renderButtons();
                
                if(this.collection.getSelectedSeats().length > 0) {
                
                    $.ajax({
                       url: '/api.php/order',
                       success: this.handleOrder,
                       dataType: 'json'
                   });
                }
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
            var self = this;
            var buttonTypes = ['next', 'previous'];
            var funcs = {
                'next': function() {
                    
                    //Strict equals here because it always returns something
                    //either true if valid or an array if invalid
                    var valid = self.collection.valid();
                    if(valid !== true) {
                        simply.errors.addErrors(valid);
                    }else{
                        simply.errors.hide();
                        location.hash = 'your-info';
                    }
                }
            }
            var wrapper, label;
            
            for(var el in buttonTypes) {
                button = buttonTypes[el];

                var self = this;
                //Has to be wrapped in a closure due to loop
                (function(btn) {
                    label = btn === "next" ? "Next" : "Back";
                    var wrapper = $(self.make('div', {class: "buttonWrapper " + btn + "Button"}));
                    self[btn + "Button"] = $(self.make('button', {}, label));
                    
                    if(funcs[btn]) {
              
                        self[btn + "Button"].bind('click', function(event) {
                            event.preventDefault();
                            funcs[btn].apply();
                        });
                        
                    }
                    
                    wrapper.append(self[btn + "Button"]);
                    self.$el.append(wrapper);
                })(button);
            }
        },
        
        handleOrder: function(data) {
            this.clock(data.timestamp);  
        },
        
        show: function() {
            this.$el.slideDown('fast');  
        },
        
        render: function() {
            
            return this.el;
        },
        
        clock: function(timestamp) {
            
            this.timestamp = timestamp + (60 * 10);
            
            if(!this.clockElement) {
                this.clockElement = $(simply.templates.clock());
                this.$el.append(this.clockElement);
                
                this.clockTimeElement = $('.clockTime');
                
                this.clockElement.fadeIn();
                
                this.startTimer();
            }
            
            
        },
        
        startTimer: function() {
            var that = this;
            
            var timeremaining =  this.timestamp - (Tempus.now() / 1000);
            
            if(this.collection.getSelectedSeats().length === 0) {
                this.clockElement.fadeOut();
                this.clockElement.remove();
                this.clockElement = null;
                return;
            }
            
            if(timeremaining > 0) {
                
                //Workout how many mins/secs
                mins = Math.floor(timeremaining / 60);
                secs = Math.floor(timeremaining % 60);
                
                secs = secs + '';
                if(secs.length === 1) {
                    secs = '0' + secs;
                }
                
                mins = mins + '';
                if(mins.length === 1) {
                    mins = '0' + mins;
                }
                
                this.clockTimeElement.html(mins + ':' + secs);
                
                setTimeout(function() {
                    that.startTimer.apply(that);
                }, 1000);
                
            }else{
                
                $.ajax({
                    url: '/api.php/killOrder',
                    dataType: 'json',
                    success: function() { location.hash = ''}
                });
                
            }
            
        },
        
        
        
        
        //This function removes any amount of seats over the amount allowed
        adjustBookedSeats: function() {
            var totalAllowed = simply.ticketTypes.getTotalTickets()
            var totalSelected = this.collection.getTotalSelected();
            
            if(totalSelected > totalAllowed) {
                var difference = totalSelected - totalAllowed;
                this.collection.removeSeats(difference);
            }
        }
        
    });
    
})(window.simply);
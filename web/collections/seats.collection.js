(function(simply) {
    
    simply.collections.seats = Backbone.Collection.extend({
        
        model: simply.models.seat,
        
        //Overriden
        fetch: function(options) {
            var self = this;
            
            setTimeout(function() {
                
                //Manually feed in the seats for now
                var rows = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j'];
                
                var unique = 0, seatNumber;
                
                for(var x=rows.length - 1; x>=0; x-=1) {
                    
                    seatNumber = 1;
                    
                    for(var y=1; y<27; y+=1) {
                        forSale = true;
                        if(rows[x] == 'j') {
                            if(seatNumber < 5) {
                                forSale = false;
                            }
                            
                            if(y < 4 || y===26 || y===8) {
                                self.add({
                                    id: unique,
                                    row: rows[x],
                                    number: '',
                                    booked: false,
                                    forSale: false,
                                    selected: false,
                                    noSeat: true
                                });
                            }else{
                                self.add({
                                    id: unique,
                                    row: rows[x],
                                    number: seatNumber,
                                    booked: false,
                                    forSale: forSale,
                                    selected: false
                                });
                                seatNumber +=1;
                                
                            }
                        }else{
                            
                            booked = false;
                            
                            if(rows[x] == 'e') {
                                if(seatNumber > 5 && seatNumber < 22) {
                                    booked = true;
                                }
                            }
                            
                            self.add({
                                id: unique,
                                row: rows[x],
                                number: seatNumber,
                                booked: booked,
                                forSale: forSale,
                                selected: false
                            });
                            seatNumber +=1;
                           
                        }
                         unique +=1;
                        
                    }
                }
                
                if(typeof options.success === 'function') {
                    options.success.apply();
                }
                
            }, 500);
        },
        
        convertToRows: function() {
            
            var rows = {};
            
            this.each(function(seat) {
                
                if(!rows.hasOwnProperty(seat.get('row'))) {
                    
                    rows[seat.get('row')] = [];
                }
                
                rows[seat.get('row')].push(seat);
                
            }, this);
            
            return rows;
        },
        
         getTotalSelected: function() {
            
            var totalCount = 0;
            
            this.each(function(seat) {
                if(seat.get('selected')) {
                    totalCount +=1;
                }
            });
            
            return totalCount;
            
        }
        
    });
    
})(window.simply);
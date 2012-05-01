(function(simply) {
    
    simply.views.checkout = Backbone.View.extend({
        
        initialize: function() {
            this.setElement(this.make('div', {class: 'orderSummary'}, 'Loading order summary please wait...'));
            
            _.bindAll(this);
            this.renderInfo();
        },
        
        addRow: function(label, value) {
            var row = $(this.make('tr'));
            row.append(this.make('th', {}, label + ':'));
            row.append(this.make('td', {}, value));
            
            this.table.append(row);
        },
        
        renderInfo: function() {
            
            //Render the table
            this.table = $(this.make('table'));
            
            //this.table.append(this.make('thead', {}, 'Please confirm your order'));
            
            this.addRow('You are seeing', simply.shows.getSelectedShow().get('name'));
            this.addRow('On', simply.performances.getSelectedPerformance().get('name'));
            
            //TO DO hard coded to Rhoda, this needs to come from DB
            
            this.addRow('At', 'Rhoda McGaw Theatre, Woking');
            
            //Now grab the seats
            var rows = simply.seats.convertToRows(simply.seats.getSelectedSeats());
            
            var rowsHolder = $(this.make('div',{ "class" : "rowsHolder"}));
            
            var row, rowContainer, rowView;
            
            for(row in rows) {
                rowContainer = $(this.make('div', {"class" : "row"}));
                
                rowContainer.append(this.make('div', {"class" : "rowId"}, row));
                
                for(seat in rows[row]) {
                    rowView = new simply.views.seat({model: rows[row][seat], collection: this.collection, readonly: true});
                    rowContainer.append(rowView.render());
                }
                
                rowsHolder.append(rowContainer);
            }
            
            this.addRow('Seats', rowsHolder);
            
            var ticketsChosen = simply.ticketTypes.getOrderedTickets();
            
            //TO DO this should be a template
            var ticketsList = $(this.make('table'));
            
            var head = $(this.make('tr'));
            head.append(this.make('th', {}, 'Ticket Type'));
            head.append(this.make('th', {}, 'Quantity'));
            head.append(this.make('th', {}, 'Price'));
            head.append(this.make('th', {}, 'Total'));
            
            ticketsList.append(head);
            
            var orderTotal = 0, ticketsTotal = 0;
            
            for(var x=0; x<ticketsChosen.length; x+=1) {
                
                ticketsTotal += ticketsChosen[x].get('quantity');
                
                rowTotal = ticketsChosen[x].get('quantity') * ticketsChosen[x].get('price');
                
                tr = $(this.make('tr'));
                tr.append(this.make('td', {}, ticketsChosen[x].get('name')));
                
                tr.append(this.make('td', {}, ticketsChosen[x].get('quantity')));
                
                tr.append(this.make('td', {}, '&pound' + ticketsChosen[x].get('price')));
                
                tr.append(this.make('td', {}, '&pound' + rowTotal));
                
                ticketsList.append(tr);
                
                orderTotal += rowTotal;
            }
            
            //TO DO this should be in an order summary model
            var bookingFee = Math.round((ticketsTotal * 0.5) * 100) / 100;
            orderTotal = Math.round(orderTotal * 100) / 100;
            
            
            var endRow = $(this.make('tr', {class: 'orderFooter'}));
            endRow.append(this.make('td', {'colspan': 3, class: 'totalCell'}, 'Sub Total'));
            endRow.append(this.make('td', {}, '&pound;' + orderTotal));
            
            ticketsList.append(endRow);
            
            var feeRow = $(this.make('tr', {class: 'orderFooter'}));
            feeRow.append(this.make('td', {'colspan': 3, class: 'totalCell'}, 'Booking Fee'));
            feeRow.append(this.make('td', {}, '&pound;' + bookingFee));
            
            ticketsList.append(feeRow);
            
            var totalRow = $(this.make('tr', {class: 'orderFooter'}));
            totalRow.append(this.make('td', {'colspan': 3, class: 'totalCell'}, 'Total'));
            totalRow.append(this.make('td', {}, '&pound;' + (bookingFee + orderTotal)));
            
            ticketsList.append(totalRow);
            
            
            this.addRow('Tickets', ticketsList);
            
            this.$el.html(this.table);
            
        },
        
        render: function() {
            
            
            return this.$el;
            
        }
    });
    
})(window.simply);
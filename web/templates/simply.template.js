(function(simply) {
    
    simply.templates = {
        mapKey: _.template("<h2>Choose your seats</h2><div class=\"keyRow\"><div class=\"seat notForSale\">1</div> Not for sale</div><div class=\"keyRow\"><div class=\"seat takenSeat\">1</div> Seat sold</div><div class=\"keyRow\"><div class=\"seat\">1</div> Seat Available</div><div class=\"keyRow\"><div class=\"seat selectedSeat\">1</div> Your seat</div>")
    }
    
})(window.simply);
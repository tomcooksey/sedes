(function(simply) {
    
    simply.models.personalDetails = Backbone.Model.extend({
        
        url: '/api.php/personalDetails'
         
    });
    
})(window.simply);
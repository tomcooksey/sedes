(function(simply) {
    
    simply.form = Backbone.View.extend({
        
        fields: [],
        name: null,
        
        initialize: function(options) {

            this.name = options.name;
            
            this.el = $(this.make('form', {id: this.name, name: this.name}));
            
        },
        
        addField: function(field) {
            this.fields.push(field);
            
            this.el.append(field.render());
        },
        
        removeField: function(field) {
              
        },
        
        render: function() {
            
            return this.el;
        }
    });
    
})(window.simply);
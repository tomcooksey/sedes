(function(simply) {
    simply.collections.stages = Backbone.Collection.extend({
        
        model: simply.models.stage,
        
        initialize: function() {

            this.add([
                {
                    "number": 1,
                    "title": "1. Select your performance",
                    "completed" : false,
                    "current": true
                },
                
                 {
                    "number": 2,
                    "title": "2. Choose your seats",
                    "completed" : false,
                    "current": false
                },
                
                 {
                    "number": 3,
                    "title": "3. Your Info",
                    "completed" : false,
                    "current": false
                },
                
                 {
                    "number": 4,
                    "title": "4. Payment",
                    "completed" : false,
                    "current": false
                }
            ]);
        },
        
        changeStage: function() {
            console.log('stage changing');
            var stageNumber = simply.session.get('current_stage');
            
            this.each(function(stage) {
                stage.set({
                    completed: stage.get('number') < stageNumber,
                    current: stage.get('number') === stageNumber
                });
            });
            
            this.trigger('stageChange', stageNumber);
            
        }
        
    });
})(window.simply);
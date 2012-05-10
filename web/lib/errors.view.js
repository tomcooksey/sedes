(function(simply) {
    
    simply.views.errors = Backbone.View.extend({
       
       initialize: function(options) {
        
            this.setElement(this.make('div', {"class": 'errorPane'}));
            
            this.$el.append(this.make('h2', {}, 'Ooops...'));
            this.$el.append(this.make('p', {}, 'Please correct the following errors before continuing'));
            
            this.errorContents = $(this.make('div', {"class": 'errorContents'}));
            this.$el.append(this.errorContents);
            
            this.closeButton = $(this.make('button', {}, 'OK'));
            this.$el.append(this.closeButton);
            
            $('.inner').append(this.$el);
            
            var self = this;
            this.window = $(window);
            
            this.delegateEvents();
            
            $(document).bind('keyup', function(event) {
               if( event.keyCode === 27) {
                    self.hide();
               }
            });
            
            
            //Bind to keep it at the top
            $(window).scroll(function() {
                self.$el.css('top', self.window.scrollTop() + 'px');
            });
       },
       
       events: {
            'click button' : 'hide',
            'keyup' : 'keyPress'
       },
       
       keyPress: function(event) {
            console.log(event);
       },
       
       show: function() {
            this.$el.slideDown('fast');
       },
       
       hide: function(callback) {
            var self = this;
            this.$el.slideUp('fast', function() {
                if(typeof callback === 'function') {
                    self.errorContents.html('');
                    callback.apply();
                }
            });
            
       },
       
       addErrors: function(errors) {
            var self = this;
            
            this.hide(function() {
                var errorList = $(self.make('ul')), li;
            
                for(var x=0; x<errors.length; x+=1) {
                    li = self.make('li', {}, errors[x]);
                    errorList.append(li);
                }
                
                self.errorContents.append(errorList);
                self.show();
            })
            
            
       }
    });
    
})(window.simply);
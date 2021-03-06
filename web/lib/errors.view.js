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
                
                var topVal;
                
                if(simply.viewport.mode === 'desktop') {
                    topVal = self.window.scrollTop();
                }else{
                    topVal = self.window.scrollTop() + 20;
                }
                    
                self.$el.css('top', topVal + 'px');
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
            if(simply.viewport.mode === 'desktop') {
                this.$el.slideDown('fast');
            }else{
                this.$el.width(simply.viewport.window.width() - 40);
                this.$el.height(simply.viewport.window.height() - 40);
                this.$el.fadeIn('fast');
            }
       },
       
       hide: function(callback) {
        
            var self = this;
            
            var methodName = simply.viewport.mode === 'desktop' ? 'slideUp' : 'fadeOut';
            
            this.$el[methodName]('fast', function() {
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
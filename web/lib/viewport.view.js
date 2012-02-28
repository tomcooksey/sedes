(function(simply) {
    simply.views.viewport = Backbone.View.extend({
    
        progressBar: null,
        collections: {},
        views: {},
        el: '#activeSpace',
        responseWarningTime: 49,
        cancelRequestTime: 100,
        
        initialize: function(options) {

            this.collections.progress = new simply.collections.stages();
            
            _.bindAll(this);
            
            
            
            //Create our bindings to the session object
            simply.session.on('change:current_stage', this.collections.progress.changeStage, this.collections.progress);
            simply.session.on('change:show_id', this.showChange, this);
            simply.session.on('change:performance_id', this.performanceChange, this);
            
            //Trigger a change on the session so that we get the first bits done
            
            this.progressBar = new simply.views.progress({
                collection: this.collections.progress    
            });
            
            this.loadingOverlay = $('#loading');
            this.loadingText = $('.loadingInfo');
            this.window = $(window);
            
            //Apply the changeStage function
            this.collections.progress.changeStage.apply(this.collections.progress);
            
            this.showTitle = $('#show_name');
            this.performanceTitle = $('#performance_name');
            
            //Return this for chaining
            return this;
        },
        
        setLoadingActive: function() {
            console.log('about to make request');
            simply.globalChanging = true;
        },
        
        setLoadingInActive: function() {
            console.log('request complete');
            simply.globalChanging = false;
        },
        
        //TO DO What are these functions passed?  If they are passed the collection
        //reference, surely we can have one method that does all these?!
        showChange: function() {
            console.log('here I would update the performances');
            this.setLoadingActive();
            simply.performances.fetch({'success': this.setLoadingInActive, 'error': this.ajaxError});
            this.setShowName();
        },
        
        setShowName: function() {
            var currentShow = simply.shows.get(simply.session.get('show_id'));
            
            if(currentShow !== undefined) {
                this.showTitle.html(currentShow.get('name'));
            }  
        },
        
        setPerformanceName: function() {
            var currentPerformance = simply.performances.get(simply.session.get('performance_id'));
            
            if(currentPerformance !== undefined) {
                this.performanceTitle.html(currentPerformance.get('name'));
            }
        },
        
        performanceChange: function() {
            console.log('here I would request the ticket types and prices');
            this.setLoadingActive();
            simply.ticketTypes.fetch({'success': this.setLoadingInActive, 'error': this.ajaxError});
            
            this.setPerformanceName();
        },
        
        ajaxError: function(args, response) {
            this.loadingText.addClass('loadingError');
            var textString = $.parseJSON(response.responseText).responseMessage;
            this.setLoading("We're sorry, something went wrong.  Please quote the following error:<br/>" + textString);
        },
        
        render: function() {
            //Added here because it's common to all views
            this.progressBar.render();
        },
        
        setLoading: function(initialText) {
            
            if(initialText) {
                this.loadingText.html(initialText);
            }
            
            this.loadingOverlay.height(this.window.height());
            this.loadingOverlay.width(this.window.width());
            this.loadingOverlay.fadeIn('fast');
        },
        
        addView: function(el, ref) {
            var self = this;
            
            this.setLoading();
            
            var checks = 0;
            
            setter = function() {
                if(simply.globalChanging) {
                    setTimeout(function() {
                        
                        
                        if(checks > self.responseWarningTime) {
                            if(checks > self.cancelRequestTime) {
                                self.loadingText.text('An error has occured that we cannot rectify, please try again later.');
                                self.loadingText.addClass('loadingError');
                                return;
                            }else{
                                self.loadingText.text('...sorry this is taking a while');
                                
                            }
                        }
                        
                        setter.apply();
                        checks +=1;
                        
                    }, 100);
                }else{
                    self.loadingOverlay.fadeOut('fast', function() {
                        self.loadingText.text('Loading, please wait...');
                    });
                    self.views[ref] = el;
                    
                    self.$el.append(el.render());
                }
            }
            
            //Timed out to our animation time in initial call
            setTimeout(function() {
                setter.apply();
            }, 500);  
        },
        
        removeElement: function(selector) {
            $(selector, this.$el).remove();
        },
        
        clean: function() {
            
            //Destroy the views
            for(var x in this.views) {
                this.views[x].off();
                this.views[x].off();
            }
            
            this.$el.html('');
        }
        
    });
    
})(window.simply);
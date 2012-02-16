(function () {
    
    dependencies = [];
    dependenciesFulfilled = false;
    completedCount = 0;
    fatal = false;
    successCallback = null;
    bootstrapper = false;
    
    function Bootstrapper() {
        
        if (bootstrapper) return bootstrapper;
        
        bootstrapper = this;
    
        function completion() {
            completedCount +=1;
        }
        
        function error() {
            fatal = true;
        }
        
        function checker() {
            if(completedCount !== dependencies.length && !fatal) {
                setTimeout(checker, 100);
            }else{
                if(fatal) {
                    alert('Application could not initialise, please try again later');
                }else{
                    if(typeof successCallback === 'function') {
                        successCallback.apply();
                    }
                }
                
            }
        }
        
    }
        
    Bootstrapper.prototype = {
        addDependency: function(dependency) {
            dependencies.push(dependency);
        },
        
        start: function(callback) {
            successCallback = callback;
            
            for(var dependency in dependencies) {
                dependencies[dependency].fetch.call(dependencies[dependency], {'success': completion,
                                                     'error': error});
            }
            
            
            checker.apply(this);
        }
    }
    
}());
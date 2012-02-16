(function () {
    
    dependencies = [];
    dependenciesFulfilled = false;
    completedCount = 0;
    fatal = false;
    successCallback = null;
    bootstrapper = false;
    
    var completion = function () {
        completedCount +=1;
    }
    
    var error =  function() {
        fatal = true;
    }
    
    var checker = function() {
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
    
    function Bootstrapper() {
        
        if (bootstrapper) return bootstrapper;
        
        bootstrapper = this;        
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
    
    window.Bootstrapper = Bootstrapper;
    
}());
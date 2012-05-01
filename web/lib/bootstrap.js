(function () {
    
    var dependencies = [],
    dependenciesFulfilled = false,
    completedCount = 0,
    fatal = false,
    successCallback = null,
    errorCallBack = null,
    bootstrapper = false
    
    var completion = function (atts) {
        completedCount +=1;
    }
    
    var error =  function(atts) {
        fatal = true;
    }
    
    var checker = function() {
        
        if(completedCount !== dependencies.length && !fatal) {
            setTimeout(checker, 100);
        }else{
            if(fatal) {
                
                if(typeof errorCallBack === 'function') {
                    errorCallBack.apply();
                }else{
                    throw new Error('Error callback should be a function');
                }
            }else{
                if(typeof successCallback === 'function') {
                    successCallback.apply();
                }else{
                    throw new Error('Success callback should be function');
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
        
        start: function(sCallback, eCallback) {
            successCallback = sCallback;
            errorCallBack = eCallback;
            
            for(var dependency in dependencies) {  
                dependencies[dependency].fetch.call(dependencies[dependency], {'success': completion,
                                                     'error': error, 'add' : true});
            }
            
            
            checker.apply(this);
        }
    }
    
    window.Bootstrapper = Bootstrapper;
    
}());
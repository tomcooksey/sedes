<!DOCTYPE html>
    
<html>

    <head>
        <title>Simply Tickets</title>
        
        <link rel="stylesheet" type="text/css" href="css/simplyTickets.css" />
        <!--hosted for the time being-->
	<script type="text/javascript" src="/jquery.js"></script>
        <script src="underscore.js"></script>
        <script src="backbone.js"></script>
	
	<script src="/lib/bootstrap.js"></script>
        
	<script type="text/javascript">
	
	//Initialisation has to be inline to allow bootstrapping of data
        
        (function($) {
    
	    window.simply = {
		views: {},
		models: {},
		routers: {},
		collections: {},
		forms: {},
		fields: {}
	    };
	    
	    $(document).ready(function() {

		//Get control of the loading screen so that
		//we can use it for loading, errors etc
		var win = $(window);
		var loadingOverlay = $('#loading');
		
		loadingOverlay.height(win.height());
		loadingOverlay.width(win.width());
		loadingOverlay.fadeIn('fast');
		
		//We need to setup the errors page first
		simply.errors = new simply.views.errors();
			
		//Put shows in global namespace for ease of use
		simply.shows = new simply.collections.shows();
		
		//We're going to load the content asyncronously
		$.ajax({
		    url: '/api.php/shows',
		    method: 'GET',
		    success: function(response) {
			
			//Have to PARSE as JSON otherwise it's just a string..
			response = $.parseJSON(response);
			
			//We can reset the shows because they are static and not
			//session dependent.
			simply.shows.reset(response);
			
			//Bootstrap with data from server, these critical collections
			//go in the global namespace as they are needed accross numerous
			//views & forms
			simply.session = new simply.models.session();
			simply.ticketTypes = new simply.collections.ticketTypes();
			simply.performances = new simply.collections.performances();
			simply.personalDetails = new simply.models.personalDetails();
	
			//The bootstrapper blocks the app starting whilst it
			//fulfills each dependency asyncronously.  This is because
			//Backbone's recommended method of prepopulating collections
			//with collection.reset() won't work in this app as it's
			//all session based.
			var dispatch = new Bootstrapper();
			dispatch.addDependency(simply.session);
			dispatch.addDependency(simply.ticketTypes);
			dispatch.addDependency(simply.performances);
			dispatch.addDependency(simply.personalDetails);
			
			dispatch.start(function() {
			    new simply.routers.main();
			    Backbone.history.start();
			}, function() {
			    //Create a new viewport
			    errorViewport = new simply.views.viewport();
			    errorViewport.loadingText.addClass('loadingError');
			    var textString = 'Could not initialise Application, please try again later';
			    errorViewport.setLoading("We're sorry, something went wrong.  Please quote the following error:<br/>" + textString);
			    //alert();
			});
		    },
		    error: function() {
			alert('No session recieved');
		    }
		});
		
		
		
	    });
	    
	    
	})(jQuery);
        
	
	</script>

        <!--models-->
	<script src="models/stage.model.js"></script>
	<script src="models/session.model.js"></script>
	<script src="models/show.model.js"></script>
	<script src="models/performance.model.js"></script>
	<script src="models/ticketType.model.js"></script>
	<script src="models/seat.model.js"></script>
	<script src="models/personalDetails.model.js"></script>
        
        <!--collections-->
        <script src="collections/stages.collection.js"></script>
	<script src="collections/shows.collection.js"></script>
	<script src="collections/performances.collection.js"></script>
	<script src="collections/ticketTypes.collection.js"></script>
	<script src="collections/seats.collection.js"></script>
	
	<!--field libs-->
	<script src="lib/form/fields/field.view.js"></script>
	<script src="lib/form/fields/select.field.view.js"></script>
	<script src="lib/form/fields/radio.field.view.js"></script>
	<script src="lib/form/fields/button.field.view.js"></script>
	<script src="lib/form/fields/performance.field.view.js"></script>
	
	
	<!--form lib-->
	<script src="lib/form/form.view.js"></script>
	
	<!--forms-->
	<script src="forms/seats.form.js"></script>
	<script src="forms/choosePerformance.form.js"></script>
	<script src="forms/chooseShow.form.js"></script>
	<script src="forms/personalDetails.form.js"></script>
	
        <!--views-->
	<script src="lib/progressStage.view.js"></script>
	<script src="lib/progress.view.js"></script>
	<script src="lib/viewport.view.js"></script>
	<script src="views/seatMap.view.js"></script>
	<script src="views/seat.view.js"></script>
	<script src="lib/errors.view.js"></script>
	<script src="views/checkout.view.js"></script>
        
        <!--routers-->
        <script src="routers/main.router.js"></script>
        
        <!--templates-->
	<script src="templates/simply.template.js"></script>
        
    </head>
    
    <body>
        
	<div id="loading">
	    <div class="loadingInfo">
		Loading, please wait...
	    </div>
	    
	</div>
	
	<header>
	    <div class="inner">
		<img src="images/common/logo.png" alt="Simply Theatre" class="logo" />
	    </div>
	</header>
	
	<section class="app">
	    
	    <h1 id="show_name"> </h1>
	    <h2 id="performance_name"> </h2>
	    
	    <div id="orderProgress">
		<div class="bar"></div>
		<div class="mask"></div>
		<ul class="steps">
		    
		</ul>
	    </div>
	    
	    
	    
	    <div id="activeSpace">
		
		
		
	    </div>
	    
	</section>
	
	<footer>
	    Powered by <a href="#">Sedes</a> v0.1.0 | &copy; 2012
	</footer>

    </body>
    
</html>
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
		//Start the router and navigation
		//Load the loading text
		var win = $(window);
		var loadingOverlay = $('#loading');
		
		loadingOverlay.height(win.height());
		loadingOverlay.width(win.width());
		loadingOverlay.fadeIn('fast');
			
		//Put shows in global namespace for ease of use
		simply.shows = new simply.collections.shows();
		simply.shows.reset(<?php echo file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/api.php/shows');?>);
		
		//Bootstrap with data from server
		simply.session = new simply.models.session();
		simply.ticketTypes = new simply.collections.ticketTypes();

		var dispatch = new bootstrapper();
		dispatch.addDependency(simply.session);
		dispatch.addDependency(simply.ticketTypes);
		
		dispatch.start(function() {
		    new simply.routers.main();
		    Backbone.history.start();
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
	
	
	<!--form lib-->
	<script src="lib/form/form.view.js"></script>
	
	<!--forms-->
	<script src="forms/seats.form.js"></script>
	<script src="forms/choosePerformance.form.js"></script>
	<script src="forms/chooseShow.form.js"></script>
	
        <!--views-->
	<script src="lib/progressStage.view.js"></script>
	<script src="lib/progress.view.js"></script>
	<script src="lib/viewport.view.js"></script>
	<script src="views/seatMap.view.js"></script>
	<script src="views/seat.view.js"></script>
        
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
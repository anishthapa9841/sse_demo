<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div>
		<div><pre>LATEST EVENTS</pre>></div>
		<div id="events_display">
		</div>
	</div>
	<script>
		window.onload = function() {
			document.getElementById("events_display").innerHTML = "";
			var evtSource = new EventSource('sse.php');
		
			// debugging the event source connection code
			console.log(evtSource.withCredentials);
		    console.log(evtSource.readyState);
		    console.log(evtSource.url);
		    evtSource.onopen = function() {
		      console.log("Connection to server opened.");
		    };
		    evtSource.onerror = function(e) {
		      console.log(e);
		      console.log("EventSource failed.");
		    };
		    // end debugging code
	     
			//for checking the contineous connection
			evtSource.addEventListener("ping", function(e) {
				console.log(e.data);
			}, false);

			evtSource.addEventListener("notification", function(e) {
		      //console.log(e.data);
		      var v = JSON.parse(e.data);
		      console.log(v);
		      document.getElementById("events_display").innerHTML += "<p>" + v.title + " " + v.notification_data + "</p>";
			 }, false);

			window.onunload = function() {
	    	console.log('Connection closed');
	    	evtSource.close();
	    	//evtSource = new EventSource($('#sse_url').val());
	    	};
		}
		

	</script>
</body>
</html>
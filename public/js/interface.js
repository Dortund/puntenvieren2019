var parliament = d3.parliament().width(600).height(300).innerRadiusCoef(0.4);
parliament.enter.fromCenter(true).smallToBig(true);
parliament.exit.toCenter(true).bigToSmall(true);
parliament.on("click", function(e) { console.log(e); });

var countdownTarget = new Date("Jan 5, 2021 15:37:25").getTime();
//Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countdownTarget - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("countdownTimer").innerHTML = ((days * 24) + hours) + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text 
  if (distance < 0) {
    document.getElementById("countdownTimer").innerHTML = "EXPIRED";
  }
}, 1000);

var setData = function(d) {
	var parties = d['parties'];
    
	// Get style tag for seat colours and remove it
	document.getElementById("seatColours").remove();

	// Create our new stylesheet
	var style = document.createElement('style');
	style.id = "seatColours";

	for (var i = 0; i < parties.length; i++) {
		var elem = parties[i];
		style.innerHTML += 'svg .seat.' + elem['id'] + '{ fill: ' + elem['colour'] + ' }\n';
	}

	// Get the first script tag
	var ref = document.querySelector('script');

	// Insert our new styles before the first script tag
	ref.parentNode.insertBefore(style, ref);

    // Update our parliament graph
    d3.select("svg").datum(parties).call(parliament);

    // Update our side overview list
    var table = document.getElementById("listTable");
    var rows = table.getElementsByTagName("tr").length;

	parties.sort(function (a, b) {
	    if (a.seats > b.seats)
		    return -1;
	    else if (a.seat < b.seat)
		    return 1;
	    else
		    return 0;
	});

	for (var i = 0; i < parties.length; i++) {
		var elem = parties[i];

		if (i < rows) {
			table.deleteRow(i);
		}
		
		var row = table.insertRow(i);
		var cell = row.insertCell();
		cell.innerHTML = '<svg width="25" height="25"><circle cx="12" cy="12" r="12" class="seat ' + elem.name + '" /></svg';
		cell = row.insertCell();
		cell.innerHTML = elem.screenname;
		cell = row.insertCell();
		cell.innerHTML = (Math.round((elem.seats / 750) * 10000) / 100) + "%";
	}
	
	// Update info for the current motion
	if (d['motion'] == null) {
		document.getElementById("motion").innerHTML = "Er is momenteel geen motie om over te stemmen";
		document.getElementById("countdownTimer").style.display = "none";
	}
	else {
		document.getElementById("motion").innerHTML = d['motion']['text'];
		countdownTarget = new Date(d['motion']['time_of_vote']).getTime();
		document.getElementById("countdownTimer").style.display = "block";
	}
	
	// Update info for the previous motion
	if (d['prevMotion'] == null) {
		document.getElementById("prevMotion").innerHTML = "Er is geen voorgaande motie";
	}
	else {
		document.getElementById("prevMotion").innerHTML = d['prevMotion']['text'];
		if (d['results'] == null) {
			// iets van 'de stemmen worden geteld'
		}
		else {
			// geef resultaten
		}
	}
};

d3.json(window.location.href + '/seatData', setData);

setInterval(function() { d3.json(window.location.href + '/seatData', setData); }, 3000)
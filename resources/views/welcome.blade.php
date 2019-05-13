<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="{{ asset('js/d3.min.js') }}"></script>
        <script src="{{ asset('js/d3-parliament.js') }}"></script>

        <title>Puntenvieren 2019</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    	<style media="screen">
            html, body {
                width: 100%;
                height: 100%;
                padding: 0px;
                margin: 0px;
                background: white;
            }
            svg {
                width: 100%;
                height: 100%;
            }
            svg.seat {
                cursor: pointer;
                transition: all 800ms;
            }
            /* common */
            svg .seat.vacant { fill: #FFFFFF }
            svg .seat.no-party { fill: #909090 }
        </style>
        <style id="seatColours"></style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <svg width="800" height="800"></svg>
            </div>
        </div>
        
        <script type="text/javascript">
                    var parliament = d3.parliament().width(800).height(800).innerRadiusCoef(0.4);
                    parliament.enter.fromCenter(true).smallToBig(true);
                    parliament.exit.toCenter(true).bigToSmall(true);
                    parliament.on("click", function(e) { console.log(e); });
        
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
                    };
        
                    //d3.json("european.json", setData);
                    d3.json(window.location.href + '/seatData', setData);
        
                    setInterval(function() { d3.json(window.location.href + '/seatData', setData); }, 6000000)
                </script>
    </body>
</html>

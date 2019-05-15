<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="{{ secure_asset('js/d3.min.js') }}"></script>
        <script src="{{ secure_asset('js/d3-parliament.js') }}"></script>

        <title>Puntenvieren 2019</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ secure_asset('css/interface.css') }}" rel="stylesheet">
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
            	<div id="parliamentContainer">
	                <svg width="600" height="300"></svg>
	                <div id="motions">
	                	<div>
        	                <div style="font-weight:bold">Huidige Motie:</div>
        	                <div id="motion">Er is nog geen motie om over te stemmen</div>
        	                <div id="countdownTimer"></div>
    	                </div>
    	                <div>
    	                	<div style="font-weight:bold">Vorige Motie:</div>
        	                <div id="prevMotion">Er is geen voorgaande motie</div>
        	                <div id="results" class="flex-container">
        	                
        	                </div>
    	                </div>
	                </div>
                </div>
                <div id="listContainer">
                	<table id="listTable">
                      <tr><td>Partij</td><td>Percentage</td></tr>
                    </table>
                </div>
            </div>
        </div>
        
        <script src="{{ secure_asset('js/interface.js') }}"></script>
    </body>
</html>

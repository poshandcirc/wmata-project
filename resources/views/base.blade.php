<!DOCTYPE html>
<html lang="en">
<head>
	<title>WMATA Times</title>
	<meta charset="utf-8">

	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js" defer></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script type="text/javascript" src="js/app.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
	<div id="app">
		<h1>WMATA Times App<h1>
		<!-- Line Select Buttons -->
		<div class="line-btn">
			<button v-for="line in lineCodes" 
				v-on:click="selectedCode = line.code" 
				:class="line.color" 
				class="btn btn-outline-light">
				@{{ line.color }}
			</button>
		</div>
		<!-- Stations -->
		<div class="station-btn">
			<p class="placeholder small" v-if="selectedCode == null"><em><br>Select a metro line to see stations and times.</em></p>
			<div v-for="result in results">
				<div>
					<station ref="station" v-bind:name=result.Name 
						v-bind:colorcode="selectedCode"
						v-bind:stationcode=result.Code
						v-bind:address=result.Address.Street
						v-bind:city=result.Address.City
						v-bind:state=result.Address.State
						v-bind:zip=result.Address.Zip
						v-bind:linecode2=result.LineCode2
						v-bind:linecode3=result.LineCode3
						v-bind:linecode4=result.LineCode4>
					</station>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
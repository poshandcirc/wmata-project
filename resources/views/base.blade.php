<!DOCTYPE html>
<html lang="en">
<head>
	<title>WMATA Times</title>
	<meta charset="utf-8">

	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js" defer></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/vuex@3.1.3/dist/vuex.js"></script>
	<script src="https://unpkg.com/vue-router@3.1.6/dist/vue-router.js"></script>
	<script type="text/javascript" src="js/app.js" defer></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/css/foundation.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
	<div id="app">
		<h1>WMATA Times App<h1>
		<div class="line-btn">
			<button v-for="line in lineCodes" v-on:click="selectedCode = line.code" :class="line.color" class="btn btn-outline-light">
				@{{ line.color }}
			</button>
		</div>
		<div v-for="result in results">
			<div>
				<station v-bind:name=result.Name>
				</station>
			</div>
		</div>
	</div>
</body>
</html>
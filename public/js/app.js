const vm = new Vue({
    // this.lineCodes: hard-coded the codes since there were only 6 - I think there might be a better way
    // watch: will display station when line button is clicked
    el: '#app',
    data () {
        return {
          results: null,
          lineCodes: [{code:'RD', color:'Red'},
            {code: 'BL', color: 'Blue'},
            {code: 'YL', color: 'Yellow'},
            {code: 'OR', color: 'Orange'}, 
            {code: 'GR', color: 'Green'},
            {code:'SV', color: 'Silver'}],
          selectedCode: null
        }
    },
    watch: {
        selectedCode: function (newCode, oldCode) {axios.get(`api/lines/${this.selectedCode}`)
        .then(response => {this.results = response.data})}
    }
});

/* Component for station display based on lines */
const station = Vue.component('station', {
    // this.showInfoBool: was my way of doing a very crude rudimentary toggle
    // because I couldn't get the bootstrap collapse to work with Vue -- this is me
    // acknowledging that it was a quick (but admittedly dirty) fix
    // mounted: will take name and turn it into query format for Google Maps search URL
    props: {
        name: String, 
        colorcode: String,
        stationcode: String,
        address: String,
        city: String,
        state: String,
        zip: String,
        linecode2: String,
        linecode3: String,
        linecode4: String
    },
    data () {
        return {
            showInfoBool: false,
            showArrivals: false,
            searchURL: null
        }
    },
    mounted () {
        let queryString = this.name.replace(" ", "+").concat("+station");
        this.searchURL = "https://www.google.com/maps/search/?api=1&query=".concat(queryString);
    },
    watch: {
        colorcode (newVal) {
            this.showInfoBool = false;
        }
    },
    template: '<div class="station">' +
        '<button v-on:click="showInfoBool= !showInfoBool" :class=colorcode class="btn btn-outline-dark btn-block">' +
        '{{ name }}</button>'+
        '<div v-show="showInfoBool" id="stationInfo">' +
        '<div class="card card-body">' + 
        '<h5>Address: <a :href=searchURL target="_blank">{{ address }}, {{ city }}, {{ state }} {{ zip }}</a></h5>' + 
        '<h5 v-if="linecode2 != null">Connecting Lines:' + 
        '<svg v-if="linecode2 != null" height="80" width="80" :class=linecode2>' +
        '<circle cx="40" cy="40" r="30" stroke="black" stroke-width="3"/>' +
        '</svg>' +
        '<svg v-if="linecode3 !== null" height="80" width="80" :class=linecode3>' +
        '<circle cx="40" cy="40" r="30" stroke="black" stroke-width="3"/>' +
        '</svg>' +
        '<svg v-if="linecode4 != null" height="80" width="80" :class=linecode4>' +
        '<circle cx="40" cy="40" r="30" stroke="black" stroke-width="3"/>' +
        '</svg></h5>' +
        '<button v-on:click="showArrivals = !showArrivals" class="btn btn-secondary">' +
        'Upcoming Arrivals</button>' +
        '<arriving v-if="showArrivals" :line=colorcode :station=stationcode></arriving>' + 
        '</div>' +
        '</div>' +
        '</div>'
});

/* Component for table construction from arriving trains */
const arriving = Vue.component('arriving', {
    props: {
        line: String,
        station: String
    },
    data () {
        return {
            arrivingTrains: null,
            lineData: this.line,
            stationdata: this.station
        }
    },
    mounted() {
        axios.get(`api/lines/${this.lineData}/stations/${this.stationData}`)
        .then(response => {this.arrivingTrains = response.data})
    },
    template: '<div><table class="table small">' +
        '<thead><tr><th scope="col">Destination</th><th scope="col">Line</th>' +
        '<th scope="col">Arriving In</th></tr></thead>' +
        '<tbody><tr v-for="train in arrivingTrains">' +
        '<th class="w-50" scope="row">{{train.DestinationName}}</th>' +
        '<td><svg height="50" width="40" :class=train.Line>' +
        '<circle cx="20" cy="20" r="15" stroke="black" stroke-width="3"/>' +
        '</svg> {{ train.Line }}</td>' +
        '<td>{{train.Min}}</td></tr>' +
        '</tbody></table></div>'
});
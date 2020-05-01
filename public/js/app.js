const vm = new Vue({
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
          stationName: null,
          selectedCode: "BL"
        }
    },
    watch: {
        selectedCode: function (newCode, oldCode) {axios.get(`api/lines/${this.selectedCode}`)
        .then(response => {this.results = response.data})}
    },
    mounted() {
        axios.get(`api/lines/${this.selectedCode}`)
        .then(response => {this.results = response.data})
    }
});

const station = Vue.component('station', {
    props: ['name'],
    template: '<div class="station"><button class="btn btn-outline-dark btn-block">{{ name }}</button></div>'
});
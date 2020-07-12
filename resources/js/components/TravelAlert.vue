<template>

</template>

<script>
    export default {
        name: "TravelAlert",

        data(){

            return{
                countries:[],
                countrySelected: '',
                countryAlert:'',
                loader:true
            }
        },

        methods:{

            getCountries(){

                axios.get('http://api.coronatracker.com/v2/analytics/country')
                    .then(data=>{
                    console.log(data.data);
                        if(data.data.length > 0){

                            this.countries = data.data;
                            this.countrySelected = data.data[0].countryCode;
                            this.loader = false;
                        }

                    }).catch(e=>{
                    console.log(e);
                });
            },

            getTravelAlert(){

                    var country = this.countrySelected;
                    this.loader = true;

                    axios.get('http://api.coronatracker.com/v1/travel-alert')
                        .then(data=>{

                            var alerts = [];

                            if(data.data.length > 0){

                                alerts = data.data;

                                var search = alerts.find(el=>{
                                   return el.countryCode == this.countrySelected;
                                });

                                if(search){

                                    this.countryAlert = search;
                                    this.countryAlert.publishedDate = moment(this.countryAlert.publishedDate).format('DD.MMM.YYYY');
                                }
                                this.loader = false;
                                $('html, body').animate({
                                    scrollTop: 600
                                }, 500, 'swing');
                            }

                }).catch(e=>{
                   console.log(e);
                });
            }

        },


        created() {

            this.getCountries();

        }
    }


</script>

<style scoped>

    [v-clock]{
        display: none;
    }

</style>

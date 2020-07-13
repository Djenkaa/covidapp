<template>

</template>

<script>
    import { setCORS } from "google-translate-api-browser";

    export default {
        name: "TravelAlert",

        data(){

            return{
                countries:[],
                countrySelected: 'AF',
                countryAlert:'',
                loader:false,
                allCountries: JSON.parse(this.allcountries)
            }
        },

        props:['locale','allcountries'],


        methods:{

            languages(locale){

                var lang = '';

                switch (locale) {

                    case 'gb':
                        lang = 'en';
                        break;
                    case 'rs':
                        lang = 'bs';
                        break
                }
                return lang;
            },


            // getCountries(){
            //
            //     axios.get('http://api.coronatracker.com/v2/analytics/country')
            //         .then(data=>{
            //
            //             if(data.data.length > 0){
            //
            //                 this.countries = data.data;
            //                 this.countrySelected = data.data[0].countryCode;
            //                 this.loader = false;
            //             }
            //
            //         }).catch(e=>{
            //         console.log(e);
            //     });
            // },

            getTravelAlert(){

                    var country = this.countrySelected;
                    this.loader = true;
                    var vm = this;

                    const translate = setCORS("https://cors-anywhere.herokuapp.com/");

                    axios.get('https://api.coronatracker.com/v1/travel-alert')
                        .then(data=>{

                            var alerts = [];

                            if(data.data.length > 0){

                                alerts = data.data;

                                var search = alerts.find(el=>{
                                   return el.countryCode == this.countrySelected;
                                });

                                if(search){

                                    var appLocale = vm.languages(this.locale);

                                    this.countryAlert = search;
                                    this.countryAlert.publishedDate = moment(this.countryAlert.publishedDate).locale(appLocale).format('DD.MMM.YYYY');
                                    this.countryAlert.countryName = this.allCountries[country];

                                    translate(this.countryAlert.alertMessage, { to: appLocale })
                                        .then(res => {
                                            if(res.text){

                                                this.countryAlert.alertMessage = res.text;
                                            }
                                        })
                                        .catch(err => {
                                            console.error(err);
                                        });
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

            // this.getCountries();

            // console.log(this.allCountries);
        }
    }


</script>

<style scoped>



</style>

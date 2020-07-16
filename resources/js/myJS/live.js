$(document).ready(function () {

    globalStats();
    slideAllCountries();
    chartData();
    topTheWorstCountries();
    mostSuccessfulCountry();



    var liveChart = function (chartArray) {

    // Variables
    var $chart = $('#live-chart');


    // Methods

    function init($chart) {


        var salesChart = new Chart($chart, {
            type: 'bar',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function (value) {
                                if (!(value % 10)) {
                                    return numeral(value).format('0,0');
                                }
                            }
                        },
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function (item, data) {
                            var label = data.datasets[item.datasetIndex].label || '';
                            var yLabel = numeral(item.yLabel).format('0,0');
                            var content = '';

                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + ': ' + yLabel + ' </span>';
                            }

                            // content += ' <span class="popover-body-value">' + yLabel + '</span>';
                            return content;
                        }
                    },

                },
                title: {
                    display: true,
                    text: 'Confirmed & Deaths cases'
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
            data: {
                labels: chartArray.countries,
                datasets: [{
                    label: 'Confirmed',
                    data: chartArray.confirmed,
                    backgroundColor: '#fb6340'
                },
                    {
                        label: 'Deaths',
                        data: chartArray.deaths,
                        backgroundColor: '#f5365c'
                    }]
            }
        });

        // Save to jQuery object

        $chart.data('chart', salesChart);

    }


    // Events

    if ($chart.length) {

        init($chart);
    }

};


function chartData() {

    $.ajax('https://api.coronatracker.com/v3/analytics/dailyNewStats?limit=10')
        .done(function (data) {

            if (data) {

                if (typeof data == 'string') {

                    data = JSON.parse(data);
                }
                theWorstCountry(data[0]);

                var countries = [];
                var confirmed = [];
                var deaths = [];

                for(var i = 0; i<data.length; i++){

                    countries.unshift(data[i].country);
                    confirmed.unshift(data[i].daily_cases);
                    deaths.unshift(data[i].daily_deaths);
                }
                liveChart({countries, confirmed, deaths});

            }
        });
}




var countries = false;

function slideAllCountries() {

    $.get('https://api.coronatracker.com/v3/stats/worldometer/country')
        .done(function (data) {

            if (data) {

                if (typeof data == 'string') {

                    data = JSON.parse(data);
                }

                var temp = ``;
                for (var i = 0; i < data.length; i++) {

                    temp += `
                       <tr>
                            <th scope="row">
                                <img src="https://www.countryflags.io/${data[i].countryCode}/shiny/32.png" alt=""> ${data[i].country.length > 15 ? data[i].country.substring(0, 15) + '...' : data[i].country}
                            </th>
                            <td>
                               ${data[i].totalConfirmed}
                            </td>
                            <td>
                                 ${data[i].totalDeaths}
                            </td>
                            <td>
                                 ${data[i].totalRecovered}
                            </td>
                        </tr>
                `
                }

                var holderHeight = $('.tableFixHead').height();
                $('#countryHolder').css('margin-top', holderHeight);
                $('#listOfCoutrnies').html(temp);

                countries = true;
            }
        });
}




setInterval(function () {

    if (countries == true) {

        var margin = $('#countryHolder').css('margin-top');
        var holderHeight = $('.tableFixHead').height();
        var height = $('#countryHolder').height();

        if (parseInt(margin) <= -height) {
            countries = false;
            slideAllCountries();
            margin = holderHeight;

        }

        var slide = parseInt(margin) - 1;

        $('#countryHolder').css('margin-top', slide + 'px');
    }

}, 20);


function theWorstCountry(country) {

    $.get(`https://api.coronatracker.com/v3/stats/worldometer/country?countryCode=${country.country_code}`)
        .done(function (data) {

            if(data){

                if(typeof data == 'string'){

                    data = JSON.parse(data);
                }

                theWorstCountryTemplate(data[0]);

            }
        });

}


function theWorstCountryTemplate(data) {

    var temp = ``;

    temp = `<tr>
                                <th scope="row">
                                    <div class="media align-items-center">

                                        <img src="https://www.countryflags.io/${data.countryCode}/shiny/48.png">
                                        <span class="name mb-0 text-sm ml-1"> ${data.country}</span>

                                    </div>
                                </th>
                                <td class="budget">
                                   ${numeral(data.dailyConfirmed).format('0,0')}
                                </td>
                                <td>
<!--                    <span class="badge badge-dot mr-4">-->
<!--                      <i class="bg-warning"></i>-->
<!--                      <span class="status">pending</span>-->
<!--                    </span>-->
                                ${numeral(data.dailyDeaths).format(0,0)}
                                </td>
                                <td>
                                  ${numeral(data.totalConfirmed).format(0,0)}

                                </td>
                                <td>
<!--                                    <div class="d-flex align-items-center">-->
<!--                                        <span class="completion mr-2">60%</span>-->
<!--                                        <div>-->
<!--                                            <div class="progress">-->
<!--                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    ${numeral(data.totalDeaths).format('0,0')}
                                </td>
                                <td>

                                ${numeral(data.totalRecovered).format('0,0')}
                                </td>

                            </tr>`;

    $('#theWorstCountry').html(temp);
}


function globalStats() {

    $.get('https://api.coronatracker.com/v3/stats/worldometer/global')
        .done(function (data) {

            if(data){

                if(typeof data == 'string'){

                    data = JSON.parse(data);
                }

                $('#liveTotalConfirmed').text(numeral(data.totalConfirmed).format('0,0'));
                $('#liveTotalDeaths').text(numeral(data.totalDeaths).format('0,0'));
                $('#liveTotalRecovered').text(numeral(data.totalRecovered).format('0,0'));
                $('#liveTotalActive').text(numeral(data.totalActiveCases).format('0,0'));
            }
        });
}


function mostSuccessfulCountry() {

    $.get('https://api.coronatracker.com/v3/stats/worldometer/country')
        .done(function (data) {

            if(data){

                if(typeof data == 'string'){

                    data = JSON.parse(data);
                }
                var country = _.last(data);

                $('#successfulCountryName').html(`<img src="https://www.countryflags.io/${country.countryCode}/shiny/48.png" /> ${country.country}`);
                $('#successfulCountryConfirmed').text(country.totalConfirmed);
            }
        });
}


function topTheWorstCountries() {

    $.get('https://api.coronatracker.com/v3/stats/worldometer/global')
        .done(function (global) {

            if(global){

                if(typeof global == 'string'){

                    global = JSON.parse(global);
                }

                $.get('https://api.coronatracker.com/v3/stats/worldometer/country?limit=7')
                    .done(function (data) {

                        console.log(data);
                        console.log(global);

                        topTheWorstCountriesTemplate(data, global);
                    });
            }
        });


}



function topTheWorstCountriesTemplate(data, global) {

    var temp = ``;

    for(var i = 0; i<data.length; i++){

        var totalConfirmed = parseInt(data[i].totalConfirmed) / parseInt(global.totalConfirmed) * 100;
        var totalDeaths = parseInt(data[i].totalDeaths) / parseInt(global.totalDeaths) * 100;;

        temp+=`<tr>
                <th scope="row">
                    <div class="media align-items-center">

                        <img src="https://www.countryflags.io/${data[i].countryCode}/shiny/48.png">
                        <span class="name mb-0 text-sm ml-1"> ${data[i].country}</span>

                    </div>
                </th>
                <td class="budget">
                    ${numeral(data[i].dailyConfirmed).format('0,0')}
                </td>
                <td>
                    ${numeral(data[i].dailyDeaths).format('0,0')}
                </td>

                <td>
                    <div class="d-flex align-items-center">
                        <span class="completion mr-2">${totalConfirmed.toFixed(2)}%</span>
                        <div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar"
                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 60%;"></div>
                            </div>
                        </div>
                        <span class="ml-2"> <i class="fas fa-globe-americas fa-lg"></i></span>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <span class="completion mr-2">${totalDeaths.toFixed(2)}%</span>
                        <div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar"
                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 60%;"></div>
                            </div>

                        </div>
                        <span class="ml-2"> <i class="fas fa-globe-americas fa-lg"></i></span>
                    </div>
                </td>

        </tr>`
    }
    $('#theWorstCountries').html(temp);

}


});


# Simple MTA API App

## Introduction:

This is a simple [Lumen](https://lumen.laravel.com/) PHP backend that has been set up to query the [Metro WMATA API](https://developer.wmata.com/).

---

### A COVID-19 Interlude:
Originally, we would have required you to generate API keys from [Metro WMATA API](https://developer.wmata.com/) and use them to get real results. Given the Metro’s limited hours during the COVID-19 crisis, we’ve added a feature so you can work on this project after 9pm!

There’s an environmental variable `USE_REAL_API`. This is set to `false` by default, and if you keep it set that way, it will return faked incoming train results.

We still encourage you to get actual api keys, add them to the `.env`, and use them instead when it is available! Looking over the documentation will prepare you for the results that will be returned by the backend whether real or faked.

---

## Prerequisites:

This project assumes you have both `php` and `composer` installed on your computer. Composer is a package management system for `php`. Instructions for download and use are available [here](https://getcomposer.org/download/).

## Installation:

1. Navigate to a directory where you’re storing your code.

2. Clone the Repo: `https://github.com/DSPolitical/wmata-project.git`

3. Navigate to Directory: `cd wmata-times`

4. Copy the Example .env: `cp .env.example .env`

5. *If you’re using the real api*: Edit the .env file and add in your API tokens `METRO_API_KEY` and `METRO_API_SECRET` and set `USE_REAL_API` to `true`.

6. Install the dependencies for the project: `composer install`

7. Run localhost in background to view the site locally: `php -S localhost:8000 -t public`

8. In your web browser, navigate to `http://localhost:8000`, it will have the result of the app.

## Your Task

Build a front-end application that meets the following requirements:
* As a user, when I select a station and a train line, I expect to see a list of arrival times for incoming trains of that line at that station.
* As a user, when I select a station, I expect to see information about that station.
* As a user, when I am looking at a list of train arrivals, I expect that the most imminent arrival time will be highlighted.
* BONUS: As a User, if I make the same request (line + station) more than once per minute, it returns a cached value from the vuex store.

These are the front-end files you’re looking for:
* Base HTML file: `resources/views/base.blade.php` 
* Base CSS File: `public/css/style.css` 
* Base Javascript File: `public/js/app.js` 

By default, this project is set up as a Vue project. The base HTML file includes CDN links for [Vue](https://vuejs.org/), [VueX](https://vuex.vuejs.org/), and [Vue Router](https://router.vuejs.org/), along with a link to [Axios](https://github.com/axios/axios) for pinging the back-end, and [bootstrap](https://getbootstrap.com/) for styling if you would like to include it.

It also includes links to the base Javascript and CSS files mentioned above. Feel free to install the CDNs locally, use different ones, or swap them out for React.

## API Help:

* The available train line codes are:
```
    'Red'    : 'RD',
    'Blue'   : 'BL',
    'Yellow' : 'YL',
    'Orange' : 'OR',
    'Green'  : 'GR',
    'Silver' : 'SV'
```

There are two API routes set up for you to use

1. Sending a request to fetch results of a line: `api/lines/{line}`

    This will return a list of stations with their codes which can be used to ping the other endpoint.

2. Sending a request to fetch the results of a station: `api/lines/{line}/stations/{station}`

This will return information about the trains scheduled to arrive in the station

The results of both of these is the raw result from the [API queries](https://developer.wmata.com/docs/services/547636a6f9182302184cda78/operations/547636a6f918230da855363f).
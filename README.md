## ISeekPlant test weather application
* Author: Reilly Hurst

## Description
A simple Laravel / React application to view 5-day forecast data for a given dropdown list of locations (cities).
Application should fetch weather data from the OpenWeatherMap API and render onto the screen.
Application should also include a console tool to allow user input for multiple city / location forecasts & generate a table of results.

## Assumptions
Only a single city / location viewed at any one time on the client side UI.
Should allow for incorrect / miss-spelt cities when fetching from API to error gracefully.
Console command should error gracefully and notify of invalid API response / forecast.

## Design Decisions
Decision was made to render forecast data into a seperate react route / component instead of utilising a state to render on input on the homepage.
Regarding the openweathermap API, the returned data format was a chronological order of arrays by hour / date, decision was made when parsing
api response to the UI to group by chronological date first, with all hourly arrays nested within

## Installation after cloning
* Create api key from openweathermap free 5Day / 3Hour API service https://home.openweathermap.org/users/sign_up
* Copy .env.example to .env and past api key into `OPENWEATHER_APP_KEY`

* Run `composer install`
* Run `npm install`
* Run `npm run dev`
* Run `php artisan serve`

## Console forecast generator commany
* Run `php artisan forecast:generate`
* input comma delimited list of cities when prompted

## Author notes
A varying weather api service with a single result per forecast day may have proved easier to work with over having multiple 'hour' forecasts per day to parse / render.
Testing could utilise more time spent with mocking Guzzle request to assert json response / status.
Nested resources may be overkill for preparing and returning json data to the client side, with nested resources individually having no use by other endpoints for example.
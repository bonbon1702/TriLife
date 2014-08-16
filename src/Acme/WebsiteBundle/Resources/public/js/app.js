/**
 * Created by tuan on 8/16/14.
 */

var scotchApp = angular.module('scotchApp', ['ngRoute'], function($interpolateProvider){
    $interpolateProvider.startSymbol("[[");
    $interpolateProvider.endSymbol("]]");
});
// configure our routes
scotchApp.config(function($routeProvider) {
    $routeProvider

        // route for the home page
        .when('/', {
            templateUrl : Routing.generate('acme_website_about'),
            controller  : 'mainController'
        })

        // route for the about page
        .when('/about', {
            templateUrl : Routing.generate('acme_website_about'),
            controller  : 'aboutController'
        })

        // route for the contact page
        .when('/contact', {
            templateUrl : Routing.generate('acme_website_contact'),
            controller  : 'contactController'
        });
});


// create the controller and inject Angular's $scope
scotchApp.controller('mainController', function($scope) {
    // create a message to display in our view
    $scope.message = 'Everyone come and see how good I look!';
});

scotchApp.controller('aboutController', function($scope) {
    $scope.message = 'Look! I am an about page.';
});

scotchApp.controller('contactController', function($scope) {
    $scope.message = 'Contact us! JK. This is just a demo.';
});


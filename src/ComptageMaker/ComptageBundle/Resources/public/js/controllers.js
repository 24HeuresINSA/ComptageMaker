'use strict';

/* Controllers */

var comptagemakerControllers = angular.module('comptagemakerControllers', []);

comptagemakerControllers.controller('countCtrl', ['$scope','$http',
    function($scope,$http){

        $scope.count = {};
        $scope.count.sessions = [];
        $scope.path = "";
        $scope.route = null;

        $scope.register = function(){
            window.location.href= $scope.route;
        }

        $scope.$watch('count.sessions',function(){
            $scope.path = $scope.count.sessions.map(function(elem){
                return elem.id;
            }).join('-');

            $scope.route = Routing.generate('inscrit_create', { sessionId: $scope.path });
            console.log($scope.route);

        },true)

    }]);

comptagemakerControllers.controller('sessionCtrl', ['$scope','$http',
    function($scope,$http){
        $scope.session = {};
        $scope.session.id = null;
        $scope.session.checked = null;


        $scope.$watch('session',function(){
            var found = -1;
            for(var i=0;i<$scope.count.sessions.length;i++)
            {
                if($scope.count.sessions[i].id == $scope.session.id)
                {
                    found = i;
                }
            }
            if(found == -1)
            {
                if($scope.session.checked == true)
                {
                    $scope.count.sessions.push($scope.session);
                }
            }
            else
            {
                if($scope.session.checked == false)
                {
                    $scope.count.sessions.splice(found,1);
                }
            }
        },true);

    }]);
var comptagemakerServices = angular.module('comptagemakerServices', []);


comptagemakerServices.directive('myRow',['$document', function($document){
    return {
        require: 'myRow',
        restrict: 'A',
        link: function(scope, element, attr, rowCtrl)
        {
            element.on('click',function(event){
                event.preventDefault();
                var hasClass = element.hasClass("success");
                element.removeClass("success");
                if(!hasClass){
                    element.addClass("success");
                }
                rowCtrl.toggle(element)
            });
        },
        controller:  function($scope){
            var session = $scope.session = {};


            this.toggle = function(element)
            {
                session.checked = element.hasClass('success');
                $scope.$broadcast('toggle',session.checked);
            }

        }
    }
}]);

comptagemakerServices.directive('myCheckbox',['$document',function(){
    return {
        require: '^myRow',
        restrict: 'A',
        controller: function($scope){
            $scope.$on('toggle',function(event,message){
                $scope.session.checked = message;
                $scope.$apply();
            });
        }
    }
}]);
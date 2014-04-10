var comptagemaker = angular.module('comptagemaker', [
    'comptagemakerControllers', 'comptagemakerServices'
]);

comptagemaker.config(['$interpolateProvider', function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{');
    $interpolateProvider.endSymbol('}]}');
}]);
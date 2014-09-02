app.directive('psDataSource', function($timeout, $http) {
    return {
        scope: true,
        compile: function(element, attrs, transclude) {
            return function($scope, $el, attrs, ctrl) {
                $scope.data = JSON.parse($el.find("data[name=data]").text());
                $scope.params = JSON.parse($el.find("data[name=params]").text());
                $scope.name = $el.find("data[name=name]").text().trim();
                $scope.class = $el.find("data[name=class_alias]").text().trim();
                $scope.sqlParams = {};

                $scope.query = function(f) {
                    $http.post(Yii.app.createUrl('/formfield/DataSource.query'), {
                        name: $scope.name,
                        class: $scope.class,
                        params: $scope.sqlParams
                    }).success(function(data) {
                        $scope.data = data;
                        if (typeof f == "function") {
                            f(true, data);
                        }
                    }).error(function(data) {
                        if (typeof f == "function") {
                            f(false, data);
                        }
                    });

                }

                $scope.updateParam = function(key, value, name) {
                    if (typeof $scope.sqlParams[name] == "undefined") {
                        $scope.sqlParams[name] = {};
                    }

                    $scope.sqlParams[name][key] = value;
                }

                $scope.resetParam = function(key, name) {
                    delete $scope.sqlParams[name][key];
                }

                $scope.$parent[$scope.name] = $scope;
            }

        }
    };
});
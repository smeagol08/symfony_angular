/**
 * The main controller for the app. The controller:
 * - retrieves and persists the model via Restangular
 * - exposes the model to the template and provides event handlers
 *
 * root_path & assets_path variables are set inside index.html.twig globally
 *
 * @type {angular.Module}
 */


angular.module('ApiClient.controllers', ['ngCookies'])
    .controller('Login', ['AuthHandler', '$scope', '$window', '$cookies', 'Restangular', 'Digest', '$uibModal', function (AuthHandler, $scope, $window, $cookies, Restangular, Digest, $uibModal) {
        // On Submit function
        $scope.getSalt = function () {
            var username = $scope.username;
            var password = $scope.password;
            // Get Salt
            Restangular
                .oneUrl('salts', root_path + 'public/salts/' + username).get()
                .then(function (response) {
                    var salt = response.salt;
                    // Encrypt password accordingly to generate secret
                    Digest.cipher(password, salt).then(function (secret) {
                        // Display salt and secret for this example
                        $scope.salt = salt;
                        $scope.secret = secret;

                        $uibModal.open({
                            animation: true,
                            templateUrl: assets_path + '/common/modal.html',
                            controller: 'ModalInstanceCtrl',
                            size: 'lg',
                            resolve: {
                                items: {
                                    Salt: $scope.salt,
                                    Secret: $scope.secret
                                },
                                title: function () {
                                    return "Login result"
                                },
                                introduction: function () {
                                    return [
                                        "Salt value is pulled from the database at following URL: " + root_path + 'public/salts/' + username,
                                        "Secret is your hashed, salted password, saved in cookies"
                                    ]
                                }
                            }
                        });

                        // Store auth informations in cookies for page refresh
                        $cookies.put('username', $scope.username);
                        $cookies.put('secret', $scope.secret);

                        $window.location = '#/pages';
                    }, function (err) {
                        console.log(err);
                    });
                });
        };
    }])
    .controller('PageController', ['$scope', '$window', 'Restangular', '$uibModal', function ($scope, $window, Restangular, $uibModal) {

        $scope.pages = [];
        Restangular
            .all('pages').getList()
            .then(function (response) {
                $scope.pages = response;
            });

        $scope.showPage = function (page) {
            $uibModal.open({
                animation: true,
                templateUrl: assets_path + '/page/page-show.html',
                controller: 'PageModalInstanceCtrl',
                resolve: {
                    page: page
                }
            });
        };

        $scope.editPage = function (page) {
            $uibModal.open({
                animation: true,
                templateUrl: assets_path + '/page/page-edit.html',
                controller: 'PageModalInstanceCtrl',
                resolve: {
                    page: page
                }
            });
        };

    }])
    .controller('PageModalInstanceCtrl', ['$scope', '$uibModalInstance', 'page', function ($scope, $uibModalInstance, page) {

        $scope.page = page;

        $scope.ok = function () {
            $uibModalInstance.close();
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };

        $scope.doneEditing = function (page) {
            page.title = page.title.trim();
            page.put();
            $uibModalInstance.close();
        };

    }])
    .controller('ModalInstanceCtrl', ['$scope', '$uibModalInstance', 'items', 'title', 'introduction', function ($scope, $uibModalInstance, items, title, introduction) {

        $scope.items = items;
        $scope.title = title;
        $scope.introduction = introduction;


        $scope.ok = function () {
            $uibModalInstance.close();
        };

    }]);
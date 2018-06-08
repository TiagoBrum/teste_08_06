(function () {
  'use strict';
  app.controller('TarefasCtrl', ['$rootScope', '$scope', '$location', '$filter', '$http', function ($rootScope, $scope, $location, $filter, $http)
		{
			$rootScope.activetab = $location.path();
			var self = $scope;

			self.modelAux = {descricao: null, titulo: null};

            self.modelTarefas = 
                {
                    label: "Tarefas",
                    allowedTypes: ['tarefa'],
                    tarefas: []
                };
        
            // Model to JSON for demo purpose
            self.$watch('modelTarefas', function(modelTarefas) {
                self.modelAsJson = angular.toJson(modelTarefas, true);
				localStorage.setItem("tbTarefas", JSON.stringify(modelTarefas));                
            }, true);

			self.tools = {
				setTime: function() {
					return moment().format('L') + ' ' + moment().format('LTS');
				},
                clearTarefa: function () {
                    self.msg = null;
					self.modelAux ={descricao: null, titulo: null};
					$('#collapseTarefa').collapse('hide');
                },
                addTarefa: function () {
                    if(!self.tools.verificaTarefa()) return;
                    
                    if(self.modelAux.index >= 0) {
                        var index = self.modelAux.index;
                        delete self.modelAux.index;
					    self.modelTarefas.tarefas[index] = angular.copy(self.modelAux); 
                    } else {
                        self.modelTarefas.tarefas.push(angular.copy(self.modelAux));
                    }
					localStorage.setItem("tbTarefas", JSON.stringify(self.modelTarefas));
					self.tools.clearTarefa();
                },
                editTarefa: function (index) {
                    if(!self.tools.verificaTarefa()) return;
                    
                    self.modelAux = angular.copy(self.modelTarefas.tarefas[index]); ;
                    self.modelAux.index = index;
					localStorage.setItem("tbTarefas", JSON.stringify(self.modelTarefas));
                    $('#collapseTarefa').collapse('show');
                },
                verificaTarefa: function() {
                    self.msg = "";
                    if(self.modelAux.titulo == null || self.modelAux.titulo == '' || self.modelAux.titulo == undefined) {
                        self.msg = "Campo título é obrigatório.";
                        return false;
                    }
                    if(self.modelAux.descricao == null || self.modelAux.descricao == '' || self.modelAux.descricao == undefined) {
                        self.msg = "Campo descrição é obrigatório.";                        
                        return false;
                    }
                    return true;
                },
				recuperaRegistros: function() {

                    $http.get('/tarefa/tarefa/get-tarefas')
                    .then(function successCallback(response) {
                        console.log('done');
                        
                        console.log(response);
                        self.modelTarefas.tarefas = response.data;
                        return;                      
                    }, function errorCallback(response) {
                        console.log('fail');                       
                        
                        console.log(response);
                        
                        self.modelTarefas.tarefas = [];
                        return;
                    });

                    $http.post('/tarefa/tarefa/set-tarefa', {'teste':'rteste'})
                    .then(function successCallback(response) {
                      
                        return;                      
                    }, function errorCallback(response) {
                       
                        return;
                    });


					// //recupera os dados salvos no local storage
					// var reg = localStorage.getItem("tbTarefas");
					// reg     = JSON.parse(reg);

                    // if (reg === null) return;

					// self.modelTarefas = angular.copy(reg);
				},
            };
            
            // Model to JSON for demo purpose
            $scope.$watch('lists', function(lists) {
                $scope.modelAsJson = angular.toJson(lists, true);
            }, true);

			self.tools.recuperaRegistros();
		}]);
})();
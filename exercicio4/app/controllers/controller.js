(function () {
  'use strict';
  app.controller('TarefasCtrl', ['$rootScope', '$scope', '$location', '$filter', function ($rootScope, $scope, $location, $filter)
		{
			$rootScope.activetab = $location.path();
			var self = $scope;

			self.modelAux = {descricao: null, titulo: null};

            self.modelTarefas  = [
                {
                    label: "Tarefas",
                    allowedTypes: ['tarefas'],
                    tarefas: []
                },
            ];

            self.lists = 
                {
                    label: "People",
                    allowedTypes: ['man', 'woman'],
                    max: 6,
                    people: [
                        {name: "Frank", type: "man"},
                        {name: "Mallory", type: "woman"},
                        {name: "Alex", type: "unknown"},
                        {name: "Oscar", type: "man"},
                        {name: "Wendy", type: "woman"}
                    ]
                };
        
            // Model to JSON for demo purpose
            self.$watch('lists', function(lists) {
                self.modelAsJson = angular.toJson(lists, true);
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
					self.modelTarefas[0].tarefas.push(angular.copy(self.modelAux));
					//armazena usando localStorage no broswer
					localStorage.setItem("tbTarefas", JSON.stringify(self.modelTarefas));
					//limpa o form de entrada
					self.tools.clearTarefa();
                },
                buscaVeiculo: function () {
                    self.modelAux = $filter('filter')(self.modelTarefas.tarefas, { modelTarefas: self.modelTarefas });

                    if (self.modelAux.length > 0) {
                        self.modelAux = self.modelAux[0];
                        self.msg = null;

                    } else {
                        self.msg = "Veiculo não encontrado";
                        return false;
                    }
                    
                },
				recuperaRegistros: function() {
					//recupera os dados salvos no local storage
					var reg = localStorage.getItem("tbTarefas");
					reg     = JSON.parse(reg);

                    if (reg === null) return;

					self.modelTarefas = reg;
				},
            };
            
            // Model to JSON for demo purpose
            $scope.$watch('lists', function(lists) {
                $scope.modelAsJson = angular.toJson(lists, true);
            }, true);

			self.tools.recuperaRegistros();
		}]);
})();
app.controller("processController", function($scope, $http, PROCESS_URL, $sce){

	$scope.test_cases_number;

	$scope.set_m_and_n = function(test_case){		
		test_case.n = test_case.m_n.split(" ")[0];
		m = test_case.m_n.split(" ")[1];
		
		test_case.operations = [];
		for(var i = 0; i < m; i++){
			test_case.operations.push({operation_name: "", params: ""});
		}

	}

	$scope.create_test_cases = function(){
		$scope.test_cases = [];
		for(i = 0; i < $scope.test_cases_number; i++){
			$scope.test_cases.push({m_n: null, n: null, operations: []})
		}

	}

	$scope.process = function(){
		console.log($scope.test_cases);
		$http.post(PROCESS_URL, {"test_cases": $scope.test_cases}).success(
			function(response){
				$scope.output = $sce.trustAsHtml(response.output.replace(/,/g, "<br/>"));
			});		
	}
})
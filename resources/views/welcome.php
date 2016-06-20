<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.js"></script>
        <script src="app/app.js"></script>
        <script src="app/controllers/process.js"></script>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                color: black;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div ng-app="cubeSumation" class="container">
            
            
            <div class="container">
                
                <div class="title">
                    <img src="http://www.grability.com/wp-content/uploads/2016/06/Grability-Logo-Outlined-01_rszd-1-300x107.png" />
                </div>

                <div  ng-controller="processController">
                    <button ng-click="process()">Process</button>
    
                    <label id="testCase">Test Cases</label>
                    <input type="number" ng-model="test_cases_number" min="1" max="50" ng-change="create_test_cases()"/>

                    <div ng-repeat="test_case in test_cases track by $index">
                        <fieldset class="form-group">                
                            <legend>Test Case {{$index + 1}}</legend>

                            <label for="m_n_{{$index}}">N M</label>
                            <input id="m_n_{{$index}}" type="text" ng-model="test_case.m_n" ng-change="set_m_and_n(test_case)" />

                            <div ng-repeat="operation in test_case.operations track by $index">

                                <label for="op_{{$index}}"> Operation </label>
                                <select id="op_{{$index}}" ng-model="operation.operation_name">
                                    <option value="query">QUERY</option>
                                    <option value="update">UPDATE</option>
                                </select>

                                <label for="params_{{$index}}"> Parameters </label>
                                <input id="params_{{$index}}" type="text" ng-model="operation.params" />
                            </div>
                        </fieldset>
                    </div>

                    <fieldset class="form-group">
                        <legend> Output </legend>
                        <div ng-bind-html="output"></div>
                    </fieldset>
                </div>
            </div>
        </div>
    </body>

</html>

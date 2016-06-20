<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Cube;

class CubeController extends Controller
{
	public function  process(Request $request){

		$output = "";


		foreach($request->input('test_cases') as $test_case){
			$cube = new Cube($test_case["n"]);

			// Run all operations
			foreach($test_case["operations"] as $operation){
				
				$params = explode(" ", $operation["params"]);

				if($operation["operation_name"] == "query"){
					$output .= $cube->query($params[0], $params[1], $params[2], $params[3], $params[4], $params[5]) . ",";
				}
				elseif($operation["operation_name"] == "update"){
					$cube->update($params[0], $params[1], $params[2], $params[3]);
				}
			} 
		}

		return response()->json(["output" => $output]);
	}
}

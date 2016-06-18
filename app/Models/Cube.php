<?php

namespace App\Models;

class Cube{

	private $cube;

	const MIN_VALUE = -1000000000;
	const MAX_VALUE = 1000000000;
	const MAX_SIZE = 100;

	public function __construct($size, $value = 0){
		if($size > self::MAX_SIZE){
			throw new \Exception(sprintf("Size should be equal or less than %d", self::MAX_SIZE));
			
		}
		$this->cube = array_fill(0, $size, array_fill(0, $size, array_fill(0, $size, 0)));
	}

	// Updates the value of block (x,y,z) to $value.
	public function update($x, $y, $z, $value){

		if(!$this->is_valid_coordinate($x, $y, $z)){
			throw new \Exception(sprintf("x, y and z should be in range between 1 and %d", count($this->cube)), 2);
			
		}
		if(!$this->is_valid_value($value)){
			throw new \Exception(sprintf("The value should be in range between %d and %d", self::MIN_VALUE, self::MAX_VALUE));
		}

		// The first block is defined by the coordinate (1,1,1) 
		$x = $this->calcule_offset($x);
		$y = $this->calcule_offset($y);
		$z = $this->calcule_offset($z);
		
		$this->cube[$x][$y][$z] = $value;
		return $this;
	}

	/*
	 * Calculates the sum of the value of blocks whose x coordinate is between x1 and x2 (inclusive), y
	 * coordinate between y1 and y2 (inclusive) and z coordinate between z1 and z2 (inclusive). 
	 */
	public function query($x1, $y1, $z1, $x2, $y2, $z2){

		if(! $this->is_valid_range_coordinates($x1, $y1, $z1, $x2, $y2, $z2)){
			throw new \Exception("Range of Coordinates are not valid");
		}

		$x1 = $this->calcule_offset($x1);
		$y1 = $this->calcule_offset($y1);
		$z1 = $this->calcule_offset($z1);
		$x2 = $this->calcule_offset($x2);
		$y2 = $this->calcule_offset($y2);
		$z2 = $this->calcule_offset($z2);

		$sum = 0;

		// sumarize all elements in sub cube
		for($i = $x1; $i <= $x2; $i++){
			for($j = $y1; $j <= $y2; $j++){
				for($k = $z1; $k <= $z2; $k++){
					$sum += $this->cube[$i][$j][$k];
				}
			}
		}
		return $sum;
	}

	/*
	 * php index array begins at 0 but our first block is defined by the coordinate (1,1,1) so we need
	 * calcule an offset
	 */ 
	private function calcule_offset($position){
		return $position - 1;
	}

	/*
	 * Validate if 1 <= x,y,z <= N 
	 *
	 */
	private function is_valid_coordinate($x, $y, $z){
		return 	(1 <= $x) && ($x <= count($this->cube)) &&
				(1 <= $y) && ($y <= count($this->cube)) &&
				(1 <= $z) && ($z <= count($this->cube));

	}

	/*
	 * Validate if -10^9 <= $value <= 10^9
	 */
	private function is_valid_value($value){
		return (self::MIN_VALUE <= $value) && (self::MAX_VALUE <= pow(10, 9));
	}

	/*
	 * Validates
	 * 	1 <= x1 <= x2 <= N
	 *	1 <= y1 <= y2 <= N
	 *	1 <= z1 <= z2 <= N 
	 *
	 */
	private function is_valid_range_coordinates($x1, $y1, $z1, $x2, $y2, $z2){
		return 	$this->is_valid_coordinate($x1, $y1, $z1) &&
				$this->is_valid_coordinate($x2, $y2, $z2) && 
				$x1 <= $x2 && $y1 <= $y2 && $z1 <= $z2;
	}
}
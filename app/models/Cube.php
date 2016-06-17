<?php

class Cube{

	private $cube;

	public function __construct($size, $value = 0){
		$this->cube = array_fill(0, $n, array_fill(0, $m, array_fill(0, $size, 0));
	}

	// Updates the value of block (x,y,z) to $value.
	public function update($x, $y, $z, $value){

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
		$x1 = $this->calcule_offset($x1);
		$y1 = $this->calcule_offset($y1);
		$z1 = $this->calcule_offset($z1);
		$x2 = $this->calcule_offset($x2);
		$y2 = $this->calcule_offset($y2);
		$z2 = $this->calcule_offset($z2);

		// Get the sub cube to sumarize
		$sub_cube = array_slice(array_slice(array_slice($this->cube, $z1, $z2 - $z1), $y1, $y2 - $y1), $x1, $x2 - $x1);

		$sum = 0;

		// sumarize all elements in sub cube
		for($i = 0; $i < count($sub_cube); $i++){
			for($j = 0; $j < count($sub_cube[0]); $j++){
				for($k = 0; $k < count($sub_cube[0][0]); $k++){
					$sum += $sub_cube[$i][$j][$k]
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
}
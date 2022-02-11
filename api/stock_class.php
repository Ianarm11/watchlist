<?php

/*****
A class representation of an individual stock.
On creation of an object, all values are initialized.
getNewData() is called to represent the changing random data.
*****/

Class Stock {

var $symbol = '';
var $openPrice = 0;
var $lastPrice = 0;
var $volume = 0;
var $change = 0;

public function __construct($name) {
	$this->symbol = $name;
	$this->openPrice = rand(1, 1000);
	$this->lastPrice = rand(($this->openPrice - 10), ($this->openPrice + 10));
	$this->volume = rand(100, 1000);
	$this->change = $this->getChangeData($this->lastPrice);
}

public function getNewData() {
	$this->lastPrice = rand(($this->openPrice - 10), ($this->openPrice + 10));
	$this->volume = rand(100, 1000);
	$this->change = $this->getChangeData($this->lastPrice);
}

public function getChangeData($lastData) {
	if ($this->openPrice != $lastData) {
		$data = $this->openPrice - $lastData;
        	$data = $data * -1;
		return $data;
	} else {
		return 0;
	}
}

} //endofclass

?>

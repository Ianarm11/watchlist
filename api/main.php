<?php
/*****
Initalization of first 4 stocks and puts them in a global array.
*****/
require("stock_class.php");
$stocks = array();

$apple = createStockObject('$AAPL');
addStock($apple);

$microsoft = createStockObject('$MSFT');
addStock($microsoft);

$tesla = createStockObject('$TSLA');
addStock($tesla);

$gamestop = createStockObject('$GME');
addStock($gamestop);

function createStockObject($ticker) {
	$newStock = new Stock($ticker);
	return $newStock;
}

function addStock($stock) {
	global $stocks;
	array_push($stocks, $stock);
}

function updateData() {
	$results = array();
	global $stocks;

	foreach ($stocks as $stock) {
	  $stock->getNewData();
	  array_push($results, $stock);
	}
	return $results;
}

?>

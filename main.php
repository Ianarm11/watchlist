<?php
require("api/main.php");
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<h1>Watch List Test</h1>

<style>
table {
font-family: arial, sans-serif;
border-collaspe: collaspe;
width: 80%;
}

td, th {
border: 1px solid #dddddd;
text-align: left;
padding: 8px;
}

tr:nth-child(even){
background-color: #dddddd;
}
</style>

<script>
setInterval(updateTable, 5000);
function updateTable() {
  $.ajax({
     type : "POST",
     url : 'api/ajax.php',
     data: {functionname: 'updateData'},
     success : function (result) {
       var res = JSON.parse(result);
       const lastCollection = document.getElementsByClassName("last");
       const changeCollection = document.getElementsByClassName("change");
       const volumeCollection = document.getElementsByClassName("volume");

       for(let i = 0; i < lastCollection.length; i++) {
         $.each(res, function(key, value) {
             lastCollection[i].innerHTML = res[i].lastPrice;
         });
       }

       for(let i = 0; i < changeCollection.length; i++) {
         $.each(res, function(key, value) {
             changeCollection[i].innerHTML = res[i].change;
         });
       }

       for(let i = 0; i < volumeCollection.length; i++) {
         $.each(res, function(key, value) {
             volumeCollection[i].innerHTML = res[i].volume;
         });
       }
     },
     error : function (error) {
        console.log (error);
     }
   });
}

$(document).ready(function(){
      $(".add-row").click(function(){
          var newSymbol = $("#newSymbol").val();
          var newStock = populateAndAppendRow(newSymbol);
      });
});

function populateAndAppendRow(symbol) {
  jQuery.ajax({
    type: "POST",
    url: 'api/ajax.php',
    data: {functionname: 'createStockObject', arguments: [symbol]},

    success : function (result) {
       var stock = JSON.parse(result);
       var row = "<tr><td>" + stock.symbol + "</td><td>" + stock.openPrice +"</td><td>" + stock.lastPrice +"</td><td> " + stock.change +"</td><td>" + stock.volume +"</td></tr>";
       $("table tbody").append(row);
    },
    error : function (error) {
       console.log (error);
    }
  });
}
</script>

<form>
<input type="text" id="newSymbol" placeholder="Symbol..">
<input type="button" class="add-row" value="Add Symbol">
</form>

<table id="watchListTable">
<tbody>
<tr>
<th>Symbol</th>
<th>Open Price</th>
<th>Last Price</th>
<th>Change</th>
<th>Volume</th>
</tr>
<?php
foreach ($stocks as $stock) {
?>
<tr>
<td class="symbol"><?php echo $stock->symbol; ?></td>
<td class="open"><?php echo $stock->openPrice; ?></td>
<td class=last><?php echo $stock->lastPrice; ?></td>
<td class="change"><?php echo $stock->change; ?></td>
<td class="volume"><?php echo $stock->volume; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

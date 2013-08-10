<li><a href="view_my_db.php">--- Go Back ---</a></li>

<?php

$button = $_GET ['submit'];
$search = $_GET ['search']; 

if(!$button)
echo "you didn't submit a keyword";
else
{
if(strlen($search)<=1)
echo "Search term too short";
else{
echo "You searched for <b>$search</b> <hr size='1'></br>";
include '../db.php';

$search_exploded = explode (" ", $search);

foreach($search_exploded as $search_each)
{
@$x++;
if($x==1)
@$construct .="brand LIKE '%$search_each%'";
else
$construct .="AND brand LIKE '%$search_each%'";

}

$construct ="SELECT * FROM incharger WHERE $construct";
$run = mysql_query($construct);

$foundnum = mysql_num_rows($run);

if ($foundnum==0)
echo "Sorry, there are no matching result for <b>$search</b>.</br></br>1. 
Try more general words.Try different words with similar
 meaning</br>2. Please check your spelling";
 else
{
echo "$foundnum results found !<p>";

while($runrows = mysql_fetch_assoc($run))
{
$title = $runrows ['brand'];
$desc = $runrows ['type'];
$qty = $runrows ['qty'];
$buy = $runrows ['buy'];

echo " <b> Modle = $title <br> Code = $desc<br>Bought = $buy <br>Quantity = $qty <br><hr>";

}
}

}
}

?>
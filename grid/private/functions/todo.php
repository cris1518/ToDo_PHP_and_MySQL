<?php


function getUrlAttributes(){

    $path=parse_url($_SERVER['REQUEST_URI']);
$qry=explode("&",$path["query"]);
$attr=array();
foreach($qry as $value){
$arr=explode("=",$value);
$name=$arr[0];
$attr[$name]=$arr[1];
}

return $attr;
}


function randCheck(){
    $input = array(" ","checked");
$rand_keys = array_rand($input, 1);
  
return  $input[$rand_keys];
}


 
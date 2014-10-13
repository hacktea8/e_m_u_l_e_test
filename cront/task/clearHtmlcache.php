<?php

$cacheDir = '';

$cmd = 'rm -f %s/*.html';

$dirArr = scandir($cacheDir);

foreach($dirArr as $vf){
 if(in_array($vf, array('.','..'))){
  continue;
 }
 $vp = $cacheDir.'/'.$vf;
 if( !is_dir($vp)){
  continue;
 }
 $order = sprintf($cmd, $vp);
 exec($order);
 echo "$order exec OK!\n";
}


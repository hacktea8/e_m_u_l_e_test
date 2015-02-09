<?php

define('ROOTPATH', dirname(__FILE__).'/');
$cacheDir = ROOTPATH.'../../application/cache/webhtmlcache';


$dirArr = scandir($cacheDir);

foreach($dirArr as $vf){
 if(in_array($vf, array('.','..'))){
  continue;
 }
 $vp = $cacheDir.'/'.$vf;
 if( !is_dir($vp)){
  continue;
 }
 echo "==== Clear cache $vp start ***** =====\n";
 $subDir = scandir($vp);
 foreach($subDir as $vsf){
  if(in_array($vsf, array('.','..'))){
   continue;
  }
  $vsp = $vp.'/'.$vsf;
  if( is_dir($vsp)){
   continue;
  }
  $ctime = filemtime($vsp);
  if(time() - $ctime > 259200){
   file_put_contents($vsp,'');
  }
 }
}


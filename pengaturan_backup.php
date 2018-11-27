<?php
									
									
											$biaya = 6000;
											$waktucuci = 15;
											$overtime = 0;
											$overtime2 = 0;
											$gratis = 0;
											$hadiah = 0;
											$hadiah2 = "";
											
											
												//melipatkan nilai & menyimpannya kedalam array// 
												
												$a = 0;
												$b = 0;
												$c = 0;
												
												$_overtime2 = array();
												$_gratis = array();
												$_hadiah = array();
												
												if($overtime2 != 0 ){
												 do{
												  $a = $a+$overtime2;
												  $_overtime2[] = $a;
												  
												} while ($a <= 100);
												}else {$_overtime2 = 0;}

												if($gratis != 0){	
												  do{
												  $b = $b+$gratis;
												  $_gratis[] = $b;
												   
												} while ($b <= 100);
												}else {$_gratis = 0;}   
												   
												if($hadiah != 0){   
												  do{ 
												  $c = $c+$hadiah;
												  $_hadiah[] = $c;
												  
												 } while ($c <= 100);
												}else {$_hadiah = 0;}
											
											?>
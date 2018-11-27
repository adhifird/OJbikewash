<?php
									
									
											$biaya = 6000;
											$waktucuci = 15;
											$overtime = 500;
											$overtime2 = 5;
											$gratis = 5;
											$hadiah = 10;
											$hadiah2 = "souvenir";
											
											
												//melipatkan nilai & menyimpannya kedalam array// 
												
												$a = 0;
												$b = 0;
												$c = 0;
												
												$_overtime2 = array();
												$_gratis = array();
												$_hadiah = array();
												 
												 do{
												  $a = $a+$overtime2;
												  $_overtime2[] = $a;
												  
												} while ($a <= 100);
												  
												  do{
												  $b = $b+$gratis;
												  $_gratis[] = $b;
												   
												} while ($b <= 100);
												   
												  do{ 
												  $c = $c+$hadiah;
												  $_hadiah[] = $c;
												  
												 } while ($c <= 100);
												 
												 echo $_hadiah[21];
											
											?>
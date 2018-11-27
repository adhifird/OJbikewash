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
												
												if($overtime2 != 0 ){
													do{
													  $a = $a+$overtime2;
													  $_overtime2[] = $a;
													}while ($a <= 100);
												}else{
													do{
													$a = ++$a;
													$_overtime2[] = $a;
													}while ($a <= 1);													
												}

												if($gratis != 0 ){
													do{
													  $b = $b+$gratis;
													  $_gratis[] = $b;
													}while ($b <= 100);
												}else{
													do{
													$b = ++$b;
													$_gratis[] = $b;
													}while ($b <= 1);													
												}
												   
												if($hadiah != 0 ){
													do{
													  $c = $c+$hadiah;
													  $_hadiah[] = $c;
													}while ($c <= 100);
												}else{
													do{
													$c = ++$c;
													$_hadiah[] = $c;
													}while ($c <= 1);													
												}
											
											?>
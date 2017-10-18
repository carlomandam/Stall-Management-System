<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.foundation.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.jqueryui.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> </head>

<body onload="">
    <div class="container" id="main">
        <div class="row">
            <div>
                <div id="header" style="text-align:center">
                    <h3 style="font-weight:bold">My Seoul Tiangge</h3>
                    <h4>KASUNDUAN SA PAG-UPA</h4> </div>
                <div style="margin-left:10%;margin-right:10%;">
                    <p style="text-indent:50px">
                        <center> My Seoul Tiangge, ay isang korporasyon na inorganisa at umiiral na sa ilalim at sa bisa ng mga batas ng Republika ng Pilipinas, at may address ng lugar ng negosyo sa Lot 4 Block 5 Manila East Road, Phase 1 Taytay, Rizal, simula dito ay tinutukoy na OWNER;</center>
						
                                <center><p>- and -</p></center>
                            <p>
                                <center><u><?php echo e(\Illuminate\Support\Str::upper($data['contract']->StallHolder->stallHFName)); ?> <?php echo e(\Illuminate\Support\Str::upper($data['contract']->StallHolder->stallHMName)); ?> <?php echo e(\Illuminate\Support\Str::upper($data['contract']->StallHolder->stallHLName)); ?></u>, nasa wastong gulang, Filipino, may-asawa/walang asawa at naninirahan sa <u><?php echo e($data['contract']->StallHolder->stallHAddress); ?></u>, simula dito ay tinutukoy na VENDOR;</center>
                            </p>and
                            <p>
                                <center>DATAPWA’T, ang OWNER ay may stalls na pinapaupahan sa Lot 4 Block 5 Manila East Road, Phase 1 Taytay, Rizal, at ang VENDOR na nagnanais na umupa ng isang stall ng OWNER ay naglalathala at sumasang-ayon na pumasok sa isang Kasunduan ng Pag-upa sa ilalim ng sumusunod na mga alituntunin at kondisyon:</center>
							</p>
                    <br> </div>
                    <?php
                        $prate = $data['contract']->Stall->StallType->StallRate->dblRate * ($data['contract']->Stall->StallType->StallRate->dblPeakAdditional / 100);
                        $rate = $data['contract']->Stall->StallType->StallRate->dblRate;
                    ?>
                <div style="margin-left:10%;margin-right:10%;">
                    <p><strong>1.</strong>	Na ang stall na uupahan ng VENDOR ay Stall No. <u><?php echo e($data['contract']->stallID); ?></u> ayon sa stall plan na nakalakip dito bilang “<u><?php echo e($data['contract']->Stall->Floor->Building->bldgName); ?></u>”. </p>
                    
                    <p><strong>2.</strong>	Ang Stall no. <u><?php echo e($data['contract']->stallID); ?></u> na uupahan ng VENDOR ay <u><?php echo e($data['contract']->Stall->StallType->StallTypeSize->stypeArea); ?></u>sq. m. ang laki ayon sa stall plan na minarkahan ng OWNER. </p>
                    
                    <p><strong>3.</strong>	Ang halaga ng upa ng stall ay <u>Php <?php echo e(number_format($data['contract']->Stall->StallType->StallRate->dblRate,2,'.',',')); ?></u> na mayroong karagdagang <u><?php echo e(($data['contract']->Stall->StallType->StallRate->peakRateType == 1) ? 'Php '.number_format($data['contract']->Stall->StallType->StallRate->dblPeakAdditional,2,'.',',') : $data['contract']->Stall->StallType->StallRate->dblPeakAdditional.'% (Php '.number_format(($data['contract']->Stall->StallType->StallRate->dblRate * ($data['contract']->Stall->StallType->StallRate->dblPeakAdditional / 100)),2,'.',',').')'); ?></u> tuwing <i>"Peak Days"</i> o <i>"Holidays"</i>, na babayaran ng VENDOR sa OWNER bawat araw ng pagtitinda. Magagamit o mababawasan and deposito sa anumang pagka-antala sa pagbabayad ng VENDOR ng upa.</p>
                    
                    <p><strong>4.</strong>  Ang termino ng pag-gamit sa stall ay hanggang isang taon na magsisimula sa araw ng pagbabayad ng membership/registration fee at automatikong magtatapos kahit walang “NOTICE” o “PASABI” ang OWNER.  Matutuloy lamang ang pag-upa sa stall sa pamamagitan lamang ng pagbabayad ng renewal ng registration ng VENDOR. </p>
                    
					<p style="text-indent:50px;"><b>INITIAL PAYMENT: Php <?php echo e(number_format($data['main'] + $data['sec'],2,'.',',')); ?>.</b></p>
					<p style="text-indent:50px;">Php <?php echo e(number_format($data['main'],2,'.',',')); ?>: Maintenance Fee (Paid Annually)</p>
					<p style="text-indent:50px;">Php <?php echo e(number_format($data['sec'],2,'.',',')); ?>: Security Deposit (Consumable / Non-Refundable)</p>
					 <style>
                            table {
                                font-family: arial, sans-serif;
                                width: 100%;
                                border-collapse: collapse;
                            }
                            
                            td,
                            th {
                                border: 1px solid #dddddd;
                                text-align: center;
                                padding: 8px;
                            }
                        </style>
                            <table>                                
                                <tr>
                                    <th>Market Days</th>
                                    <th>RATES</th>
                                </tr>
                                <?php if(in_array('sun',$data['mdays'])): ?>
                                <tr>
                                    <td>Sunday</td>
                                    <td>Php <?php echo e((in_array('sun',$data['pdays'])) ? number_format($prate,2,'.',',') : number_format($rate,2,'.',',')); ?></td>
                                </tr>
                                <?php endif; ?>
								<?php if(in_array('mon',$data['mdays'])): ?>
                                <tr>
                                    <td>Monday</td>
                                    <td>Php <?php echo e((in_array('mon',$data['pdays'])) ? number_format($prate,2,'.',',') : number_format($rate,2,'.',',')); ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(in_array('tue',$data['mdays'])): ?>
                                <tr>
                                    <td>Tuesday</td>
                                    <td>Php <?php echo e((in_array('tue',$data['pdays'])) ? number_format($prate,2,'.',',') : number_format($rate,2,'.',',')); ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(in_array('wed',$data['mdays'])): ?>
                                <tr>
                                    <td>Wednesday</td>
                                    <td>Php <?php echo e((in_array('wed',$data['pdays'])) ? number_format($prate,2,'.',',') : number_format($rate,2,'.',',')); ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(in_array('thu',$data['mdays'])): ?>
                                <tr>
                                    <td>Thursday</td>
                                    <td>Php <?php echo e((in_array('thu',$data['pdays'])) ? number_format($prate,2,'.',',') : number_format($rate,2,'.',',')); ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(in_array('fri',$data['mdays'])): ?>
                                <tr>
                                    <td>Friday</td>
                                    <td>Php <?php echo e((in_array('fri',$data['pdays'])) ? number_format($prate,2,'.',',') : number_format($rate,2,'.',',')); ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(in_array('sat',$data['mdays'])): ?>
                                <tr>
                                    <td>Saturday</td>
                                    <td>Php <?php echo e((in_array('sat',$data['pdays'])) ? number_format($prate,2,'.',',') : number_format($rate,2,'.',',')); ?></td>
                                </tr>
                                <?php endif; ?>
                                <p></p>
                            </table>
					
					
                    <p><strong>5.</strong>	Ang VENDOR ay magbabayad ng <u>Php <?php echo e(number_format($data['sec'],2,'.',',')); ?></u> bilang security deposit para sa anumang pinsala (damages) sa stall na maaaring mangyari habang inuupahan at inuukupahan ito ng VENDOR.  Ang halagang ito ay dapat na i-replenish ng VENDOR kung sakaling magamit sa pagpapagawa ng anumang pinsala sa stall.  </p>
                    
                    <p><strong>6.</strong>	Ang VENDOR ay hindi dapat mag-kabit ng linya ng kuryente o outlets, plumbing, drainage, o kahit anong structure sa stall na inuupahan ng walang written consent ang OWNER.  Ang paglabag dito ay nangangahulugan ng maagang pagtatapos ng kasunduan ng pag-upa, forfeiture ng security deposit, at pagbabayad ng halaga sa mga repairs. </p>
                    <p>Ang VENDOR ay maaaring humingi ng pahintulot sa OWNER sa pagpapa-aayos ng structure at utilities na naayon sa written approval mula sa OWNER.  Ang lahat ng halaga na magagastos sa pagpapagawa o pagpapa-ayos ay manggagaling lamang sa VENDOR.</p>
                    
					
					<p><strong>7.</strong>	Ang VENDOR ay kailangang humingi ng written approval sa OWNER kung nais ng VENDOR na lumipat sa ibang stall sa loob ng MySeoul Tiangge.</p>
                    
					<p><strong>8.</strong>	Lahat ng signages at iba pang promotional strategies at gimmicks na isasagawa ng VENDOR na lagpas sa paligid ng inuupahang stall ay dapat na may written approval galling sa OWNER.</p>
                       
                    <p><strong>9.</strong>	Ang VENDOR ay siyang tanging tagapag-ingat ng kanyang paninda. Ang OWNER walang pananagutan sa anumang pagkawala o pinsala ng paninda ng VENDOR kahit na ito ay sanhi ng improper use of facilities, facility failure, theft, robbery, force majeure, o acts of god. </p>
                    
                    <p><strong>10.</strong> Ang VENDOR ay hindi dapat magtinda, maglagak at maglagay ng anumang hazardous, illegal, stolen, o counterfeit (pekeng) merchandise o materials sa loob at paligid ng stall na pag-aari ng MySeoul Tiangge.  Ang OWNER ay may karapatang mag- reject, mag-disapprove at mag-dispose ng anumang produkto o paninda kapag ito ay labag sa safety at legal standards kahit na walang pasabi sa VENDOR.</p>
                    
                    <p><strong>11.</strong> Ang VENDOR ay dapat sa lahat ng pagkakataon ay panatilihing malinis at maganda ang stall at ang paligid nito.  Ang VENDOR ay dapat na hindi gumawa ng mga bagay o aksyon na makakaapekto sa kalinisan ng buong stall at sa paligid nito.</p>
					
					<p><strong>12.</strong> Ang VENDOR pati ng kanyang mga empleyado ay dapat na sa lahat ng pagkakataon ay panatilihin ang magandang samahan sa kanilang kapwa vendor at huwag maging sanhi o magdudulot ng anumang sigalot, hidwaan, away o anumang violence sa kapwa vendor.  Anumang hidwaan, away o sigalot na makakaapekto sa kaayusan ng negosyo at ng samahan ng mga vendors sa mga tiangge ay dapat na maayos sa pamamagitan ng mediation process na pangungunahan ng VENDOR. Ang hindi pagtupad sa tuntunin ng kasunduan sa panahon ng mediation ay magiging sanhi ng termination ng Kasunduang ito at nangangahulugan na ang VENDOR sampu ng kinatawan niyo ay hindi na maaring pumasok sa Tiangge. </p>
					<p><strong>13.</strong> Ang VENDOR ay dapat na sumunod sa lahat ng alintuntunin at patakaran ng namamahala ng tiangge kabilang dito pero hindi limitado sa policies, procedures, projects, business practices, merchandise selection at display.  Anumang paglabag dito ay nangangahulugan ng termination ng Kasunduang ito. </p>
					<p><strong>14.</strong> Ang Kasunduang ito ay maaaring tapusin ng mas maaga sa termino nito kung may written agreement ang bawat partido. Dapat na magbigay agad ng NOTICE o PASABI ang VENDOR kung tatapusin na ang Kasunduang ito.</p>
					<p><strong>15.</strong> Ang Kasunduang ito ay maagang matapos kapag may paglabag ang VENDOR sa kahit na aling alituntunin na nakasaad sa Kasunduang ito o anumang rules, regulations o policies na isinaad ng management ng MySeoul, Inc. habang nag-ooperate ang Tiangge</p>
					<p><strong>16.</strong> Sa araw ng pagtatapos ng Kasunduan sa kahit na anong kadahilanan o walang bagong kasunduan sa pag-upa, ang OWNER ay may karapatan na kunin ang stall kahit walang pahintulot ng VENDOR o PASABI o NOTICE sa kanya ang OWNER. May karapatan din na ipagbawal ang pagpasok ng VENDOR o sinumang kinatawan/katiwala nito sa Tiangge ng walang pahintulot mula sa OWNER.  Kasama dito, karapatan din ng OWNER na iligpit o itago ang ano mang panindang naiwan sa stall na inupahan ng VENDOR.  Maaaring kunin ng VENDOR ang mga naitagong paninda matapos bayaran sa OWNER ang halaga ng kanyang nagastos sa pagpapatago at pagliligpit ng paninda pati na ang halaga ng pagkakautang ng VENDOR sa OWNER, kung mayroon man.  Pagkalipas ng sampung (10) araw mula sa pagtatapos ng kasunduang ito, kung hindi pa rin kinukuha o tinutubos ng VENDOR ang mga panindang itinago o iniligpit ng OWNER, ito ay nangangahulugan na wala na itong balak pang kunin ng VENDOR. </p>
					<p><strong>17.</strong> Ang OWNER ay magbibigay ng clearance sa VENDOR kapag nabayaran na lahat ng VENDOR ang dapat bayaran sa OWNER.  Ito ay magsisilbing gate pass ng VENDOR sa pagkuha o paglabas ng mga produkto o paninda nito na galling sa stall na inupahan niya.</p>
					<p><strong>18.</strong> Ang hindi striktong pagpapatupad ng OWNER sa alintunin at kondisyon ng Kasunduang ito ay hindi nangangahulugan na pagpapabaya o pagpapaubaya sa ibang alituntunin at kondisyon ng Kasunduang ito. Ang “pag-ubaya” ay magiging isang pagpalit ng Kasunduan, kung ito ay nakasaad o nakasulat sa isang dokumento. </p>
					<p></p>
				
				
				</div>
                <div style="margin-top:5%;">
					<p style="text-indent:50px;">IN WITNESS WHEREOF, we hereby set our hands, this <u><?php echo e(date('jS',strtotime($data['contract']->contractStart))); ?></u> day of <u><?php echo e(date('F',strtotime($data['contract']->contractStart))); ?></u> <u><?php echo e(date('Y',strtotime($data['contract']->contractStart))); ?></u> in _____________________, Philippines. </p>
                    <p>
                        <center>
                            <input type="text" value="Benito Roger L. De Joya" style="border:transparent;border-bottom:2px solid black;width:160px;background-color:transparent margin-right:28%;text-align: center;" disabled></center>
                    </p>
                    <p>
                        <center>
                            <label style="margin-right:22%;">Owner</label>
                            <label style="margin-left:22%;">Vendor</label>
                        </center>
                    </p>
                    <p>
                        <center>
                            <label style="margin-right:22%;">(Signature over Printed Name)</label>
                            <label>(Signature over Printed Name)</label>
                        </center>
                    </p>
                </div>
                <div style="margin-left:70%;margin-top:10%"> </div>
            </div>
            <br />
            <footer> </footer>
        </div>
    </div>
</body>
</html>
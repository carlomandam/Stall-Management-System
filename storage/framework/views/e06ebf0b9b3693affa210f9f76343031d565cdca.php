<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="100%">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <style type="text/css">
        @page{
            margin-top: 1cm;
            margin-bottom: 0.25cm;
        }
        body{
            font-family: "SegoeUI","Sans-serif";
            font-size: 12px;
        }
        .header{
            font-size: 20px!important;
        }
        .banner{
            font-size: 13px!important;
        }
        .banner1{
            font-size: 12px!important;
        }
        .page-break {
            page-break-after: always;
        }
        .center{
            text-align: center;
        }
        .col-md-12{
            width: 100%;
        }
        .col-md-6{
            width: 50%;
        }
        .border{
            border: 1px solid black;
        }
        .text-right{
            text-align: right;
        }
        table{
            clear: both;
            border: 1px solid black
        }
        tbody tr{
            border: 1px solid black;
        }
        tr:nth-child(even) {
            background-color: #e6e6e6
        }
        th{
            background-color: black;
            color: white;
        }
        .footer{
            position: absolute;
            bottom: 0;
        }
        .footerd{
            font-size: 0.8em;
        }
    </style>
    <body>
        <div class="center header">
            <b>Bill</b>
        </div>
        <div >
            <b style=" font-size: 20px!important">My Seoul</b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b style=" font-size: 14px!important">Date:<?php echo e(Carbon\Carbon::today()->format('F d, Y')); ?></b>
          
        </div>
        <div class="banner">
            <b>Goods and Garments</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b style="margin-left: 30px;">Bill No: <?php echo e($billID); ?></b>

        </div>
         <div class="banner1">
            <b>L4 B5 Manila East Homes St. San juan Taytay,Rizal</b>
        </div>

        <div>
            <table width="100%" border="1px solid black">
                <thead >                    
                    <tr>
                        <th colspan="2" style="text-align: left;">Bill To</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  width="25%"><b>Stall Code:</b></td>
                        <td><?php echo e($billing->StallRental->Stall->stallID); ?></td>
                    </tr>
                    <tr>
                        <td  width="25%"><b>Stall Holder:</b></td>
                        <td  width="75%"><?php echo e($billing->StallRental->StallHolder->stallHFName." ".$billing->StallRental->StallHolder->stallHLName); ?></td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
        <div  style="margin-top: 5px;">
            <b style="font-size: 15px;">Billing Details</b>
        </div>
        <div class="col-md-12">
            <table width="100%">
                <thead >
           
                  <?php $__currentLoopData = $contract; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $con): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>      

                    <tr>
                        <th style="text-align: left;">Date</th>
                        <th style="text-align: left;"">Description</th>
                        <th style="text-align: left;"">Amount</th>
                      
                    </tr>
                </thead>
                <tbody>
                   
            <?php $__currentLoopData = $con->StallRate->RateDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
           <?php
           $first = Carbon\Carbon::parse($billing->billDateFrom)->format('d');
           $last = Carbon\Carbon::parse($billing->billDateTo)->format('d');
           $nextDay = Carbon\Carbon::parse($billing->billDateFrom);
           $total = 0;
           ?>
                        <?php for($i = $first; $i<= $last; $i++): ?>

                     
                        <tr>

                        <td><?php echo e($nextDay->format('F d, Y')); ?></td>
                            
                            <?php if($con->StallRate->frequencyDesc==1): ?>
                             <td>Monthly Rate</td>
                            <?php elseif($con->StallRate->frequencyDesc==2): ?>
                               <td>Weekly Rate</td>
                            <?php elseif($con->StallRate->frequencyDesc==3): ?>
                               <td><?php echo e($nextDay->format("l")); ?> Rental Rate</td>
                            <?php endif; ?>
                       
                       
                        <td>Php <?php echo e(number_format($rd->dblRate,2)); ?> <?php
                        $total += $rd->dblRate;
                        ?></td>
                      
                        <?php
                        $nextDay = $nextDay->addDays(1);
                        ?>
                        </tr>
                        <?php endfor; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                       
                </tbody>
            </table>
        </div>
        <div style="margin-top: 10px;margin-left: 73%;">
            <b style="font-size: 15px;">Total:</b>
            <b style="font-size: 14px;color: red;">Php <?php echo e(number_format($total,2)); ?></b>
        </div>
        <div>
            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </body>
</html>
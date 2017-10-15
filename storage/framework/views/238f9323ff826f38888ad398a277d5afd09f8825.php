<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Acknowledgement Receipt</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <style type="text/css">
        @page{
            margin-top: 1cm;
            margin-bottom: -0.75cm;
        }
        body{
            font-family: "SegoeUI","Sans-serif";
            font-size: 12px;
        }
        .header{
            font-size: 16px!important;
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
        
        table{
            clear: both;
            border: 1px solid black
        }
        tbody td{
            border-bottom: 1px solid black;
            padding: 10px;
        }
       
       
        .footer{
            position: absolute;
            bottom: 0;
            margin-bottom: 60px;
        }
        .footerd{
            font-size: 0.8em;
        }
    </style>
    <body>
        
        <div class="center">
            <label class="header"><b><i>MySeoul Goods and Garments</i></b></label>
            <p>L4 B5 Manila East Homes St. San Juan Taytay,Rizal</p>
        </div>
        <br>
        <div  class = "col-md-4" style="float: right">
            <label><b><i>Payment No.</i></b>00001</label>
            <br>
            <br>
       
            <label><b><i>Date:</i></b> <?php echo e(Carbon\Carbon::today()->format('F d, Y')); ?></label>
        </div>
       
        <br>
        <div class = "col-md-12">
            <table width="100%">
                <tbody>
                    <tr>
                        <td><b><i>RECEIVED From:</i></b></td>
                    </tr>
                    <tr>
                        <td><b><i>with Stall at:</i></b></td>
                    </tr>
                    <tr>
                        <td><b><i>the sum of PESOS: (Php)</i></b></td>
                    </tr>
                    <tr>
                        <td><b><i>in Partial/Full Payment of:</i></b></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: none;"><b><i>From:</i></b><b><i>To:</i></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <div style="float:right" class="col-md-6">
                RECEIVED BY: ______________________<br>
              
            </div>
            
            <br><br>
            <div class="footerd">Printed by: </div>
        </div>
    </body>
</html>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 20px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    .header{
        background-color: #bec4ce;
    }
    .header-right{
        background-color: #d0d6e0;
    }
    
    @media  only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2" >
                    <table>
                        <tr>
                            <td class="title header">
                                MySeoul Goods & Garments<br>
                                <span style="font-size:14px;">L4 B5 Manila East Homes St. San juan Taytay,Rizal</span>

                            </td>


                            
                            <td class="header">
                                Receipt No.<br>
                                Date: <br>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                              <i>RECEIVED from:</i>
                                John Doe<br>
                                <i>Stall Code:</i>
                                MN-101 
                                
                            </td>
                            
                            
                        </tr>
                    </table>
                </td>
            </tr>
            
           
            <tr class="heading">
                <td>
                  <i>Description</i>
                </td>
                
                <td>
                   <i> Amount</i>
                </td>
            </tr>
            
            <tr class="item">
               
            </tr>
            
            <tr class="item">
               
            </tr>
            
            <tr class="item last">
                <td>
                    Domain name (1 year)
                </td>
                
                <td>
                    $10.00
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                
                <td>
                   Total Amount: Php 10000.00 
                </td>
            </tr>
            <tfoot>
                    <tr>
                        
                        <td></td>
                        <td>By:_________________</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>&nbsp&nbsp&nbsp&nbsp&nbspAuthorized Signature</td>
                    </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>

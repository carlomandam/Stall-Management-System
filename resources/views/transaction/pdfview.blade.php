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
                    <h4>Rental Agreement</h4> </div>
                <div style="margin-left:10%;margin-right:10%;">
                    <p style="text-indent:50px">
                        <center> THIS AGREEMENT made this (day) <b>{{date_format(date_create($data['contract']->contractStart), 'd')}} </b>of (Month) <b>{{date_format(date_create($data['contract']->contractStart), 'F')}}</b>, (Year) <b>{{date_format(date_create($data['contract']->contractStart), 'Y')}}</b>,
                            <p>
                                <center>is between:</center>
                            </p>
                            <p>
                                <center><b>Benito Roger L. De Joya </b> (OWNER) of My Seoul Tiangge </center>
                            </p>and
                            <p>
                                <center> <b>  {{ $data['contract']->StallHolder->stallHFName. " ". $data['contract']->StallHolder->stallHMName[0]. ". ". $data['contract']->StallHolder->stallHLName}} </b>(VENDOR)</center>
                            </p> The OWNER and VENDOR hereby agree the rental of Stall No. <b> {{$data['contract']->stallID}} </b>located on (Floor) <b> {{$data['contract']->Stall->Floor->floorLevel}} </b>,(Building) <b> {{$data['contract']->Stall->Floor->Building->bldgName}}.</b> Commencing on this day until {{$data['contract']->contractEnd}}. This agreement is subject to the following terms and conditions: </center>
                    </p>
                    <br> </div>
                <div style="margin-left:10%;margin-right:10%;">
                    <p>1. Membership</p>
                    <p style="text-indent:50px;">Vendor agrees to pay the annual membership fee for the maintenance of the facilities. This membership fee is non-refundable. </p>
                    <p>2. Contract Period</p>
                    <p style="text-indent:50px;">The contract shall be a term of starting on the (day) @if($data['contract']->contractStart != "") <b> {{date_format(date_create($data['contract']->contractStart), 'd')}} </b> of (Month) <b> {{date_format(date_create($data['contract']->contractStart), 'F')}} </b>,(Year) <b> {{date_format(date_create($data['contract']->contractStart), 'Y')}} </b>.</p> @endif
                    <p>3. Security Deposit</p>
                    <p style="text-indent:50px;">Vendor agrees to pay the security deposit. This security deposit is non – refundable but consumable. It will cover unpaid rent upon termination of the rent agreement.</p>
                    <p>4. Rental fees</p>
                    <p style="text-indent:50px;">Vendor shall pay rent of Php {{ number_format($data['contract']->StallRate->dblRate, 2, '.', ',')}} daily with additional @if($data['contract']->StallRate->peakRateType == 1) Php.{{$data['contract']->StallRate->dblPeakRate}}
                    @elseIf($data['contract']->StallRate->peakRateType == 2) {{$data['contract']->StallRate->dblPeakRate . '% (Php.'.($data['contract']->StallRate->dblRate * $data['contract']->StallRate->dblPeakRate) / 100}})@endIf on peak days</p>
                    <p>5. Termination</p>
                    <p style="text-indent:50px;">This agreement may be renewed subject to the sole discretion of the management of MySeoul, Inc. The agreement may be terminated beforehand upon mutual written agreement of both parties. It may also be terminated if the vendor violates any stipulation of this agreement; OR if the vendor violates any rule, regulation, or policy declared by the management of MySeoul, Inc. in the course of operations. </p>
                    <p>6. Clearance </p>
                    <p style="text-indent:50px;">A clearance shall be issued to the vendor upon full account settlement. It shall serve as a gate pass for the egress of goods and merchandise owned by the vendor. </p>
                    <p>7. Installation of additional structure or utilities</p>
                    <p style="text-indent:50px;">The vendor shall not install power lines or outlets, plumbing, drainage, or any structure within the premises and perimeter of the property without a written consent of the owner. Violation is subject to immediate termination of lease, forfeiture of security deposit, and repair charges. </p> @if(!empty($util))
                    <p style="text-indent:50px;">(a)The following utilities shall be provided and/or paid by the vendor indicated beside each item:
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
                                    <th>Stall Utilities</th>
                                    <th>Utilities Rate</th>
                                    <th>Meter ID</th>
                                </tr>
                                <tr>
                                    <td> Electricity </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                                <p></p>
                            </table>
                    @endif
                    <p>8. Stall and Merchandise</p>
                    <p style="text-indent:50px;">The vendor shall be the responsible for the safety and order of his merchandise. MySeoul, Inc. provides security services but will not be liable for any loss or damage including but not limited to improper use of facilities, facility failure, theft, robbery, force majeure, or acts of god. </p>
                    <p>9. Rules and Regulation</p>
                    <p style="text-indent:50px;">Vendor must obey all the rules and regulations given by the management including but not limited to policies, procedures, projects, business practices, merchandise selection and display. Any violation shall be subject to fines, disciplinary action, or termination of contract as deemed by the owner.</p>
                    <p>10. Product storage, handling, and sales</p>
                    <p style="text-indent:50px;">The vendor shall not sell, store, or handle hazardous, illegal, stolen, or counterfeit merchandise or materials within the premises or perimeter of MySeoul Tiangge. All products to be sold, handled, or stored at MySeoul Tiangge are subject to sole written consent of the owner. The owner reserves the rights to reject, disapprove, and dispose any product or merchandise that violates safety and legal standards without prior notification or consent.</p>
                </div>
                <div style="margin-top:5%;">
                    <p>
                        <center>
                            <input type="text" value="Benito Roger L. De Joya" style="border:transparent;border-bottom:2px solid black;width:160px;background-color:transparent margin-right:28%;text-align: center;" disabled>
                            <input type="text" value="{{ $data['contract']->StallHolder->stallHFName. ' '. $data['contract']->StallHolder->stallHMName[0]. '. '. $data['contract']->StallHolder->stallHLName}}" style="border:transparent;border-bottom:2px solid black;width:160px;background-color:transparent;margin-left:28%; text-align: center;" disabled> </center>
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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print Invoice</title>
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet"/>
    <style type="text/css" media="screen">
        body{ background: none; }
    </style>
</head>
<body style="color: #494949; font-family: 'Quicksand-Regular';" onload="window.print()">
    <table style="border-collapse: collapse; width: 100%; margin-bottom: 10px;">
        <tbody>
            <tr>
                <td width="400" style="vertical-align:top;"> <img src="http://167.71.212.250/images/logo.svg" alt="Logo" style="height: 30px; margin-top: 10px;"> </td>
                <td style="vertical-align:top; text-align: right; font-size: 8pt; line-height: 26px; color: #494949; font-family: 'Quicksand-Bold';">Proforma Invoice</td>
            </tr>
        </tbody>
    </table>

    <table style="border-collapse: collapse; width: 100%; margin-bottom: 10px; border-bottom: 3px solid #000000;">
        <tbody>
            <tr>
                <td style="font-size: 6pt; line-height: 10px; padding-bottom: 10px;">
                    <div>Email: gtexportsg@gmail.com</div>
                    <div>Address: 61 Ubi Ave 2, #01-21, Automobile Megamart</div>
                    <div>Singapore 408898</div>
                    <div>Tel: (+65) 96178716</div>
                    <div>Company Registration No. 202007318G</div>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="border-collapse: collapse; width: 100%; margin-bottom: 20px;">
        <tbody>
            <tr>
                <td width="60%" style="vertical-align:top;"> 
                    <table style="border-collapse: collapse; width: 100%; font-size: 7pt; line-height: 13px;">
                        <tr>
                            <td style="font-family: 'Quicksand-Bold'; width: 100px;">CONSIGNEE:</td>
                            <td>{{ $invoice->first_name }} {{ $invoice->last_name }}</td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Quicksand-Bold'; padding-bottom: 10px;">ADDRESS:</td>
                            <td style="padding-bottom: 25px;">{{ $invoice->consignee_address }} </td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Quicksand-Bold';">CONTACT:</td>
                            <td>{{ $invoice->contact_no }} </td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Quicksand-Bold';">EMAIL:</td>
                            <td>{{ $invoice->email }} </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align:top; text-align: right;">
                    <table style="border-collapse: collapse; width: 100%; font-size: 7pt; line-height: 13px;">
                        <tr style="color: #000; font-family: 'Quicksand-Bold';">
                            <td style="border:1px solid #000; width: 45%; text-align: left; padding: 5px 10px;">Invoice No. :</td>
                            <td style="border:1px solid #000; text-align: center; padding: 5px 10px;">{{ $invoice->invoice_number }}</td>
                        </tr>
                        <tr style="color: #000; font-family: 'Quicksand-Bold';">
                            <td style="border:1px solid #000; width: 45%; text-align: left; padding: 5px 10px;">Date: </td>
                            <td style="border:1px solid #000; text-align: center; padding: 5px 10px;">{{ date('d F, Y', strtotime($invoice->date)) }}</td>
                        </tr>
                        <tr style="color: #000; font-family: 'Quicksand-Bold';">
                            <td style="border:1px solid #000; width: 45%; text-align: left; padding: 5px 10px;">Payment Terms:</td>
                            <td style="border:1px solid #000; text-align: center; padding: 5px 10px;">{{ $invoice->payment_terms }}</td>
                        </tr>
                        <tr style="color: #000; font-family: 'Quicksand-Bold';">
                            <td style="border:1px solid #000; width: 45%; text-align: left; padding: 5px 10px;">Type:</td>
                            <td style="border:1px solid #000; text-align: center; padding: 5px 10px;">{{ $invoice->type }}</td>
                        </tr>
                        <tr style="color: #000; font-family: 'Quicksand-Bold';">
                            <td style="border:1px solid #000; width: 45%; text-align: left; padding: 5px 10px;">Port of Destination:</td>
                            <td style="border:1px solid #000; text-align: center; padding: 5px 10px;">{{ $invoice->port_of_destination }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="border-collapse: collapse; width: 100%; color: #000; font-size: 7pt; line-height: 10px;">
        <thead>
            <tr>
                <th colspan="9">&nbsp;</th>
                <th style="border:1px solid #000; text-align: center;">By Sea Freight</th>
            </tr>
        </thead>
        <tbody style="border:1px solid #000;">
            <tr>
                <th rowspan="2" style="padding: 0 5px; background: #C4C4C4;">S/N</th>
                <th colspan="8" style="padding: 10px; border:1px solid #000; background: #C4C4C4; font-family: 'Quicksand-Bold';">
                    <div>PRODUCT DESCRIPTIONS (USED MOTOR VEHICLE)</div>
                </th>
                <th rowspan="2" style="padding: 0 5px; background: #C4C4C4;">
                    <div style="margin-bottom: 10px;">AMOUNT</div>
                    <div>CNF (USD)</div>
                </th>
            </tr>
            <tr>
                <th style="border:1px solid #000; background: #C4C4C4;text-align:center;padding:5px 10px;">VEHICLE NO.</th>
                <th style="border:1px solid #000; background: #C4C4C4;text-align:center;padding:5px 10px;">MAKE & MODEL</th>
                <th style="border:1px solid #000; background: #C4C4C4;text-align:center;padding:5px 10px;">COLOUR</th>
                <th style="border:1px solid #000; background: #C4C4C4;text-align:center;padding:5px 10px;">ORD</th>
                <th style="border:1px solid #000; background: #C4C4C4;text-align:center;padding:5px 10px;">ENGINE CAP</th>
                <th style="border:1px solid #000; background: #C4C4C4;text-align:center;padding:5px 10px;">MILEAGE</th>
                <th style="border:1px solid #000; background: #C4C4C4;text-align:center;padding:5px 10px;">CHASSIS NO.</th>
                <th style="border:1px solid #000; background: #C4C4C4;text-align:center;padding:5px 10px;">ENGINE NO.</th>
            </tr>
            @foreach($invoice->invoice_details as $detail)
            <tr>
                <th style="border:1px solid #000; vertical-align: top;  border-bottom: 1px solid white;text-align:center;padding:5px 10px 0 10px;">{{ $detail->vehicle_number }}</th>
                <th style="border:1px solid #000; vertical-align: top;  border-bottom: 1px solid white;text-align:center;padding:5px 10px 0 10px;">{{ $detail->make_model }}</th>
                <th style="border:1px solid #000; vertical-align: top;  border-bottom: 1px solid white;text-align:center;padding:5px 10px 0 10px;">{{ $detail->colour }}</th>
                <th style="border:1px solid #000; vertical-align: top;  border-bottom: 1px solid white;text-align:center;padding:5px 10px 0 10px;">{{ $detail->ord }}</th>
                <th style="border:1px solid #000; vertical-align: top;  border-bottom: 1px solid white;text-align:center;padding:5px 10px 0 10px;">{{ date('d F Y', strtotime($detail->date)) }}</th>
                <th style="border:1px solid #000; vertical-align: top;  border-bottom: 1px solid white;text-align:center;padding:5px 10px 0 10px;">{{ $detail->engine_cap }}</th>
                <th style="border:1px solid #000; vertical-align: top;  border-bottom: 1px solid white;text-align:center;padding:5px 10px 0 10px;">{{ $detail->mileage }}KM</th>
                <th style="border:1px solid #000; vertical-align: top;  border-bottom: 1px solid white;text-align:center;padding:5px 10px 0 10px;">{{ $detail->chassis_no }}</th>
                <th style="border:1px solid #000; vertical-align: top;  border-bottom: 1px solid white;text-align:center;padding:5px 10px 0 10px;">{{ $detail->engine_no }}</th>
                <th style="border:1px solid #000; vertical-align: top;  border-bottom: 1px solid white;text-align:center;padding:5px 10px 0 10px;">$ {{ number_format($detail->amount, 2, '.', ',') }}</th>
            </tr>
            @endforeach
            <!-- <tr>
                <th style="border:1px solid #000; vertical-align: top; text-align:center;padding:0px 10px;">2</th>
                <th style="border:1px solid #000; vertical-align: top; text-align:center;padding:0px 10px;">SKC 3216D</th>
                <th style="border:1px solid #000; vertical-align: top; text-align:center;padding:0px 10px;">AUDI Q7 3.0 QUATTRO A</th>
                <th style="border:1px solid #000; vertical-align: top; text-align:center;padding:0px 10px;">White</th>
                <th style="border:1px solid #000; vertical-align: top; text-align:center;padding:0px 10px;">11 August 2021</th>
                <th style="border:1px solid #000; vertical-align: top; text-align:center;padding:0px 10px;">2995cc</th>
                <th style="border:1px solid #000; vertical-align: top; text-align:center;padding:0px 10px;">52,000KM</th>
                <th style="border:1px solid #000; vertical-align: top; text-align:center;padding:0px 10px;">WAUZZZ4L6 BD007551</th>
                <th style="border:1px solid #000; vertical-align: top; text-align:center;padding:0px 10px;">CJT003528</th>
                <th style="border:1px solid #000; vertical-align: top; text-align:center;padding:0px 10px;">$ 13,000.00</th>
            </tr> -->
            <tr>
                <th colspan="8" style="border:1px solid #000;text-align:center;padding:5px 10px;">&nbsp;</th>
                <th style="border:1px solid #000;text-align:center;padding:5px 10px; text-align: right;">
                    <div>Sub-Total:</div>
                    <div>Received:</div>
                    <div>Payment Due:</div>
                </th>
                <th style="border:1px solid #000;text-align:center;padding:5px 10px;">
                    <div>$ {{ number_format($invoice->sub_total, 2, '.', ',') }}</</div>
                    <div>$ 13,000.00</div>
                    <div>$ {{ number_format($invoice->total, 2, '.', ',') }}</</div>
                </th>
            </tr>
            <tr>
                <th colspan="8" style="border:1px solid #000;text-align:center;padding:5px 10px; text-align: left; padding: 10px; vertical-align: top;">
                    <div style="margin-bottom: 5px;">Payment: Please pay to our account via Telegraph Transfer (TT).</div>
                    <div>Take Note: All payments must be in USD.</div>
                </th>
                <th style="border:1px solid #000;text-align:center;padding:5px 10px; vertical-align: top; padding-top: 10px; text-align: right; border-right: 0;">Remarks:</th>
                <th style="border:1px solid #000;text-align:center;padding:5px 10px;">
                {{ $invoice->remarks }}</th>
            </tr>
            <tr>
                <th colspan="7" style="border:1px solid #000;text-align:center;padding:5px 10px; text-align: left; padding: 10px; vertical-align: top; line-height: 10px;">
                    <table>
                        <tr>
                            <td width="160" style="vertical-align: top;">Account Name:</td>
                            <td style="vertical-align: top;">GT Export Pte Ltd</td>
                        </tr>
                        <tr>
                            <td width="160" style="vertical-align: top;">Bank Name:</td>
                            <td style="vertical-align: top;">DBS Bank</td>
                        </tr>
                        <tr>
                            <td width="160" style="vertical-align: top;">Branch Name:</td>
                            <td style="vertical-align: top;">DBS Habourfront</td>
                        </tr>
                        <tr>
                            <td width="160" style="vertical-align: top;">Branch Code:</td>
                            <td style="vertical-align: top;">012</td>
                        </tr>
                        <tr>
                            <td width="160" style="vertical-align: top;">Bank Code:</td>
                            <td style="vertical-align: top;">7171</td>
                        </tr>
                        <tr>
                            <td width="160" style="vertical-align: top;">Address:</td>
                            <td style="vertical-align: top;">12  Marina Blvd. Marina Bay Financial Centre Tower 3, DBS Asia Central, Singapore 018982</td>
                        </tr>
                        <tr>
                            <td width="160" style="vertical-align: top;">Swift Code:</td>
                            <td style="vertical-align: top;">DBSSSGSG</td>
                        </tr>
                        <tr>
                            <td width="160" style="vertical-align: top;">Beneficiary:</td>
                            <td style="vertical-align: top;">GT Export Pte Ltd</td>
                        </tr>
                        <tr>
                            <td width="160" style="vertical-align: top;">Account No:</td>
                            <td style="vertical-align: top;">DBS Current 012-902-8118</td>
                        </tr>
                        <tr>
                            <td width="160" style="vertical-align: top;">Intermediary Bank (USD):</td>
                            <td style="vertical-align: top;">JPMorgan Chase Bank, N.A.</td>
                        </tr>
                        <tr>
                            <td width="160" style="vertical-align: top;">SWIFT BIC Code:</td>
                            <td style="vertical-align: top;">CHASUS33</td>
                        </tr>
                    </table>
                </th>
                <th style="border-bottom: 0;">&nbsp;</th>
                <th colspan="2" style="border:1px solid #000;text-align:center; vertical-align: top; padding: 20px 5px;">Please acknowledge by returning our email to notify us if there are any changes or discrepancies.</th>
            </tr>
        </tbody>
    </table>

    <table style="border-collapse: collapse; width: 100%; margin-top: 120px; font-size: 7pt; line-height: 14px;">
        <tbody>
            <tr>
                <td width="50%" style="vertical-align:top; text-align: center; padding: 0 50px;">
                    <div style="border-top: 1px solid #000; padding-top: 5px; color: #000;">Customer Signature</div>
                </td>
                <td width="50%" style="vertical-align:top; text-align: center; padding: 0 50px;">
                    <div style="border-top: 1px solid #000; padding-top: 5px; color: #000;">GT Export Pte Ltd</div>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
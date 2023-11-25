<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
            border-collapse: collapse;
        }

        th, td {
            border: solid 1px #777;
            border-collapse: collapse;
            padding: 2px;
            /*margin: 2px;*/
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        thead tr td {
            font-weight: bold;
        }

        .logoLeft {
            position: fixed;
            margin-top: 10px;
            margin-left: 20px;
            height: 80px !important;
            Width: auto !important;
        }

        .companyname {
            position: fixed;
            margin-top: 2px;
            margin-left: 20px;
            /*font-weight: 400;*/
            /*font-size: 36px;*/
            /*font-size: x-large;*/
            font-size: 40px;
            text-align: center;
            text-transform: uppercase;
            height: 45px;
        }

        .address1 {
            position: fixed;
            margin-top: 50px;
            font-weight: 400;
            font-size: 16px;
            text-align: center;
            font-family: sans-serif;
        }

        .address2 {
            position: fixed;
            margin-top: 48px;
            top: 22px !important;
            font-weight: 400;
            font-size: 16px;
            text-align: center;
            font-family: sans-serif;
        }

        .gst {
            position: fixed;
            margin-top: 43px;
            top: 46px !important;
            font-weight: 400;
            font-size: 16px;
            text-align: center;
            font-family: sans-serif;
        }

        .page-break {
            page-break-after: always;
        }

    </style>

</head>
<body>

<table width="100%" class="print:*">
    <thead>
    <tr>
        <td colspan="2">
            <div style="height: 110px;" class="bg-blue-400 ">
                {{--                --}}{{--<img class="logoLeft" src=data:image/png;base64,{{$cmp->get('logo')}}"/>--}}
                                <div style="text-align: center; width: 100%;" class="companyname">Amal Tex</div>
                                <div style="text-align: center; width: 100%;" class="address1">address1</div>
                                <div style="text-align: center; width: 100%;" class="address2">address2</div>
                                <div style="text-align: center;width: 100%;" class="gst">gst</div>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="  background-color: darkgray">
            <div style=" height: 25px;text-align: center;  vertical-align: middle; color: white; font-size: large  ">
                Delivery Challan

            </div>
            <div style="text-align: right; color: white; margin-top: -22px; margin-bottom: 5px">
                Original copy&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </td>
    </tr>
    <tr>
        <td style="padding: 0;margin: 0;height: 50px">
            <div style="text-align: left;">
                <p style="font-size: 20px">&nbsp;&nbsp;M/s.{{$contact->get('contact_name')}}</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$contact->get('address_1')}}</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$contact->get('address_2')}}</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$contact->get('address_3')}}</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$contact->get('gst')}}</p>
            </div>
        </td>
        <td style="padding: 0;margin: 0;height: 50px">
            <div style="text-align: left; width: 100%">
                <div><span style="vertical-align: middle;font-size: 18px; ">&nbsp;&nbsp;Invoice no:&nbsp;</span><span
                        style="font-size: 18px;">{{$obj->vno}}</span></div>
                <div><span style="vertical-align: middle;font-size: 18px; ">&nbsp;&nbsp;Date:&nbsp;</span><span
                        style="font-size: 18px;">{{$obj->vdate}}</span></div>
            </div>
        </td>
    </tr>
    </thead>
</table>

<table width="100%">
    <thead style="background-color: lightgray;">
    <tr>
        <th>#</th>
        <th>Cutting No</th>
        <th>Colour</th>
        <th>Sizes</th>
        <th>Quantity</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $index => $row)

        <tr>
            <td width="12" align="center">{{$index+1}} </td>
            <td align="center">&nbsp;{{$row['cutting_no']}}</td>
            <td align="left">&nbsp;{{$row['colour_name']}}</td>
            <td align="left">&nbsp;{{$row['size_name']}}</td>
            <td align="center">&nbsp;{{$row['qty']}}</td>
        </tr>

    @endforeach
    <tr>
        <td align="center"></td>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="center">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="6" align="left">Transport : {{$obj->receiver_details}}</td>
        <td colspan="3" align="left">&nbsp;</td>
        <td align="right">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="6" style="height: 40px; text-align: left; vertical-align: top; padding-top: 5px ">Receiver Sign
        </td>
        <td colspan="4" style="height: 40px; text-align: center; vertical-align: top; padding-top: 5px ">
            for company </td>
    </tr>
    </tbody>
</table>

</body>
</html>

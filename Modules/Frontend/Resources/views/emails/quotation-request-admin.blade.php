<!DOCTYPE html>
<html>

<head>
    <title>Qutation Request</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Barlow', sans-serif;
            font-weight: 400;
        }
    </style>

</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <div style="margin:auto; width:600px;background: #ffffff;">
        <table id="Table_01" width="600" border="0" cellpadding="0" cellspacing="0" align="center">
            <thead>
                <tr>
                    <td style="padding: 0px 0px 0px;">
                        <table width="600" style="margin: auto; background: #E7151F; height: 35px;">
                            <tbody>
                                <tr>
                                    <td style="background: #E7151F; padding: 0px;">
                                        <table width="565" style="margin: auto;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 0px;">
                                                        <h1
                                                            style="color: #ffffff; font-size: 18px; font-weight: 400; text-align: center; padding: 0 0 0px;margin: 0;">
                                                            Qutation Request</h1>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:center;padding-top:35px; padding-bottom: 30px;">
                        <a style="display: block; width: 208px; margin: auto;" href="" target="_blank"
                            data-saferedirecturl="">
                            <img src="{{ Storage::disk('public')->exists(\App\Helpers\AdminHelper::getValueByKey('website_logo')) ? Storage::url(\App\Helpers\AdminHelper::getValueByKey('website_logo')) : asset(\App\Helpers\AdminHelper::getValueByKey('website_logo')) }}"
                                width="208" height="124">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 110px 0px;">
                        <table width="380" style="margin: auto; text-align: center;">
                            <tbody>
                                <tr>
                                    <td style="padding: 0px 0 50px;">
                                        <h1
                                            style="color: #E7151F; font-size: 20px; font-weight: 600; text-align: center; padding: 0 0 10px;margin: 0;">
                                            Hi Admin</h1>
                                        <p
                                            style="text-align: center; margin: auto; width: 300px; font-size: 14px; font-weight: 400; color: #272525; line-height: 26px; margin-top:0px; margin-bottom: 0px;">
                                            You have received a Quotation Request
                                            <br>
                                            Order #{{ $quotation->uid }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 17px 0px;">
                        <table width="565" style="margin: auto; background: #E7151F; height: 30px;">
                            <tbody>
                                <tr>
                                    <td style="background: #E7151F; padding: 0px;">
                                        <table width="565" style="margin: auto;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 0px;">
                                                        <h1
                                                            style="color: #ffffff; font-size: 14px; font-weight: 400; text-align: center; padding: 0 0 0px;margin: 0;">
                                                            Order Id: #{{ $quotation->uid }}</h1>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 17px 0px;">
                        <table width="565" style="margin: auto; background: #ffffff; height: 30px;">
                            <tbody>
                                <tr>
                                    <td style="background: #ffffff; border-radius: 5px;padding: 23px 0 20px;">
                                        <table width="565" style="margin: auto;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 0px;">
                                                        <p
                                                            style="font-size: 14px;color: #E7151F; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 10px; text-align: center;">
                                                            Request received
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 37px 0px;">
                        <table width="525" style="margin: auto; background: #ffffff;">
                            <tbody>
                                <tr>
                                    <td style="background: #ffffff; padding: 0px 0 0px 0px;">
                                        <table style="width: 100%;">
                                            <thead style="background: #000000; padding: 0px 0 0px 0px;">
                                                <tr>
                                                    <td style="margin: 0px; text-align: center">
                                                        <table style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th
                                                                        style="width: 15%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                        Product Name
                                                                    </th>
                                                                    <th
                                                                        style="width: 10%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                        Product Code
                                                                    </th>
                                                                    <th
                                                                        style="width: 18%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                        Specification
                                                                    </th>
                                                                    <th
                                                                        style="width: 7%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                        Qty
                                                                    </th>
                                                                    <th
                                                                        style="width: 10%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                        Price
                                                                    </th>
                                                                    <th
                                                                        style="width: 10%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                        Bid Price
                                                                    </th>
                                                                    <th
                                                                        style="width: 15%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                        Total
                                                                    </th>
                                                                    <th
                                                                        style="width: 15%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                        Total Bid Price
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody style="background: #ffffff; padding: 0px 0 0px 0px;">
                                                <tr>
                                                    <td
                                                        style="margin: 0px; text-align: center; padding-top: 15px; padding-bottom: 20px;">
                                                        @foreach ($quotation->quotationDetails as $quotation_detail)
                                                            <table
                                                                style="width: 100%; height: 40px; border:1px solid #E2E2E2;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td
                                                                            style="width: 15%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                            {{ $quotation_detail->product->title }}
                                                                        </td>
                                                                        <td
                                                                            style="width: 10%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                            {{ $quotation_detail->product->product_code }}
                                                                        </td>
                                                                        <td
                                                                            style="width: 18%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                            {{ $quotation_detail->product->specification }}
                                                                        </td>
                                                                        <td
                                                                            style="width: 7%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                            {{ $quotation_detail->quantity }}
                                                                        </td>
                                                                        <td
                                                                            style="width: 10%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                            $ @formattedPrice($quotation_detail->price)
                                                                        </td>
                                                                        <td
                                                                            style="width: 10%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                            $ @formattedPrice($quotation_detail->bid_price)
                                                                        </td>
                                                                        <td
                                                                            style="width: 15%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                            $ @formattedPrice($quotation_detail->total_price)
                                                                        </td>
                                                                        <td
                                                                            style="width: 15%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                            $ @formattedPrice($quotation_detail->total_bid_price)
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 20px 0px;">
                        <table width="565" style="padding: 0px 0px 0px; border-bottom: 1px solid #F4F4F4;">
                            <tr>
                                <td style="padding: 0px 17px 0px;">
                                    <table width="525"
                                        style="padding: 15px 0 30px; margin: auto; background: #ffffff;" border="0"
                                        cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td style="margin: 0px; text-align: left;">
                                                    <p
                                                        style="font-size: 14px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                        Total
                                                    </p>
                                                </td>
                                                <td style="margin: 0px; text-align: right;">
                                                    <p
                                                        style="font-size: 12px;color: #031717; font-weight: 700; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: right;">
                                                        $ @formattedPrice($quotation->total_price)
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin: 0px; text-align: left;">
                                                    <p
                                                        style="font-size: 14px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                        Total Bid Price
                                                    </p>
                                                </td>
                                                <td style="margin: 0px; text-align: right;">
                                                    <p
                                                        style="font-size: 12px;color: #031717; font-weight: 700; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: right;">
                                                        $ @formattedPrice($quotation->total_bid_price)
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
            @if ($siteSettings->copy_right)
                <tfoot>
                    <tr>
                        <td style="padding: 0px 0px 0px;">
                            <table width="600" style="margin: auto; background: #000000; height: 35px;">
                                <tbody>
                                    <tr>
                                        <td style="background: #000000; padding: 0px;">
                                            <table width="565" style="margin: auto;">
                                                <tbody>
                                                    <tr>
                                                        <td style="padding: 0px;">
                                                            <p
                                                                style="color: #ffffff; font-size: 14px; font-weight: 400; text-align: center; padding: 0 0 0px;margin: 0;">
                                                                {{ $siteSettings->copy_right }}</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</body>

</html>

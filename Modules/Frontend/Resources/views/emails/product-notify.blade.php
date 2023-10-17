
<!DOCTYPE html>
<html>

<head>
    <title>Product Notification</title>
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
                                                           Product Nitification</h1>
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
                    <td style="text-align:center;padding-top:35px; padding-bottom: 37px;">
                        <a style="display: block; width: 208px; margin: auto;" href="" target="_blank"
                            data-saferedirecturl="">
                            <img src="@getEmailLogo()" width="208"
                                height="124">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 80px 0px;">
                        <table width="445" style="margin: auto; text-align: center;">
                            <tbody>
                                <tr>
                                    <td style="padding: 0px 0 50px;">
                                        <h1
                                            style="color: #E7151F; font-size: 20px; font-weight: 600; text-align: center; padding: 0 0 10px;margin: 0;">
                                            This Product is InStock</h1>
                                        <p
                                            style="text-align: center; font-size: 14px; font-weight: 400; color: #272525; line-height: 26px; margin-top:0px; margin-bottom: 0px;">
                                           Hi {{$data->user->name}}
                                        </p>
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
                                                    <td style="margin: 0px; text-align: center; padding: 0 20px;">
                                                        <table style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th
                                                                        style="width: 20%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                                        Product Code
                                                                    </th>
                                                                    <th
                                                                        style="width: 20%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                                        Product Name
                                                                    </th>
                                                                    <th
                                                                        style="width: 20%; font-size: 14px;color: #ffffff; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: right;">
                                                                        Stock
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
                                                        style="margin: 0px; text-align: center; padding-top: 15px; padding-bottom: 50px;">
                                                        <table
                                                            style="padding: 0 20px; width: 100%; height: 40px; border:1px solid #E2E2E2;">
                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        style="width: 20%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                                        {{$data->product->product_code}}
                                                                    </td>
                                                                    <td
                                                                        style="width: 20%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                                        {{$data->product->title}}
                                                                    </td>
                                                                    <td
                                                                        style="width: 20%; font-size: 14px;color: #E7151F; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: right;">
                                                                        In Stock
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
                            </tbody>
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

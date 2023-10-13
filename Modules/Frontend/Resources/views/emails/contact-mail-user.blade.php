<!DOCTYPE html>
<html>

<head>
    <title>Contact Mail</title>
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
                                                            welcome to Al Masar Al Saree</h1>
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
                    <td style="text-align:center;padding-top:60px; padding-bottom: 95px;">
                        <a style="display: block; width: 208px; margin: auto;" href=""
                            target="_blank" data-saferedirecturl="">
                            <img src="{{ url(\App\Helpers\AdminHelper::getValueByKey('website_logo')) }}" width="208"
                                height="124">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 110px 0px;">
                        <table width="380" style="margin: auto; text-align: center;">
                            <tbody>
                                <tr>
                                    <td style="padding: 0px 0 85px;">
                                        <h1
                                            style="color: #E7151F; font-size: 20px; font-weight: 600; text-align: center; padding: 0 0 10px;margin: 0;">
                                            Contact Mail</h1>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 110px 0px;">
                        <table width="380" style="margin: auto; padding: 0 0px 0;">
                            <tbody>
                                <tr>
                                    <td style="background: #ffffff; border-radius: 5px;padding: 0px 0 0;">
                                        <table width="380" style="margin: auto;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 0px 0 35px;">
                                                        <h1
                                                            style="color: #E7151F; text-transform: uppercase; font-size: 14px; font-weight: 500; text-align: center; padding: 0 0 15px;margin: 0;">
                                                            Name</h1>
                                                        <p
                                                            style="text-align: center; margin: auto; width: 285px; font-size: 14px; font-weight: 400; color: #444444; line-height: 26px; margin-top:0px; margin-bottom: 0px;">
                                                          {{$contact_enquiry->name}}
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0px 0 35px;">
                                                        <h1
                                                            style="color: #E7151F; text-transform: uppercase; font-size: 14px; font-weight: 500; text-align: center; padding: 0 0 15px;margin: 0;">
                                                            Email</h1>
                                                        <p
                                                            style="text-align: center; margin: auto; width: 285px; font-size: 14px; font-weight: 400; color: #444444; line-height: 26px; margin-top:0px; margin-bottom: 0px;">
                                                          {{$contact_enquiry->email}}
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0px 0 35px;">
                                                        <h1
                                                            style="color: #E7151F; text-transform: uppercase; font-size: 14px; font-weight: 500; text-align: center; padding: 0 0 15px;margin: 0;">
                                                            Phone</h1>
                                                        <p
                                                            style="text-align: center; margin: auto; width: 285px; font-size: 14px; font-weight: 400; color: #444444; line-height: 26px; margin-top:0px; margin-bottom: 0px;">
                                                          {{$contact_enquiry->phone}}
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0px 0 35px;">
                                                        <h1
                                                            style="color: #E7151F; text-transform: uppercase; font-size: 14px; font-weight: 500; text-align: center; padding: 0 0 15px;margin: 0;">
                                                            Subject</h1>
                                                        <p
                                                            style="text-align: center; margin: auto; width: 285px; font-size: 14px; font-weight: 400; color: #444444; line-height: 26px; margin-top:0px; margin-bottom: 0px;">
                                                          {{$contact_enquiry->subject}}
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0px 0 35px;">
                                                        <h1
                                                            style="color: #E7151F; text-transform: uppercase; font-size: 14px; font-weight: 500; text-align: center; padding: 0 0 15px;margin: 0;">
                                                            Message</h1>
                                                        <p
                                                            style="text-align: center; margin: auto; width: 285px; font-size: 14px; font-weight: 400; color: #444444; line-height: 26px; margin-top:0px; margin-bottom: 0px;">
                                                          {{$contact_enquiry->message}}
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        @if ($siteSettings->phone && $siteSettings->email)
                                        <table width="380" border="0" cellpadding="0" cellspacing="0"
                                            style="margin: auto; padding-top: 0px; padding-bottom: 0px; margin-top: 0px;">
                                            <tbody>
                                                <tr>
                                                    <td
                                                        style="margin: 0px; text-align: right; width:100%; padding: 0 0 55px;">
                                                        <table style="width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    @if ($siteSettings->phone)
                                                                        <td style="width: 33.3%;">
                                                                            <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td
                                                                                            style="width: 26px; text-align: right; padding: 0px;">
                                                                                            <img src="https://ux.intersmarthosting.in/Mailers/AlMasar/images/ic-01.png"
                                                                                                width="26"
                                                                                                height="26"
                                                                                                style="object-fit: contain;">
                                                                                        </td>
                                                                                        <td
                                                                                            style="padding-left: 15px; padding-right: 0px; font-size: 13px; color: #2f2f2f; font-weight: 400; margin: 0px; text-align: left;">
                                                                                            <a href="tel:{{ @$siteSettings->converted_phone_number }}"
                                                                                                style="display: block; text-decoration: none; font-size: 14px; color: #444444; font-weight: 400; margin: 0px; text-align: left;">
                                                                                                Call us
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    @endif
                                                                    @if ($siteSettings->email)
                                                                        <td style="width: 33.3%;">
                                                                            <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td
                                                                                            style="width: 26px; padding: 0px;">
                                                                                            <img src="https://ux.intersmarthosting.in/Mailers/AlMasar/images/ic-03.png"
                                                                                                width="26"
                                                                                                height="26"
                                                                                                style="object-fit: contain;">
                                                                                        </td>
                                                                                        <td
                                                                                            style="padding-left: 15px; padding-right: 0px; font-size: 13px; color: #2f2f2f; font-weight: 400; margin: 0px; text-align: right;">
                                                                                            <a href="mailto:{{@$siteSettings->email}}"
                                                                                                style="display: block; text-decoration: none; font-size: 14px; color: #444444; font-weight: 400; margin: 0px; text-align: right;">
                                                                                                Send Email
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
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
                                                            © All Rights Reserved Al Masar Al Saree 2023</p>
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
        </table>
    </div>
</body>

</html>


@extends('Notifications.email')
<!-- pre-header -->
@section('content')
<table style="display:none!important;">
    <tr>
        <td>
            <div style="overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;">
                Pre-header for the newsletter template
            </div>
        </td>
    </tr>
</table>
<!-- pre-header end -->
<!-- header -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">

    <tr>
        <td align="center">
            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                <tr>
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">

                        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                            <tr>
                                <td align="center" height="70" style="height:70px;">

                                    {{--<a href="" style="display: block; border-style: none !important; border: 0 !important;">--}}
                                        {{--<img width="100" border="0" style="display: block; width: 100px;" src="https://mdbootstrap.com/img/logo/mdb-email.png" alt="" /></a>--}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                </tr>

            </table>
        </td>
    </tr>
</table>
<!-- end header -->

<!-- big image section -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

    <tr>
        <td align="center">
            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                <tr>

                    <td align="center" class="section-img">
                        <a href="" style=" border-style: none !important; display: block; border: 0 !important;"><img src="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img (67).jpg" style="display: block; width: 590px;" width="590" border="0" alt="" /></a>

                    </td>
                </tr>
                <tr>
                    <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">


                        <div style="line-height: 35px">

                            NEW  <span style="color: #5caad2;">Campaign</span>

                        </div>
                    </td>
                </tr>

                <tr>
                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">
                        <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                            <tr>
                                <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">
                        <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                            <tr>
                                <td align="center" style="color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">


                                    <div style="line-height: 24px">

                                        Campaign description goes here...
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">
                        <table border="0" align="center" width="160" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="">

                            <tr>
                                <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="center" style="color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;">


                                    <div style="line-height: 26px;">
                                        <a href="" style="color: #ffffff; text-decoration: none;">Goto the Page</a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                            </tr>

                        </table>
                    </td>
                </tr>


            </table>

        </td>
    </tr>

</table>
<!-- end section -->

<!-- contact section -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

    <tr class="hide">
        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
    </tr>
    <tr>
        <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
    </tr>

    <tr>
        <td height="60" style="border-top: 1px solid #e0e0e0;font-size: 60px; line-height: 60px;">&nbsp;</td>
    </tr>

    <tr>
        <td align="center">
            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590 bg_color">

                <tr>
                    <td>
                        <table border="0" width="300" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                            <tr>
                                <!-- logo -->
                                <td align="left">
                                    <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="80" border="0" style="display: block; width: 80px;" src="{{asset('/images/fann.png')}}" alt="" /></a>
                                </td>
                            </tr>

                            <tr>
                                <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="left" style="color: #888888; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 23px;" class="text_color">
                                    <div style="color: #333333; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">

                                        Email us: <br/> <a href="mailto:" style="color: #888888; font-size: 14px; font-family: 'Hind Siliguri', Calibri, Sans-serif; font-weight: 400;">contact@fann.io</a>

                                    </div>
                                </td>
                            </tr>

                        </table>

                        <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                            <tr>
                                <td width="2" height="10" style="font-size: 10px; line-height: 10px;"></td>
                            </tr>
                        </table>

                        <table border="0" width="200" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                            <tr>
                                <td class="hide" height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td>
                            </tr>



                            <tr>
                                <td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td>
                            </tr>

                            <tr>
                                <td>
                                    <table border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>
                                                <a href="#" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Qc3zTxn.png" alt=""></a>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <a href="#" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/RBRORq1.png" alt=""></a>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <a href="#" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Wji3af6.png" alt=""></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td>
    </tr>

</table>
<!-- end section -->

<!-- footer ====== -->
<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f4f4">

    <tr>
        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
    </tr>

    <tr>
        <td align="center">

            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                <tr>
                    <td>
                        <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                            <tr>
                                <td align="left" style="color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                    <div style="line-height: 24px;">

                                        <span style="color: #333333;">Fann.io</span>

                                    </div>
                                </td>
                            </tr>
                        </table>

                        <table border="0" align="left" width="5" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                            <tr>
                                <td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                            </tr>
                        </table>

                        <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                            <tr>
                                <td align="center">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td align="center">
                                                <a style="font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;color: #5caad2; text-decoration: none;font-weight:bold;" href="#">UNSUBSCRIBE</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>

            </table>
        </td>
    </tr>

    <tr>
        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
    </tr>

</table>

@endsection

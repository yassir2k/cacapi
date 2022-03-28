<!DOCTYPE html>
<body>
    <div style="background-color:green; width:auto">
        <center>
            <b style="font-family:Century Gothic; color:white; font-size: 36px">Corporate Affairs Commission</b>
            <img src="{{ Request::root() }}/public/images/cac-logo.png" alt="cac logo" />
        </center>
    </div>
    <br />
    <div style="border-bottom:2px solid green">
        <p><strong style="font-family:Century Gothic; color:green; font-size: 18px">API Portal</strong></p>
    </div>
    <div style="background-color:#f5f5f5">
    <br />
        <p style="text-indent :5em;"> Dear <b>{{ $organization_ }}</b>,</p>
        <p style="text-indent :5em;">You initiated a user account registration process on the Corporate Affairs Commission (CAC) API Portal.</p>
        <p style="text-indent :5em;"> Click the link below to verify your email.</p>
        <p style="text-indent :5em;"><a href="{{ route('verify', ['token' => $token_ ]) }}"> Click here</a></p>
        <br />
        <p style="text-indent :5em;">Regards,</p>
        <p style="text-indent :5em;"><b>Yassir Yahaya</b></p>
        <p style="text-indent :5em;"><i>System Administrator</i></p>
    </br />
    </div>
</body>
</html>
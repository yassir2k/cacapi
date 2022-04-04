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
        <p style="text-indent :5em;"> <b>Attention:  {{ $contactName_ }}</b></p>
        <p style="text-indent :5em;">We write to kindly notify you that your API account has been reactivated on <b>{{$time_}}</b>.</p>
        <p style="text-indent :5em;">Please be informed that your login credentials still remains the same.</p>
        <p style="text-indent :5em;">You can proceed to the login page should you want to access your portal, or </p>
        <p style="text-indent :5em;">access the API as described in the user manual issued to you. </p>
        <br />
        <p style="text-indent :5em;">Regards,</p>
        <p style="text-indent :5em;"><b>Yassir Yahaya</b></p>
        <p style="text-indent :5em;"><i>System Administrator</i></p>
    </br />
    </div>
</body>
</html>
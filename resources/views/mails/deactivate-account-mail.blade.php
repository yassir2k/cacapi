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
        <p style="text-indent :5em;">We write to kindly notify you that your API account has been blocked on <b>{{$time_}}</b>.</p>
        <p style="text-indent :5em;">It is possible that your deactivation was as a result of suspicious activities coming from your account.</p>
        <p style="text-indent :5em;">To reactivate your account, please contact the CAC Team via email.</p>
        <br />
        <p style="text-indent :5em;">Regards,</p>
        <p style="text-indent :5em;"><b>Yassir Yahaya</b></p>
        <p style="text-indent :5em;"><i>System Administrator</i></p>
    </br />
    </div>
</body>
</html>
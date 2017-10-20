
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Untitled Document</title>
</head>

<body>
<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td height="100" style="background-color:#eeeeee; border-top:solid 10px #333333">
            <img src="<?php echo $this->localization->profile('logo') ?>">
        </td>
    </tr>
    <tr>
        <td height="31" valign="top" style="padding:20px">
            <br/>
            <br/>
            <?php if(!empty($campaign->email_body)) echo $campaign->email_body  ?>
            <br/>
            <br/>
        </td>
    </tr>
    <tr>
        <td height="50" style="background-color:#eeeeee; border-bottom:solid 5px #333333; text-align:center; font-size:12px; color:#666">
            <strong><?php echo $this->localization->profile('company_name') ?></strong>&nbsp;&nbsp;&nbsp;<?php echo $this->localization->profile('address') ?>
        </td>
    </tr>
</table>
</body>
</html>

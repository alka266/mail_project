<?php 
$name=addslashes($_POST['name']);
$email=addslashes($_POST['email']);
$contact=addslashes($_POST['contact']);
$message=addslashes($_POST['message']);

$from = 'MIME-Version: 1.0' . "\r\n";
$from.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$from.= 'From: <'.$email.'>' . "\r\n";

$to2="alkamishra61293@gmail.com";

$subject="There is a query on Alka Blog";

$body =' <div align="center">  
 <table border="0" cellspacing="0" cellpadding="0" width="600">  
 <tbody>  
 <tr>  
 <td valign="top" align="center" style="border:#222 solid 8px">  
 <table border="0" cellspacing="0" cellpadding="0" width="593">  
 <tbody>  
 <tr>  
 <td valign="top" style="color: white;background: green;height: 100px;padding-top: 35px;font-size: 20px;padding-left: 15px;font-weight: bold;">Alka Mishra</td>  
 </tr>  
 <tr>  
 <td></td>  
 </tr>  
 <tr>  
 <td valign="top">  
 <div align="center">  
 <table border="0" cellspacing="0" cellpadding="0" width="529" style="background-color:#fff">  
 <tbody>  
 <tr>  
 <td valign="top">&nbsp;</td>  
 </tr>  
 <tr>  
 <td valign="top">&nbsp;</td>  
 </tr>  
 <tr>  
 <td valign="top" style="font-size:14px;color:#333">Dear <span style="font-weight:bold;color:green">Alka</span>,</td>  
 </tr>  
 <tr>  
 <td valign="top">&nbsp;</td>  
 </tr>  
 <tr>  
 <td valign="top" style="font-size:14px;color:#333">A user has submitted form with the following details:</td>  
 </tr>  
 <tr>  
 <td valign="top">&nbsp;</td>  
 </tr>  
 <tr>  
 <td valign="top">  
 <table border="0" cellspacing="0" cellpadding="0" width="100%">  
 <tbody>  
 <tr>  
 <td width="155" height="22" align="left" valign="top" bgcolor="green" style="padding-left:10px;font-size:14px;color:#fff;padding-top:3px;padding-bottom:3px">Name :</td>  
 <td width="3" height="22" align="left" valign="top"></td>  
 <td height="22" align="left" valign="top" bgcolor="#CCCCCC" style="font-size:14px;color:#333;padding:3px 10px 5px 10px">' . $_POST['name'] . '</td>  
 </tr>  
 <tr bgcolor="#FFFFFF" align="left" valign="top">  
 <td colspan="3" align="left"><img src="http://i.imgur.com/dgsBwxL.gif" alt="" width="1" height="3" border="0"></td>  
 </tr>  
 <tr>  
 <td width="155" height="22" align="left" valign="top" bgcolor="green" style="padding-left:10px;font-size:14px;color:#fff;padding-top:3px;padding-bottom:3px">Email id :</td>  
 <td width="3" height="22" align="left" valign="top"></td>  
 <td height="22" align="left" valign="top" bgcolor="#CCCCCC" style="font-size:14px;color:#333;padding:3px 10px 5px 10px">' . $_POST['email'] . '</td>  
 </tr>  
 <tr bgcolor="#FFFFFF" align="left" valign="top">  
 <td colspan="3" align="left"><img src="http://i.imgur.com/dgsBwxL.gif" alt="" width="1" height="3" border="0"></td>  
 </tr>  
 <tr>  
 <td width="155" height="22" align="left" valign="top" bgcolor="green" style="padding-left:10px;font-size:14px;color:#fff;padding-top:3px;padding-bottom:3px">Phone :</td>  
 <td width="3" height="22" align="left" valign="top"></td>  
 <td height="22" align="left" valign="top" bgcolor="#CCCCCC" style="font-size:14px;color:#333;padding:3px 10px 5px 10px">' . $_POST['contact'] . '</td>  
 </tr>  
 <tr bgcolor="#FFFFFF" align="left" valign="top">  
 <td colspan="3" align="left"><img src="http://i.imgur.com/dgsBwxL.gif" alt="" width="1" height="3" border="0"></td>  
 </tr>  
 <tr>  
 <td width="155" height="22" align="left" valign="top" bgcolor="green" style="padding-left:10px;font-size:14px;color:#fff;padding-top:3px;padding-bottom:3px">Message :</td>  
 <td width="3" height="22" align="left" valign="top"></td>  
 <td height="22" align="left" valign="top" bgcolor="#CCCCCC" style="font-size:14px;color:#333;padding:3px 10px 5px 10px">' . $_POST['message'] . '</td>  
 </tr>  
 <tr bgcolor="#FFFFFF" align="left" valign="top">  
 <td colspan="3" align="left"><img src="http://i.imgur.com/dgsBwxL.gif" alt="" width="1" height="3" border="0"></td>  
 </tr>  
 </tbody>  
 </table>  
 </td>  
 </tr>  
 <tr bgcolor="#FFFFFF" align="left" valign="top">  
 <td colspan="3" align="left"><img src="http://i.imgur.com/dgsBwxL.gif" alt="" width="1" height="3" border="0"></td>  
 </tr>  
 <tr>  
 <td height="50" align="left" valign="top" style="font-size:14px;color:#333;padding-top: 15px;"><strong>Thanks,</strong><br><strong>Alka Mishra</strong></td>  
 </tr>  
 <tr>  
 <td valign="top"></td>  
 </tr>  
 </tbody>  
 </table></div>  
 </td>  
 </tr>  
 <tr>  
 <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>  
 </tr>  
 <tr>  
 <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>  
 </tr>  
 <tr>  
 <td height="25" align="center" valign="middle" bgcolor="#222222" style="color:#fff;font-size:12px;font-style:normal;font-weight:normal;padding-top:6px">Copyright © 2018-2019 Alka Mishra. All rights reserved.</td>  
 </tr>  
 </tbody>  
 </table>  
 </td>  
 </tr>  
 </tbody>  
 </table></div>'; 


mail($to2,$subject,$body,$from);

/// mail to customer

$to=$email;
$subject="Thanks for Contacting Alka Mishra";

 $body = '<div align="center">  
 <table border="0" cellspacing="0" cellpadding="0" width="600">  
 <tbody>  
 <tr>  
 <td valign="top" align="center" style="border:#222 solid 8px">  
 <table border="0" cellspacing="0" cellpadding="0" width="593">  
 <tbody>  
 <tr>  
 <td valign="top" style="color: white;background: green;height: 100px;padding-top: 35px;font-size: 20px;padding-left: 15px;font-weight: bold;">Alka Mishra</td>  
 </tr>  
 <tr>  
 <td></td>  
 </tr>  
 <tr>  
 <td valign="top">  
 <div align="center">  
 <table border="0" cellspacing="0" cellpadding="0" width="529" style="background-color:#fff">  
 <tbody>  
 <tr>  
 <td valign="top">&nbsp;</td>  
 </tr>  
 <tr>  
 <td valign="top">&nbsp;</td>  
 </tr>  
 <tr>  
 <td valign="top" style="font-size:14px;color:#333">Dear <span style="font-weight:bold;color:green">' . $_POST['name'] . '</span>,</td>  
 </tr>  
 <tr>  
 <td valign="top">&nbsp;</td>  
 </tr>  
 <tr>  
 <td valign="top" style="font-size:14px;color:#333">Thank you for contacting Bhawesh Bhaskar. He will get in touch with you soon.</td>  
 </tr>  
 <tr>  
 <td valign="top">&nbsp;</td>  
 </tr>  
 <tr>  
 <td valign="top">  
 </td>  
 </tr>  
 <tr bgcolor="#FFFFFF" align="left" valign="top">  
 <td colspan="3" align="left"><img src="http://i.imgur.com/dgsBwxL.gif" alt="" width="1" height="3" border="0"></td>  
 </tr>  
 <tr>  
 <td height="50" align="left" valign="top" style="font-size:14px;color:#333"><strong>Thanks,</strong><br> <strong>Alka Mishra</strong></td>  
 </tr>  
 <tr>  
 <td valign="top"></td>  
 </tr>  
 </tbody>  
 </table></div>  
 </td>  
 </tr>  
 <tr>  
 <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>  
 </tr>  
 <tr>  
 <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>  
 </tr>  
 <tr>  
 <td height="25" align="center" valign="middle" bgcolor="#222222" style="color:#fff;font-size:12px;font-style:normal;font-weight:normal;padding-top:6px">Copyright © 2018-2019 Alka Mishra. All rights reserved.</td>  
 </tr>  
 </tbody>  
 </table>  
 </td>  
 </tr>  
 </tbody>  
 </table></div>'; 



$from = 'MIME-Version: 1.0' . "\r\n";
$from.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$from.= 'From: <no-reply@alka.ctd@gmail.com>' . "\r\n";

 $mail =mail($to,$subject,$body,$from);
if ($mail == true){

echo "Thankypu for Contacting Alka Mishra";
}
?>
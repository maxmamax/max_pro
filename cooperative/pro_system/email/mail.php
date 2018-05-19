<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">

body {
margin-left: 0px;
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
}

</style></head>

<body>
<form id="form1" name="form1" method="post" action="send_mail.php">
<table width="415" border="0" cellspacing="1" cellpadding="1">
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="179">ชื่อ-นามสกุลผู้ส่ง</td>
<td width="229"><label>
<input name="name" type="text" id="name" />
</label></td>
</tr>
<tr>
<td>อีเมล์ผู้ส่ง</td>
<td><label>
<input name="sender" type="text" id="sender" />
</label></td>
</tr>
<tr>
<td>หัวข้อ</td>
<td><label>
<input name="header" type="text" id="header" />
</label></td>
</tr>
<tr>
<td valign="top">ข้อความ</td>
<td><label>
<textarea name="messages" cols="30" rows="5" wrap="virtual" id="messages"></textarea>
</label></td>
</tr>
<tr>
<td colspan="2"><div align="center">
<label>
<input type="submit" name="Submit" value="send mail" />
</label>
</div></td>
</tr>
</table>
</form>
</body>
</html>

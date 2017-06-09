<?php
   if(isset($_POST["send"])){
     //print_r($_POST);
     $from = $_POST["from"];
     $to = $_POST["to"];
     $subject = $_POST["subject"];
     $message = $_POST["message"];
     $_SESSION["from"] = $from;
     $_SESSION["to"] = $to;
     $_SESSION["subject"] = $subject;
     $_SESSION["message"] = $message;
     $error_from = "";
     $error_to = "";
     $error_subject = "";
     $error_message = "";
     $error = FALSE;
     
     if (!preg_match("/^[a-z0-9][a-z0-9\.-_]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i", $to)) {
     $error_to = "Некорректный e-mail";
     $error = FALSE;
   }
     if (strlen($subject) == 0){
     $error_subject = "Не написана тема";
     $error = FALSE;
     }
     if (strlen($message) == 0){
     $error_message = "Не написано сообщение";
     $error = FALSE;
     }
     if ($error){
     $subject = "=?utf-8?B?".base64_encode($subject)."=?";
     $headers = "From: $from\r\Reply-to: $from\r\nContent-type: text/plain; charset=windows-1251\r\n";
     mail($to, $subject, $message, $headers);
     header("Location: success.php?send=1");
     exit;
     }
 
 
 
   }
 
?>
 
<html>
<head>
   <title>Сервис рассылки</title>
</head>
<body>
   <h1>Отправьте почту!</h1>
   <form name="myform" action="index.php" method="post">
     <table>
       <tr>
         <td>От кого</td>
         <td>
         <input type="text" name="from" value="<?php $_SESSION["from"];?>">
         </td>
         <td>
           <span style="color: red;"><?php echo $error_from;?></span>
         </td>
       </tr>
       <tr>
         <td>Кому</td>
         <td>
         <input type="text" name="to value="<?php $_SESSION["to"];?>">
         </td>
         <td>
           <span style="color: red;"><?php echo $error_to;?></span>
         </td>
       </tr>
       <tr>
         <td>Тема</td>
         <td>
         <input type="text" name="subject" value="<?php $_SESSION["subject"];?>">
         </td>
         <td>
           <span style="color: red;"><?php echo $error_subject;?></span>
         </td>
       </tr>
       <tr>
         <td>Сообщение</td>
         <td>
         <textarea name="message" cols="15" rows="10"><?php $_SESSION["message"];?></textarea>
         </td>
         <td>
           <span style="color: red;"><?php echo $error_message;?></span>
         </td>
       </tr>
         <tr>
         <td colspan="3">
         <input type="submit" name="send" value="Отправить">
         </td>
       </tr>
     </table>
   </form>
</body>
</html>
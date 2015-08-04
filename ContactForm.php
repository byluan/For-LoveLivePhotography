<div style="color: red;">
<?php
if ($_POST["hidSubmit"]=="Y"){
$errors = array();
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email']; 
$phone = $_POST['phone']; 
$date = $_POST['date']; 
$time = $_POST['time']; 
$AmPm = $_POST['AmPm']; 
$guest = $_POST['guest']; 
$location = $_POST['location']; 
$video = $_POST['video']; 
$photo = $_POST['photo']; 
$typeevent = $_POST['typeevent'];
$comment = $_POST['comment'];

//---Error message if Required questions are left blank---
if (empty($_POST["fname"])==true||empty($_POST["lname"])==true||empty($_POST["email"])==true||empty($_POST["phone"])==true||
        empty($_POST["date"])==true) { 
		$errors[] = 'REQUIRE: Name, Email, Phone Number, Date of Event';}
//---First Name Validation---
		else{ 
                    if(ctype_alpha($_POST["fname"])==false) {
                    $errors[] = 'Name MUST only contain letters';}
//---Last Name Validation---
		  if(ctype_alpha($_POST["lname"])==false) {
                    $errors[] = 'Name MUST only contain letters';}	
//---Email Validation---	
		  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){			     
                    $errors[] = 'That\'s not a valid email address';} 
//---Phone Number Validation---
		  if(ctype_digit($_POST["phone"])=== false) {
                    $errors[] = "Phone number MUST only contain number";} 

//---Email form to Zak when submitted
}if(empty($errors)===true){
$to = "cerebro1000@gmail.com";
$subject .= "Lovelivephotography Contact Form";
$message .= "\nCLIENT INFO\n*Name: " . $fname. $lname;
$message .= "\n*Email: " . $email;
$message .= "\n*Phone Number: " . preg_replace('~.*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4}).*~', '($1) $2-$3', $phone);
$message .= "\n*Date of event: " . preg_replace('~.*(\d{2})[^\d]*(\d{2})[^\d]*(\d{4}).*~', '$1/$2/$3', $date); 
$message .= "\n\nTime of event: " . $time. " ".$AmPm;
$message .= "\nLocation: " . $location;
$message .= "\nNumber of Guests: " . $guest;
$message .= "\nPhotographers Needed: " . $photo;
$message .= "\nVideographers Needed: " . $video;
$message .= "\nEvent Type: " . $typeevent;
$message .= "\n\nMESSAGE \n" . $comment;
$headers = "From: $email";
$headers .= "\nReply-To: $email";
mail($to,$subject,$message,$headers);

//---Sends a Copy of the message to the sender---
$from = $email;
$subject2 = "THANK YOU! Zak Zatar of LoveLivePhotography recieved your message.";
$message2 = "We will get in touch with you as soon as we can.\n\n";
$message2 .="   -Zak Zatar\n";
$message2 .= "A COPY OF YOUR MESSAGE BELOW: \n\n" . $_POST['comment'];
$headers2 = "From:" . $to;
$headers2 .= "\nReply-To: lovelivephotography@yahoo.com";
mail($from,$subject2, $message2, $headers2);   

//---Send to Confirmation page after form is submitted
$url = 'http://www.lovelivephotography.com/?page_id=1176&preview=true';
    echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">'; 

     }
}
?>
<?php 
if (empty($errors) === false){
	echo '<ul>';
	foreach($errors as $error){
		echo '<li>', $error, '</li>';
		}
	echo '</ul>';	
	}  
?>    
</div>

<form method="POST" action="">
<input type="hidden" id="hidSubmit" name="hidSubmit" value="Y"/>
<b>First Name: </b><input type="text" id="fname" name="fname" <?php if (isset($_POST['fname']) === true){echo 'value="' , strip_tags ($_POST['fname']),'"';}?>/>*

<b>Last Name: </b><input type="text" id="lname" name="lname" <?php if (isset($_POST['lname']) === true){echo 'value="' , strip_tags ($_POST['lname']),'"';}?>/>*

<b>Email: </b><input type="email" id="email" name="email" <?php if (isset($_POST['email']) === true){echo 'value="',strip_tags($_POST['email']),'"';}?>/>*

<b>Phone: </b><input type="text" minlenth="10" maxlength="10" id="phone" name="phone" <?php if (isset($_POST['phone']) === true){echo 'value="' , strip_tags ($_POST['phone']) , '"';}?>/>*

<b>Date of Event: </b><input type="text" id="date" name="date" maxlength="10" size="11" <?php if (isset($_POST['date']) === true){echo 'value="' , strip_tags ($_POST['date']) , '"';}?>/>* mm/dd/yyyy

Time of Event: <input type="number" id="time" name="time" maxlength="5" size="5" <?php if (isset($_POST['time']) === true){echo 'value="' , strip_tags ($_POST['time']), '"';}?>/><input type="radio" name="AmPm" value="AM">AM <input type="radio" name="AmPm" value="PM">PM

Event Location: <input type="text" id="location" name="location" maxlength="40" size="40" <?php if (isset($_POST['location']) === true){echo 'value="' , strip_tags ($_POST['location']) , '"';}?>/>

Number of Guests: <input type="text" id="guest" name="guest" maxlength="20" size="12" <?php if (isset($_POST['guest']) === true){echo 'value="' , strip_tags ($_POST['guest']) , '"';}?>/>

Photographers:<select id="photo" name="photo">
  <option value="N/A">Need How Many</option>
  <option value="1">1</option>
  <option value="2">2</option>
  </select>
Videographers:
<select id="video" name="video">
  <option value="N/A">Need How Many</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>  
  </select>
Type of Event:<select id="typeevent" name="typeevent">
  <option value="N/A">Choose One</option>
  <option value="Engagement">Engagement</option>
  <option value="Birthday">Birthday</option>
  <option value="Wedding">Wedding</option>
  <option value="Quinceanera">Quincea&ntilde;era/ Sweet 15</option> 
  <option value="Life event">Life Event</option>
  <option value="Other">Other</option>
  </select>
MESSAGE:
<textarea id="comment" name="comment" rows="15" cols="75" maxlength="100"></textarea>
<input type="submit" value="Send"/>
</form>
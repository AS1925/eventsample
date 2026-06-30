<?php session_start();
include("includes/header.html");
?>
<h1> Contact Us</h1>
<form >
    <input type="text" placeholder="Name"><br><br>
    <input type="email" placeholder="Email"><br><br>
    <textarea placeholder="Message"></textarea><br><br>
    <button>Send</button>
</form>
<?php include("includes/footer.html");?>
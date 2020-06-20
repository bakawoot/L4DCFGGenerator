<?php
//check if user pressed the Generate button
if($_SERVER['REQUEST_METHOD']=='POST'){

    //if you add more input just increase this
    $cvar1 = (!empty($_POST['cvar1']) && is_numeric($_POST['cvar1']))?$_POST['cvar1']:die('Wrong parameter type');
    $cvar2 = (!empty($_POST['cvar2']) && is_numeric($_POST['cvar2']))?$_POST['cvar2']:die('Wrong parameter type');
    $cvar3 = (!empty($_POST['cvar3']) && is_numeric($_POST['cvar3']))?$_POST['cvar3']:die('Wrong parameter type');
    //and this.
    $content .= "async_allow_held_files $cvar1".PHP_EOL;
    $content .= "async_mode $cvar2".PHP_EOL;
    $content .= "blink_duration $cvar3".PHP_EOL;

    //Don't change this. this is where we generate the file
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-disposition: attachment; filename=autoexec.cfg');
    header('Content-Length: '.strlen($content));
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    header('Pragma: public');
    echo $content;
    exit;
}
?>
<html>
<head>
<title>Left 4 Dead config generator</title>
</head>
<body>

<h1>Left 4 Dead config generator</h1>

<!--this is where the form starts-->
<form action="" method="post">
  <input type="reset" value="Clear changes">

  <!--first cvar-->
  <p>async_allow_held_files
    <select name="cvar1">
      <option value="1" selected="selected">enabled</option>
      <option value="2">disabled</option>
    </select>
    Allow AsyncBegin/EndRead()
  </p>

  <!--second cvar-->
  <p>async_mode
    <select name="cvar2">
      <option value="1">enabled</option>
      <option value="2" selected="selected">disabled</option>
    </select>
    Set the async filesystem mode (0 = async, 1 = synchronous)
  </p>

  <!--third cvar-->
  <p>blink_duration
    <input type="text" name="cvar3" value="0.2">
    How many seconds an eye blink will last.
  </p>

  <!--Don't change this-->
  <p><input type="submit" value="Generate"></p>
</form>

<p>Drag the file onto the Left 4 Dead cfg folder.</p>

<a href="https://developer.valvesoftware.com/wiki/List_of_L4D_Cvars#A">
   <button>You can find all the L4D CVars here.</button>
</a>

</body>
</html>

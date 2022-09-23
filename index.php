<?php
require ("core/header.php");
?>
<?php
require ("core/nav.php");
?>
<?php
// main login code
if (isset($_POST['username'])) {
	if (false) {
	  $error = true;
	  $errormsg = "Captcha failed, please try again.";
	} else {
	  $ip_address = md5($_SERVER['REMOTE_ADDR']);
	  $error = false;
	  $errormsg = "";

	  $username = mysqli_real_escape_string($connect, $_POST['username']);
	  $password = mysqli_real_escape_string($connect, $_POST['password']);

	  $dbuserq = mysqli_query($connect, "SELECT * FROM users WHERE username='$username'") or die(mysqli_error($connect));

	  if (mysqli_num_rows($dbuserq) < 1) {
		$error = true;
		$errormsg = "That account doesn't exist. Login using a different account or create a new one.";
	  } else {
		$dbuser = mysqli_fetch_assoc($dbuserq);
		if (password_verify($password, $dbuser['password'])) {
		  $user = $dbuser;
		  $token = md5($username . $user['id'] . $ip_address . time() . rand(0, 1000));

		  $tokenq = mysqli_query($connect, "INSERT INTO `session_tokens`(`id`, `token`, `user_id`, `ip_address`)
		  VALUES
		  (NULL, '$token', '". $user['id'] ."','$ip_address')") or die(mysqli_error($connect));

		  setcookie("BT_AUTH", $token, time() + (60 * 60 * 24 * 7000), "/");

		  if (isset($_GET['ReturnUrl'])) {
			$loc = utf8_decode(urldecode($_GET['ReturnUrl']));

			header("Location: $loc");
		  } else {
			header("Location: /");
		  }
		} else {
		  $error = true;
		  $errormsg = "Password is incorrect.";
		}
	  }
	}


	if ($error) {
	  echo "<div style=\"color:red; text-align:center;\">
  $errormsg
  </div>";
	}
  }
?>
					
			
				<div id="Body">
	<div id="SplashContainer">
	<?php

if (!$isloggedin) {
  echo "<div id=\"SignInPane\">
  <div id=\"LoginViewContainer\">
			  <div id=\"LoginView\">
				  <h5>Member Login</h5>
  <div class=\"AspNet-Login\">
  <form method=\"POST\" action=\"\">
						  <div class=\"AspNet-Login\">
							  <div class=\"AspNet-Login-UserPanel\">
								  <label for=\"\" id=\"\" class=\"Label\">Character Name</label>
								  <input name=\"username\" type=\"text\" id=\"\" tabindex=\"1\" class=\"Text\"/>
							  </div>
							  <div class=\"AspNet-Login-PasswordPanel\">
								  <label for=\"\" id=\"\" class=\"Label\">Password</label>
								  <input name=\"password\" type=\"password\" id=\"\" tabindex=\"2\" class=\"Text\"/>
							  </div>
							  <!--div class=\"AspNet-Login-RememberMePanel\"-->
							  <!--/div-->
							  <div class=\"AspNet-Login-SubmitPanel\">
							  <button tabindex=\"3\" class=\"Button\" type=\"submit\" name=\"Login\">Login</button>
							  </div>
							  <div class=\"AspNet-Login-PasswordRecoveryPanel\">
								  <a id=\"\" tabindex=\"5\" href=\"Login/ResetPasswordRequest.html\">Forgot your password?</a>
							  </div>
						  </div>
  </div>
			  </div>
  </div>";
} else {
  echo "
  <div id=\"SignInPane\">
  <div id=\"LoginViewContainer\">
			  <div id=\"LoginView\">
				  <h5>Logged In</h5>
  <div class=\"AspNet-Login\">
						  <div class=\"AspNet-Login\">
							  <div class=\"AspNet-Login-UserPanel\">
								  <h5>Renders will be worked on.</h5>
							  </div>
						  </div>
  </div>
			  </div>
  </div>
	";
}

?>

			<div id="ctl00_cphRoblox_pFigure">
				<div id="Figure"><a id="ctl00_cphRoblox_ImageFigure" disabled="disabled" title="Figure" onclick="return false" style="display:inline-block;"><img src="https://www.goodblox.xyz/resources/figure1.png" border="0" id="img" alt="Figure" blankurl="http://t1.roblox.com:80/blank-115x130.gif"/></a></div>
</div>
		</div>
		<div id="RobloxAtAGlance">
			<h2><?=$sitename?> Virtual Playworld</h2>
			<h3><?=$sitename?> is Free!</h3>
			<ul id="ThingsToDo">
				<li id="Point1">
					<h3>Build your personal Place</h3>
					<div>Create buildings, vehicles, scenery, and traps with thousands of virtual bricks.</div>
				</li>
				<li id="Point2">
					<h3>Meet new friends online</h3>
					<div>Visit your friend's place, chat in 3D, and build together.</div>
				</li>
				<li id="Point3">
					<h3>Battle in the Brick Arenas</h3>
					<div>Play with the slingshot, rocket, or other brick battle tools.  Be careful not to get "bloxxed".</div>
				</li>
			</ul>
			<div id="Showcase">
				<!--embed style="width:400px; height:326px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId=2296704981611021533&hl=en" flashvars="" /-->
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="400" height="326" id="FLVPlayer">
					<param name="movie" value="FLVPlayer_Progressive.swf"/>
					<param name="salign" value="lt"/>
					<param name="quality" value="high"/>
					<param name="scale" value="noscale"/>
					<param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=http://content.roblox.com/ChristmasDemoFinal&amp;autoPlay=true&amp;autoRewind=true"/>
					<embed src="FLVPlayer_Progressive.swf" flashvars="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=http://content.roblox.com/ChristmasDemoFinal&amp;autoPlay=true&amp;autoRewind=true" quality="high" scale="noscale" width="400" height="326" name="FLVPlayer" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>    
				</object>
			</div>
			<div id="Install">
				<div id="CompatibilityNote"><div id="ctl00_cphRoblox_pCompatibilityNote">
	Works with your<br/>Windows PC!
</div></div>
				<div id="DownloadAndPlay"><a id="ctl00_cphRoblox_hlDownloadAndPlay" href="Login/New-aspx_ReturnUrl_/Games.html"><img src="images/DownloadAndPlay.png" alt="FREE - Download and Play!" border="0"/></a></div>
			</div>
			<div id="ctl00_cphRoblox_pForParents">
				<div id="ForParents">
					<a id="ctl00_cphRoblox_hlKidSafe" title="<?=$sitename?> is kid-safe!" href="Parents.html" style="display:inline-block;"><img title="<?=$sitename?> is kid-safe!" src="images/COPPASeal-150x150.png" border="0"/></a>
				</div>
</div>
		</div>
		<div id="UserPlacesPane">
			<div id="UserPlaces_Content">
				<table id="ctl00_cphRoblox_DataListCoolPlace" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="UserPlace">
						<a id="ctl00_cphRoblox_DataListCoolPlace_ctl00_rbxContentImage" title="Crossroads" href="Place_id_1818.html" style="display:inline-block;cursor:pointer;"><img src="t5_subdomain/Place-120x70-4caebf1df59f3e62f6cff6741433fb81.Png" border="0" id="img" alt="Crossroads"/></a>
					</td><td class="UserPlace">
						<a id="ctl00_cphRoblox_DataListCoolPlace_ctl01_rbxContentImage" title="City Wall" href="Place_id_20538.html" style="display:inline-block;cursor:pointer;"><img src="t2_subdomain/Place-120x70-f4f5bb09442d66a8d225643e9f640831.Png" border="0" id="img" alt="City Wall"/></a>
					</td><td class="UserPlace">
						<a id="ctl00_cphRoblox_DataListCoolPlace_ctl02_rbxContentImage" title="✪Ultimate Paintball CTF" href="Place_id_47828.html" style="display:inline-block;cursor:pointer;"><img src="t1_subdomain/Place-120x70-2c8ee77fa67d614896ece97cc8931777.Png" border="0" id="img" alt="✪Ultimate Paintball CTF"/></a>
					</td><td class="UserPlace">
						<a id="ctl00_cphRoblox_DataListCoolPlace_ctl03_rbxContentImage" title="Roblox Soccer" href="Place_id_47930.html" style="display:inline-block;cursor:pointer;"><img src="t3_subdomain/Place-120x70-ffa3622dc9b700017d1ed3a73d6f95b5.Png" border="0" id="img" alt="Roblox Soccer"/></a>
					</td><td class="UserPlace">
						<a id="ctl00_cphRoblox_DataListCoolPlace_ctl04_rbxContentImage" title="Gold Digger! NEW CHARACTER CLASSES!" href="Place_id_179994.html" style="display:inline-block;cursor:pointer;"><img src="t7_subdomain/Place-120x70-f65e5cfc0ebc27a7725c7ca527435d9e.Png" border="0" id="img" alt="Gold Digger! NEW CHARACTER CLASSES!"/></a>
					</td>
	</tr>
</table>
			</div>
			<div id="UserPlaces_Header">
				<h3>Cool Places</h3>
				<p>Check out some of our favorite <?=$sitename?> places!</p>
			</div>
			<div id="ctl00_cphRoblox_ie6_peekaboo" style="clear: both"></div>
		</div>
	</div>
				</div>
				<?php
				require ("core/footer.php");
				?>
				</body>
</html>
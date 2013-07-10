<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a single post.
 *
 * @package esoTalk
 */

$post = $data["post"];

$tmp_posterIsAdmin = false;
		
if (!empty($post["info"]))
{
	foreach ((array)$post["info"] as $info)
	{
		if (strpos($info, 'Administrator') !== FALSE)
		{
			$tmp_posterIsAdmin = true;
			break;
		}
	}
}
?>

<div class='post hasControls <?php echo implode(" ", (array)$post["class"]); ?>' id='<?php echo $post["id"]; ?>'<?php
if (!empty($post["data"])):
foreach ((array)$post["data"] as $dk => $dv)
	echo " data-$dk='$dv'";
endif; ?>>

<?php if (!empty($post["avatar"])): ?>
<div class='avatar'<?php if (!empty($post["hideAvatar"])): ?> style='display:none'<?php endif; ?>>
<?php 
	if (ET::$session->isAdmin() or $tmp_posterIsAdmin)
	{
		echo $post["avatar"]; 
	}
	else
	{
		echo '<img src="/esoTalk/core/skin/avatar.png" alt="" class="avatar ">';
	}
?>
</div>
<?php endif; ?>

<div class='postContent thing'>

<div class='postHeader'>
<div class='info'>
<h3>
	<?php 
		if (ET::$session->isAdmin() or $tmp_posterIsAdmin)
		{
			echo $post["title"]; 
		}
		else
		{
			echo "Member";
		}
		
	?>
</h3>
<?php 
	if (!empty($post["info"]))
	{
		foreach ((array)$post["info"] as $info)
		{
			echo $info, "\n"; 
		}
	}
?>
</div>
<div class='controls'>
<?php if (!empty($post["controls"])) foreach ((array)$post["controls"] as $control) echo $control, "\n"; ?>
</div>
</div>

<?php if (!empty($post["body"])): ?>
<div class='postBody'>
<?php echo $post["body"]; ?>
</div>
<?php endif; ?>

</div>

</div>
<html>
<head></head>
<script type="text/javascript" src="../ste_content/js/wysiwyg.js"></script>
<body onLoad="iFrameOn();">

<form action="<?php echo $action; ?>" name="myform" id="myform" method="POST">
	<p>			
		<?php 
		echo $tp_list_up;
		echo $tp_list;
		echo $tp_list_down; 
		?>
	</p>
	<?php
	
	echo $titles;
	
	?>
	<div id="wrapper" style="padding:8px; width:700px;">
		<input type="button" onClick="iBold()" value="B">
		<input type="button" onClick="iUnderline()" value="U">
		<input type="button" onClick="iItalic()" value="I">
		<input type="button" onClick="iFontSize()" value="Text Size">
		<input type="button" onClick="iForeColor()" value="Text Color">
		<input type="button" onClick="iHorizontalRule()" value="HR">
		<input type="button" onClick="iUnorderedList()" value="UL">
		<input type="button" onClick="iOrderedList()" value="OL">
		<input type="button" onClick="iLink()" value="Link">
		<input type="button" onClick="iUnLink()" value="UnLink">
		<input type="button" onClick="iImage()" value="Image">
	</div>
	<textarea style="display:none;" name="myTextArea" id="myTextArea" cols="100" rows="14"></textarea>
	<iFrame name="richTextField" id="richTextField" style="border: #000000 1px solid; width:700px; height:300px;"></iFrame>
	</p>
	
	<input name="myBtn" type="button" value="Click to Post" onClick="javascript:submit_form();" />
	
	<?php echo $hidden; ?>
	
</form>

</body>
</html>
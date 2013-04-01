<script type="text/javascript">
function change_theme(value,label)
{
//alert('t');
var theme=value;
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
xmlhttp.open("POST","ajax.php",true);
xmlhttp.onreadystatechange=function()
 {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
	//alert(xmlhttp.responseText);
	var html=xmlhttp.responseText;
	html=html.slice(1,-1);
	//alert(html);
	var array=html.split(',');
	document.getElementById('fileslist').innerHTML='';
	$("#fileslist").removeData("dropkick");
	$("#dk_container_fileslist").remove();
	for(x in array)
	{
		document.getElementById('fileslist').innerHTML+="<option>"+array[x].slice(1,-1)+"</option>";
	}
	$("#fileslist").dropkick({change: function(value, label) {change_file(value,label);}});
    }
}
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("action=change_theme&theme="+theme);
}

function change_file(value,label)
{
var file=value;
var theme=document.getElementById('themeslist').value
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
xmlhttp.open("POST","ajax.php",true);
xmlhttp.onreadystatechange=function()
 {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
	//alert(xmlhttp.responseText);
	var html=xmlhttp.responseText;
	//html=html.slice(1,-1);
	//alert(html);
	//var array=html.split(',');
	//document.getElementById('fileslist').innerHTML='';
	//for(x in array)
	//{
		//document.getElementById('fileslist').innerHTML+="<option>"+array[x].slice(1,-1)+"</option>";
	//}
	document.getElementById('file_content').value=html;
    }
}
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("action=change_file&theme="+theme+"&file="+file);
}

function save_file()
{
var file=document.getElementById('fileslist').value;
var theme=document.getElementById('themeslist').value;
var content=document.getElementById('file_content').value;
//alert(document.getElementById('file_content').value);
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.open("POST","ajax.php",true);
xmlhttp.onreadystatechange=function()
 {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //alert(xmlhttp.responseText);
    }
}
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("action=save_file&theme="+theme+"&file="+file+"&content="+content);
}
</script>

		
		<div>
				<div id="table_head"></div>
				<table>
					<tbody>
						<tr>
							<td>
							Theme
							<select class="span3" tabindex="1" id="themeslist" >
							<?php 
								foreach(get_themes() as $t)
								{
									if($t != $theme)
									echo "<option >$t</option>";
									else
									echo "<option>$t</option>";
								}
							?>
							</select>
							File
							<select class="span3" tabindex="1" name="fileslist" id="fileslist">
							<?php 
								foreach(get_template_files($theme)  as $f)
								{
									if($f != 'index.php')
									echo "<option value='$f' >$f</option>";
									else
									echo "<option value='$f' selected='selected'>$f</option>";
								}
							?>
							</select>
							</td>
						</tr>
						<tr>
							<td>
							<textarea class="mceNoEditor" rows="30" cols="70" name='file_content' id="file_content">
							<?php
								echo get_template_file_content($theme,'index.php');
							?>
							</textarea>
							</td>
						</tr>
						<tr>
							<td>
							<button class='btn btn-large btn-block' onclick="save_file()">save</button></td>
					</tbody>
				</table>
				<div id="table_foot"></div>
			
		</div>

<?php

	// ----------------------------------------- müsli connection, problably should be removed in production
	
	$dbHandle = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro");
	mysql_select_db("fyysika_ee");
	mysql_query("SET NAMES utf8");

	
	// other setup items:
	// latex generator specific values
	$latex_tmp_folder = sys_get_temp_dir();	// full path to temp folder where partial images are stored
	$latex_output_folder = "";
	$latex_output_folder = dirname($_SERVER["SCRIPT_FILENAME"]). "/media/valem_pildid/";	// full path to the folder where all images will be stored
	$enableLog = false;
	$logFile = $latex_output_folder . "writer.log";	// send to given fiel
	//$logFile = "";	// empty means that standard php error_log is used
			
	//var_dump (is_writable($latex_output_folder));
    //var_dump (is_readable($latex_output_folder));
    
	// URL where to load an image for selected formula
	$webImageLoading = "media/valem_pildid/";
	
	// URL where to load updated preview for typed in image
	$webImageRefresh = "valem_disp.php";
	
	// are the names field changed in different serves?
	$nameField = "nimi_est";
	//$nameField = "nimi";
	
	include_once "helpers.php";
	// -------------------------------------------------------------

	//include("FCKeditor/fckeditor.php") ;
	
	$eh= trim((string)@$_GET["action"]);
	$vid=trim((string)@$_GET["vid"]);
	$aid=trim((string)@$_GET["aid"]);
	$klass=trim((string)@$_GET["klass"]);

	// -------------------------------------------------------------------------------
	if(!isset($_GET["equation"]))
	{
		$noLoad = false;
		header('Content-Type: text/html; charset=utf-8');
		$rida  = array();
		$line = array();
	
		if($eh=="new"){
			$tmp=mysql_query("INSERT INTO valem (".$nameField.") VALUES (\"Nimetu\")");
			$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
			$vid=$tmp["last_insert_id()"];
	
	// Kui on määratud peatükk
			if($aid and $klass)
			{
				$query_insert="INSERT INTO ".$klass."_valem (oid1,oid2) VALUES (" . (int)@$aid . "," . (int)@$vid . ")";
				echo $query_insert;
				$tmp=mysql_query($query_insert);
			}
			//echo $vid;
			// ------------------------------------------------
		} elseif($eh=="save"){
			
			$valjad = array($nameField,"tex", "tex_html");
					
			if (get_magic_quotes_gpc())	$_POST = array_map('stripslashes', $_POST);
			
			foreach($valjad as $var){
				if(isset($_POST[$var]))
				{
					$rida[$var]=$var."='".mysql_real_escape_string($_POST[$var])."'";
				}
			}
			
			$equation = (trim((string)@$_REQUEST["tex"]));
			$saver = new FormulaManager($latex_tmp_folder, $latex_output_folder, $dbHandle);
			
			$fileNameOnly ="formula_" . (int)@$vid;
			$fileNameFinal = $saver->formulaSave($equation, $fileNameOnly);
			
			//echo "<hr>$fileNameFinal<hr>";
			// hardcoded value for PNG ttype of picture!!
			$fileNameOnly .= ".png";
			
			$pathFinal = $latex_output_folder . $fileNameOnly;
			
			if(strlen($fileNameFinal) && file_exists($pathFinal))
			{
				if(count($rida) > 0){
					$query="UPDATE valem SET ".implode(",",$rida).", image = '".mysql_real_escape_string($fileNameOnly)."' WHERE id=".(int)@$vid;
					$result=mysql_query($query);
					
					if($result)
					{
						?>
						<hr>SALVESTATUD<hr>
						<?php
					}
				}
			}
			else
			{
				//print_r($_POST);
				$line[$nameField] = @$_POST[$nameField];
				$line['tex'] = @$_POST['tex'];
				$line['tex_html'] = @$_POST['tex_html'];
				$line["id"] = $vid;
				$noLoad = true;
				?>
				TÕRGE ANDMETE SALVESTAMISEL ANDMEBAASI. Midagi läks vist katki valemi pildi genereerimisel ja salvestamisel <br><br>
				<?php
			}
		}
		
		if(!$noLoad)
		{
			$query="SELECT * FROM valem WHERE id=".$vid;
		    $result=mysql_query($query);
			$line= mysql_fetch_array($result);
		}
		
?>
<?php /*?>
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>
<?php
*/
?>

<script type="text/x-mathjax-config">
    // <![CDATA[
    MathJax.Hub.Config({
        TeX: {extensions: ["AMSmath.js", "AMSsymbols.js"]},
        extensions: ["tex2jax.js"],
        jax: ["input/TeX", "output/HTML-CSS"],
        showProcessingMessages : false,
        messageStyle : "none" ,
        showMathMenu: false ,
        tex2jax: {
            processEnvironments: true,

			inlineMath: [ ['$','$'], ['\\(','\\)'] ],
            displayMath: [ ['$$','$$'], ["\\[","\\]"] ],

            preview : "none",
            processEscapes: true
        },
        "HTML-CSS": { linebreaks: { automatic:true, width: "latex-container"} }
    });
    // ]]>
</script>
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<link href="scat.css" rel="stylesheet" type="text/css" />

<?php
// LAtex2HTML items
?>

     
<br>

<form name="valem" method="post" action="<? echo "?page=valem_disp&klass=".$klass."&action=save&vid=".$vid; ?>">
	<table width="100%" border="0" cellpadding="5">
		<tr>
			<td align="left" class="fields">Nimi:</td>
			<td class="fields"><input name="<?php echo $nameField; ?>" type="text" class="fields" value="<? echo @$line[$nameField]; ?>" size="65" /></td>
			<td class="fields"><input class="button" type="submit" name="Submit" value="Salvesta" /></td>
		</tr>
		<tr>
			<td align="left" class="fields">Tex:</td>
			<td class="fields"><input name="tex" id="tex"  type="text" class="pealkiri" value="<? echo $line["tex"]; ?>" size="65" /></td>
			<td class="fields">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" class="fields">TEX2HTML5:</td>
			<td class="fields"><textarea name="tex_html" id="tex_html" rows="5" cols="80"><? echo $line["tex_html"]; ?></textarea>
			</td>
			<td class="fields">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">
				<input type="button" name="refresh" value="Refresh preview" id="preview_refresh" />
			</td>
		</tr>
		<tr>
			<td width="38%" align="left" valign="top" class="fields">Img:</td>
			<td width="37%" align="center" valign="top">
			<img src="" alt="Veebipilt" name="image" id="web_image"/>
			<td width="25%" valign="top">&nbsp;</td>
		</tr>
		
		<tr>
			<td width="38%" align="left" valign="top" class="fields">MathJax:</td>
			<td align="center" valign="top" id="mathjax_preview">$${}$$</td>
			<td width="25%" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td width="38%" align="left" valign="top" class="fields">latex2HTML5:</td>
			<td align="center" valign="top" id="tex_html_preview"></td>
			<td width="25%" valign="top">&nbsp;</td>
		</tr>
	</table>
</form>

<script type="text/JavaScript">

function refreshPreviewImage()
{
	$("#mathjax_preview").html("$$" + $("#tex").val() + "$$");
	MathJax.Hub.Queue(["Typeset",MathJax.Hub,"mathjax_preview"]);

	var milliseconds = new Date().getTime();
	$('#web_image').attr('src', "<?php echo $webImageRefresh; ?>?equation=" + encodeURIComponent($("#tex").val()) +"&t=" + (milliseconds + ""));

	// latex2html preview

	 var TEX = new LaTeX2HTML5.TeX({
         tagName: 'section',
         className: 'latex-container',
         latex: $("#tex_html").val()
     });
     TEX.render();
     $("#tex_html_preview").html(TEX.$el);
}


$(document).ready(function()
{
	$("#preview_refresh").click(function(e){
		if(!(e === undefined) && !(e===null)){	 (e.preventDefault) ? e.preventDefault() : e.returnValue = false; }
		refreshPreviewImage();
	});

	refreshPreviewImage();
});
</script>
<?php
	}
	else
	{
		$equation = (trim((string)@$_REQUEST["equation"]));
		if (get_magic_quotes_gpc())	$equation = stripslashes($equation);
		
		$preview = new FormulaManager($latex_tmp_folder, $latex_output_folder, $dbHandle);
		$preview->formulaPreview($equation, $enableLog, $logFile);
			
	}





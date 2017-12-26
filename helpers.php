<?php

if (!class_exists("LatexRender")) include_once "class.latexrender.php";

class FormulaManager
{
	private $tmpFolder = "";
	private $outputFolder = "";
	private $dbConnection = null;
	
	private $contentType = "image/png;";
	
	public function __construct($tmpFolder, $outputFolder, &$dbHandle)
	{
		$this->tmpFolder = $tmpFolder;
		$this->outputFolder = $outputFolder;
		$this->dbConnection = $dbHandle;
	}
	
		
	public function getOutputFormat()
	{
		return "Content-type: " . $this->contentType;
	}
	
	public function formulaPreview($equation, $logging = false, $logFile = "")
	{
		try
		{
			//$equation = (trim((string)@$_REQUEST["equation"]));
			$equation = trim((string)@$equation);
			if(strlen($equation) <= 3) throw new core_Exception("no_equation", 404);
			
			//echo $equation;exit;
			
			$render = new LatexRender($this->outputFolder, "", $this->tmpFolder);
			$render->setLogging($logging, $logFile);
			
			$filename = $render->getFormulaURL($equation, true);
				
			//echo "<hr>filename final: $filename<hr>";
			//echo "<hr>Veakood mis lõpuks tuli: ". $render->_errorcode."<hr>";
			//exit;
			
			if(file_exists($filename) && is_readable($filename))
			{
				$info = getimagesize($filename);
				$imageType = image_type_to_mime_type(@$info[2]);
				$this->contentType = $imageType;
				
				// http://stackoverflow.com/a/1851856
				header('Content-Type:'. $this->contentType);
				header('Content-Length: ' . filesize($filename));
				readfile($filename);
			}
			else
				throw new Exception("Unable to read file", 404);
				
		}catch(Exception $err)
		{
			// TODO generate error image as needed
			$im  = imagecreatetruecolor(150, 30);
	      	$bgc = imagecolorallocate($im, 255, 255, 255);
	      	$tc  = imagecolorallocate($im, 0, 0, 0);
	
	      	imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
	      	imagestring($im, 1, 5, 5, $err->getMessage(), $tc);
	      	header('Content-Type: image/png');
	      	
	      	imagepng($im);
			imagedestroy($im);
		}
		
		exit;
	}
	
	public function formulaSave($equation, $fileNameUser)
	{
		$filename = "";
		try
		{
			//$equation = (trim((string)@$_REQUEST["equation"]));
			$equation = trim((string)@$equation);
			if(strlen($equation) <= 3) throw new Exception("no_equation", 404);
			
			//echo $equation;exit;
			
			$render = new LatexRender($this->outputFolder, "", $this->tmpFolder);
			$filename = $render->getFormulaURL($equation, false, $fileNameUser);
			//echo "<hr> error code = " . $render->_errorcode. " : ". $render->_errorextra."<hr>";
			//echo "<hr>--$filename<hr>";
				
		}catch(Exception $err)
		{
			echo "<hr>VIGA: ". $err->getCode(). ": ". $err->getMessage()."</hr>";
			return false;
		}
		
		return $filename;
	}
}
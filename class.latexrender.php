<?php
/**
 * LaTeX Rendering Class
 * Copyright (C) 2003  Benjamin Zeiss <zeiss@math.uni-goettingen.de>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 * --------------------------------------------------------------------
 * @author Benjamin Zeiss <zeiss@math.uni-goettingen.de>
 * @version v0.8
 * @package latexrender
 *
 */

class LatexRender {

    // ====================================================================================
    // Variable Definitions
    // ====================================================================================
    protected $_picture_path = "";
    protected $_picture_path_httpd = "";
    protected $_tmp_dir = "";
    // i was too lazy to write mutator functions for every single program used
    // just access it outside the class or change it here if nescessary
    
    protected $_latex_path = "/usr/bin/latex";
    protected $_dvips_path = "/usr/bin/dvips";
    protected $_convert_path = "/usr/bin/convert";
    protected $_identify_path="/usr/bin/identify";
    protected $_formula_density = 120;
    protected $_xsize_limit = 500;
    protected $_ysize_limit = 500;
    protected $_string_length_limit = 2000;
	protected $_font_size = 12;
	protected $_latexclass = "article"; //install extarticle class if you wish to have smaller font sizes
    protected $_tmp_filename;
	protected $_image_format = "png"; //change to png if you prefer
	
    // this most certainly needs to be extended. in the long term it is planned to use
    // a positive list for more security. this is hopefully enough for now. i'd be glad
    // to receive more bad tags !
    protected $_latex_tags_blacklist = array(
        "include","def","command","loop","repeat","open","toks","output","input",
        "catcode","name","^^",
        "\\every","\\errhelp","\\errorstopmode","\\scrollmode","\\nonstopmode","\\batchmode",
        "\\read","\\write","csname","\\newhelp","\\uppercase", "\\lowercase","\\relax","\\aftergroup",
        "\\afterassignment","\\expandafter","\\noexpand","\\special"
        );
    public $_errorcode = 0;
	public $_errorextra = "";

	protected $logging = false;
	protected $logFile = "";

    // ====================================================================================
    // constructor
    // ====================================================================================

    /**
     * Initializes the class
     *
     * @param string $picture_path where the rendered pictures should be stored
     * @param string $picture_path_httpd same  path, but from the httpd chroot
     * @param String $tmp_dir Temprary folder
     */
    public function __construct($picture_path, $picture_path_httpd, $tmp_dir) {
        $this->_picture_path = $picture_path;
        $this->_picture_path_httpd = $picture_path_httpd;
        $this->_tmp_dir = $tmp_dir;
        $this->_tmp_filename = md5(rand() . "_" . time());
    }

    // ====================================================================================
    // public functions
    // ====================================================================================
	public function getImageFormat()
	{
		return $this->_image_format;
	}
    /**
     * Picture path Mutator function
     *
     * @param string sets the current picture path to a new location
     */
    public function setPicturePath($name) {
        $this->_picture_path = $name;
    }

    /**
     * Picture path Mutator function
     *
     * @returns the current picture path
     */
    public function getPicturePath() {
        return rtrim($this->_picture_path, "/");
    }

    /**
     * Picture path HTTPD Mutator function
     *
     * @param string sets the current httpd picture path to a new location
     */
    public function setPicturePathHTTPD($name) {
        $this->_picture_path_httpd = $name;
    }

    /**
     * Picture path HTTPD Mutator function
     *
     * @returns the current picture path
     */
    public function getPicturePathHTTPD() {
        return $this->_picture_path_httpd;
    }

    /**
     * Tries to match the LaTeX Formula given as argument against the
     * formula cache. If the picture has not been rendered before, it'll
     * try to render the formula and drop it in the picture cache directory.
     *
     * @param string formula in LaTeX format
     * @param bool $preview Build a preview image not for other loadings
     * @returns the webserver based URL to a picture which contains the
     * requested LaTeX formula. If anything fails, the resultvalue is false.
     */
    public function getFormulaURL($latex_formula, $preview = false, $fileNameUser = "") {
        // circumvent certain security functions of web-software which
        // is pretty pointless right here
        $latex_formula = preg_replace("/&gt;/i", ">", $latex_formula);
        $latex_formula = preg_replace("/&lt;/i", "<", $latex_formula);

        $formula_hash = md5($latex_formula);
        $fileNameUser = trim((string)@$fileNameUser);

        $filename = $formula_hash . ".".$this->_image_format;
        $full_path_filename = ($preview) ? "" : $this->getPicturePath()."/".$filename;
        
        //echo $this->getPicturePath();
        //echo "<hr> filename start: $filename<hr>";
		//exit;
		$this->log("Kasutame failinime " . $filename);;
		
       
        if (is_file($full_path_filename)) {
        	$this->log("fail on juba olemas, seega seda tegema ei hakka");
            return $this->getPicturePathHTTPD()."/".$filename;
        } else {
            // security filter: reject too long formulas
            if (strlen($latex_formula) > $this->_string_length_limit) {
            	$this->_errorcode = 1;
            	$this->log("Valem on liiga pikk");
                return false;
            }

            // security filter: try to match against LaTeX-Tags Blacklist
            for ($i=0;$i<sizeof($this->_latex_tags_blacklist);$i++) {
                if (stristr($latex_formula,$this->_latex_tags_blacklist[$i])) {
                	$this->_errorcode = 2;
                	$this->log("Valemis on symbolid, mida ei lubata kasutada");
                    return false;
                }
            }
	
            // security checks assume correct formula, let's render it
            if ($this->renderLatex($latex_formula, $preview)) {
            	$pictureHTTPPath = $this->getPicturePathHTTPD();
            	
            	$finalFilePath = ($preview)
            		? $this->_tmp_dir . "/" . $filename
            		: ((strlen($pictureHTTPPath) > 0) ? "/" : "") .$filename;
            	
            	// rename the file if needed
            	// TODO escape all bad characters from the filename provided by a user !!!!
				if(strlen(trim((string)@$fileNameUser)) > 0 && !$preview )
				{
					$newName = trim((string)@$fileNameUser) . "." . $this->_image_format;
					//echo $full_path_filename;
					$full_path_filename2 = $this->getPicturePath()."/". $newName;
					
					if(!rename($full_path_filename, $full_path_filename2))
					{
					
						return false;
					}
				}
				
            	
                return $finalFilePath;
            } else {
                // uncomment if required
                // $this->_errorcode = 3;
                return false;
            }
        }
    }

    // ====================================================================================
    // private functions
    // ====================================================================================

    /**
     * wraps a minimalistic LaTeX document around the formula and returns a string
     * containing the whole document as string. Customize if you want other fonts for
     * example.
     *
     * @param string formula in LaTeX format
     * @returns minimalistic LaTeX document containing the given formula
     */
    protected function wrap_formula($latex_formula) {
    	$newLine = "\n";
        $string  = '\documentclass['.$this->_font_size.'pt]{'.$this->_latexclass.'}'. $newLine;
        $string .= '\usepackage[utf8]{inputenc}'. $newLine;
        $string .= '\usepackage{amsmath}'. $newLine;
        $string .= '\usepackage{amsfonts}'. $newLine;
        $string .= '\usepackage{amssymb}'. $newLine;
        $string .= '\pagestyle{empty}'. $newLine;
        $string .= '\begin{document}'. $newLine;
        $string .= '$' . $latex_formula . '$' . $newLine;
        $string .= '\end{document}'. $newLine;

        $this->log("Latexi jaoks kirjutatakse faili andmed:\n " . $string);
        
        return $string;
    }

    /**
     * returns the dimensions of a picture file using 'identify' of the
     * imagemagick tools. The resulting array can be adressed with either
     * $dim[0] / $dim[1] or $dim["x"] / $dim["y"]
     *
     * @param string path to a picture
     * @returns array containing the picture dimensions
     */
    protected function getDimensions($filename) {

    	$command = $this->_identify_path." ".$filename;
    	$this->log("Käivitame käsu: " . $command);
        $output2 = array();
        $output=exec($command, $output2);

		$this->log("Result:\n" . print_r($output2, true));
       // echo "<hr> identify " . $this->_identify_path." ".$filename ."<hr>";
        $result=explode(" ",$output);
        
        //echo "<pre>".print_r($output, true)."</pre>";
        
        $dim=explode("x",$result[2]);
        $dim["x"] = $dim[0];
        $dim["y"] = $dim[1];

        return $dim;
    }

    /**
     * Renders a LaTeX formula by the using the following method:
     *  - write the formula into a wrapped tex-file in a temporary directory
     *    and change to it
     *  - Create a DVI file using latex (tetex)
     *  - Convert DVI file to Postscript (PS) using dvips (tetex)
     *  - convert, trim and add transparancy by using 'convert' from the
     *    imagemagick package.
     *  - Save the resulting image to the picture cache directory using an
     *    md5 hash as filename. Already rendered formulas can be found directly
     *    this way.
     *
     * @param string LaTeX formula
     * @returns true if the picture has been successfully saved to the picture
     *          cache directory
     */
    protected function renderLatex($latex_formula, $preview = false) {
        $latex_document = $this->wrap_formula($latex_formula);

        $current_dir = getcwd();

        chdir($this->_tmp_dir);

        // create temporary latex file
        $fp = fopen($this->_tmp_dir."/".$this->_tmp_filename.".tex","a+");
        fputs($fp,$latex_document);
        fclose($fp);

        // create temporary dvi file
        $command = $this->_latex_path." --interaction=nonstopmode ".$this->_tmp_filename.".tex";
        $this->log("Käivitame käsu: " . $command);
        $output = array();
        $status_code = exec($command,  $output);
        $this->log("Result:\n" . print_r($output, true));
        

       // echo "<hr>".htmlspecialchars($command)."<hr>";;
        if (!$status_code) { $this->cleanTemporaryDirectory(); chdir($current_dir); $this->_errorcode = 4; return false; }

        // convert dvi file to postscript using dvips
        $command = $this->_dvips_path." -E ".$this->_tmp_filename.".dvi"." -o ".$this->_tmp_filename.".ps";
        $this->log("Käivitame käsu: " . $command);
        $output = array();
        $status_code = exec($command, $output);
//        echo "<hr>".htmlspecialchars($command)."<hr>";
		$this->log("Result:\n" . print_r($output, true));
		
        // imagemagick convert ps to image and trim picture
        $command = $this->_convert_path." -density ".$this->_formula_density.
                    " -trim -transparent \"#FFFFFF\" ".$this->_tmp_filename.".ps ".
                    $this->_tmp_filename.".".$this->_image_format;
                    
		$this->log("Käivitame käsu: " . $command);
        $output = array();
        $status_code = exec($command);

        $this->log("Result:\n" . print_r($output, true));
        //var_dump($status_code);
        // test picture for correct dimensions
        $dim = $this->getDimensions($this->_tmp_dir . "/" . $this->_tmp_filename.".".$this->_image_format);
		
        if ( ($dim["x"] > $this->_xsize_limit) or ($dim["y"] > $this->_ysize_limit)) {
            $this->cleanTemporaryDirectory();
            chdir($current_dir);
            $this->_errorcode = 5;
            $this->_errorextra = ": " . $dim["x"] . "x" . number_format($dim["y"],0,"","");
            return false;
        }

        // copy temporary formula file to cahed formula directory
        $latex_hash = md5($latex_formula);
        $filename = $this->getPicturePath()."/" . $latex_hash. ".".$this->_image_format;
        if(!$preview)
        {
        	$this->log("kopeerime faili: ". $this->_tmp_filename.".".$this->_image_format ." asukohta ". $filename);
        	$status_code = copy($this->_tmp_filename.".".$this->_image_format,$filename);
        }
        else
        {
        	$this->log("kopeerime faili: ". $this->_tmp_filename.".".$this->_image_format ." asukohta ". $filename);
        	$filename = $this->_tmp_dir . "/".$latex_hash.".".$this->_image_format;
        	$status_code = copy($this->_tmp_filename.".".$this->_image_format, $filename);

        	//echo getcwd() . "\n";
        	
        	//var_dump(file_exists(getcwd()."/".$this->_tmp_filename.".".$this->_image_format));
        	//var_dump($status_code);
        	//var_dump($this->_tmp_filename.".".$this->_image_format);
        	//var_dump($filename);
        }

        $this->cleanTemporaryDirectory();
        
        if (!$status_code) { chdir($current_dir); $this->_errorcode = 6; return false; }
        chdir($current_dir);

        return true;
    }

    /**
     * Cleans the temporary directory
     */
    protected function cleanTemporaryDirectory() {
        $current_dir = getcwd();
        chdir($this->_tmp_dir);

        unlink($this->_tmp_dir."/".$this->_tmp_filename.".tex");
        unlink($this->_tmp_dir."/".$this->_tmp_filename.".aux");
        unlink($this->_tmp_dir."/".$this->_tmp_filename.".log");
        unlink($this->_tmp_dir."/".$this->_tmp_filename.".dvi");
        unlink($this->_tmp_dir."/".$this->_tmp_filename.".ps");
        unlink($this->_tmp_dir."/".$this->_tmp_filename.".".$this->_image_format);

        chdir($current_dir);
    }

    public function setLogging($enable, $logFile)
    {
    	$this->logging = (bool)@$enable;
    	//echo "<hr>$logFile<hr>";
    	$this->logFile = trim((string)@$logFile);
    	//var_dump($this->logging);
    	//exit;
    }
    
    protected function log($message)
    {
    	if($this->logging)
    	{
    		$message = "[". date("Y-m-d h:i:s")."] " . $message;
    		if(strlen($this->logFile) > 0)
    		{
    			clearstatcache();
    			//var_dump (is_writable($this->logFile));
    			//var_dump (is_readable($this->logFile));
    			//echo substr(sprintf('%o', fileperms($this->logFile)), -4);
    			//echo "-" . getmyuid().':'.getmygid()."-";
    			//echo $this->logFile."<br>";;
    			error_log($message ."\n", 3, $this->logFile);
    			
    			//echo "<hr>".$message."<hr>";
    			
    		}
    		else
    		{
    			error_log($message ."\n");
    		}
    	}
    }
}

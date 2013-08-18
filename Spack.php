<?php 
/**
* class Spack
* 
* @description  Simple Javascript concatenator/packer
* @author       Max Tobias Weber (Maxtobiasweber@gmail.com)
* 
*/
class Spack{
	var $filesToPack;
	var $spack_path;
	var $scriptFileExists;

	function __construct($options = null){

		$this->spack_path = $_SERVER['DOCUMENT_ROOT'].'/spack/';

		$this->scriptFileExists = false;
		if(file_exists($this->getTargetPathAbsolute()))$this->scriptFileExists = true;

		

		if($options){


		}
	}

	public function getTargetScriptName(){
		return md5($_SERVER['REQUEST_URI']).'.js';
	}


	public function getTargetPathAbsolute(){
		return $this->spack_path.'packed/'.$this->getTargetScriptName();
	}

	public function getTargetPathRelative(){
		return '/spack/packed/'.$this->getTargetScriptName();
	}

	// add string filepath or array of string filepaths to javascript files
	public function addFile($file){
		if(is_array($file)){

			foreach($file as $file_item){
				$this->addFile($file_item);
			}

		}else if(is_string($file)){

			if(file_exists($_SERVER['DOCUMENT_ROOT'].$file)){
				$this->filesToPack[] = $_SERVER['DOCUMENT_ROOT'].$file;
			}else if(file_exists($file)){
				$this->filesToPack[] = $file;
			}
		}
	}

	// starts output buffer to init inline script
	public function scriptStart(){

		ob_start();

	}

	// return filepath in spack temp folder for given filename
	private function tempFilename($cnt){
		return $this->spack_path.'tmp/'.$cnt.'.js';
	}

	// starts output buffer to end inline script
	public function scriptEnd(){

		if(!$this->scriptFileExists){
			$scriptContent = ob_get_contents();
  	

	  	$scriptContent = '
'.$scriptContent;
	  	// save contents to temp file
	  	$i = 1;
	  	while(file_exists($this->tempFilename($i))){
	  		$i++;
	  	}

	  	file_put_contents($this->tempFilename($i), $scriptContent);

	  	$this->addFile($this->tempFilename($i));
	
		}
		
  	ob_end_clean();
	}

	public function build(){
		
		if(!$this->scriptFileExists){
			exec('cat '.implode(' ',$this->filesToPack).' > '.$this->getTargetPathAbsolute());
			exec('rm '.$this->spack_path.'tmp/*');
		}

		echo '<script src="'.$this->getTargetPathRelative().'"></script>';
	}


	
}
?>
<?php

class describe extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function index() {

		// $this->albums();
	}

	public function word($word='') {
		$data = $this->model->getWordDetails($word);
		//~ var_dump($data);
		($data) ? $this->view('describe/word', $data) : $this->view('error/index');
	}
	public function volume($vnum) {
		$data = $this->model->getVolumeDetails($vnum);
		//~ var_dump($data);
		($data) ? $this->view('describe/volume', $data) : $this->view('error/index');
	}

	public function crossrefword($word='',$wordid=''){
		$data = $this->model->getCrossRefWordDetails($word,$wordid);
		($data) ? $this->view('describe/word', $data) : $this->view('error/index');
	}

	public function innercrossrefword($innerid=''){
		$data = $this->model->getInnerCrossRefWordDetails($innerid);
		($data) ? $this->view('describe/wordhighlight', $data) : $this->view('error/index');
	}

	public function interwordcrossref($wordid){
		$data = $this->model->getCrossRefWordDetails($wordid,$wordid); //word, wordid
		if($data){
			$this->view('describe/word', $data);		
		}
		else
		{
			$data = $this->model->getInnerCrossRefWordDetails($wordid);
			if($data){

				$this->view('describe/wordhighlight', $data);		
			}
			else{
				
				$this->view('error/index');			
			}			
		}
	}

}

?>

<?php

class search extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function index() {

		$this->field();
	}

	public function field() {
		
		$data = $this->model->getGetData();
		// var_dump($data);
		unset($data['url']);

		// Check if any data is posted. For this journal name should be excluded.
		if($data) {

			$data = $this->model->preProcessPOST($data);

			$query = $this->model->formStrictQuery($data, METADATA_TABLE);
			$result['A'] = $this->model->executeQuery($query['query'],$query['words']);

			$query = $this->model->formGeneralQuery($data, METADATA_TABLE);
			$result['B'] = $this->model->executeQuery($query['query'],$query['words']);

			$query = $this->model->formDescriptionQuery($data, METADATA_TABLE, 'ORDER BY word');
			$result['C'] = $this->model->executeQuery($query['query'],$query['description']);

			$result = array_filter($result);

			($result) ? $this->view('search/result', $result) : $this->view('error/noResults', 'search/index/');
		}
		else {

			$this->view('error/index');
		}
	}
}

?>

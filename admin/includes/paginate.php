<?php 

class Paginate{

	public $page;
	public $currentPage;
	public $itemPerPage;
	public $itemTotalCount;

	public function __construct($page=1,$itemPerPage=4,$itemTotalCount=0){

		$this->currentPage = (int)$page;
		$this->itemPerPage = (int)$itemPerPage;
		$this->itemTotalCount = (int)$itemTotalCount;

	} // end __construct

	public function nextPage(){

		return $this->currentPage + 1;

	} //end nextPage

	public function previousPage(){

		return $this->currentPage - 1;

	} //end previousPage

	public function totalPage(){

		return ceil($this->itemTotalCount/$this->itemPerPage);

	} // end totalPage

	

	public function hasPrevious(){

		return $this->previousPage() >= 1 ? true : false;

	} // end hasPrevious

	public function hasNext(){

		return $this->nextPage() <= $this->totalPage() ? true : false;

	} // end hasNext

	public function offset(){
		return ($this->currentPage - 1 ) * $this->itemPerPage;
	} // end offset

} // end class paginate

?>
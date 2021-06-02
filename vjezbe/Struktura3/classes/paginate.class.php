<?php 


class Paginate {

    public $current_page;
    public $limit;
    public $items_total_count;
    public $offset;

	public function __construct($page=1, $limit=4, $items_total_count=0 ){

		$this->current_page = (int)$page;
		$this->limit = (int)$limit;
        $this->items_total_count = (int)$items_total_count;
        $this->offset = $this->offset();
	}

    public function next(){
        return $this->current_page + 1;
    }


	public function previous(){
		return $this->current_page - 1;
    }

	public function page_total(){
		return ceil($this->items_total_count/$this->limit);
    }

	public function has_previous(){
		return $this->previous() >= 1 ? true : false;
	}


	public function has_next(){
		return $this->next() <= $this->page_total() ? true : false;

	}

	public function offset() {
		return ($this->current_page -1 ) * $this->limit;
	}

} // Paginate Class


 ?>
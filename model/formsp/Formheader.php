<?php

class Formheader
{
	public function form_header($name_table){
		return '<div class="modal-header">
	              <h4 class="modal-title">Registrar '.$name_table.'</h4>
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>';
	}
}
?>
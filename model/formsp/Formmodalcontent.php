<?php

class Formmodalcontent 
{
	public function inicio_modal_content($id_modal)
	{
		return '<div class="modal fade" id="'.$id_modal.'">
			        <div class="modal-dialog">
			          <div class="modal-content">';
	}
	public function fin_modal_content(){
		return ' </div>         
        	</div>
      </div>';
	}
}
?>
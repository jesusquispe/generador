<?php
class Form_body
{

    public function inicio_modal_content($id_modal)
	{
		return '
		<div class="modal fade" id="form'.$id_modal.'Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">';
	}
	public function fin_modal_content(){
		return '
				</div>         
        	</div>
      </div>';
	}
    public function form_header($name_table){
		return '
					<div class="modal-header">
						<h4 class="modal-title">Registrar '.$name_table.'</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>';
    }
    public function inicio_body(){
		return '
					<div class="modal-body">
						<form>';
	}
	public function fin_body(){
		return '
						</form>
					</div>';
    }
    public function form_input($valor){
		return '	
							<div class="form-group">
								<label for="'.$valor.'">'.$valor.'</label>
								<input type="text" class="form-control" id="'.$valor.'" aria-describedby="nombreHelp" placeholder="'.$valor.'">				    
							</div>';

    }
    public function form_footer(){
		return '
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerra</button>
						<button type="button" class="btn btn-primary">Guadar</button>
					</div>';
	}
	
}
?>
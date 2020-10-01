<?php

class Form
{
	
	public function __construct()
	{
		return true;
	}
	public function form_input($valor){
		return '<div class="form-group">
						<label for="'.$valor.'">'.$valor.'</label>
						<input type="text" class="form-control" id="'.$valor.'" aria-describedby="nombreHelp" placeholder="'.$valor.'">				    
					</div>';

	}

}
?>
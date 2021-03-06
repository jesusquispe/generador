<?php

class Table_body
{
	
	
	public function inicio_body_table_thead(){
		return '
					<thead>
						<tr role="row">';
	}
	public function fin_body_table_thead(){
		return '	
						</tr>
					</thead>';
	}
	public function menu_body_table_thead($variable){
		return '
							<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 219px;">'.$variable.'</th>';
	}

	public function inicio_body_table_tbody(){
		return '
				<tbody>
					<tr role="row" class="odd">';
	}

	public function fin_body_table_tbody(){
		return '
					</tr>                
				</tbody>';
	}
	public function menu_body_table_tbody(){
		return '
						<td>null</td>';
	}
	//footer de una tabla
	public function inicio_body_table_tfoot(){
		return '
				<tfoot>
                	<tr>';
	}
	public function fin_body_table_tfoot(){
		return '
					</tr>
                </tfoot>';
	}
	public function menu_body_table_tfoot($valor){
		return '
						<th rowspan="1" colspan="1">'.$valor.'</th>';
	}

	public function incio_body_table(){
		return ' 
		<div class="row">
          	<div class="col-sm-12">
          		<div class="table-responsive">
          		<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">';
	}

	public function fin_body_table(){
		return '
				</table>
              </div>
          </div>
      </div>';
	}

	public function paginate(){
		return '
				<div class="row">
					<div class="col-md-8">
						<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
					</div>
					<div class="col-md-4">
						<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
							<ul class="pagination">
								<li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
		';
	}

	public function inicio_card($valor){
		return '
<div class="card">
    <div class="card-header">
    	<div class="row">
    		<div class="col-md-8">
    			<h3 class="card-title">Lista de '.$valor.'</h3>
    		</div>
    		<div class="col-md-2 text-right">
    			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#form'.$valor.'Modal">Nuevo</button>
    		</div>
    		<div class="col-md-2 text-right">
    			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">Exportar</button>
    		</div>
    	</div>
    </div>
	<div class="card-body">
	      <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

	      	<div class="row">
	      		<div class="col-md-10">
	      			<div class="dataTables_length" id="example1_length">
	      				<label>Mostrar 
	      				<select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm">
	          				<option value="10">10</option>
	          				<option value="25">25</option>
	          				<option value="50">50</option>
	          				<option value="100">100</option>
	      				</select> entradas</label>
	      			</div>
	      		</div>
	          	<div class="col-md-2">
	          		<div id="example1_filter" class="dataTables_filter">
	          			<label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>
	          		</div>
	          	</div>
      		</div>';
	}
	public function fin_card(){
		return '
				</div>
			</div>
      </div>';
	}
	public function html(){
		return "<h1>hola como estas table</h1>";
	}
}

?>
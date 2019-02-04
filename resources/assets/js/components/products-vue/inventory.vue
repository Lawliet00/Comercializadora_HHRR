<template>
	<div>
		<div class="x_panel">
				<div class="x_title">
					<h2>Inventario</h2>
					<div class="align-right btn-toolbar">
						<div class="btn-group">
							<button class="btn btn-dark" @click="getModal('ModalProductionProcess')">
							  Proceso de producción
							</button>
							<button class="btn btn-dark" @click="getModal('ModalEmpaquetado')">
							  Empaquetado
							</button>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<!-- Modal -->
					<div class="modal fade" id="ModalProductionProcess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Proceso de Producción</h5>
					      </div>
					      <div class="modal-body">
					      		<div v-if="product_list.length != 0">
					        		<production :inventory="product_list" :categories="categories" :formulario="'produccion'"></production>
					      		</div>
					      </div>
					    </div>
					  </div>
					</div>

					<div class="modal fade" id="ModalEmpaquetado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Actualizar Inventario de Producto</h5>
					      </div>
					      <div class="modal-body">
								<div v-if="product_list.length != 0">
					        		<production :inventory="product_list" :categories="categories" :formulario="'empaquetado'"></production>
					      		</div>
					      </div>
					    </div>
					  </div>
					</div>


					<!-- TABLA DE TODOS LOS PRODUCTOS -->
					<table id="datatable" class="table table-striped table-bordered" v-if="product_list.length != 0">
						<thead>
							<tr>
								<th>Foto</th>
								<th>Producto</th>
								<th>
									Existencia en inventario
								</th>
								<th>
									Unidades por bulto
								</th>
								<th>
									Cantidad de bultos
								</th>
								<th>
									Stock Min
								</th>
								<th>Acciones</th>
							</tr>
						</thead>

						<tbody>
							<tr v-for="inventory_f in product_list">
								<td><img :src="inventory_f.product.image" alt="" width="50px" height="50px"></td>
								<td>{{ inventory_f.product.name }}</td>
								<td v-if="inventory_f.product.medida == 'Unidades'">
									<div v-if="update_info && toUpdate.id == inventory_f.id">
										<input type="number" class="form-control" v-model="inventory_f.quantity">
									</div>
									<div v-else>
										<div v-if="inventory_f.quantity != null">
											{{ inventory_f.quantity }}<span> Unidad(es)</span>
										</div>
										<div align="center" v-else>----</div>
									</div>
								</td>
								<td v-else>
									<div v-if="update_info && toUpdate.id == inventory_f.id">
										<input type="number" class="form-control" v-model="inventory_f.Kg_L">
									</div>
									<div v-else>
										{{ inventory_f.Kg_L }}
										<span v-if="inventory_f.product.medida == 'Kg'">Kg.</span>
										<span v-else-if="inventory_f.product.medida == 'L'">L.</span>
									</div>
								</td>

								<td v-if="inventory_f.product.quantity_for_box != null">
									{{ inventory_f.product.quantity_for_box }}
								</td>
								<td v-else>
									<div align="center"> ---- </div>									
								</td>

								<td v-if="inventory_f.product.quantity_for_box != null && inventory_f.product.medida == 'Unidades'">
									{{ CalcularUnidadBultos(inventory_f.quantity, inventory_f.product.quantity_for_box) }}
								</td>
								<td v-else-if="inventory_f.product.quantity_for_box != null && (inventory_f.product.medida == 'Kg' || inventory_f.product.medida == 'L')">
									{{ CalcularUnidadBultos(inventory_f.Kg_L, inventory_f.product.quantity_for_box) }}
								</td>
								<td v-else>
									<div align="center"> ---- </div>									
								</td>
								
								<td v-if="inventory_f.product.medida == 'Unidades'">
									<div v-if="update_info && toUpdate.id == inventory_f.id">
										<input type="number" class="form-control" v-model="inventory_f.stock_min">
									</div>

									<div align="center" v-else-if="inventory_f.stock_min == null"> ---- </div>
									
									<div align="center" v-else-if="inventory_f.quantity >= (inventory_f.stock_min*2)">
										<label class="label label-success">
											{{ inventory_f.stock_min }}<span> Unidad(es)</span>
										</label>
									</div>	
									
									<div align="center" v-else-if="inventory_f.quantity >= inventory_f.stock_min">
											<label class="label label-warning">
												{{ inventory_f.stock_min }}<span> Unidad(es)</span>
										</label>
									</div>
									
									<div align="center" v-else>
										<label class="label label-danger">
											{{ inventory_f.stock_min }}<span> Unidad(es)</span>
										</label>	
									</div>
								</td>
								<td v-else>
									<div v-if="update_info && toUpdate.id == inventory_f.id">
										<input type="number" class="form-control" v-model="inventory_f.stock_min">
									</div>


									<div align="center" v-else-if="inventory_f.stock_min == null"> <span>----</span> </div>
									
									<div align="center" v-else-if="inventory_f.Kg_L >= inventory_f.stock_min*2">
										<label class="label label-success">
											{{ inventory_f.stock_min }}
											<span v-if="inventory_f.product.medida == 'Kg'">Kg.</span>	
											<span v-else-if="inventory_f.product.medida == 'L'">L.</span>
										</label>
									</div>	
									
									<div align="center" v-else-if="inventory_f.Kg_L >= inventory_f.stock_min">
											<label class="label label-warning">
												{{ inventory_f.stock_min }}
												<span v-if="inventory_f.product.medida == 'Kg'">Kg.</span>	
												<span v-else-if="inventory_f.product.medida == 'L'">L.</span>
										</label>
									</div>
									
									<div align="center" v-else>
										<label class="label label-danger">
											{{ inventory_f.stock_min }}
											<span v-if="inventory_f.product.medida == 'Kg'">Kg.</span>	
											<span v-else-if="inventory_f.product.medida == 'L'">L.</span>
										</label>	
									</div>
								</td>
								<td>
									<div class="btn-group  btn-group-sm">
										<button class="btn btn-success" type="button" @click="UpdateProduct(inventory_f, false)" v-if="update_info && toUpdate.id == inventory_f.id">Aplicar</button>

										<button class="btn btn-info" type="button" @click="UpdateProduct(inventory_f, true)" v-else>Actualizar</button>

									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
		</div>
	</div>
</template>

<script>

	export default{
		props:['inventory','categories'],
		data(){
			return{
				update_info:false,
				product_list:[],
				toUpdate:[],
				getColumns(){
	                return [
		                {
		                    label: 'Imagen',
		                    field: 'product.image',
		                },
		                {
		                   label:'Name',
		                   field: 'product.name',
		                },
		                {
		                    label:'action',
		                    html: true,
		                }
		            ];
	          	},
			}
		},
		mounted(){
			console.log(this.inventory);
			this.product_list = this.inventory;
			// this.get_all_products();
		},
		methods:{
			get_all_products(){
				axios.get('/inventory/get_all_products').then(response => {
					this.product_list = response.data.products;
					console.log(this.product_list)
					// this.view = 'table_products';
				});
			},
			getModal(modal){
				$('#'+modal).modal('toggle');
			},
			CalcularUnidadBultos(qty, qty_for_box){  // transforma de unidades a bultos
				var sueltos = qty, bultos = 0;

				while(sueltos >= qty_for_box){
					bultos++;
					sueltos = sueltos-qty_for_box
				}
				return (bultos+' bultos - sueltos: '+sueltos);
			},
			UpdateProduct(inventory_f, change){
				// $('ModalUpdatedProd').modal('toggle');
				// return 
				this.update_info = change;
				this.toUpdate = inventory_f;

				if (!change) {
					
					if (inventory_f.stock_min == "") { inventory_f.stock_min = null; }
					if (inventory_f.quantity == "") { inventory_f.quantity = null; }
					if (inventory_f.Kg_L == "") { inventory_f.Kg_L = null; }

					axios.post('/inventory/update',{
													'idProd':inventory_f.id,
													'quantity':inventory_f.quantity,
													'Kg_L':inventory_f.Kg_L,
													'stock_min':inventory_f.stock_min
													}).then(response=>{
						this.product_list = []
						this.product_list = response.data.allInventory;
						alert('Actualización Aplicada');
					});
				}
			},
		},
	}
</script>

<style>
	.align-right{
		float: right;
	}
	.align-center{
		float: center;
	}
</style>
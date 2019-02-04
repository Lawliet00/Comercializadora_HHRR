<template>
	<div>

		<div v-if="formulario == 'produccion'">
			<form>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" style="margin-top: 0px;">Selecciona La materia a producir
					</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
	                  <select class="form-control col-md-7 col-xs-12" v-model="selected_Materia_res">
	                  	<option disabled="">Seleccione una opción</option>

	                  	<option v-for="prod in allMateriaProducida" :value="prod" v-if="materiales.indexOf(prod) == -1">
	                  		<span>
	                  			{{ prod.product.name }}
	                  		</span>
	                  	</option>
	                  </select>
	                </div>
				</div>
			</form>
			<br><br>
			<table class="table table-responsive" v-if="materiales.length > 0">
					<thead>
						<!-- <th></th> -->
						<th v-if="selected_Materia_res != null"><h4><strong>Materias necesarias</strong></h4></th>
						<th></th>
					</thead>
					<tbody>
						<tr v-for="info in materiales">
							<!-- <td>
								<button class="btn btn-danger" @click="RemoveProd(info)"><i class="fa fa-trash"></i></button>
							</td> -->
							<td><strong>{{ info.product.name }}</strong></td>
							<td>
								<div>
									<input type="number" class="form-control" required="" v-model="qty_materiaPrima[materiales.indexOf(info)]">
								</div><span><strong>{{ 'Disponible: '+(info.Kg_L-qty_materiaPrima[materiales.indexOf(info)]) }} {{ info.product.medida }}.</strong></span>
							</td>
						</tr>
						<tr>
							<td>
								<label class="control-label"><strong>Materia resultante:</strong>
								</label>
							</td>
							<td>
								<input type="number" v-model="resultado" class="form-control">
							</td>
						</tr>
					</tbody>
				</table>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn btn-dark" @click="CalculateProductFinal(1)">Guardar</button>
				</div>
				
		</div>
		<div v-else-if="formulario == 'empaquetado'">
			<form class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-4" style="margin-top: -1rem;" >Selecciona producto a empaquetar
						</label>
						<div class="col-md-7 col-sm-7 col-xs-7">
							<select class="form-control col-md-7 col-sm-7 col-xs-7" v-model="selected_prod">
			                  	<option disabled="">Seleccione una opción</option>

			                  	<option v-for="prod in allEmpaquetado" :value="prod" v-if="materialesBase.indexOf(prod) == -1">
			                  		<span>
			                  			{{ prod.product.name }}
			                  		</span>
			                  	</option>
							</select>
						</div>
					</div>
					<div class="ln_solid"></div>
		    		<div class="form-group" v-if="selected_prod != null">
						<label class="control-label col-md-4 col-sm-4 col-xs-4" style="margin-top: -1rem;">Ingrese la cantidad de bultos
						</label>
						<div class="col-md-7 col-sm-7 col-xs-7">
							<input type="number" class="form-control" v-model="ValueBultos">
						</div>
					</div>
			    	<div class="form-group" v-if="selected_prod != null">
			    		<label class="control-label col-md-4 col-sm-4 col-xs-4" style="margin-top: -1rem;">Cantidad de unidades
						</label>
						<div class="col-md-7 col-sm-7 col-xs-7">
							<input type="number" class="form-control" v-model="ValueUnidadesSobrantes">
						</div>
			    	</div>
				</form>
				<br><br>

		    	<table class="table table-responsive">
		    		<thead>
		    			<th v-if="selected_prod != null"><h4><strong>Materiales necesarios</strong></h4></th>
		    			<th></th>
		    		</thead>
		    		<tbody>
		    			<tr v-for="info in materialesBase">
							<td><strong>{{ info.product.name }}</strong></td>
							<td>
								<div>
									<input type="number" class="form-control" disabled="" required="" v-model="qty_materiaBase[materialesBase.indexOf(info)]">
								</div>

								<span v-if="info.quantity != null"><strong>{{ 'Disponible: '+(info.quantity-qty_materiaBase[materialesBase.indexOf(info)]) }} {{ info.product.medida }}.</strong></span>

								<span v-else><strong>{{ 'Disponible: '+(info.Kg_L-qty_materiaBase[materialesBase.indexOf(info)]) }} {{ info.product.medida }}.</strong></span>
							</td>
						</tr>
		    		</tbody>
		    	</table>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn btn-dark" @click="CalculateProductFinal(2)">Guardar</button>
				</div>
		</div>
	</div>
</template>

<script>

//local registration
import {FormWizard, TabContent} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';

	export default{
		props:['inventory','categories','formulario'],
		data(){
			return{
				update_info:false,
				product_list:[],
				allMateria_prima:[],
				allEmpaquetado:[],
				allProduction:[],
				allMateriaProducida:[],
				selected_Materia_prima:null,
				selected_Materia_res:null,
				selected_prod:null,
				materiales:[],
				materialesBase:[],
				toUpdate:[],

				// variables de input type"number"
				qty_materiaPrima:[],
				qty_materiaBase:[],
				resultado:0,
				ValueBultos:0,
				ValueUnidadesSobrantes:0,
			}
		},
		components: {
		  FormWizard,
		  TabContent
		},
		mounted(){
			// console.log(this.inventory);
			this.clean();
			this.filter_product(this.inventory);
		},
		watch:{
			selected_Materia_res:function(res){
				this.materiales = [];
				var products = res.product.mix;
				
				for (var pos in products) {
					for (var i in this.inventory) {
						if (this.inventory[i].product.id == products[pos].materia_prima) {
							this.materiales.push(this.inventory[i]);
							this.qty_materiaPrima.push(0);
							break;
						}
					}
				}
			},
			selected_prod:function(res){
				this.materialesBase = [];
				var products = res.product.mix;
				
				for (var pos in products) {
					for (var i in this.inventory) {
						if (this.inventory[i].product.id == products[pos].materia_prima) {
							this.materialesBase.push(this.inventory[i]);
							this.qty_materiaBase.push(0);
							break;
						}
					}
				}
			},
			qty_materiaPrima: function(res){
				// console.log(res)
				var info = res;
				var cal = (parseFloat(info[0])+parseFloat(info[1])+parseFloat(info[2])+parseFloat(info[3]));
				var a = cal*(this.numeroAleatorio()/100);
				this.resultado = (cal - a).toFixed(2);
			},
			ValueBultos:function(res){
				var peso = parseFloat(this.selected_prod.product.peso_unit);
				var qty_box = parseInt(this.selected_prod.product.quantity_for_box);
				var sueltas = parseInt(this.ValueUnidadesSobrantes);
				var boxes = parseInt(res);

				for(var n in this.qty_materiaBase){
					this.qty_materiaBase[n] = boxes*qty_box + sueltas;
				}

				var i;
				for(i in this.materialesBase){
					if (this.materialesBase[i].product.category_id == 2) {
						break;
					}
				}
				this.qty_materiaBase[i] = boxes*(peso*qty_box) + sueltas*peso;
			},
			ValueUnidadesSobrantes:function(res){
				var peso = parseFloat(this.selected_prod.product.peso_unit);
				var qty_box = parseInt(this.selected_prod.product.quantity_for_box);
				var sueltas = parseInt(res);
				var boxes = parseInt(this.ValueBultos);

				for(var n in this.qty_materiaBase){
					this.qty_materiaBase[n] = boxes*qty_box + sueltas;
				}

				var i;
				for(i in this.materialesBase){
					if (this.materialesBase[i].product.category_id == 2) {
						break;
					}
				}
				this.qty_materiaBase[i] = boxes*(peso*qty_box) + sueltas*peso;
			},
		},
		methods:{
			clean(){
				this.selected_Materia_res = null;
				this.materiales = [];
				this.resultado = 0;
				this.qty_materiaPrima = [];

				this.selected_prod = null;
				this.ValueBultos = 0;
				this.ValueUnidadesSobrantes = 0;
				this.qty_materiaBase = [];
			},
			CalculateProductFinal(cases){
				var inventory_f = [];

				// materia que se produce 
				if (cases == 1) {
					inventory_f.push({
						'id':this.selected_Materia_res.product.id,
						'medida':this.selected_Materia_res.product.medida,
						'quantity':(this.selected_Materia_res.product.medida == 'Unidades')?parseInt(this.resultado):null,
						'Kg_L':(this.selected_Materia_res.product.medida == 'Unidades')?null:parseFloat(this.resultado)
					});


					for (var i in this.materiales) {
						inventory_f.push({
							'id':this.materiales[i].product.id,
							'medida':this.materiales[i].product.medida,
							'quantity':(this.materiales[i].product.medida == 'Unidades')?parseInt(this.qty_materiaPrima[i]):null,
							'Kg_L':(this.materiales[i].product.medida == 'Unidades')?null:parseFloat(this.qty_materiaPrima[i])
						});
					}
				}
				// Productos terminados (empaquetados)
				else if(cases == 2){
					var unit = (this.ValueUnidadesSobrantes != '') ? this.ValueUnidadesSobrantes : 0;
					var tot = parseInt(this.ValueBultos)*parseInt(this.selected_prod.product.quantity_for_box)+parseInt(unit);
					inventory_f.push({
						'id':this.selected_prod.product.id,
						'medida':this.selected_prod.product.medida,
						'quantity':(this.selected_prod.product.medida == 'Unidades')?tot:null,
						'Kg_L':(this.selected_prod.product.medida == 'Unidades')?null:tot
					});


					for (var i in this.materialesBase) {
						inventory_f.push({
							'id':this.materialesBase[i].product.id,
							'medida':this.materialesBase[i].product.medida,
							'quantity':(this.materialesBase[i].product.medida == 'Unidades')?parseInt(this.qty_materiaBase[i]):null,
							'Kg_L':(this.materialesBase[i].product.medida == 'Unidades')?null:parseFloat(this.qty_materiaBase[i])
						});
					}
				}

				console.log(inventory_f)
				axios.post('/inventory/AddToProd',{'inventory':inventory_f}).then(response=>{
					this.$parent.product_list = [];
					this.$parent.product_list = response.data.inventory;
					alert('Actualización Aplicada');
					this.clean();
				});

		    },
		    numeroAleatorio() {
		    	// return Math.round(Math.random()*(10-1)+1);
				return parseFloat((Math.random()*(4-1)+1).toFixed(2)); // float
			},
		    RemoveProd(elem){
		    	this.materiales.splice(elem,1);
		    },
			llamar(){
				alert('llamando')
			},
			filter_product(inventory){
				for (var i = 0; i < inventory.length; i++) {
					// if (inventory[i].product.category_id == 1) {
					// 	// this.allMateria_prima.push(inventory[i]);
					// 	// this.materiales.push(inventory[i]);
					// 	// this.qty_materiaPrima.push(0);
					// 	// console.log(inventory[i])
					// }
					// else if (inventory[i].product.category_id == 2) {
					// 	this.allProduction.push(inventory[i]);
					// }
					// else 
					if (inventory[i].product.category_id == 3) {
						this.allEmpaquetado.push(inventory[i]);	
					}
					else if (inventory[i].product.category_id == 2) {
						this.allMateriaProducida.push(inventory[i]);
					}
				}
			}
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

	button.enviar{
		margin-top: -70px;
	}
</style>
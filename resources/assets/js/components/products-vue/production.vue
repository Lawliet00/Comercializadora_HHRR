<template>
	<div>
		<form-wizard title="Procesos de Producción"
					 subtitle=""
					 nextButtonText="Siguiente"
					 backButtonText="Anterior"
					 finishButtonText="Finalizar">
		  <tab-content title="Etapa de Elaboración"
		  				:before-change="CalculateMatterPrimeToProduct">
		  				<br>
		    	<form>
		    		<!-- <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" style="margin-top: -3px;">Selecciona los productos bases
						</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
		                  <select class="form-control col-md-7 col-xs-12" v-model="selected_Materia_prima">
		                  	<option disabled="" v-if="allMateria_prima.length != materiales.length">Seleccione una opción</option>
		                  	<option disabled="" v-else>No quedan productos por agregar</option>

		                  	<option v-for="prod in allMateria_prima" :value="prod" v-if="materiales.indexOf(prod) == -1">
		                  		<span>
		                  			{{ prod.product.name }}
		                  		</span>
		                  	</option>
		                  </select>
		                </div>
					</div>
					<br><br><br> -->
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

				<br><br><br>

				<table class="table table-responsive" v-if="materiales.length > 0">
					<thead>
						<!-- <th></th> -->
						<th><h4><strong>Materias necesarias</strong></h4></th>
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

				

		  </tab-content>
		  <tab-content title="Additional Info">
		      My second tab content
		   </tab-content>
		   <tab-content title="Last step">
		     Yuhuuu! This seems pretty damn simple
		   </tab-content>
		</form-wizard>
		<!-- <button @click="llamar()" class="btn btn-success enviar">Button</button> -->

                    <!--   <div class="actionBar">
                      	<div class="msgBox">
                      		<div class="content">
                      			
                      		</div>
                      		<a href="#" class="close">X</a>
                      	</div>
                      	<div class="loader">
                      		Loading
                      	</div>
                      	<a href="#" class="buttonFinish btn btn-default">Finish</a>
                      	<a href="#" class="buttonNext btn btn-success" style="">Next</a>
                      	<a href="#" class="buttonPrevious btn btn-primary buttonDisabled" style="">Previous</a>
                      </div> -->
	</div>
</template>

<script>

//local registration
import {FormWizard, TabContent} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';

	export default{
		props:['inventory','categories'],
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
				materiales:[],
				toUpdate:[],

				// variables de input type"number"
				qty_materiaPrima:[],
				resultado:0,
			}
		},
		components: {
		  FormWizard,
		  TabContent
		},
		mounted(){
			// console.log(this.inventory);
			this.filter_product(this.inventory);
		},
		watch:{
			selected_Materia_res:function(res){
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
			qty_materiaPrima: function(res){
				// console.log(res)
				var info = res;
				var cal = (parseFloat(info[0])+parseFloat(info[1])+parseFloat(info[2])+parseFloat(info[3]));
				var a = cal*(this.numeroAleatorio()/100);
				this.resultado = (cal - a).toFixed(2);
			}
		},
		methods:{
			CalculateMatterPrimeToProduct:function() {
				var inventory_f = [];

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
						'quantity':(this.selected_Materia_res.product.medida == 'Unidades')?parseInt(this.qty_materiaPrima[i]):null,
						'Kg_L':(this.selected_Materia_res.product.medida == 'Unidades')?null:parseFloat(this.qty_materiaPrima[i])
					});
				}
				console.log("INVEN")
				console.log(inventory_f)
				axios.post('/inventory/AddToProd',{'inventory':inventory_f}).then(response=>{
					// this.product_list = response.data.allInventory;
					console.log(response.data)
					alert('Actualización Aplicada');
				});
				return true;
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
					if (inventory[i].product.category_id == 1) {
						// this.allMateria_prima.push(inventory[i]);
						// this.materiales.push(inventory[i]);
						// this.qty_materiaPrima.push(0);
						// console.log(inventory[i])
					}
					else if (inventory[i].product.category_id == 2) {
						this.allEmpaquetado.push(inventory[i]);	
					}
					else if (inventory[i].product.category_id == 3) {
						this.allProduction.push(inventory[i]);
					}
					else if (inventory[i].product.category_id == 4) {
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
<template>
	<div>
		<form-wizard title="Procesos de Producción"
					 subtitle=""
					 nextButtonText="Siguiente"
					 backButtonText="Anterior"
					 finishButtonText="Finalizar">
		  <tab-content title="Etapa de Elaboración"
		  				:before-change="CalculateMatterPrimeToProduct">
		    	<form>
		    		<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" style="margin-top: -10px;">Selecciona los productos bases
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
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
		    	</form>

				<br><br>

				<table class="table table-responsive" v-if="materiales.length > 0">
					<thead>
						<th></th>
						<th>Materias Primas</th>
						<th></th>
					</thead>
					<tbody>
						<tr v-for="info in materiales" class="row">
							<td>
								<button class="btn btn-danger" @click="RemoveProd(info)"><i class="fa fa-trash"></i></button>
							</td>
							<td><strong>{{ info.product.name }}</strong></td>
							<td>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<input type="number" class="form-control" required="" v-model="qty_materiaPrima[materiales.indexOf(info)]">
								</div><span v-if="info.type_stock_min == 'Kg_L'"><strong>{{ 'Disponible: '+(info.Kg_L-qty_materiaPrima[materiales.indexOf(info)]) }} {{ info.product.medida }}.</strong></span>
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
				selected_Materia_prima:null,
				materiales:[],
				toUpdate:[],

				// variables de input type"number"
				qty_materiaPrima:[],
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
			selected_Materia_prima:function(res){
				if (res != null) {
					this.materiales.push(res);
					this.qty_materiaPrima.push(0);
					this.selected_Materia_prima = null;
					console.log(res);
				}
			},
		},
		methods:{
			CalculateMatterPrimeToProduct:function() {
				
				return true;
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
						this.allMateria_prima.push(inventory[i]);
					}
					else if (inventory[i].product.category_id == 2) {
						this.allEmpaquetado.push(inventory[i]);	
					}
					else if (inventory[i].product.category_id == 3) {
						this.allProduction.push(inventory[i]);
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
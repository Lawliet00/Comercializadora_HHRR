<template>
	<div>
		<div>
			<div class="x_panel">
				<div class="x_title">
					<h2>Lista de Clientes</h2>
					<div>
						<div class="align-right btn-toolbar">
							<div class="btn-group">
								<button class="btn btn-dark" type="button" v-on:click="change_view('form_newClient')">Agregar Nuevo Cliente</button>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="x_content table-responsive">
					<!-- TABLA DE TODOS LOS PRODUCTOS -->
                	<table id="datatable" class="table table-striped table-bordered" v-if="client_list.length != 0">
						<thead>
							<tr>
								<th>RIF</th>
								<th>Negocio</th>
								<th>Nombre</th>
								<th>Dirección</th>
								<th>Telefono</th>
								<th>Correo Electronico</th>
								<th>Iva</th>
								<th>Acciones</th>
							</tr>
						</thead>

						<tbody>
							<tr v-for="client in client_list">
								<td>{{ client.code_rif }}</td>
								<td>{{ client.name_bussines }}</td>
								<td>{{ client.name }}</td>
								<td>{{ client.address }}</td>
								<td>{{ client.phone }}</td>
								<td>{{ client.email }}</td>
								<td>{{ client.tax }}%</td>
								<td>
									<div class="btn-group  btn-group-sm">
										<button class="btn btn-info" type="button" @click="UpdateClient(client)">Actualizar</button>
										<button class="btn btn-danger" type="button" @click="DeleteClient(client.id)">Eliminar</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>



		<!-- MODALS -->

		<div class="modal fade" id="ModalForm_newClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Formulario Nuevo Cliente</h5>
		      </div>
		      <div class="modal-body">
		      	<!-- FORMULARIO DE CREACION DE NUEVO PRODUCTO -->
		      		<form class="form-horizontal form-label-left">
					

					<!-- CODIGO RIF / CI -->
					  <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">RIF
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-7">
							<input type="text" class="form-control" data-inputmask="'mask' : 'A-9999999-9'" id="maskRIF">
                        </div>
                      </div>

					<!-- Nombre del Negocio -->
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Nombre del Negocio <span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-7">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-9" v-model="client.name_bussines">
                        </div>
                      </div>

						<!-- Nombre del producto -->
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Nombre del Cliente <span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-7">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-9" v-model="client.name">
                        </div>
                      </div>

                      	<!-- Dirección -->
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Dirección <span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-7">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-9" v-model="client.address">
                        </div>
                      </div>

					<!-- Telefono -->
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Telefono <span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-7">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-9" data-inputmask="'mask' : '(9999)999-9999'" id="maskPhone">
                        </div>
                      </div>

					<!-- Correo Electronico -->
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Correo Electronico <span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-7">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-9" v-model="client.email">
                        </div>
                      </div>

                      <!-- IVA -->
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">IVA <span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-7">
                          <input type="number" required="required" class="form-control col-md-7 col-xs-9" v-model="client.tax">
                        </div>
                      </div>
                    </form>
		      </div>
				<div class="modal-footer" align="center">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-primary" type="button" @click="clean_form()" v-if="!update_form">Limpiar formulario</button>
					<button class="btn btn-success" type="button" @click="AddOrUpdate_Product()" v-if="!update_form">Agregar</button>
					<button class="btn btn-success" type="button" @click="AddOrUpdate_Product()" v-else>Actualizar</button>
				</div>
		    </div>
		  </div>
		</div>

	</div>
</template>
<script>

// import axios from 'axios';
	export default{
		data(){
			return{
				view:'table_clients',    // values: table_clients, form_newClient
				update_form:false,  // values: true or false 
				client_list:[],
				update_id:'',
				disabledRif:false,
				var_rif:'',
				var_phone:'',
				client:{
					'code_rif':null,
					'name_bussines':null,
					'name':null,
					'address':null,
					'phone':null,
					'email':null,
					'tax':null,
				}
			}
		},
		mounted(){
			this.get_all_clients();
		},
		watch:{
			var_rif: function(res){
				this.client.code_rif = res;
				console.log(document.getElementById('maskRIF'))
				// if (res.length == 9) {
				// 	var aux = this.var_rif[8];
				// 	this.var_rif[8] = '-';
				// 	this.var_rif[9] = '-';
				// }else if(res.length < 7){
				// 	console.log(this.var_rif.split('-'))
				// 	this.var_rif = this.var_rif.split('-')[0];
				// }else{
				// 	console.log('ccc-'+this.var_rif.split('-'))
				// }
			},
		},
		methods:{
			change_view(view_select){
				this.clean_form();
				$('#ModalForm_newClient').modal('toggle');
				this.update_form = false;
			},
			clean_form(){
				this.client.code_rif = null;
				this.client.name_bussines = null;
				this.client.name = null;
				this.client.address = null;
				this.client.phone = null;
				this.client.email = null;
				this.client.tax = 0;

				document.getElementById('maskRIF').value = "";
				document.getElementById('maskPhone').value = "";

			},
			get_all_clients(){
				axios.get('/client/get_all_clients').then(response => {
					this.client_list = response.data.clients;
					this.view = 'table_clients';
				});
			},
			AddOrUpdate_Product(){
				this.client.code_rif = document.getElementById('maskRIF').value;
				this.client.phone = document.getElementById('maskPhone').value;
				console.log(this.client)
				if (!this.update_form) {
					axios.post('/client/add_client',this.client).then(response => {
						this.get_all_clients();
						alert("cliente agregado correctamente");
						this.clean_form();
					});
				}else{
					axios.post('/client/update_client',this.client).then(response => {
						this.get_all_products();
						this.update_form = false;
						alert("client actualizado correctamente");
						this.clean_form();
					});
				}
			},
			UpdateClient(client){
				// console.log(product);
				this.client.id = client.id;
				document.getElementById("maskRIF").value = client.code_rif;
				this.client.name_bussines = client.name_bussines;
				this.client.name = client.name;
				this.client.address = client.address;
				document.getElementById("maskPhone").value = client.phone;
				this.client.email = client.email;
				this.client.tax = client.tax;
				this.update_form = true;

				$('#ModalForm_newClient').modal('toggle');
			},
			DeleteClient(id){
				axios.delete('/client/delete_client/'+id).then(response => {
					this.get_all_clients();
					alert("eliminado");
				});
			},
		},
	}
</script>

<style>
	.align-right{
		float: right;
	}
</style>
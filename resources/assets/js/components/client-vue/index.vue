<template>
	<div>
		<div>
			<div class="x_panel">
				<div class="x_title">
					<h2 v-if="view == 'table_clients'">Lista de Clientes</h2>
					<h2 v-else-if="view == 'form_newClient' && !update_form">Formulario de nuevos clientes</h2>
					<h2 v-else>Formulario de actualización de clientes</h2>
					<div>
						<div class="align-right btn-toolbar">
							<div class="btn-group">
								<button class="btn btn-dark" type="button" v-on:click="change_view('table_clients')">Tabla de Clientes</button>
								<button class="btn btn-dark" type="button" v-on:click="change_view('form_newClient')">Agregar Nuevo Cliente</button>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="x_content table-responsive" v-if="view == 'table_clients'">
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


				<!-- FORMULARIO DE CREACION DE NUEVO PRODUCTO -->
				<div v-else-if="view == 'form_newClient'">
					<form @submit.prevent="AddOrUpdate_Product()" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
					

					<!-- CODIGO RIF / CI -->
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">RIF
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
							<select class="form-control" v-model="type_rif" name="" id="">
								<option value="J">J</option>
								<option value="E">E</option>
								<option value="X">No RIF</option>
							</select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-10">
							<input type="text" class="form-control" :disabled="disabledRif" v-model="var_rif">
                        </div>
                      </div>

					<!-- Nombre del Negocio -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del Negocio <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="client.name_bussines">
                        </div>
                      </div>

						<!-- Nombre del producto -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del Cliente <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="client.name">
                        </div>
                      </div>

                      	<!-- Dirección -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="client.address">
                        </div>
                      </div>

					<!-- Telefono -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefono <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="client.phone">
                        </div>
                      </div>

					<!-- Correo Electronico -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo Electronico <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" required="required" class="form-control col-md-7 col-xs-12" v-model="client.email">
                        </div>
                      </div>

                      <!-- IVA -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">IVA <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" required="required" class="form-control col-md-7 col-xs-12" v-model="client.tax">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button" @click="change_view('table_clients')">Cancelar</button>
						  <button class="btn btn-primary" type="reset" v-if="!update_form">Limpiar formulario</button>
                          <button class="btn btn-success" type="submit" v-if="!update_form">Agregar</button>
                          <button class="btn btn-success" type="submit" v-else>Actualizar</button>
                        </div>
                      </div>
                    </form>
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
				type_rif:'',
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
			type_rif: function(res){
				if (res == 'X') {
					this.client.code_rif = '';
					this.disabledRif = true;
				}
				else{this.disabledRif = false;}
			},
			// var_rif: function(res){
			// 	if (res.length == 9) {
			// 		var aux = this.var_rif[8];
			// 		this.var_rif[8] = '-';
			// 		this.var_rif[9] = '-';
			// 	}else if(res.length < 7){
			// 		console.log(this.var_rif.split('-'))
			// 		this.var_rif = this.var_rif.split('-')[0];
			// 	}else{
			// 		console.log('ccc-'+this.var_rif.split('-'))
			// 	}
			// },
		},
		methods:{
			change_view(view_select){
				if (view_select == 'form_newClient') {
					// this.clean_form();
					this.update_form = false;
				}
				this.view = view_select
			},
			clean_form(){
				this.client.code_rif = null;
				this.client.name_bussines = null;
				this.client.name = null;
				this.client.address = null;
				this.client.phone = null;
				this.client.email = null;
				this.client.tax = 0;
			},
			get_all_clients(){
				axios.get('/client/get_all_clients').then(response => {
					this.client_list = response.data.clients;
					this.view = 'table_clients';
				});
			},
			AddOrUpdate_Product(){
				if (!this.update_form) {
					if (this.type_rif != 'X') {
						this.client.code_rif = this.type_rif+'-'+this.var_rif;
					}
					axios.post('/client/add_client',this.client).then(response => {
						this.get_all_clients();
						alert("cliente agregado correctamente");
					});
				}else{
					axios.post('/client/update_client',this.client).then(response => {
						this.get_all_products();
						this.update_form = false;
						alert("producto actualizado correctamente");
					});
				}
			},
			UpdateClient(client){
				// console.log(product);
				this.client.id = client.id;
				this.client.code_rif = client.code_rif;
				this.client.name_bussines = client.name_bussines;
				this.client.name = client.name;
				this.client.address = client.address;
				this.client.phone = client.phone;
				this.client.email = client.email;
				this.client.tax = client.tax;
				this.update_form = true;
				this.view = 'form_newClient';
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
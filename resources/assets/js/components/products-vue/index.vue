<template>
	<div>
		<div>
			<div class="x_panel">
				<div class="x_title">
					<h2 v-if="view == 'table_products'">Lista de Productos</h2>
					<h2 v-else-if="view == 'form_product' && !update_form">Formulario de producto</h2>
					<h2 v-else>Formulario de actualización de producto</h2>
					<div>
						<div class="align-right btn-toolbar">
							<div class="btn-group">
								<button class="btn btn-dark" type="button" v-on:click="change_view('table_products')">Tabla de Productos</button>
								<button class="btn btn-dark" type="button" v-on:click="change_view('form_product')">Agregar Producto</button>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="x_content" v-if="view == 'table_products'">
					<!-- TABLA DE TODOS LOS PRODUCTOS -->
					<table id="datatable" class="table table-striped table-bordered" v-if="product_list.length != 0">
						<thead>
							<tr>
								<th>Foto</th>
								<th>Nombre</th>
								<th>Valor Unitario</th>
								<th>precio</th>
								<th>Cantidad por bulto</th>
								<th>Acciones</th>
							</tr>
						</thead>

						<tbody>
							<tr v-for="product in product_list">
								<td><img :src="product.image" alt="" width="50px" height="50px"></td>
								<td>{{ product.name }}</td>
								<td>{{ product.peso_unit }} 
									<span v-if="product.medida == 'Kg'">Kg</span>
									<span v-else-if="product.medida == 'L'">L</span>
									<span v-else-if="product.medida == 'Unidades'">Unidad</span>
								</td>
								<td>BsS {{ product.price }}</td>
								<td>{{ product.quantity_for_box }}</td>
								<td>
									<div class="btn-group  btn-group-sm">
										<button class="btn btn-info" type="button" @click="UpdateProduct(product)">Actualizar</button>
										<button class="btn btn-danger" type="button" @click="DeleteProduct(product.id)">Eliminar</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>


				<!-- FORMULARIO DE CREACION DE NUEVO PRODUCTO -->
				<div v-else-if="view == 'form_product'">
					<form @submit.prevent="AddOrUpdate_Product()" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

				
					<div class="form-group">
						<label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Selecciona la categoria a la que pertenecera el producto <span class="required">*</span></label>

						<select v-model="type_category" class="form-control col-md-9 col-sm-9 col-xs-9">
							<option disabled="">Selecciona una opción</option>
							<option v-for="category in categories_list" :value="category.id">
								{{ category.name }}
							</option>
						</select>
					</div>
					<br><br>
						<!-- Nombre del producto -->
                      <div class="form-group" v-if="product.category_id != null">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre del Producto <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="product.name">
                        </div>
                      </div>

                      <!-- Peso Unitario del producto -->
                      <div class="form-group" v-if="product.category_id != null && product.category_id == 3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Peso del Producto - Kg <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" step=0.001 required="required" class="form-control col-md-7 col-xs-12" v-model="product.peso_unit">
                        </div>
                      </div>

                      <!-- Precio unitario del producto -->
						<div class="form-group"v-if="product.category_id != null">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Precio del Producto - BsS <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" step=0.10 required="required" class="form-control col-md-7 col-xs-12" v-model="product.price">
                        </div>
                      </div>

						<!-- Cantidad de Unidades por bulto -->
					  <div class="form-group" v-if="product.category_id != null && (product.category_id == 3 || product.category_id == 5)">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Cantidad de Unidades por bulto <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" required="required" class="form-control col-md-7 col-xs-12" v-model="product.qty_for_box">
                        </div>
                      </div>

					<div class="form-group" v-if="product.category_id != null">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Selecciona el tipo de medida</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" v-model="product.medida" required="required">
                            <option disabled="">Selecciona un opción</option>
                            <option value="Kg">Kg</option>
							<option value="L">L</option>
							<option value="Unidades">Unidades</option>
                          </select>
                        </div>
                      </div>               

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button" @click="change_view('table_products')">Cancelar</button>
						  <button class="btn btn-primary" type="reset" :disabled="disable_button" v-if="!update_form">Limpiar formulario</button>
                          <button class="btn btn-success" type="submit" :disabled="disable_button" v-if="!update_form">Agregar</button>
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
		props:['products','categories'],
		data(){
			return{
				view:'table_products',    // values: table_products, form_product
				type_category:null,       // values: null, 1, 2, 3
				disable_button:true,     // values: true or false  
				update_form:false,        // values: true or false 
				product_list:[],
				categories_list:[],
				update_id:'',
				product:{
					'id':null,
					'image':null,
					'category_id':null,
					'name':null,
					'peso_unit':null,
					'price':null,
					'qty_for_box':null,
					'medida':null,
				}
			}
		},
		mounted(){
			this.product_list = this.products;
			this.categories_list = this.categories;
		},
		watch:{
			type_category: function(res){
				this.product.category_id = res;
				if (this.product.category_id != null) {
					this.disable_button = false;
				}
			},
		},
		methods:{
			change_view(view_select){
				if (view_select == 'form_product') {
					this.clean_form();
					this.update_form = false;
				}
				this.view = view_select
			},
			clean_form(){
				this.product.image = null;
				this.product.name = null;
				this.product.peso_unit = null;
				this.product.price = null;
				this.product.category_id = null;
				this.product.medida = null;
				this.product.qty_for_box = null;
			},
			get_all_products(){
				axios.get('/product/get_all_products').then(response => {
					this.product_list = response.data.products;
					this.view = 'table_products';
				});
			},
			AddOrUpdate_Product(){
				if (!this.update_form) {
					this.product.image = '/img/imgDefault.jpeg';
					axios.post('/product/add_product',this.product).then(response => {
						this.get_all_products();
						alert("producto agregado correctamente");
					});
				}else{
					axios.post('/product/update_product',this.product).then(response => {
						this.get_all_products();
						this.update_form = false;
						alert("producto actualizado correctamente");
					});
				}
				location.reload();
			},
			DeleteProduct(id){
				axios.delete('/product/deleteProduct/'+id).then(response => {
					this.get_all_products();
					alert("eliminado");
				});
			},
			UpdateProduct(product){
				// console.log(product.peso_unit);
				this.product.category_id = product.category_id;
				this.type_category = product.category_id;
				this.product.id = product.id;
				this.product.name = product.name;
				this.product.peso_unit = product.peso_unit;
				this.product.price = product.price;
				this.product.qty_for_box = product.quantity_for_box;
				this.product.medida = product.medida;
				this.update_form = true;
				this.view = 'form_product';
			},
		},
	}
</script>

<style>
	.align-right{
		float: right;
	}
</style>
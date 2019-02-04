<template>
	<div>
		<div>

			<div class="x_panel" style="width: 30% !important; float: right;">
				<div class="x_title">
					<h2>Agregar Producto</h2>
					<div align="right">
						<span class="btn-xs btn-info" title="Seleccione un cliente para habilitar"><i class="fa fa-info" style="color: white;"></i></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<form action="">
						<div>
							<label class="label-control">
								<span>Lista de productos <strong>*</strong></span>
								<select v-model="infoProduct.prod_selected" class="form-control" style="width: 127% !important;" required="" :disabled="client == null" title="Seleccione un cliente para habilitar">
									<option disabled="" default>Seleccione un producto</option>
									<option v-for="prod in all_products" :value="prod">
										{{prod.name}}
									</option>
								</select>
							</label>
						</div>
						<br>
						<div>
							<label class="label-control">
								<span>Bultos <strong>*</strong></span>
								<input type="number" class="form-control" placeholder="Cantidad de bultos" v-model="infoProduct.qtyBox" style="width: 123% !important;" required="" :disabled="client == null">
							</label>
						</div>
						<br>
						<div>
							<label class="label-control">
								<span>Unidades <strong>*</strong></span>
								<input type="number" class="form-control" placeholder="Cantidad de unidades" v-model="infoProduct.qtyUnit" style="width: 123% !important;" required="" :disabled="client == null">
							</label>
						</div>
						<br>
						<div v-if="infoProduct.prod_selected != null">
							<button class="btn btn-dark" @click="AddToInvoice()" type="button" style="width: 100% !important;"><i class="fa fa-plus"> Agregar a factura</i></button>
						</div>
						<div v-else>
							<button class="btn btn-dark" type="button" style="width: 100% !important;" disabled=""><i class="fa fa-plus">Agregar a factura</i></button>
						</div>
					</form>
				</div>
			</div>

			<div style="width: 68% !important; float: left;">
				<table class="table table-responsive">
					<thead>
						<th v-if="client != null"></th>
						<th>Nombre del negocio</th>
						<th>RIF</th>
						<th>Dirección</th>
						<th>Telefono</th>
						<th>Iva</th>
					</thead>
					<tbody>
						<tr v-if="client == null">
							<td>
								<select v-model="client" class="form-control">
									<option default="" disabled="">Seleccione un cliente</option>
									<option v-for="cli in clients" :value="cli">
										{{ cli.name_bussines}}
									</option>
								</select>
							</td>
						</tr>
						<tr v-else>
							<td>
								<button class="btn btn-danger" @click="cleanCli()"><i class="fa fa-close"></i></button>
							</td>
							<td>
								{{client.name_bussines}}
							</td>
							<td>
								{{client.code_rif}}
							</td>
							<td>
								{{client.address}}
							</td>
							<td>
								{{client.phone}}
							</td>
							<td>
								{{client.tax}}%
							</td>
						</tr>
					</tbody>
				</table>
				<br><br>
				<table class="table table-responsive">
					<thead>
						<th></th>
						<th>Producto</th>
						<th>Cantidad de Bultos</th>
						<th>Cantidad Unitaria</th>
						<th>Precio por bulto</th>
						<th>SubTotal</th>
					</thead>
					<tbody>
						<tr v-for="prod in invoices">
							<td>
								<button class="btn btn-danger btn-xs" @click="deleteInInvoice(prod)"><i class="fa fa-close"></i></button>
							</td>
							<td>
								{{ prod.product.name }}
							</td>
							<td>
								{{ prod.qtyBox }}
							</td>
							<td>
								{{ prod.qtyUnit }}
							</td>
							<td>
								<div>
									<span>BsS </span>{{ prod.product.price }}
								</div>
							</td>
							<td>
								<div>
									<span>BsS </span>{{ parseFloat(prod.qtyBox*(prod.product.price) + prod.qtyUnit*(prod.product.price/prod.product.quantity_for_box)).toFixed(2) }}
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<br>
				<div class="clearfix"></div>
				<div align="right">
					<label>Sub-Total: BsS {{(subTotal).toFixed(2)}}</label>
				</div>
				<div align="right">
					<label v-if="client != null">Iva ({{client.tax}}%): BsS {{(totIVA).toFixed(2)}}</label>
					<label v-else>Iva%: BsS {{(totIVA).toFixed(2)}}</label>
				</div>
				<div align="right">
					<label>Total a Pagar: BsS {{(tot).toFixed(2)}}</label>
				</div>
				<div v-if="client != null && invoices[0] != null">
					<button class="btn btn-dark" @click="SaveInvoice()">Guardar Factura</button>
					
				</div>
				<div v-else>
					<button class="btn btn-dark" disabled="" >Guardar Factura</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>

export default{

	props:['products','clients'],
	data(){
		return{
			all_products:[],
			subTotal:0,
			totIVA:0,
			tot:0,
			infoProduct:{
				id:null,
				qtyBox:0,
				qtyUnit:0,
			},
			invoices:[],
			client:null,
		}
	},
	mounted(){
		this.all_products = this.products;
	},
	watch:{
		client:function(res){
			this.CalculateSubTotal();
		},
	},
	methods:{
		cleanCli(){
			this.client = null;
		},
		clean(){
			this.infoProduct = {
				id:null,
				qtyBox:0,
				qtyUnit:0,
			};
		},
		CalculateSubTotal(){
			if (this.client != null) {
				this.subTotal = 0;
				this.totIVA = 0;
				for (var i in this.invoices) {
					var aux1 = this.invoices[i].qtyBox*(this.invoices[i].product.price);
					var aux2 = this.invoices[i].qtyUnit*(this.invoices[i].product.price/this.invoices[i].product.quantity_for_box);
					this.subTotal = parseFloat(this.subTotal) + parseFloat(aux1) + parseFloat(aux2);
					this.subTotal = parseFloat(parseFloat(this.subTotal).toFixed(2));
				};
				this.totIVA = parseFloat((parseFloat(this.subTotal)*parseFloat(this.client.tax)/100).toFixed(2));
				this.tot = this.subTotal+this.totIVA;
			}
			else{
				this.clean();
			}

		},
		AddToInvoice(){

			if (this.infoProduct.qtyBox != '' || this.infoProduct.qtyUnit != '') {

				this.invoices.push({
					idInventory:this.infoProduct.prod_selected.inventory.id,
					product:this.infoProduct.prod_selected,
					qtyBox:parseInt(this.infoProduct.qtyBox),
					qtyUnit:parseInt(this.infoProduct.qtyUnit),
				});
				this.clean();
				this.CalculateSubTotal();
			}
		},
		SaveInvoice(){
			console.log(this.invoices);
			// axios.post('orders/RemoveInInventory',{'info':this.invoices}).then(response=>{
			// 	alert("exito")
			// }).catch(err=>{
			// 	console.log(err);
			// });
		},
		deleteInInvoice(product){
			var index = this.invoices.indexOf(product);
			this.invoices.splice(index,1);
			this.CalculateSubTotal();
		},
	},
}
</script>
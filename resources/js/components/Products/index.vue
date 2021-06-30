<template>
	<div
		id="products-index"
		class="col-12"
	>
		<router-link :to="{ name: 'productAdd' }">+ Agregar producto</router-link>
		<div class="table-responsive my-3">
			<table class="table">
				<caption>
					Lista de productos
					<div
						class="spinner-border"
						role="status"
						v-show="searching"
					>
						<span class="visually-hidden">Loading...</span>
					</div>
				</caption>
				<thead>
					<tr>
						<th>ID</th>
						<th>Categoría</th>
						<th>Producto</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<tr
						v-for="p in Products"
						:key="p.id"
					>
						<td>
							<router-link
								:to="{
									name:'productEdit',
									params: {
										id: p.id
									}
								}"
								v-text="p.id"
								:title="'Ver el detalle del producto:' + p.name"
							>
							</router-link>
						</td>
						<td
							v-if="p.category"
							v-text="p.category.name"
						></td>
						<td v-else>-</td>
						<td v-text="p.name"></td>
						<td>
							<button
								type="button"
								class="btn btn-danger btn-sm"
								@click="_delete(p)"
							>Borrar</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			Products: [],
			searching: false
		};
	},
	methods: {
		get() {
			this.searching = true;
			axios
				.get("/api/admin/products", {
					params: {
						category: true
					}
				})
				.then(response => (this.Products = response.data))
				.catch(error => {
					console.error(error, error.response);
				})
				.then(() => {
					this.searching = false;
				});
		},
		_delete(Product) {
			Swal.fire({
				icon: "warning",
				title: `¿Desea borrar el producto: ${Product.name}?`,
				showCancelButton: true,
				cancelButtonText: "Cancelar",
				confirmButtonText: "Sí, borralo",
				customClass: {
					confirmButton: "btn btn-danger mx-3",
					cancelButton: "btn btn-light mx-3"
				},
				reverseButtons: true,
				buttonsStyling: false
			}).then(result => {
				if (result.isConfirmed) {
					axios
						.delete(`/api/admin/products/${Product.id}`)
						.then(() => this.get())
						.catch(error => {
							console.error(error, error.response);
						});
				}
			});
		}
	},
	created() {
		this.get();
	}
};
</script>
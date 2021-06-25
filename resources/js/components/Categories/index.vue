<template>
	<div
		id="categories-index"
		class="col-12"
	>
		<router-link :to="{ name: 'categoryAdd' }">+ Agregar categoría</router-link>
		<div class="table-responsive my-3">
			<table class="table">
				<caption>
					Lista de categorías
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
						<th>Nombre</th>
						<th>Padre</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<tr
						v-for="c in Categories"
						:key="c.id"
					>
						<td>
							<router-link
								:to="{
									name:'categoryEdit',
									params: {
										id: c.id
									}
								}"
								v-text="c.name"
								:title="'Ver el detalle de la categoría:' + c.name"
							>
							</router-link>
						</td>
						<td v-text="c.name"></td>
						<td>{{ c.father != null ? c.father.name : '-' }}</td>
						<td>
							<button
								type="button"
								class="btn btn-danger btn-sm"
								@click="_delete(c)"
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
			Categories: [],
			searching: false
		};
	},
	methods: {
		get() {
			this.searching = true;
			axios
				.get("/api/admin/categories", {
					params: {
						father: true
					}
				})
				.then(response => (this.Categories = response.data))
				.catch(error => {
					console.error(error, error.response);
				})
				.then(() => {
					this.searching = false;
				});
		},
		_delete(Category) {
			Swal.fire({
				icon: "warning",
				title: `¿Desea borrar la categoría: ${Category.name}?`,
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
						.delete(`/api/admin/categories/${Category.id}`)
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
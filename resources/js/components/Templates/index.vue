<template>
	<div
		id="templates-index"
		class="col-12"
	>
		<router-link :to="{ name: 'templateAdd' }">+ Agregar plantilla</router-link>

		<form
			class="my-3"
			@submit.prevent.stop="get"
		>
			<div class="row">
				<div class="col-sm-6">
					<div class="input-group mb-3">
						<input
							type="search"
							class="form-control"
							placeholder="Categoría"
							v-model="search"
							aria-label="Buscar categorías"
							aria-describedby="button-addon2"
						>
						<button
							class="btn btn-outline-secondary"
							type="submit"
							id="button-addon2"
						>Buscar</button>
					</div>
				</div>
			</div>
		</form>

		<div class="table-responsive my-3">
			<table class="table">
				<caption>
					Lista de plantillas
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
						<th>Categoría</th>
						<th>Atributos</th>
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
									name:'templateEdit',
									params: {
										id: c.id
									}
								}"
								v-text="c.name"
								:title="'Ver el detalle de la plantilla:' + c.name"
							>
							</router-link>
						</td>
						<td>{{ c.templates.length }}</td>
						<td>
							<button
								type="button"
								class="btn btn-danger btn-sm"
								@click="_delete(c)"
							>Borrar</button>
						</td>
					</tr>
					<tr v-if="Categories.length == 0">
						<td
							colspan="3"
							class="text-center py-3"
						>No se encontraron registros</td>
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
			searching: false,
			search: ""
		};
	},
	methods: {
		get() {
			this.searching = true;
			axios
				.get("/api/admin/templates", {
					params: {
						search: this.search
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
			/*
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
            */
		}
	},
	created() {
		this.get();
	}
};
</script>
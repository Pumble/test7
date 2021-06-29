<template>
	<div
		id="templates-edit"
		v-cloak
		class="col-12"
	>
		<form @submit.prevent.stop="put">
			<div class="mb-3">
				<label
					for="category_id"
					class="form-label"
				>ID:</label>
				<input
					type="number"
					class="form-control"
					id="category_id"
					disabled
					v-model="Category.id"
				>
			</div>
			<div class="mb-3">
				<label
					for="category_name"
					class="form-label"
					required
				>Nombre:</label>
				<input
					type="text"
					class="form-control"
					id="category_name"
					v-model="Category.name"
					readonly
				>
			</div>

			<div class="row mt-5 mb-3">
				<h4>Atributos</h4>
				<hr>

				<div
					class="col-12 col-sm-4 col-md-3"
					@click="addAttribute"
				>
					<div class="card mb-3 addAttribute">
						<div class="card-body text-center">
							<h6 class="card-title">Agregar atributo</h6>
							<h1 class="card-subtitle mb-2 text-muted">+</h1>
						</div>
					</div>
				</div>

				<div
					class="col-12 col-sm-4 col-md-3"
					v-for="(t,i) in filteredTemplates"
					:key="t.id"
				>
					<div class="card mb-3">
						<div class="card-body">
							<h6
								v-if="!('added' in t)"
								class="card-title"
								v-text="t.attribute.name"
							></h6>
							<select
								v-else
								:id="Category.id + '__' + i"
								class="form-select form-select-sm mb-3"
								aria-label=".form-select-sm"
								v-model="t.attribute_id"
								placeholder="Nombre"
								required
							>
								<option
									v-for="(a, i) in Attributes"
									:key="i"
									:value="a.id"
									v-text="a.name"
								></option>
							</select>

							<select
								:id="Category.id + '_' + t.id"
								class="form-select form-select-sm"
								aria-label=".form-select-sm"
								v-model="t.type"
								placeholder="Tipo"
							>
								<option
									v-for="(v, i) in types"
									:key="i"
									:value="v"
									v-text="v"
									required
								></option>
							</select>
							<button
								type="button"
								class="btn btn-link card-link text-danger"
								@click="removeAttribute(t.id)"
							>Quitar</button>
						</div>
					</div>
				</div>
				<!--AGREGAR UN NUEVO ATRIBUTO-->
				<!--QUITAR UN ATRIBUTO DEL TEMPLATE-->
			</div>

			<button
				class="btn btn-primary"
				type="submit"
				:disabled="working"
			>
				<span
					v-show="working"
					class="spinner-border spinner-border-sm"
					role="status"
					aria-hidden="true"
				></span>
				Enviar
			</button>
		</form>
	</div>
</template>
<script>
export default {
	data() {
		return {
			Category: {
				id: null,
				category_id: null,
				name: null
			},
			Attributes: [],
			working: false,
			errors: []
		};
	},
	computed: {
		types() {
			return this.$root.types;
		},
		filteredTemplates() {
			if (this.Category.id !== null) {
				return this.Category.templates.filter(t => {
					return t.deleted || t.deleted == true ? false : true;
				});
			} else {
				return [];
			}
		}
	},
	methods: {
		put() {
			this.working = true;
			this.errors = [];
			axios
				.put("api/admin/templates", {
					templates: this.Category.templates.map(t => {
						return {
							id: t.id,
							category_id: t.category_id,
							attribute_id: t.attribute_id,
							type: t.type
						};
					})
				})
				.then(response => {
					Swal.fire({
						icon: "success",
						text: "Datos actualizados"
					}).then(() => {
						this.$router.back();
					});
				})
				.catch(error => {
					console.error(error, error.response);
					if (error.response.data)
						this.errors = error.response.data.errors;
				})
				.then(() => {
					this.working = false;
				});
		},
		get(category_id) {
			this.working = true;
			axios
				.get(`/api/admin/templates/${category_id}`)
				.then(response => (this.Category = response.data))
				.catch(error => {
					console.error(error, error.response);
				})
				.then(() => {
					this.working = false;
				});
		},
		getAttributes() {
			this.working = true;
			axios
				.get(`/api/admin/attributes`)
				.then(response => (this.Attributes = response.data))
				.catch(error => {
					console.error(error, error.response);
				})
				.then(() => {
					this.working = false;
				});
		},
		addAttribute() {
			this.Category.templates.push({
				attribute: null,
				attribute_id: null,
				category_id: this.Category.id,
				type: "Float",
				added: true
			});
		},
		removeAttribute(id) {
			var index = this.Category.templates.findIndex(x => x.id === id);
			this.Category.templates[index].deleted = true;
			// template.deleted = true;
			// this.Category.templates[index].deleted = true;
			// this.Category.templates.splice(index, 1);
		}
	},
	created() {
		if (this.$route.params) {
			if (this.$route.params.id) {
				this.get(this.$route.params.id);
				this.getAttributes();
			} else {
				Swal.fire({
					icon: "error",
					text: "Intenta volver a seleccionar la categoría"
				});
			}
		}
	}
};
</script>
<style scoped>
.addAttribute {
	cursor: pointer;
	transition: 0.2s all ease;
}
.addAttribute:hover {
	cursor: pointer;
	transform: scale(0.95, 0.95);
}
</style>
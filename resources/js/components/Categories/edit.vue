<template>
	<div
		id="categories-edit"
		v-cloak
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
				>
			</div>
			<div class="mb-3">
				<label
					for="category_name"
					class="form-label"
				>Categoría padre:</label>
				<select
					class="form-select"
					v-model="Category.category_id"
				>
					<option>-Indique una opción-</option>
					<option
						v-for="c in Categories"
						:key="c.id"
						:value="c.id"
						v-text="c.name"
					></option>
				</select>
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
			Categories: [],
			working: false,
			errors: []
		};
	},
	methods: {
		put() {
			this.working = true;
			this.errors = [];
			axios
				.put("api/admin/categories", this.Category)
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
				.get(`/api/admin/categories/${category_id}`)
				.then(response => (this.Category = response.data))
				.catch(error => {
					console.error(error, error.response);
				})
				.then(() => {
					this.working = false;
				});
		},
		getCategories() {
			this.working = true;
			axios
				.get(`/api/admin/categories`, {
					params: {
						father: false
					}
				})
				.then(response => (this.Categories = response.data))
				.catch(error => {
					console.error(error, error.response);
				})
				.then(() => {
					this.working = false;
				});
		}
	},
	created() {
		if (this.$route.params.id) {
			this.get(this.$route.params.id);
			this.getCategories();
		}
	}
};
</script>
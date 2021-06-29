<template>
	<div
		id="templates-add"
		v-cloak
		class="col-12"
	>
		<form @submit.prevent.stop="post">
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
				category_id: null,
				name: null
			},
			Categories: [],
			working: false,
			errors: []
		};
	},
	methods: {
		post() {
			this.working = true;
			this.errors = [];
			axios
				.post("api/admin/categories", this.Category)
				.then(response => {
					Swal.fire({
						icon: "success",
						text: "Categoría creada"
					}).then(() => {
						this.Category = {
							category_id: null,
							name: null
						};
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
		this.getCategories();
	}
};
</script>
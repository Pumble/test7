<template>
	<div
		id="products-edit"
		v-cloak
		class="col-12"
	>
		<form @submit.prevent.stop="validate">
			<div class="mb-3">
				<label
					for="product_id"
					class="form-label"
				>ID:</label>
				<input
					type="number"
					class="form-control"
					id="product_id"
					disabled
					v-model="Product.id"
				>
			</div>
			<div class="mb-3">
				<label
					for="product_name"
					class="form-label"
					required
				>Nombre:</label>
				<input
					type="text"
					class="form-control"
					id="product_name"
					v-model="Product.name"
				>
			</div>
			<div class="mb-3">
				<label
					for="category_name"
					class="form-label"
				>Categoría:</label>
				<select
					class="form-select"
					v-model="Product.category_id"
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

			<div class="row mt-5 mb-3">
				<h4>Atributos</h4>
				<hr>

				<div
					class="col-12 col-sm-4 col-md-3"
					v-for="(tv,i) in Product.templates"
					:key="i"
				>
					<div class="card mb-3">
						<div class="card-body">
							<div class="mb-3">
								<label
									:for="'tv-input-' + i"
									class="form-label"
									v-text="tv.attribute.name"
								></label>

								<input
									v-if="tv.type == 'Number' || tv.type == 'Float'"
									type="number"
									class="form-control"
									:id="'tv-input-' + i"
									aria-describedby="'tv-input-help'"
									v-model="tv.value"
									step="0.01"
									required
								>
								<input
									v-else-if="tv.type == 'String'"
									type="text"
									class="form-control"
									:id="'tv-input-' + i"
									aria-describedby="'tv-input-help'"
									v-model="tv.value"
								>
								<div v-else-if="tv.type == 'Boolean'">
									<div class="form-check">
										<input
											class="form-check-input"
											type="radio"
											:name="'tv-boolean-' + i"
											:id="'tv-boolean-true' + i"
											v-model="tv.value"
											:value="true"
										>
										<label
											class="form-check-label"
											:for="'tv-boolean-true' + i"
										>Verdadero</label>
									</div>
									<div class="form-check">
										<input
											class="form-check-input"
											type="radio"
											:name="'tv-boolean-' + i"
											:id="'tv-boolean-false' + i"
											v-model="tv.value"
											:value="false"
										>
										<label
											class="form-check-label"
											:for="'tv-boolean-false' + i"
										>Falso</label>
									</div>
								</div>
								<input
									v-else-if="tv.type == 'Object' || tv.type == 'Array'"
									type="text"
									class="form-control"
									:id="'tv-input-' + i"
									aria-describedby="'tv-input-help'"
									v-model="tv.value"
									placeholder="Pegue el objeto JSON aquí"
								>
								<input
									v-else-if="tv.type == 'Date'"
									type="date"
									class="form-control"
									:id="'tv-input-' + i"
									aria-describedby="'tv-input-help'"
									v-model="tv.value"
								>
								<input
									v-else
									type="date"
									class="form-control"
									:id="'tv-input-' + i"
									aria-describedby="'tv-input-help'"
									v-model="tv.value"
								>
								<div
									id="'tv-input-help'"
									class="form-text"
								>Este campo debe ser de tipo: {{ tv.type }}</div>
								<div
									class="invalid-feedback"
									v-show="!tv.isValid"
								>
									Datos inválidos
								</div>
							</div>
						</div>
					</div>
				</div>
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
			Product: {
				id: null,
				category_id: null,
				name: null
			},
			Categories: [],
			working: false,
			errors: []
		};
	},
	computed: {
		putData() {
			return {
				id: this.Product.id,
				category_id: this.Product.category_id,
				name: this.Product.name,
				templates: this.Product.templates.map(t => {
					return {
						id: t.pivot.id,
						value: t.jsonValue
					};
				})
			};
		}
	},
	methods: {
		put() {
			this.working = true;
			this.errors = [];
			axios
				.put("api/admin/products", this.putData)
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
		get(product_id) {
			this.working = true;
			axios
				.get(`/api/admin/products/${product_id}`, {
					params: {
						templateValues: true
					}
				})
				.then(response => {
					response.data.templates.forEach(t => {
						var aux = null;
						var jsonData = JSON.parse(t.pivot.value);
						switch (t.type) {
							case "Number":
								aux = Number.parseInt(jsonData.value);
								break;
							case "Float":
								aux = Number.parseFloat(jsonData.value);
								break;
							case "String":
								aux = String(jsonData.value);
								break;
							case "Boolean":
								aux = Boolean(jsonData.value);
								break;
							case "Object":
							case "Array":
								aux = JSON.parse(jsonData.value);
								break;
							case "Date":
								aux = new Date(jsonData.value);
								break;
						}
						t.value = aux;
					});
					this.Product = response.data;
				})
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
						father: false,
						templates: true
					}
				})
				.then(response => (this.Categories = response.data))
				.catch(error => {
					console.error(error, error.response);
				})
				.then(() => {
					this.working = false;
				});
		},
		validateTemplateValueByType(templateValue) {
			try {
				var aux = null;
				switch (templateValue.type) {
					case "Number":
						aux = Number.parseInt(templateValue.value);
						break;
					case "Float":
						aux = Number.parseFloat(templateValue.value);
						break;
					case "String":
						aux = String(templateValue.value);
						break;
					case "Boolean":
						aux = Boolean(templateValue.value);
						break;
					case "Object":
					case "Array":
						aux = JSON.parse(templateValue.value);
						break;
					case "Date":
						aux = new Date(templateValue.value);
						break;
					default:
						templateValue.validated = false;
						break;
				}
				templateValue.jsonValue = {
					value: aux
				};
				templateValue.isValid = true;
			} catch (e) {
				templateValue.isValid = false;
			}
			return templateValue.isValid;
		},
		validate() {
			var isValid = true;
			this.Product.templates.forEach(t => {
				if (!this.validateTemplateValueByType(t)) {
					isValid = false;
				}
			});
			if (isValid) {
				this.put();
			} else {
				Swal.fire({
					icon: "error",
					text: "Hay datos inválidos"
				});
			}
		}
	},
	created() {
		if (this.$route.params.id) {
			this.get(this.$route.params.id);
			this.getCategories();
		} else {
			Swal.fire({
				icon: "error",
				text: "Intenta volver a seleccionar el producto"
			});
		}
	}
};
</script>
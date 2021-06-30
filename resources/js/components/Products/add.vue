<template>
	<div
		id="products-add"
		v-cloak
		class="col-12"
	>
		<form @submit.prevent.stop="validate">
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
					for="product_name"
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
					v-for="(tv,i) in Product.templateValues"
					:key="i"
				>
					<div class="card mb-3">
						<div class="card-body">
							<div class="mb-3">
								<label
									:for="'tv-input-' + i"
									class="form-label"
									v-text="tv.name"
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
				category_id: null,
				name: null,
				templateValues: []
			},
			Categories: [],
			working: false,
			errors: []
		};
	},
	watch: {
		"Product.category_id": function(id) {
			var index = this.Categories.findIndex(x => x.id === id);
			if (index >= 0) {
				this.Product.templateValues = this.Categories[
					index
				].templates.map(t => {
					return {
						name: t.attribute.name,
						template_id: t.id,
						value: null,
						type: t.type,
						validated: false,
						jsonValue: null
					};
				});
			} else {
				this.Product.templateValues = [];
			}
		}
	},
	methods: {
		post() {
			this.working = true;
			this.errors = [];
			axios
				.post("api/admin/products", this.Product)
				.then(response => {
					Swal.fire({
						icon: "success",
						text: "Producto creado"
					}).then(() => {
						this.Product = {
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
						father: false,
						templates: true
					}
				})
				.then(response => {
					response.data.forEach(c => {
						c.templates.forEach(t => {
							t.value = null;
						});
					});
					this.Categories = response.data;
				})
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
			this.Product.templateValues.forEach(tv => {
				if (!this.validateTemplateValueByType(tv)) {
					isValid = false;
				}
			});
			if (isValid) {
				this.post();
			} else {
				Swal.fire({
					icon: "error",
					text: "Hay datos inválidos"
				});
			}
		}
	},
	created() {
		this.getCategories();
	}
};
</script>
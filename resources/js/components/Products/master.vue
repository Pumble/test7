<template>
	<div
		class="row"
		id="products-master"
	>
		<h2>Productos</h2>

		<router-view name="productsRouterView"></router-view>
	</div>
</template>
<script>
export default {
	mounted() {
		console.log("estamos en master de products");
	}
};
</script>
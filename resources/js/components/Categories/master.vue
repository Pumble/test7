<template>
	<div
		class="row"
		id="categories-master"
	>
		<h2>Categorías</h2>

		<router-view name="categoriesRouterView"></router-view>
	</div>
</template>
<script>
export default {
	mounted() {
		console.log("estamos en master de categories");
	}
};
</script>
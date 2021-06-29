<template>
	<div
		id="templates-master"
		class="row"
	>
		<h2>Plantillas</h2>

		<router-view name="templatesRouterView"></router-view>
	</div>
</template>
<script>
export default {
	mounted() {
		console.log("estamos en master de templates");
	}
};
</script>
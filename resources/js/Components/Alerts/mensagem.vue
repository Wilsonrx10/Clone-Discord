<template>
  <div class="mensagem">
    <div class="alert alert-warning" role="alert">
      {{ message }}
    </div>
  </div>
</template>

<script>
import { onMounted } from "@vue/runtime-core";
export default {
  setup(props) {
    onMounted(() => {
      setInterval(() => {
        console.log("mudar o estado da mensagem");
      }, 3000);
    });
  },
  props: {
    message: { type: String, required: true },
  },
};
</script>

<style>
</style>
<template>
  <div class="opcoes">
    <div class="ocultar"></div>

    <div class="pesquisa">
      <input type="text" placeholder="buscar" />
    </div>

    <div class="notificacao">
      <notificacao class="icone" :size="20" />
    </div>
  </div>
</template>

<script setup>
import notificacao from "vue-material-design-icons/Bell.vue";
</script>

<style scoped lang="scss">
.opcoes {
  display: flex;
  div {
    margin: 3px;
  }
  .icone {
    color: var(--white);
  }
  .pesquisa {
    position: relative;
    input {
      background-color: var(--tertiary);
      padding: 5px;
      padding-top: 2px;
      padding-left: 10px;
      border-radius: 4px;
      color: var(--white);
    }
    .icone {
      position: absolute;
      margin-left: -25px;
    }
  }
}
</style>
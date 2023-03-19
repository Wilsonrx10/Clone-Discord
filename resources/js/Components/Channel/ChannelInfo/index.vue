<template>
  <div class="container">
    <div class="opcoesOne">
      <div class="icon">
        <HashTag :size="24" />
      </div>
      <div class="title">{{serverName == NULL ? 'Servidor do Wilson' : serverName}}</div>
    </div>

    <div class="opcoesTwo">
      <Options />
    </div>
  </div>
</template>

<script setup>
import useEventsBus from "@/eventBus";
import { ref, watch } from "vue";
import HashTag from "vue-material-design-icons/Pound.vue";
import Options from "./options.vue";

const {bus,emit} = useEventsBus();
const serverName = ref();

watch(()=> bus.value.get('server'),(payload) => {
  serverName.value = payload[0].name
})

</script>

<style scoped lang="scss">
.container {
  grid-area: CI;
  background-color: var(--primary);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 17px;
  z-index: 2;
  border-bottom: 3px solid var(--discord);
  .opcoesOne {
    display: flex;
    flex-direction: row;
    div:nth-child(1) {
      color: var(--symbol);
    }
    div:nth-child(2) {
      color: var(--white);
      font-weight: 600;
    }
  }
}
</style>
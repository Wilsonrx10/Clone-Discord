<template>
  <div class="container">
    <section v-if="estado" class="list">
      <div @click="MudarListFriend('todos')" class="opcao">
        <span>Todos</span>
      </div>

      <div @click="MudarListFriend('Bloqueado')" class="opcao">
        <span>Bloqueados</span>
      </div>

      <div @click="MudarListFriend('Aceite')" class="opcao">
        <span>Aceites</span>
      </div>

      <div @click="MudarListFriend('Pendente')" class="opcao">
        <span>Pendentes</span>
      </div>

      <div @click="AdicionarAmigo" class="adicionar">
        <span>Adicionar Amigo</span>
      </div>
    </section>

    <section v-else class="usernameMessage">
      <div>
        <div class="icone">
          <At :size="26" />
        </div>

        <div class="nome">
          <span>{{ user.name }}</span>
        </div>
      </div>
    </section>

    <section v-if="addAmigos.estado">
      <AdicionarFriend @FecharModal="addAmigos.estado = false" />
    </section>
  </div>
</template>

<script setup>
import At from "vue-material-design-icons/At.vue";
import useEventsBus from "@/eventBus";
import { watch, ref, reactive } from "@vue/runtime-core";
import AdicionarFriend from "./AdicionarFriend.vue";
const { emit, bus } = useEventsBus();
const estado = ref(true);
const user = ref();
const addAmigos = reactive({
  estado: false,
});

const MudarListFriend = (event) => {
  emit("MudarListFriend", event);
};
const AdicionarAmigo = () => {
  addAmigos.estado = true;
};
watch(() => bus.value.get("ExibirMessage"),(payload) => {
    estado.value = false;
    user.value = payload[0].user ? payload[0].user : payload[0];
  }
);
</script>

<style scoped lang="scss">
@import "scss/index";
</style> 
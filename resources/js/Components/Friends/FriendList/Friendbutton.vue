<template>
  <div>
    <div
      v-for="item in amigos"
      :key="item.friend.id"
      @click="ExibirMessage(item.friend)"
      class="container"
      :class="{ active: selected }"
    >
      <div class="channel-info">
        <img :src="'/image/usuarios/' + item.friend.profile.profile_photo" />
        <div>{{ item.friend.name }}</div>
      </div>

      <div class="channel-actions">
        <SettingIcon class="icon-actions" :size="16" />
      </div>
    </div>
  </div>
</template>

<script setup>
import useEventsBus from "@/eventBus";
import HashTagIcon from "vue-material-design-icons/Pound.vue";
import SettingIcon from "vue-material-design-icons/CogOutline.vue";
import { onMounted, watch, ref } from "@vue/runtime-core";
import axios from "axios";
import { useStore } from "vuex";
const { bus, emit } = useEventsBus();
const amigos = ref();
const listaAmigos = ref();
const store = useStore();

onMounted(async() => {
    await BuscarListaAmigos();
});

watch(
  () => bus.value.get("MudarListFriend"),
  (payload) => {
    FiltrarAmigos(payload);
  }
);

const BuscarListaAmigos = async () => {
    await axios.get("channel/BuscarListaAmigos").then((response) => {
    amigos.value = response.data.friends;
    listaAmigos.value = response.data;
    store.commit('GUARDAR_LISTA_AMIGOS', response.data.friends);
  });
}

const FiltrarAmigos = (status) => {
  if (status[0] === "todos") {
    amigos.value = listaAmigos.value;
  } else {
    let amigo = listaAmigos.value;
    const filtro = amigo.filter((item) => item.status == status);
    amigos.value = filtro;
  }
};
const ExibirMessage = (item) => {
  emit("ExibirMessage", item);
};
</script>

<style scoped lang="scss">
@import "scss/Friendbutton";
</style>
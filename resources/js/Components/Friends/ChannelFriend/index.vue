<template>
  <div class="channel-data">
    <div v-if="wampus" class="Wampus">
      <div>
        <img src="/image/wampu.svg" width="400" />
        <p>Ninguém por perto para brincar com o Wampus</p>
      </div>
    </div>

    <div v-else>
      <div v-if="NewFriend.estado" class="newfriend">
        <img :src="'/image/usuarios/' + data.profile.profile_photo" alt="" />
        <strong>{{ data.name }}</strong>
        <p>Não tens nenhuma mensagem com seu novo amigo</p>
        <div>
          <span>3 Servidor em comum</span>
          <button>Adicionar</button>
          <button>Bloquear</button>
        </div>
      </div>

      <div v-else class="message">
        <channelmessage />
      </div>

      <div class="input-wrapper">
        <input
          @keypress.enter="EnviarMensagem"
          type="text"
          v-model="mensagem"
          placeholder="Conversar"
        />
        <div class="icon">
          <At :size="24" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Arrow from "vue-material-design-icons/ArrowRight.vue";
import At from "vue-material-design-icons/At.vue";
import Channelmessage from "./Channelmessage.vue";
import Channelmention from "./Channelmention.vue";
import { computed, watch, ref, reactive } from "vue";
import { useStore } from "vuex";
import axios from "axios";
import useEventsBus from "@/eventBus";

const { bus, emit } = useEventsBus();
const data = ref([]);
const store = useStore();
const mensagem = ref();
const wampus = ref(true);
const NewFriend = reactive({
  estado: false,
});

watch(
  () => bus.value.get("ExibirMessage"),
  (payload) => {
    wampus.value = false;
    data.value = payload[0];
    store.commit("GUARDAR_DADOS_MENSAGEM_USUARIO", data.value);
    if (payload[1] != null) {
      let resultado = store.state.friends.filter(
        (item) => item.id === payload[0].id
      );
      if (resultado.length > 0) {
        NewFriend.estado = false;
        store.commit("ABRIR_MENSAGEM_USUARIO");
        emit("ExibirMessages");
      } else {
        NewFriend.estado = true;
      }
    }
    store.commit("ABRIR_MENSAGEM_USUARIO");
    emit("ExibirMessages");
  }
);

const EnviarMensagem = () => {
  emit("RefreshMessage", mensagem.value);
  axios
    .post("/channel/EnviarMensagem", {
      mensagem: mensagem.value,
      id: dadosMensagem.value.id,
    })
    .then((response) => {
      console.log(response.data);
    })
    .catch((erro) => {
      console.log(erro);
    });
  mensagem.value = "";
};
</script>

<style scoped lang="scss">
@import "scss/index";
</style>
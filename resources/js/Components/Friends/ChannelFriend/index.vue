<template>
  <div class="channel-data">
    <div v-if="wampus" class="Wampus">
      <div>
        <img src="/image/wampu.svg" width="400" />
        <p>Ninguém por perto para brincar com o Wampus</p>
      </div>
    </div>

    <div v-else>
      <div v-if="NewFriend.state" class="newfriend">
        <img :src="`/image/usuarios/${data.profile.profile_photo}`" />
        <strong>{{ data.name }}</strong>
        <p>Não tens nenhuma mensagem com seu novo amigo</p>
        <div>
          <span>3 Servidor em comum</span>
          <button @click="AddFiend(data.id)">Adicionar</button>
        </div>
      </div>

      <div v-else class="message">
        <channelmessage />
      </div>

      <div class="input-wrapper">
        <input
          @keypress.enter="EnviarMensagem"
          type="text"
          v-model="form.message"
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

const form = reactive({
  message:null,
  receiver: store.state.Chat.DadosMensagemUsuario.user
});

const wampus = ref(true);

const NewFriend = reactive({
  state: false,
});

watch(() => bus.value.get("ExibirMessage"),(payload) => {
    wampus.value = false;
    data.value = payload[0];
    store.commit("Chat/GUARDAR_DADOS_MENSAGEM_USUARIO", data.value);
    if (payload[1] != null) {
      let resultado = store.state.friends.filter(
        (item) => item.user.id === payload[0].id
      );
      if (resultado.length > 0) {
        NewFriend.state = false;
        store.commit("Chat/ABRIR_MENSAGEM_USUARIO");
        emit("ExibirMessages");
      } else {
        NewFriend.state = true;
      }
    }
    store.commit("Chat/ABRIR_MENSAGEM_USUARIO");
    emit("ExibirMessages");
  }
);

const EnviarMensagem = () => {
  emit("RefreshMessage", form.message);
  axios
    .post("/channel/EnviarMensagem", { ...form })
    .then((response) => {
      console.log(response.data);
    }).finally(() => {
      form.message = "";
    })
    .catch((erro) => {
      console.log(erro);
    });
};
</script>

<style scoped lang="scss">
@import "scss/index";
</style>
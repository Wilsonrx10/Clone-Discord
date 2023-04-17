<template>
  <div ref="content">
    <div
      v-for="item in messages"
      :key="item.id"
      class="channel-message"
      :class="{ 'has-mention': hasmention }"
    >
      <div class="message">
        <div class="user">
          <img
            class="avatar"
            :src="'/image/usuarios/' + item.user.profile.profile_photo"
          />
          <strong>{{ item.user.name }}</strong>
          <span class="bot" v-if="isBot">Bot</span>
          <span class="data">{{formatDate(item.created_at)}}</span>
        </div>
        <div class="body">
          <p>{{ item.message }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { onMounted, ref, watch } from "@vue/runtime-core";
import useEventsBus from "@/eventBus";
import { useStore } from "vuex";
export default {
  props: {
    date: String,
    author: String,
    hasmention: Boolean,
    isBot: Boolean,
  },
  setup(props) {
    const { bus } = useEventsBus();
    const messages = ref([]);
    const store = useStore();
    const content = ref(null);

    onMounted(() => {
      Echo.private(`user.${store.getters.user.id}`).listen('.SendMessage', (payload) => {
        console.log(payload);
        BuscarMensagem();
      });

      BuscarMensagem();

    });


    watch(() => bus.value.get("RefreshMessage"), (payload) => {
        handleScroll();
        let newMessage = {
          message: payload[0],
          user:{
            name: store.state.user.name,
            profile: {
              profile_photo: store.state.user.profile.profile_photo
            },
          }
        }

        messages.value.push(newMessage);
      }
    );

    watch(() => bus.value.get("ExibirMessages"),(payload) => {
        BuscarMensagem();
      }
    );

    const BuscarMensagem = async () => {
      await axios
        .get(
          `/channel/BuscarMessages/${store.state.Chat.DadosMensagemUsuario.user.id}`
        )
        .then((response) => {
          messages.value = response.data;
        })
        .catch((erro) => {
          console.log(erro);
        });
    };

    const handleScroll = () => {
      content.value.scrollTo({
        top: content.value.scrollHeight,
        behavior: 'smooth',
      });
    }

    return { BuscarMensagem, messages,handleScroll,content };
  },
};
</script>

<style scoped lang="scss">
@import "scss/channelMessage";
</style>
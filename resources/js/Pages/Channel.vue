<template>
  <div id="discord">
    <div id="grid">
      <ServerList :dados_usuario="dados_usuario" />
      <ServerName :dados_usuario="dados_usuario" />
      <ChannelList />
      <UserInfo :dados_usuario="dados_usuario" />
      <ChannelInfo />
      <ChannelData />
      <UserList />
    </div>
  </div>
</template>

<script>
import { onMounted } from "@vue/runtime-core";
import { ref } from "vue";
import ServerList from "@/Components/Channel/ServerList/index.vue";
import ServerName from "@/Components/Channel/ServerName/index.vue";
import ChannelList from "@/Components/Channel/ChannelList/index.vue";
import UserInfo from "@/Components/Channel/UserInfo/index.vue";
import ChannelInfo from "../Components/Channel/ChannelInfo/index.vue";
import ChannelData from "@/Components/Channel/ChannelData/index.vue";
import UserList from "@/Components/Channel/UserList/index.vue";
import { useStore } from "vuex";

export default {
  props: {
    user: Object,
  },
  setup(props) {
    const store = useStore();
    const dados_usuario = ref([]);

    onMounted(() => {
      dados_usuario.value = props.user;
      store.commit("GUARDAR_DADOS_USUARIO", props.user);
    });

    return { dados_usuario };
  },
  components: {
    ServerList,
    ServerName,
    ChannelList,
    ServerList,
    UserInfo,
    ChannelInfo,
    ChannelData,
    UserList,
  },
};
</script>

<style scoped>
#grid {
  display: grid;
  height: 100vh;
  grid-template-columns: 71px 240px auto 240px;
  grid-template-rows: 46px auto 52px;
  grid-template-areas:
    "SL SN CI CI"
    "SL CL CD UL"
    "SL UI CD UL";
}
</style>
<template>
  <div>
    <div
      v-for="item in servers"
      :key="item.id"
      @click="AbrirServidor(item.id)"
      class="serverButton"
      :class="{ 'serverButton-hasNotification': hasNotification }"
    >
      <img :src="'/image/servidores/' + item.photo" />
      <div class="mentions" v-if="mentions">{{ mentions }}</div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useStore } from "vuex";
export default {
  props: {
    selected: Boolean,
    hasNotification: Boolean,
    mentions: Number,
  },
  setup() {
    const store = useStore();
    const servers = ref();
    onMounted(() => {
        getServers()
    });

    const getServers = () => {
        axios
        .get("/BuscarListaServidores")
        .then((response) => {
            servers.value = response.data;
        })
        .catch((erro) => {
          console.log(erro);
        });
    }

    const AbrirServidor = (id) => {
      axios
        .get("/AbrirServidor?id=" + id)
        .then((response) => {
          if (response.data == false) {
            store.commit("MUDAR_ESTADO_SERVIDOR");
          } else {
          }
        })
        .catch((erro) => {
          console.log(erro);
        });
    };

    return { getServers, AbrirServidor,servers };
  },
};
</script>

<style scoped lang="scss">
.serverButton {
  display: flex;
  flex-shrink: 0;
  align-items: center;
  justify-content: center;
  width: 48px;
  height: 48px;
  margin-bottom: 8px;
  background-color: var(--primary);
  cursor: pointer;
  position: relative;
  border-radius: 50%;
  transition: 0.2s;

  img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
  }

  &.active,
  &:hover {
    border-radius: 16px;
    background-color: var(--discord);

    img {
      border-radius: 16px;
    }
  }
}

.serverButton-hasNotification {
  &::before {
    content: "";
    width: 9px;
    height: 9px;
    background-color: var(--white);
    position: absolute;
    left: -17px;
    top: calc(50% - 4.5px);
    border-radius: 50%;
    display: block;
  }
}

.ServerButton-isHome {
  background-color: var(--rocketseat);

  &.active,
  &:hover {
    border-radius: 16px;
    background-color: var(--rocketseat);
  }
}

img {
  width: 25px;
  height: 25px;
}

.mentions {
  background-color: var(--notification);
  width: auto;
  height: 24px;
  padding: 0 4px;
  position: absolute;
  bottom: -4px;
  right: -4px;
  font-size: 13px;
  font-weight: bold;
  text-align: right;
  color: var(--white);
  border-radius: 12px;
  border: 4px solid var(--notification);
}
</style>
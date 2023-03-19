<template>
  <div>
    <div
      v-for="item in data"
      :key="item.id"
      @click="AbrirServidor(item.id)"
      class="serverButton"
      :class="{ 'serverButton-hasNotification': hasNotification }"
    >
      <img :src="`/image/servidores/${item.photo}`" />

      <div v-if="state && item.id === active" class="loading">
        <spinner />
      </div>

      <div v-else class="mentions">
        {{ mentions }}
      </div>
    </div>
  </div>
</template>

<script>
import useEventsBus from "@/eventBus";
import axios from "axios";
import { onMounted, reactive, ref, toRefs, watch } from "vue";
import { useStore } from "vuex";
import spinner from "../../../Layouts/spinner.vue";
export default {
  components: { spinner },
  props: {
    selected: Boolean,
    hasNotification: Boolean,
    mentions: Number,
  },
  setup() {
    const { bus, emit } = useEventsBus();
    const store = useStore();

    const servers = reactive({
      state: false,
      data: [],
      active: null,
    });

    const state = ref(false);

    watch(
      () => bus.value.get("updateServers"),
      (payload) => {
        getServers();
      }
    );

    onMounted(() => {
      getServers();
    });

    const getServers = () => {
      axios
        .get("/BuscarListaServidores")
        .then((response) => {
          servers.data = response.data;
        })
        .catch((erro) => {
          console.log(erro);
        });
    };

    const AbrirServidor = (server) => {
      servers.active = server;
      servers.state = true;
      axios
        .get(`/AbrirServidor/${server}`)
        .then((response) => {
          emit("server", response.data);
        })
        .finally(() => {
          servers.state = false;
        })
        .catch((erro) => {
          console.log(erro);
        });
    };

    return { getServers, AbrirServidor, ...toRefs(servers) };
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

.loading {
  width: auto;
  height: 24px;
  padding: 0 4px;
  position: absolute;
  bottom: -4px;
  right: -4px;
  font-size: 10px;
  text-align: right;
  color: var(--white);
}
</style>
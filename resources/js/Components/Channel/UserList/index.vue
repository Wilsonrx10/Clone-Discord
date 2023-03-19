<template>
  <div class="container">
    <div v-if="state" class="role">Disponivel - {{ online.length }}</div>
    <UserRole
      v-for="item in online"
      :isbot="item.is_boot"
      :member="item"
      :key="item.id"
    />
    <div v-if="state" class="role">Offline - {{ offline.length }}</div>
    <UserRole
      v-for="item in offline"
      :member="item"
      :key="item.id"
    />
  </div>
</template>

<script>
import useEventsBus from "@/eventBus";
import { reactive, toRefs, watch } from "vue";
import UserRole from "./UserRole.vue";
export default {
  setup() {
    const { bus, emit } = useEventsBus();

    const members = reactive({
      online: [],
      offline: [],
      state: false
    });

    watch(() => bus.value.get("server"),(payload) => {
        members.state = true
        members.online = payload[0].members.filter(
          (item) => item.user.status.status_type.name === "Disponivel"
        );
        members.offline = payload[0].members.filter(
          (item) => item.user.status.status_type.name != "Disponivel"
        );
      }
    );

    return { ...toRefs(members) };
  },
  components: { UserRole },
};
</script>

<style scoped lang="scss">
.container {
  grid-area: UL;
  display: flex;
  flex-direction: column;
  background-color: var(--secondary);
  padding: 3px 6px 10px 16px;
  max-height: calc(100vh - 46px);
  overflow-y: scroll;
  @include scroll;
  .role {
    margin-top: 20px;
    color: var(--grey);
    font-weight: 500;
    font-size: 12px;
    text-transform: uppercase;
  }
}
</style>
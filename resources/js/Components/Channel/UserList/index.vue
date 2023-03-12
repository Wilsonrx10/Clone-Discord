<template>
  <div class="container">
    <div class="role">Disponivel - 1</div>
    <UserRole nickname="Wilson Santos" isBot />
    <div class="role">Offline - 18</div>
    <UserRole
      nickname="Wilson Developer"
      v-for="offline in 15"
      :key="offline.id"
    />
  </div>
</template>

<script>
import UserRole from "./UserRole.vue";
export default {
  setup() {},
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
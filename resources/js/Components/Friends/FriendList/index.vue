<template>
  <div class="ChannelList">
    <div class="category">
      <div>Lista de Amigos</div>
      <div class="category-icon">
        <AddCategoryIcon :size="21" />
      </div>
    </div>

    <Friendbutton />
  </div>
</template>

<script setup>
import Friendbutton from "./Friendbutton.vue";
import AddCategoryIcon from "vue-material-design-icons/Plus.vue";
</script>
 
<style scoped lang="scss">
.ChannelList {
  grid-area: FL;
  display: flex;
  flex-direction: column;
  padding: 24px 10px 0 16px;
  background-color: var(--secondary);
  max-height: calc(100vh - 46px);
  overflow-y: scroll;
  @include scroll;
}
.category {
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: var(--grey);
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  .category-icon {
    color: var(--symbol);
    cursor: pointer;
  }
}
</style>
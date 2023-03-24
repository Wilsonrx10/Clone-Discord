<template>
  <div class="ChannelList">
    <div class="category">
      <div>Canais de Texto</div>
      <div class="category-icon">
        <AddCategoryIcon :size="21" />
      </div>
    </div>

    <Channelbutton channelName="Laravel 9" selected />
    <Channelbutton channelName="composition API" />
    <Channelbutton channelName="Vue 3" />
    <Channelbutton channelName="Vite Acelerador" />
    <Channelbutton channelName="Pinia store" />
  </div>
</template>

<script>
import AddCategoryIcon from "vue-material-design-icons/Plus.vue";
import Channelbutton from "./Channelbutton.vue";
export default {
  setup() {},
  components: { Channelbutton, AddCategoryIcon },
};
</script>

<style scoped lang="scss">
.ChannelList {
  grid-area: CL;
  display: flex;
  flex-direction: column;
  padding: 24px 10px 0 16px;
  background-color: var(--secondary);
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
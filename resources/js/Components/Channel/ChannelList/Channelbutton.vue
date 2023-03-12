<template>
  <div class="container" :class="{ active: selected }">
    <div class="channel-info">
      <HashTagIcon class="has-icons" :size="20" />
      <div>{{ channelName }}</div>
    </div>

    <div class="channel-actions">
      <InviteIcon class="icon-actions" :size="16" />
      <SettingIcon class="icon-actions" :size="16" />
    </div>
  </div>
</template>

<script>
import HashTagIcon from "vue-material-design-icons/Pound.vue";
import InviteIcon from "vue-material-design-icons/AccountPlus.vue";
import SettingIcon from "vue-material-design-icons/CogOutline.vue";
export default {
  props: {
    channelName: String,
    selected: Boolean,
  },
  setup() {},
  components: { HashTagIcon, InviteIcon, SettingIcon },
};
</script>

<style scoped lang="scss">
.container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  padding: 5px 3px;
  border-radius: 5px;
  background-color: transparent;

  > div {
    display: flex;
    align-items: center;
  }

  .channel-info {
    div {
      color: var(--senary);
      margin-left: 5px;
    }

    .has-icons {
      color: var(--symbol);
    }
  }

  .channel-actions {
    display: none;

    .icon-actions {
      cursor: pointer;
      color: var(--symbol);
      margin-left: 4px;
      transition: 0.2s;

      &:hover {
        color: var(--white);
      }
    }
  }

  &.active,
  &:hover {
    background-color: var(--quinary);

    .channel-info {
      div {
        color: var(--white);
      }
    }

    .channel-actions {
      display: flex;
    }
  }
}
</style>
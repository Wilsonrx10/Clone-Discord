<template>
  <div class="user-role">
    <div class="avatar" :class="{ 'bot-avatar': isBot }"></div>
    <strong>{{ nickname }}</strong>
    <div class="bot" v-if="isBot">Bot</div>
  </div>
</template>

<script>
export default {
  props: {
    isBot: Boolean,
    nickname: String,
  },
};
</script>

<style lang="scss" scoped>
.user-role {
  display: flex;
  align-items: center;
  margin-top: 5px;
  padding: 5px;
  cursor: pointer;
  border-radius: 5px;
  background-color: transparent;
  transition: 0.2s;

  &:hover {
    background-color: rgba(255, 255, 255, 0.1);
  }

  strong {
    margin-left: 13px;
    font-weight: 500;
    color: var(--white);
    opacity: 0.7;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
  }

  .avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    flex-shrink: 0;
    background-color: var(--primary);

    &.bot-avatar {
      background-color: var(--mention-detail);
    }
  }

  .bot {
    margin-left: 9px;
    background-color: var(--discord);
    color: var(--white);
    padding: 4px 5px;
    border-radius: 4px;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: bolder;
  }
}
</style>
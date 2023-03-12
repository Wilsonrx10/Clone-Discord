<template>
  <div class="channel-message" :class="{ 'has-mention': hasmention }">
    <div class="avatar" :class="{ 'bot-avatar': isBot }"></div>
    <div class="message">
      <div class="user">
        <strong>{{ author }}</strong>
        <span class="bot" v-if="isBot">Bot</span>
        <span class="data">{{ date }}</span>
      </div>
      <div class="body">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    date: String,
    author: String,
    hasmention: Boolean,
    isBot: Boolean,
  },
  setup() {},
};
</script>

<style scoped lang="scss">
.channel-message {
  display: flex;
  align-items: center;
  padding: 8px 16px;
  margin-right: 4px;
  background-color: transparent;
  margin-top: 13px;

  &:hover {
    background-color: var(--quaternary);
    cursor: pointer;
  }

  &.has-mention {
    background-color: var(--mention-message);
    border-left: 2px solid var(--mention-detail);
  }
}

.avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: var(--secondary);
  flex-shrink: 0;

  &.bot-avatar {
    background-color: var(--mention-detail);
  }
}

.message {
  margin-left: 17px;
  height: 40px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  strong {
    color: var(--white);
    font-size: 16px;
  }

  .data {
    margin-left: 6px;
    color: var(--grey);
    font-size: 16px;
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

  .body {
    color: var(--white);
    font-size: 16px;
    text-align: left;
  }
}
</style>
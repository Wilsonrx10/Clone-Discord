<template>
  <div class="channel-data">
    <div v-if="!state" class="discord">
      <h1>Clone Discord</h1>
    </div>
    <div v-else>
      <div v-if="data.messages.length > 0" class="message">

        <channelmessage
          v-for="item in data.messages"
          :key="item.id"
          author="Wilson LaraVue"
          date="10/10/2022"
          isBot
          hasmention
        >
          {{item.message}}
        </channelmessage>

        <!-- <channelmessage author="Mamoudou" date="10/10/2022" hasmention>
          <Channelmention>Wilson CEO </Channelmention> Você é foda mano !
        </channelmessage> -->
      </div>

      <div v-else class="Boas-vinda">
        <h2>Bem-Vindo(a) a Servidor Wilson Manuel</h2>
        <p>
          Aqui vão algumas dicas para ajudar você a começar! Para mais
          informações, confira nosso guia
        </p>

        <div class="buttons">
          <div>
            <span>Convide seus amigos</span>
            <Arrow :size="25" />
          </div>

          <div>
            <span>Personalize teu servidor com um icone</span>
            <Arrow :size="25" />
          </div>

          <div>
            <span>Envia sua primeira mensagem</span>
            <Arrow :size="25" />
          </div>
        </div>
      </div>
    </div>

    <div class="input-wrapper">
      <input type="text" placeholder="Conversar" />
      <div class="icon">
        <At :size="24"/>
      </div>
    </div>

  </div>
</template>

<script setup>
import Arrow from "vue-material-design-icons/ArrowRight.vue";
import At from "vue-material-design-icons/At.vue";
import Channelmessage from "./Channelmessage.vue";
import Channelmention from "./Channelmention.vue";
import { computed, reactive, ref, watch } from "vue";
import { useStore } from "vuex";
import useEventsBus from "@/eventBus";

const store = useStore();
const { emit, bus } = useEventsBus();
const data = reactive({
  messages: [],
});

const state = ref(false);

watch(
  () => bus.value.get("server"),
  (payload) => {
    state.value = true;
    data.messages = payload[0].messages;
  }
);
</script>

<style scoped lang="scss">
.channel-data {
  grid-area: CD;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background-color: var(--primary);
  flex: 1;

  .discord {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    h1 {
      margin-top: 120px;
      font-size: 75px;
      font-weight: bolder;
      color: var(--white);
    }
  }
  .message {
    display: flex;
    flex-direction: column;
    height: calc(100vh - 46px - 68px);
    max-height: calc(100vh - 46px - 68px);
    overflow-x: scroll;

    &::-webkit-scrollbar {
      width: 8px;
    }

    &::-webkit-scrollbar-thumb {
      background-color: var(--tertiary);
      border-radius: 4px;
    }

    &::-webkit-scrollbar-track {
      background-color: var(--secondary);
    }
  }

  .input-wrapper {
    width: 100%;
    padding: 0 16px;
    height: 68px;

    input {
      width: 100%;
      height: 44px;
      padding: 0 10px 0 57px;
      border-radius: 5px;
      color: var(--white);
      background-color: var(--chat-input);
      position: relative;

      &::placeholder {
        color: var(--grey);
      }
    }

    .icon {
      color: var(--grey);
      position: relative;
      top: -50%;
      left: 14px;
      transition: 0.2s;
      width: 24px;
    }
  }

  .Boas-vinda {
    padding: 20px;

    h2 {
      font-weight: 600;
      font-size: 30px;
      color: var(--white);
    }

    p {
      color: var(--grey);
    }

    .buttons {
      display: flex;
      flex-direction: column;

      div {
        display: flex;
        justify-content: space-between;
        width: 100%;
        padding: 18px;
        border-radius: 4px;
        margin-bottom: 10px;
        background-color: var(--tertiary);
        color: var(--white);

        &:hover {
          cursor: pointer;
          background-color: rgba(221, 221, 221, 0.157);
        }
      }
    }
  }
}
</style>
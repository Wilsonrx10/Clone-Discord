<template>
  <div class="container">
    <div @click="userinfor" class="profile">
      <img
        :src="'/image/usuarios/' + dados_usuario.profile?.profile_photo"
        class="avatar"
        alt=""
      />
      <div class="userdata">
        <strong>{{ dados_usuario.name }}</strong>
        <span>#1010</span>
      </div>
    </div>

    <div class="actions">
      <Mic :size="20" />
      <Headphone :size="20" />
      <definicoes @click="configuracoes" :size="20" />
    </div>

    <div class="user" v-show="user_info">
      <UserInfo :dados_usuario="dados_usuario" />
    </div>

    <div class="settings" v-show="user_setting">
      <Settings
        :dados_usuario="dados_usuario"
        @FecharConfiguracoes="FecharConfiguracoes"
      />
    </div>
  </div>
</template>

<script>
import Mic from "vue-material-design-icons/Microphone.vue";
import Headphone from "vue-material-design-icons/Headphones.vue";
import definicoes from "vue-material-design-icons/CogOutline.vue";
import { ref, reactive, toRefs } from "vue";
import { useStore } from "vuex";
import UserInfo from "./UserInfo.vue";
import Settings from "./Settings.vue";
export default {
  props: ["dados_usuario"],
  setup() {
    const element = reactive({
      user_info: false,
      user_setting: false,
    });

    const store = useStore();

    const configuracoes = () => {
      element.user_setting = true;
    };

    const FecharConfiguracoes = () => {
      element.user_setting = false;
    };

    const userinfor = () => {
      if (element.user_info == true) {
        element.user_info = false;
      } else {
        element.user_info = true;
      }
    };

    return {
      configuracoes,
      userinfor,
      ...toRefs(element),
      FecharConfiguracoes,
    };
  },
  components: { Mic, Headphone, definicoes, UserInfo, Settings },
};
</script>

<style scoped lang="scss">
.container {
  grid-area: UI;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  background-color: var(--quaternary);
  color: var(--white);
  box-shadow: 0 1px 0 0 rgba(0, 0, 0, 0.2);

  .profile {
    display: flex;
    align-items: center;
    padding: 4px 6px;
    border-radius: 4px;

    &:hover {
      cursor: pointer;
      background-color: var(--quinary);
    }

    .avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background-color: var(--grey);
    }

    .userdata {
      display: flex;
      margin-left: 8px;
      flex-direction: column;
      font-size: 13px;

      strong {
        display: block;
        max-width: 90px;
        font-weight: bold;
        color: var(--white);
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
      }

      span {
        color: var(--grey);
      }
    }
  }

  .actions {
    color: var(--grey);

    span {
      transition: 0.2s;
      cursor: pointer;

      &:hover {
        color: var(--white);
      }
    }
  }
}

.user {
  position: absolute;
  margin-top: -420px;
}
</style>
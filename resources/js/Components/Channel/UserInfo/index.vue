<template>
  <div class="container">
    <div @click="userinfor" class="profile">
      <img
        :src="'/image/usuarios/' + user.profile?.profile_photo"
        class="avatar"
        alt=""
      />
      <div class="userdata">
        <strong>{{ user.name }}</strong>
        <span>#1010</span>
      </div>
    </div>

    <div class="actions">
      <Mic :size="20" />
      <Headphone :size="20" />
      <definicoes @click="configuracoes" :size="20" />
    </div>

    <div class="user" v-show="info">
      <UserInfo :dados_usuario="user" />
    </div>

    <div class="settings" v-show="setting">
      <Settings
        :dados_usuario="user"
        @FecharConfiguracoes="FecharConfiguracoes"
      />
    </div>
  </div>
</template>

<script>
import Mic from "vue-material-design-icons/Microphone.vue";
import Headphone from "vue-material-design-icons/Headphones.vue";
import definicoes from "vue-material-design-icons/CogOutline.vue";
import { ref, reactive, toRefs, computed } from "vue";
import { useStore } from "vuex";
import UserInfo from "./UserInfo.vue";
import Settings from "./Settings.vue";
export default {
  setup() {
    const store = useStore();
    const user = computed(()=> store.getters.user);

    const element = reactive({
      info: false,
      setting: false,
    });


    const configuracoes = () => {
      element.setting = true;
    };

    const FecharConfiguracoes = () => {
      element.setting = false;
    };

    const userinfor = () => {
      if (element.info == true) {
        element.info = false;
      } else {
        element.info = true;
      }
    };

    return {
      configuracoes,
      userinfor,
      user,
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
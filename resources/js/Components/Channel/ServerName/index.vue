<template>
  <div class="container">
    <div class="title">{{ dados_usuario.name }}</div>
    <div class="icon">
      <ExpandIcon @click="Session_logout" :size="28" />
    </div>

    <div v-show="estado_session" class="Session_logout">
      <a @click.prevent.stop="Terminar_sessao" href="#"
        ><Logout :size="20" /> Terminar Sessão</a
      >
      <a href="#"><Onff :size="20" /> Desativar estado online</a>
    </div>

    <ModalLogout v-if="modal" />
    
  </div>
</template>

<script>
import Onff from "vue-material-design-icons/AccountTieVoice.vue";
import Logout from "vue-material-design-icons/Logout.vue";
import ExpandIcon from "vue-material-design-icons/ChevronDown.vue";
import { toRefs, reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import ModalLogout from "@/Components/Modals/Logout.vue";
export default {
  props: ["dados_usuario"],
  setup() {
    const variables = reactive({
      estado_session: false,
      modal: false,
    });
    const Session_logout = () => {
      if (variables.estado_session == false) {
        variables.estado_session = true;
      } else {
        variables.estado_session = false;
      }
    };

    const Terminar_sessao = () => {
      if (variables.modal == false) {
        variables.modal = true;
      } else {
        variables.modal = false;
      }
    };

    return { Session_logout, ...toRefs(variables), Terminar_sessao };
  },
  components: { ExpandIcon, Onff, Logout, ModalLogout },
};
</script>

<style scoped lang="scss">
.container {
  grid-area: SN;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: var(--secondary);
  padding: 0 11px 0 16px;
  box-shadow: 0 1px 0 0 rgba(0, 0, 0.9);
  z-index: 2;
}
.title {
  color: var(--white);
  font-weight: bold;
  font-size: 16px;
}
.icon {
  color: var(--white);
  cursor: pointer;
}

.Session_logout {
  display: flex;
  flex-direction: column;
  position: absolute;
  background-color: var(--tertiary);
  height: 90px;
  width: 228px;
  margin-top: 138px;
  margin-left: -10px;
  padding: 10px;
  border-radius: 3px;
  @include boxShadow;
  a {
    color: var(--senary);
    text-decoration: none;
    padding: 5px 3px;
    border-radius: 5px;
    &:hover {
      background-color: var(--quinary);
      color: var(--white);
    }
  }
}
</style>
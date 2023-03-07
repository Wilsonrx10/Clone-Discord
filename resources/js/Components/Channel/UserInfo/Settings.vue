<template>
  <div class="principal">
    <div class="setting">
      <div class="menu">
        <div class="item">
          <h2>Configurações de Usuario</h2>
          <div :class="'selected == false : active '">Perfis</div>
          <div>Privacidade e Segurança</div>
        </div>

        <div class="item">
          <h2>Configurações do aplicativo</h2>
          <div>Aparência</div>
          <div>Acessibilidade</div>
          <div>Idioma</div>
        </div>
      </div>

      <div class="container">
        <div class="separator">
          <div class="titulo">
            <h2>Minha conta</h2>
          </div>
          <div @click="FecharConfiguracoes" class="sair">
            <close class="icone" :size="20" />
            <span>Sair</span>
          </div>
        </div>

        <div class="user-content">
          <div class="capa"></div>
          <div class="user-info">
            <div>
              <img
                :src="'/image/usuarios/' + dados_usuario.profile?.profile_photo"
                alt=""
              />
              <strong>{{ dados_usuario.name }} #837763</strong>
            </div>

            <div class="botao">
              <button>Editar perfil de usuario</button>
            </div>
          </div>

          <div class="edit-user">
            <div class="dados">
              <div>
                <span>Nome de usuario</span>
                <p>{{ dados_usuario.name }}</p>
              </div>

              <div>
                <span>E-MAIL</span>
                <p>{{ dados_usuario.email }}</p>
              </div>
            </div>

            <div class="botoes">
              <button>Editar</button>

              <button>Editar</button>
            </div>
          </div>
        </div>

        <hr />

        <div class="alterar-password">
          <h2>Senha e Autenticação</h2>
          <button>Mudar Senha</button>
        </div>

        <hr />

        <div class="excluir_account">
          <button>Desativar conta</button>
          <button>Excluir conta</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import close from "vue-material-design-icons/Close.vue";
import { defineProps, reactive, defineEmits } from "vue";
const props = defineProps({
  selected: Boolean,
  dados_usuario: Object,
});

const selected = reactive(props.selected);

const emit = defineEmits(["FecharConfiguracoes"]);

const FecharConfiguracoes = () => {
  emit("FecharConfiguracoes");
};
</script>

<style scoped lang="scss">
@import "scss/settings";
</style>
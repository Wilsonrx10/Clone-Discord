<template>
  <div class="userinfo">
    <div class="capa">
      <div class="avatar">
        <img
          :src="'/image/usuarios/' + dados_usuario.profile?.profile_photo"
          class="avatar"
          alt=""
        />
      </div>

      <div class="editarPerfil">
        <Edit :size="20" />
      </div>
    </div>

    <div class="username">
      <strong>{{ dados_usuario.name }}</strong
      ><span>#1010</span>
    </div>

    <hr />

    <div class="data_inscricao">
      <h5>Temporary SMS Membro desde</h5>
      <p>{{ dados_usuario.created_at }}</p>
    </div>

    <hr />

    <div class="status">
      <disponivel
        v-if="dados_usuario.status == 'disponivel'"
        :size="18"
        style="color: green"
      />
      <ausente
        v-if="dados_usuario.status == 'Ausente'"
        :size="18"
        style="color: yellow"
      />
      <pertubar
        v-if="dados_usuario.status == 'Não pertubar'"
        :size="18"
        style="color: rgb(250, 92, 92)"
      />
      <pertubar v-if="dados_usuario.status == 'Invisivel'" :size="18" />
      <a @mouseover="DefinirStatus" mouseout="DefinirStatus" href="#">
        Definir status personalizado</a
      >
    </div>

    <div class="definir-status" v-show="status">
      <div @click="mudarStatus('disponivel')">
        <span>
          <disponivel style="color: green" :size="15" />
          Disponivel
        </span>
      </div>

      <hr />

      <div @click="mudarStatus('Ausente')">
        <span>
          <ausente class="ausente" style="color: yellow" :size="15" />
          Ausente
        </span>
      </div>

      <div @click="mudarStatus('Não pertubar')">
        <span>
          <pertubar style="color: rgb(250, 92, 92)" :size="15" />
          Não pertubar
        </span>
        <p>Você não ira mais receber notificações na area de trabalho</p>
      </div>

      <div @click="mudarStatus('Invisivel')">
        <span>
          <pertubar :size="15" />
          Invisivel
        </span>
        <p>
          Você não vai aparecer como disponivel, mas tera seu perfil disponivel
        </p>
      </div>
    </div>
  </div>
</template>
    
<script setup>
import disponivel from "vue-material-design-icons/MoonFull.vue";
import ausente from "vue-material-design-icons/MoonWaningCrescent.vue";
import pertubar from "vue-material-design-icons/MoonFull.vue";
import Edit from "vue-material-design-icons/Pencil.vue";
import { computed, defineProps, ref } from "vue";
import axios from "axios";

const props = defineProps(["dados_usuario"]);

const status = ref(false);

const DefinirStatus = () => {
  if (status.value == true) {
    status.value = false;
  } else {
    status.value = true;
  }
};

const mudarStatus = (event) => {
  let status = event;
  axios
    .post("/atualizarStatus", { status: status })
    .then((response) => {
      props.dados_usuario.status = response.data;
    })
    .catch((erro) => {
      console.log(erro);
    });
};
</script>
    
<style scoped lang="scss">
.userinfo {
  width: 325px;
  height: 323px;
  border-radius: 4px;
  background-color: var(--tertiary);
  padding: 16px;

  .capa {
    width: 100%;
    height: 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: rgb(159, 13, 135);
    border-radius: 4px;
    margin-bottom: 40px;

    .avatar img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      margin-top: 34px;
      margin-left: 20px;
      border: 2px dotted rgb(168, 166, 166);
    }

    .editarPerfil {
      background-color: rgba(57, 56, 56, 0.423);
      border-radius: 50%;
      padding: 2px 4px;
      margin-right: 4px;
    }
  }

  .data_inscricao {
    h5 {
      font-size: 15px;
      color: var(--white);
      font-weight: bold;
      text-transform: uppercase;
    }

    p {
      font-size: 13px;
    }
  }

  .status {
    a {
      text-decoration: none;
    }
  }

  .definir-status {
    position: absolute;
    width: 340px;
    height: 295px;
    background-color: var(--tertiary);
    border-radius: 4px;
    margin-left: 312px;
    margin-top: -180px;
    z-index: 999;
    padding: 20px;
    > div {
      padding: 4px 5px;
      border-radius: 4px;
      cursor: pointer;
      p {
        font-size: 12px;
        margin-left: 18px;
        color: var(--grey);
      }
      span {
        font-size: 14px;
      }

      .ausente {
        transform: rotate(45deg);
      }
      &:hover {
        background-color: var(--link);
        color: var(--white);
        span {
          color: var(--white) !important;
        }
        p {
          color: var(--white) !important;
        }
      }
    }
  }
}
</style>
<template>
  <div class="principal">
    <div class="formulario">
      <ul id="progress">
        <li class="ativo">Configurações</li>
        <li :class="{ ativo: element.fielsetfantasma }">Foto de Perfil</li>
        <li :class="{ ativo: element.fieldset03 }">Concluir cadastro</li>
      </ul>
      <fieldset v-if="element.fieldset01">
        <h2>Dados Pessoais</h2>
        <h3>Informe seus dados</h3>

        <div class="group">
          <input
            type="text"
            name=""
            placeholder="nome completo"
            :value="usuario.name"
            disabled
          />
          <input
            type="text"
            name=""
            placeholder="email"
            :value="usuario.email"
            disabled
          />
          <input
            type="text"
            v-model="form.apelido"
            placeholder="apelido"
            required
          />
        </div>

        <div class="group">
          <div>
            <AutocompletePaises @nacionalidade="nacionalidade" />
          </div>
          <div>
            <input
              type="text"
              v-model="form.cidade"
              placeholder="cidade"
              required
            />
          </div>
          <div>
            <input
              type="text"
              v-model="form.telefone"
              placeholder="telefone"
              required
            />
          </div>
        </div>

        <div class="group">
          <button @click="Next">Avancar</button>
        </div>
      </fieldset>

      <fieldset v-if="element.fieldset02">
        <h3>Adiciona uma foto de perfil</h3>

        <div class="group">
          <input
            style="display: none"
            @change="onFileChange"
            type="file"
            id="file"
            required
          />
          <div class="perfil">
            <img @click="FotoPerfil" :src="element.imagem" width="150" />
            <textarea
              v-model="form.biografia"
              class="form-control"
              rows="2"
              cols="120"
              placeholder="Fale um pouco sobre ti"
              required
            ></textarea>
          </div>
        </div>

        <div class="group">
          <div class="buttons">
            <button @click="voltarFieldset02">Voltar</button>
            <button
              :disable="element.requisicao"
              :class="{ requisicao: element.requisicao }"
              @click.prevent.stop="NextFieldset02"
            >
              Avancar
            </button>
          </div>
        </div>

        <div v-if="erro.estado" class="message">
          <Message severity="warn" :life="5000" :sticky="false">{{
            erro.message
          }}</Message>
        </div>
      </fieldset>

      <fieldset v-if="element.fieldset03">
        <h2>Adicionar Amigos</h2>
        <h3>conheça novas pessoas</h3>

        <SelectHabilidade @selecionarHabilidade="habilidade" />

        <div class="group">
          <div class="buttons">
            <button @click="voltarFieldset03">Voltar</button>
            <button @click="Concluir_cadastro">Concluir processo</button>
          </div>
        </div>
      </fieldset>
    </div>
  </div>
</template>

<script setup>
import { computed, reactive, toRefs, ref, watch } from "vue";
import AutocompletePaises from "@/Components/Cadastro/AutocompletePaises.vue";
import { Inertia } from "@inertiajs/inertia";
import Message from "primevue/message";
import SelectHabilidade from "@/Components/Cadastro/SelectHabilidade.vue";
import {UseUploadPhoto} from '../../composables/public/UploadPhoto'

const props = defineProps({
  dados_usuario: Object,
});

const usuario = computed(() => {
  return props.dados_usuario;
});

const form = reactive({
  nacionalidade: null,
  cidade: null,
  telefone: null,
  apelido: null,
  biografia: null,
  foto_perfil: null,
  habilidades: [],
});

const nacionalidade = (payload) => {
  form.nacionalidade = payload.name;
};

const habilidade = (payload) => {
  form.habilidades = payload;
};

const element = reactive({
  requisicao: null,
  fieldset01: true,
  fieldset02: false,
  fieldset03: false,
  fielsetfantasma: false,
  imagem: "image/user.jpg",
});

const erro = reactive({
  message: null,
  estado: false,
});

const {onFileChange, createImg} = UseUploadPhoto(element,form);

const Next = () => {
  element.fieldset01 = false;
  element.fieldset02 = true;
  element.fielsetfantasma = true;
};
const voltarFieldset02 = () => {
  element.fieldset01 = true;
  element.fieldset02 = false;
  element.fielsetfantasma = false;
};
const NextFieldset02 = () => {
  element.fieldset03 = true;
  element.fieldset01 = false;
  element.fieldset02 = false;
};
const voltarFieldset03 = () => {
  element.fieldset03 = false;
  element.fieldset01 = false;
  element.fieldset02 = true;
};

const FotoPerfil = () => {
  document.getElementById("file").click();
};

const Concluir_cadastro = () => {
  element.requisicao = true;
  Inertia.post("/concluir_cadastro", form, {
    onSuccess: (response) => {
      element.requisicao = false;
    },
  });
};
</script>

<style scoped lang="scss">
@import "../../../css/registre_complete";
</style>
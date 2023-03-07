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
            v-model="formulario.apelido"
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
              v-model="formulario.cidade"
              placeholder="cidade"
              required
            />
          </div>
          <div>
            <input
              type="text"
              v-model="formulario.telefone"
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
              v-model="formulario.biografia"
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

const props = defineProps({
  dados_usuario: Object,
});

const usuario = computed(() => {
  return props.dados_usuario;
});

const formulario = reactive({
  nacionalidade: null,
  cidade: null,
  telefone: null,
  apelido: null,
  biografia: null,
  foto_perfil: null,
  habilidades: [],
});

const nacionalidade = (payload) => {
  formulario.nacionalidade = payload.name;
};

const habilidade = (payload) => {
  formulario.habilidades = payload;
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

const onFileChange = (e) => {
  var files = e.target.files || e.dataTransfer.files;
  // Verificar o formato da imagem
  let arquivo = files[0].name;
  let extension = arquivo.indexOf(".") < 1 ? "" : arquivo.split(".").pop();
  if (extension == "") {
    return false;
  } else {
    const formatos_permitidos = [
      "jpg",
      "png",
      "gif",
      "jpeg",
      "JPG",
      "PNG",
      "GIF",
      "JPEG",
    ];
    let resultado = formatos_permitidos.includes(extension);
    if(resultado) {
      // Tamanho do arquivo em mb
      var tamanho_maximo = 2242880;
      var fsizet = 0;
      for (var i = 0; i <= e.target.files.length - 1; i++) {
        var fsize = e.target.files.item(i).size;
        fsizet = fsizet + fsize;
      }
      if (fsizet > tamanho_maximo) {
        erro.message =
          "Tamanho do arquivo é maior que 5mb 'Tamanho máximo  = 2MB' ";
        erro.estado = true;
        setTimeout(() => {
          erro.estado = false;
        }, 5000);
      } else {
        createImg(files[0]);
      }
    }
  }
};

const createImg = (file) => {
  var imagem = new Image();
  var reader = new FileReader();

  reader.onload = (e) => {
    element.imagem = e.target.result;
    formulario.foto_perfil = e.target.result;
  };

  reader.readAsDataURL(file);
};

const Concluir_cadastro = () => {
  element.requisicao = true;
  Inertia.post("/concluir_cadastro", formulario, {
    onSuccess: (response) => {
      element.requisicao = false;
    },
  });
};
</script>

<style scoped lang="scss">
@import "../../../css/registre_complete";
</style>
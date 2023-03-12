<template>
  <div class="principal">
    <section class="container">
      <h1 class="titulo">Criar uma Conta</h1>
      <div class="formulario">
        <div>
          <label for="email">E-mail</label>
          <input type="text" v-model="form.email" autofocus required />
        </div>

        <div>
          <label for="email">Nome de Usuario</label>
          <input type="text" v-model="form.name" name="" autofocus required />
        </div>

        <div>
          <label for="email">Senha</label>
          <input
            type="password"
            v-model="form.password"
            name=""
            autofocus
            required
          />
        </div>

        <div class="nascimento">
          <label for="email">Data nascimento</label>
          <div>
            <DropdowNascimento
              @nascimento="SalvarValorNascimento"
              :titulo="'Dia'"
            />
            <DropdowNascimento
              @nascimento="SalvarValorNascimento"
              :titulo="'Mes'"
            />
            <DropdowNascimento
              @nascimento="SalvarValorNascimento"
              :titulo="'Ano'"
            />
          </div>
        </div>

        <Toast />

        <div class="footer">
          <div>
            <input type="checkbox" />
            <p>
              Li e concordo com os termos de serviço e a política de privacidade
            </p>
          </div>
          <button @click="CadastrarUsuario">Continuar</button>
          <a href="">Já tem uma conta ?</a>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import Toast from "primevue/toast";
import { reactive } from "vue";
import DropdowNascimento from "./DropdowNacimento.vue";
import { useToast } from "primevue/usetoast";

const toast = useToast();

const form = reactive({
  name: null,
  email: null,
  dataNascimento: null,
  password: null,
});

const nascimento = reactive({
  dia: null,
  mes: null,
  ano: null,
});

const SalvarValorNascimento = (payload, tipo) => {
  if (tipo === "Dia") {
    nascimento.dia = payload;
  } else if (tipo === "Mes") {
    nascimento.mes = payload;
  } else {
    nascimento.ano = payload;
  }

  form.dataNascimento =
    nascimento.dia + "/" + nascimento.mes + "/" + nascimento.ano;
};

const CadastrarUsuario = () => {
  axios
    .post("/auth/register", { ...form })
    .then((response) => {
      if (response.data.status === 443) {
        toast.add({
          severity: "error",
          summary: "Erro no cadastro",
          detail: response.data.message,
          life: 5000,
        });
      }
    })
    .catch((erro) => {
      console.log(erro);
    });
};
</script>

<style scoped lang="scss">
@import "../scss/cadastro";
</style>
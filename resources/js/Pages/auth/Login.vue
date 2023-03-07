<template>
  <div class="principal">
    <Toast />
    <section class="container">
      <h2 class="titulo">Entrar na sua conta</h2>
      <div class="formulario">
        <div>
          <label for="email">E-mail</label>
          <input
            type="text"
            v-model="form.email"
            id="email"
            autofocus
            required
          />
        </div>

        <div>
          <label for="senha">Senha</label>
          <input
            type="password"
            v-model="form.password"
            name=""
            id="senha"
            autofocus
            required
          />
        </div>

        <div class="footer">
          <button @click="Login">Continuar</button>
          <a href="">Ainda não tenho uma conta ?</a>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import Toast from "primevue/toast";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { useToast } from "primevue/usetoast";
import { Inertia } from "@inertiajs/inertia";
import { computed, watch, ref, reactive } from "vue";

const props = defineProps({
  erro: String,
});
const toast = useToast();

const loading = ref(false);

const form = reactive({
  email: null,
  password: null,
});
const page = usePage();

const flash = computed(function () {
  return page.props.value.flash;
});

const Login = () => {
  loading.value = true;
  Inertia.post(
    "/auth/login",
    { ...form },
    {
      onSuccess: (response) => {
        loading.value = false;
      },
      onError: (erro) => {
        console.log(erro);
      },
    }
  );
};

watch(flash, (erro) => {
  if (erro.error) {
    toast.add({
      severity: "error",
      summary: "Erro na Autenticação",
      detail: erro.error,
      life: 4000,
    });
  }
});
</script>

<style scoped lang="scss">
@import "../scss/cadastro";
</style>
<template>
  <div @click="$emit('FecharModal')" class="adicionar-friend">
    <div @click.stop class="content">
      <div class="principal">
        <div class="pesquisa">
          <input
            @keyup="Search"
            type="text"
            v-model="form.search"
            placeholder="digita o id do usuario"
          />
        </div>
        <div class="resultado">
          <div v-if="resultado" class="search-not-found">
            <img src="/image/404-two.svg" width="230" />
          </div>

          <div
            class="amigos"
            v-for="item in data.amigos"
            :key="item.id"
            @click="VisualizarFriend(item)"
            @mouseover="ActiveSearch(item.id)"
          >
            <div :class="[item.id === active ? 'active' : '']">
              <img
                :src="'/image/usuarios/' + item.profile.profile_photo"
                width="20"
              />
              <span
                >{{ item.name }}
                <strong>@{{ item.profile.surname }}</strong>
              </span>
            </div>
          </div>
        </div>

        <div class="cancelar">
          <div>
            <strong>FICA A DICA: </strong>
            <p>
              Escreva "@" no começo da caixa de pesquisa para limitar os
              resultados.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import useEventsBus from "@/eventBus";
import { ref, onMounted, reactive } from "@vue/runtime-core";

const { emit, bus } = useEventsBus();

const data = reactive({
  amigos: [],
  listaPesquisa: [],
});

const form = reactive({
  search: null,
});

const resultado = ref(false);
const active = ref();

onMounted(() => {
  axios
    .get("/channel/BuscarListaUsuariosCompleto")
    .then((response) => {
      data.amigos = response.data;
      data.listaPesquisa = response.data;
    })
    .catch((erro) => {
      console.log(erro);
    });
});

const Search = () => {
  if (form.search.length >= 3 && isNaN(form.search)) {
    let friends = data.listaPesquisa.filter((item) => {
      return item.name.includes(form.search);
    });

    if (friends.length > 0) {
      data.amigos = friends;
    } else {
      resultado.value = true;
      data.amigos = [];
    }
  } else {
    resultado.value = false;
    data.amigos = data.listaPesquisa;
  }
};
const VisualizarFriend = (amigo) => {
  emit("ExibirMessage", amigo, "Addamigo");
};
const ActiveSearch = (id) => {
  active.value = id;
};
</script>

<style lang="scss" scoped>
@import "scss/AdicionarFriend";
</style>
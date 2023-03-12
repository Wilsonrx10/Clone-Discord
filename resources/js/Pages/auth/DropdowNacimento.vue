<template>
  <div>
    <input
      @click="AbrirDropdown"
      type="text"
      :placeholder="nascimento.titulo"
    />
    <div v-if="nascimento.estado" class="dropdown">
      <div
        @click="
          $emit('nascimento', lista, props.titulo), (nascimento.titulo = lista)
        "
        v-for="lista in Lista"
        :key="lista.id"
      >
        {{ lista }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, reactive, ref } from "@vue/runtime-core";

const Lista = ref([]);

const props = defineProps({
  titulo: String,
});

const nascimento = reactive({
  estado: false,
  titulo: null,
});

const AbrirDropdown = () => {
  nascimento.estado = true;
};

onMounted(() => {
  nascimento.titulo = props.titulo;
  if (nascimento.titulo === "Dia") {
    for (let i = 1; i <= 31; i++) {
      Lista.value.push(i);
    }
  } else if (nascimento.titulo === "Mes") {
    let meses = [
      "Janeiro",
      "Fevereiro",
      "Março",
      "Maio",
      "Abril",
      "Junho",
      "Julho",
      "Agosto",
      "Setembro",
      "Outubro",
      "Novembro",
      "Dezembro",
    ];
    Lista.value = meses;
  } else {
    for (let i = 1970; i <= 2022; i++) {
      Lista.value.push(i);
    }
    Lista.value.reverse();
  }
});
</script>

<style lang="scss" scoped>
input {
  background-color: var(--quaternary);
  border-radius: 4px;
  width: 145px !important;
  height: 40px;
  padding: 2px 10px 2px 10px;
}

.dropdown {
  position: absolute;
  background-color: var(--quinary);
  height: 170px;
  max-height: 170px;
  overflow-y: auto;
  @include scroll;
  width: 140px;
  margin-top: -173px;
  border-radius: 4px;
  border: 1px solid var(--tertiary);
  color: var(--senary);

  div {
    padding: 8px;
    &:hover {
      background-color: var(--grey);
      color: var(--white);
      cursor: pointer;
    }
  }
}
</style>
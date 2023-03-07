<template>
    <div @click="$emit('FecharModal')" class="adicionar-friend">
        <div @click.stop class="content">
            <div class="principal">
                <div class="pesquisa">
                    <input @keyup="PesquisarFriend" type="text" v-model="pesquisar" placeholder="digita o id do usuario">
                </div>
                <div class="resultado">

                    <div v-if="resultado_not_found" class="search-not-found">
                        <img src="/image/404-two.svg" width="230">
                    </div>

                    <div class="amigos" @click="VisualizarFriend(listamigos)" @mouseover="ActiveSearch(listamigos.id)" 
                    v-for="listamigos in listamigos" :key="listamigos.id">
                        <div :class="[listamigos.id === active ? 'active' : '']">
                            <img :src="'/image/usuarios/' + listamigos.foto_perfil" width="20">
                            <span>{{ listamigos.name }} <strong>@{{listamigos.apelido}}</strong> </span>
                        </div>
                    </div>

                </div>

                <div class="cancelar">
                   <div>
                    <strong>FICA A DICA: </strong> <p> Escreva "@" no começo da caixa de pesquisa para limitar os resultados.</p>
                   </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import useEventsBus from "@/eventBus";
import { ref, onMounted } from "@vue/runtime-core"

const {emit,bus} = useEventsBus();
const listaUsuarios = ref([])
const pesquisar = ref()
const resultado_not_found = ref(false)
const listamigos = ref();
const active = ref();

onMounted(() => {
    axios.get('/channel/BuscarListaUsuariosCompleto').then((response) => {
        listaUsuarios.value = response.data
        listamigos.value = listaUsuarios.value
    }).catch((erro) => {
        console.log(erro)
    })
})

const PesquisarFriend = () => {
    if (pesquisar.value.length >= 3 && isNaN(pesquisar.value)) {
        let lista = listaUsuarios.value
        let resultado = lista.filter((item) => {
            return item.name.includes(pesquisar.value)
        });
        if (resultado.length > 0) {
            resultado_not_found.value = false
            listamigos.value = resultado
        } else {
            resultado_not_found.value = true
            listamigos.value = [];
        }
    } else {
        resultado_not_found.value = false
        listamigos.value = [];
    }
}
const VisualizarFriend = ((amigo)=>{
    emit('ExibirMessage',amigo,'Addamigo')
});
const ActiveSearch = (id) => {
    active.value = id
}
</script>

<style lang="scss" scoped>
@import 'scss/AdicionarFriend';
</style>
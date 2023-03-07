<template>
    <div>
        <div v-for="listaMessages in listaMessages" :key="listaMessages.id" class="channel-message"
            :class="{'has-mention': hasmention}">
            <div class="message">
                <div class="user">
                    <img class="avatar" :src="'/image/usuarios/'+listaMessages.foto_perfil">
                    <strong>{{listaMessages.nome_usuario}}</strong>
                    <span class="bot" v-if="isBot">Bot</span>
                    <span class="data">10/10/2022</span>
                </div>
                <div class="body">
                    <p>{{listaMessages.mensagem}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref,watch } from '@vue/runtime-core';
import useEventsBus from '@/eventBus';
import { useStore } from 'vuex';
export default {
    props: {
        date: String,
        author: String,
        hasmention: Boolean,
        isBot: Boolean,
    },
    setup(props) {
        
        const { bus } = useEventsBus();
        const listaMessages = ref([]);
        const store = useStore();

        onMounted(() => {
        Echo.private(`user.${store.state.dadosUsuario.id}`).listen('.SendMessage', (e) => {
            console.log(e);
        });

            BuscarMensagem();
        })

        /*----------------------------------------------------

        Observadores da mensagem do usuario
        
        ---------------------------------------------------*/

        watch(() => bus.value.get('RefreshMessage'), (payload) => {
           const novaMessage = {
            nome_usuario:store.state.dadosUsuario.name,
            mensagem:payload[0],
            foto_perfil:store.state.dadosUsuario.foto_perfil,
           }

           listaMessages.value.push(novaMessage)
        });

        watch(() => bus.value.get('ExibirMessages'), (payload) => {
            BuscarMensagem();
        });

        const BuscarMensagem = async () =>{
           await axios.get('/channel/BuscarMessages?id=' + store.state.DadosMensagemUsuario.id).then((response) => {
                listaMessages.value = response.data
            }).catch((erro) => {
                console.log(erro)
            })
        }


        return { BuscarMensagem, listaMessages }
    }
}
</script>

<style scoped lang="scss">
@import "scss/channelMessage"
</style>
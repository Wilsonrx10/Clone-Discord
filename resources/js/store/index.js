import { createStore } from 'vuex'
import VuexPersistence from 'vuex-persist'
export default createStore({
    state: {
    dadosUsuario: [],
    // Variaveis do Channel 
    DadosServidor:[],
    // Variaveis do Friend 
    estadoFriend:true,
    DadosMensagemUsuario:[],
    ListaAmigos:null
    },
    getters: {
    },
    mutations: {
      GUARDAR_DADOS_USUARIO(state,payload) {
        state.dadosUsuario = payload
      },
      MUDAR_ESTADO_SERVIDOR(state) {
        if (state.Estado == true) {
          state.Estado = false
        } else {
          state.Estado = true;
        }
      },
      ABRIR_MENSAGEM_USUARIO(state) {
        state.estadoFriend = false
      },

      GUARDAR_DADOS_MENSAGEM_USUARIO(state,payload) {
        state.DadosMensagemUsuario = payload
      }

    },
    plugins:[
      new VuexPersistence({
        storage: window.localStorage
      }).plugin
    ],
    actions: {
    },
    modules: {
    }
  })
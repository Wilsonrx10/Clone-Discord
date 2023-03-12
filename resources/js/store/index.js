import { createStore } from 'vuex'
import VuexPersistence from 'vuex-persist'
export default createStore({
    state: {
    user: [],
    // Channel 
    DadosServidor:[],
    Estado: false,
    // Friend 
    estadoFriend:true,
    friends: [],
    DadosMensagemUsuario:[],
    },
    getters: {
      user(state) {
        return state.user;
      }
    },
    mutations: {
      GUARDAR_DADOS_USUARIO(state,payload) {
        state.user = payload
      },

      GUARDAR_LISTA_AMIGOS(state,payload) {
        state.friends = payload
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
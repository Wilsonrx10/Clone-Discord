import { createStore } from 'vuex'
import VuexPersistence from 'vuex-persist'
import Chat from './Chat';
import Servers from './Servers';

export default createStore({
    state: {
    user: [],
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
    },
    plugins:[
      new VuexPersistence({
        storage: window.localStorage
      }).plugin
    ],
    actions: {
    },
    modules: {
      Chat,
      Servers
    }
  })
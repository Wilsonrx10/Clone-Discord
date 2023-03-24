export default {
    GUARDAR_LISTA_AMIGOS(state, payload) {
        state.friends = payload;
    },
    ABRIR_MENSAGEM_USUARIO(state) {
        state.estadoFriend = false;
    },

    GUARDAR_DADOS_MENSAGEM_USUARIO(state, payload) {
        state.DadosMensagemUsuario = payload;
    },
};
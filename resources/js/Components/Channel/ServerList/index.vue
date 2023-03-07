<template>
    <div class="container">
        <ServerHome/>
        <AddServer @CriarServidor="modal.CriarServidor = true" />
        <div class="Button-separator"></div>
        <ServerButton :mentions="3" hasNotification/>
      
        <!-------Cria um servidor------->
        <div class="CriarServidor" v-show="modal.CriarServidor">
            <div class="content">
                <div class="principal">
                    <close @click="FecharCriarServidor" class="icone" :size="24" />
                    <h2>Crie um Servidor</h2>
                    <p>Seu servidor é onde você e seus amigos se reunem</p>
                    <div class="content-buttons">
                        <div @click="PersonalizarServidor('Jogos')">
                            <span>Jogos</span>
                        </div>

                        <div @click="PersonalizarServidor('Clubes escolar')">
                            <span>Clubes escolar</span>
                        </div>

                        <div @click="PersonalizarServidor('Grupo de Estudo')">
                            <span>Grupo de Estudo</span>
                        </div>

                        <div @click="PersonalizarServidor('Comunidade Local')">
                            <span>Comunidade Local</span>
                        </div>

                    </div>
                </div>
                <div class="content-entrar">
                    <div>
                        <h3>Já tem um convite ?</h3>
                        <button @click="EntrarServidor">Entrar em um Servidor</button>
                    </div>
                </div>
            </div>
        </div>

        <!-----Personalize seu servidor-------->
        <div class="PersonalizarServidor" v-show="modal.Personalizar">
            <div class="content">
                <div class="principal">
                    <close @click="FecharCriarServidor" class="icone" :size="24" />
                    <h2>Personalize Seu Servidor</h2>
                    <p>Seu servidor é onde você e seus amigos se reunem</p>

                    <div class="content-formulario">
                        <div class="foto">
                            <input style="display:none;" @change="onFileChange" type="file" id="file" required />
                            <img @click="Uploadfoto" :src="element.imagem">
                        </div>

                        <div class="form">
                            <label for="nome">Nome do Servidor</label>
                            <input v-model="DadosFormulario.nome" type="text" placeholder="">
                        </div>
                    </div>

                </div>

                <div class="voltar-formulario">
                    <span @click="VoltarCriarServidor('personalizar')">Voltar</span>
                    <button v-if="modal.estado_botao_CriarServidor == false"  @click="AdicionarServidor">Criar Servidor</button>
                    <button v-else>Aguarde...</button>
                </div>

            </div>
        </div>


        <!-----Entrar em um servidor-------->
        <div class="EntrarServidor" v-show="modal.EntrarServidor">
            <div class="content">
                <div class="principal">
                    <close @click="FecharCriarServidor" class="icone" :size="24" />
                    <h2>Entrar em um Servidor</h2>
                    <p>insire um link de convite para entrar no servidor</p>

                    <div class="content-formulario">
                        <div class="form">
                            <label for="link">Link do Servidor</label>
                            <input type="text" name="link" placeholder="">
                        </div>
                    </div>

                </div>

                <div class="voltar-formulario">
                    <span @click="VoltarCriarServidor('entrar')">Voltar</span>
                    <button>Entrar Servidor</button>
                </div>

            </div>
        </div>

    </div>
</template>

<script setup>
import close from 'vue-material-design-icons/Close.vue'
import ServerButton from './ServerButton.vue';
import AddServer from './AddServer.vue';
import { reactive, ref,defineProps,onMounted} from 'vue';
import axios from 'axios';
import ServerHome from './ServerHome.vue';

const props = defineProps(['dados_usuario']);

const element = reactive({
    imagem:'/image/user.jpg'
});

const DadosFormulario = reactive({
imagem:null,
nome:null,
administrador:null
})

const modal = reactive({
    CriarServidor: false,
    EntrarServidor: false,
    Personalizar: false,
    estado_botao_CriarServidor:false
})

const PersonalizarServidor = () => {
    modal.Personalizar = true;
    modal.CriarServidor = false;
}
const VoltarCriarServidor = (event) => {
    if (event == 'personalizar') {
        modal.Personalizar = false
        modal.CriarServidor = true;
    } else {
        modal.EntrarServidor = false
        modal.CriarServidor = true;
    }
}

const EntrarServidor = () => {
    modal.EntrarServidor = true;
    modal.Personalizar = false
    modal.CriarServidor = false;
}

const FecharCriarServidor = () => {
    Object.keys(modal).map(key=>{
        modal[key] = false
    })
};

const AdicionarServidor = (response) => {
    modal.estado_botao_CriarServidor = true
    DadosFormulario.administrador = props.dados_usuario.name
    axios.post('/CriarServidor', { DadosFormulario }).then((response) => {
        Object.keys(modal).map(key => {
            modal[key] = false
        })
        console.log(response.data)
    }).catch((erro) => {
        console.log(erro)
    })
}

const Uploadfoto = () => {
    document.getElementById("file").click();
}

const onFileChange = (e) => {
    var files = e.target.files || e.dataTransfer.files;
    // Verificar o formato da imagem 
    let arquivo = files[0].name;
    let extension = arquivo.indexOf('.') < 1 ? '' : arquivo.split('.').pop();
    if (extension == "") {
        return false;
    } else {
        // verificar se este formato existe no Array 
        let formatos_permitidos = ['jpg', 'png', 'gif', 'jpeg', 'JPG', 'PNG', 'GIF', 'JPEG'];
        let resultado = formatos_permitidos.includes(extension);
        if (resultado == false) {
            return false;
        } else {
            // tamanho do arquivo suportado em MB
            var tamanho_maximo = 2242880
            var fsizet = 0;
            for (var i = 0; i <= e.target.files.length - 1; i++) {
                var fsize = e.target.files.item(i).size;
                fsizet = fsizet + fsize;
            }

            if (fsizet > tamanho_maximo) {
               console.log("Tamanho do arquivo é maior que 5mb 'Tamanho máximo  = 2MB' ");
            } else {
                createImg(files[0]);
            }
        }
    }
}

const createImg = (file) => {
    var imagem = new Image;
    var reader = new FileReader;

    reader.onload = (e) => {
        element.imagem = e.target.result;
        DadosFormulario.imagem = element.imagem;
    };

    reader.readAsDataURL(file);
}

</script>

<style scoped lang="scss">
@import 'scss/ServerList';
</style>
<template>
    <div id="discord">
        <div id="grid">
            <ServerList :dados_usuario="dados_usuario"/>
            <ServerName :dados_usuario="dados_usuario"/>
            <FriendList/>
            <UserInfo :dados_usuario="dados_usuario"/>
            <FriendlInfo/>
            <AtivacionUser/>
            <ChannelFriend/>
        </div>
    </div>
</template>

<script setup>
import { onMounted,ref,defineProps} from '@vue/runtime-core';
import ServerList from '@/Components/UI Discord/ServerList/index.vue';
import ServerName from '@/Components/UI Discord/ServerName/index.vue';
import UserInfo from '@/Components/UI Discord/UserInfo/index.vue';
import FriendList from '@/Components/Friends/FriendList/index.vue';
import AtivacionUser from '../Components/Friends/AtivacionUser/index.vue';
import ChannelFriend from '../Components/Friends/ChannelFriend/index.vue';
import FriendlInfo from '@/Components/Friends/FriendlInfo/index.vue';

const props = defineProps(['usuario']);

const dados_usuario = ref([]);

onMounted(()=>{
dados_usuario.value = props.usuario
console.log(dados_usuario.value);
});
</script>

<style scoped>
    #grid {
    display: grid;
    height:100vh;
    grid-template-columns: 71px 240px auto 350px;
    grid-template-rows: 46px auto 52px;
    grid-template-areas: 
    "SL SN FI FI"
    "SL FL CF AU"
    "SL UI CF AU";
    }
</style>
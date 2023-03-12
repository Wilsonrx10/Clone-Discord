<template>
    <div id="discord">
        <div id="grid">
            <ServerList />
            <ServerName />
            <FriendList />
            <UserInfo />
            <FriendlInfo />
            <AtivacionUser />
            <ChannelFriend />
        </div>
    </div>
</template>

<script setup>
import ServerList from '@/Components/Channel/ServerList/index.vue';
import ServerName from '@/Components/Channel/ServerName/index.vue';
import UserInfo from '@/Components/Channel/UserInfo/index.vue';
import FriendList from '@/Components/Friends/FriendList/index.vue';
import AtivacionUser from '../Components/Friends/AtivacionUser/index.vue';
import ChannelFriend from '../Components/Friends/ChannelFriend/index.vue';
import FriendlInfo from '@/Components/Friends/FriendlInfo/index.vue';
</script>

<style scoped>
#grid {
    display: grid;
    height: 100vh;
    grid-template-columns: 71px 240px auto 350px;
    grid-template-rows: 46px auto 52px;
    grid-template-areas:
        "SL SN FI FI"
        "SL FL CF AU"
        "SL UI CF AU";
}
</style>
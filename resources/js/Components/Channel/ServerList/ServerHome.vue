<template>
   <Link :href="route('friend')">
    <div class="serverButton">
        <img src="/image/servidores/discord.png">   
    </div>
   </Link>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
</script>

<style scoped lang="scss">
.serverButton {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    margin-bottom: 8px;
    background-color: var(--primary);
    cursor: pointer;
    position: relative;
    border-radius: 50%;
    transition: 0.2s;

    img {
        width: 25px;
        height: 25px;
    }
}
</style>
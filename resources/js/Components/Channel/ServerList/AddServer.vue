<template>
    <div @click="$emit('CriarServidor')" class="serverButton">
        <Add class="icone" :size="26" />
    </div>
</template>

<script setup>
import Add from 'vue-material-design-icons/Plus.vue'
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
    &.active,
    &:hover {
        border-radius: 16px;
        background-color: var(--discord);
        background-color:rgb(20, 171, 20);
        .icone {
            color: var(--white);
        }
    }

    .icone {
        color:rgb(20, 171, 20);
    }
}
</style>
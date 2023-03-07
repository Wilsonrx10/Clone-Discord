<template>
    <div class="container">
        <span class="mention">
            <slot />
        </span>
    </div>
</template>

<script setup>
</script>
    
<style scoped lang="scss">
.mention {
 color:var(--link);
 margin-left: -10px;
 &:hover {
    text-decoration: underline;
 }
}
</style>
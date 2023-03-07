<template>
    <div>
        <ConfirmDialog></ConfirmDialog>
        <ConfirmDialog group="templating">
            <template #message="slotProps">
                <div class="flex p-4">
                    <i
                        :class="slotProps.message.icon"
                        style="font-size: 1.5rem"
                    ></i>
                    <p class="pl-2">{{ slotProps.message.message }}</p>
                </div>
            </template>
        </ConfirmDialog>
    </div>
</template>

<script>
import ConfirmDialog from "primevue/confirmdialog";
import { defineComponent, onMounted } from "vue";
import { useConfirm } from "primevue/useconfirm";
import { Inertia } from "@inertiajs/inertia";
export default defineComponent({
    setup() {
        const confirm = useConfirm();

        onMounted(() => {
            confirm1();
        });

        const confirm1 = () => {
            confirm.require({
                message: "Tens certeza que desejas Terminar Sessão",
                header: "Terminar Sessão",
                icon: "pi pi-exclamation-triangle",
                accept: () => {
                    Inertia.get("/logout");
                },
            });
        };
        return { confirm1 };
    },
    components: { ConfirmDialog },
});
</script>

<style scoped lang="scss"></style>
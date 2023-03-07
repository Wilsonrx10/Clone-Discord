<template>
    <div>
        <MultiSelect v-model="selectedHabilidades" :options="habilidades" optionLabel="name"
            placeholder="Select Countries" :filter="true" class="multiselect-custom">
            <template #value="slotProps">
                <div class="country-item country-item-value" v-for="option of slotProps.value" :key="option.code">
                    <div>{{option.name}}</div>
                </div>
                <template v-if="!slotProps.value || slotProps.value.length === 0">
                    Seleciona suas habilidades
                </template>
            </template>
            <template #option="slotProps">
                <div class="country-item">
                    <div>{{slotProps.option.name}}</div>
                </div>
            </template>
        </MultiSelect>
    </div>
</template>

<script>
import MultiSelect from 'primevue/multiselect';
import { ref, watch } from 'vue';

export default {
    emits:['selecionarHabilidade'],
    setup(props,{emit}) {

        const selectedHabilidades = ref();
        const selectedItems = ref();
        const selectAll = ref(false);

        const habilidades = ref([
            { name: 'VueJs'},
            { name: 'ReactJs'},
            { name: 'AngularJs'},
            { name: 'HTML5'},
            { name: 'CSS3'},
            { name: 'PHP'},
            { name: 'LARAVEL'},
            { name: 'NODEJS'},
            { name: 'ASP.NET'},
            { name: 'ASSEMBLY'}
        ]);

        const items = Array.from({ length: 1000 }, (_, i) => ({ label: `Item #${i}`, value: i }))
        
        // Levar as habilidade para o componente registro
        watch(selectedHabilidades,(novoValor)=>{
        emit('selecionarHabilidade',novoValor)
        });

        return { selectedHabilidades, habilidades, items, selectedItems, selectAll }
    },
    components: { MultiSelect },
    methods: {
        onSelectAllChange(event) {
            this.selectedItems = event.checked ? this.items.map((item) => item.value) : [];
            this.selectAll = event.checked;
        },
        onChange(event) {
            this.selectAll = event.value.length === this.items.length
        }
    }
}
</script>

<style lang="scss" scoped>
.p-multiselect {
    width: 18rem;
}

::v-deep(.multiselect-custom) {
    .p-multiselect-label:not(.p-placeholder) {
        padding-top: .25rem;
        padding-bottom: .25rem;
    }

    .country-item-value {
        padding: .25rem .5rem;
        border-radius: 3px;
        display: inline-flex;
        margin-right: .5rem;
        background-color: var(--primary-color);
        color: var(--primary-color-text);

        img.flag {
            width: 17px;
        }
    }
}

@media screen and (max-width: 640px) {
    .p-multiselect {
        width: 100%;
    }
}
</style>
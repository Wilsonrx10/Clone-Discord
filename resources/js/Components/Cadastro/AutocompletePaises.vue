<template>
    <div>
        <Dropdown style="width:308px; margin-top:6px" v-model="selectedCountry" :options="countries" optionLabel="name" :filter="true" placeholder="Seleciona seu país" :showClear="true">
            <template #value="slotProps">
                <div class="country-item country-item-value" v-if="slotProps.value">
                    <div>{{slotProps.value.name}}</div>
                </div>
                <span v-else>
                    {{slotProps.placeholder}}
                </span>
            </template>
            <template #option="slotProps">
                <div class="country-item">
                    <div>{{slotProps.option.name}}</div>
                </div>
            </template>
        </Dropdown>
    </div>
</template>

<script>
import Dropdown from 'primevue/dropdown/Dropdown.vue'
import {ref, watch} from 'vue';
export default {
    emits:['nacionalidade'],
    setup(props,{emit}) {
        const selectedMoeda = ref();
        const loading = ref(false);
        let listaCountries = ref();
        const selectedCountry = ref();
        const countries = ref([
            {name: 'Moçambique', code: 'MZ'},
            {name: 'Angola', code: 'AO'},
            {name: 'Brazil', code: 'BR'},
        ]);
        const items = ref(Array.from({ length: 100000 }, (_, i) => ({ label: `Item #${i}`, value: i })));
        const lazyItems = ref(Array.from({ length: 100000 }));

        const onLazyLoad = (event) => {
            this.loading = true;

            if (this.loadLazyTimeout) {
                clearTimeout(this.loadLazyTimeout);
            }

            // Limitar o atraso de uma chamada de back-end
            this.loadLazyTimeout = setTimeout(() => {
                const { first, last } = event;
                const lazyItems = [...this.lazyItems];

                for (let i = first; i < last; i++) {
                    lazyItems[i] = { label: `Item #${i}`, value: i };
                }

                this.lazyItems = lazyItems;
                this.loading = false;
            }, Math.random() * 1000 + 250);
        }

        // Levar a nacionalidade para o componente Registro 

        watch(selectedCountry,(novoValor)=>{
        emit('nacionalidade',novoValor);
        })
        
        return { selectedCountry,selectedMoeda, listaCountries, countries,loading, items, lazyItems, onLazyLoad, }
    },
    loadLazyTimeout: null,
    components:{Dropdown}
}
</script>

<style scoped lang="scss">
.p-dropdown {
width: 14rem;
}
</style>
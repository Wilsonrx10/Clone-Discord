import {mount} from '@vue/test-utils';
import Cadastro from '../Pages/Cadastro.vue';

describe('Cadastro - Unit', ()=>{
    it('should be a vue instance',()=>{
        const wrapper = mount(Cadastro,{
            propsData:{
                value:""
            }
        })
    })

    expect(wrapper.vn).toBeDefined();
})
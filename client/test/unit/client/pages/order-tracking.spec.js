import { mount, shallowMount, createLocalVue, RouterLinkStub } from '@vue/test-utils';
import OrderTracking from '@/pages/tracking';
import Vuelidate from 'vuelidate';

const localVue = createLocalVue();
localVue.use(Vuelidate);

const axios = {
  $post: () => Promise.resolve({
    data: {
      status: 'DELIVERED TEST'
    },
    message: 'success'
  })
};

describe('Order Tracking', () => {
  test('order delivered status received', async () => {
    const wrapper = mount(OrderTracking, {
      localVue,
      stubs: {
        NuxtLink: RouterLinkStub
      },
      mocks: {
        $axios: axios
      }
    });

    wrapper.setData({
      form: {
        orderId: 1,
        email: 'johndoe@gmail.com'
      }
    });

    const submitForm = jest.spyOn(wrapper.vm, 'submitForm');

    expect(wrapper.vm.form.email).toBe('johndoe@gmail.com');
    expect(wrapper.vm.form.orderId).toBe(1);

    await wrapper.find('form').trigger('submit');

    expect(submitForm).toHaveBeenCalled();
    expect(wrapper.vm.$data.message).toEqual('DELIVERED TEST');
  });
});

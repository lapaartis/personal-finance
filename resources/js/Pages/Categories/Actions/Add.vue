<template>
    <ModalBox :size="'small'" :show="show">
        <template v-slot:image>
            <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </template>

        <template v-slot:header>
            Add Category
        </template>

        <template v-slot:body>
            <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-6 sm:col-span-6">
                    <div class="sm:col-span-6">
                        <label for="category-name" class="block text-sm font-medium leading-5 text-gray-700">
                            Category Name
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input v-model="form.name" id="category-name" type="text"
                                   v-bind:class="{ 'border-red-500': !validations.name.valid }"
                                   class="rounded-md shadow-sm block w-full border-gray-300">
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.name.valid"
                              v-text="validations.name.message"></span>
                    </div>
                </div>
            </form>
        </template>

        <template v-slot:footer>
            <button @click="cancel" type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button @click="addCategory()" type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add
            </button>
        </template>

    </ModalBox>
</template>

<script>
import {EventBus} from '@/event-bus.js';
import ModalBox from '@/Components/ModalBox.vue';
import CategoriesAPI from '@/Api/categories.js';

export default {
    components: {
        ModalBox,
    },

    data() {
        return {
            show: false,
            form: {
                name: ''
            },
            validations: {
                name: {
                    valid: true,
                    message: 'Enter a name for this category'
                }
            }
        }
    },

    mounted() {
        this.bindEvents();
    },

    methods: {
        bindEvents() {
            EventBus.on('prompt-add-category', function () {
                this.show = true;
            }.bind(this));

            EventBus.on('close-modal', function () {
                this.show = false;
            }.bind(this));
        },

        cancel() {
            this.show = false;
        },

        addCategory() {
            if (this.validate()) {
                CategoriesAPI.store(this.form)
                    .then(function (message) {
                        this.reloadCategories();
                        this.resetForm();
                        this.resetValidations();
                        this.hideModal();
                    }.bind(this))
                    .catch(function (error) {
                        if (error.response.status === 422) {
                            this.setServerSideValidations(error.response.data.errors);
                        } else {
                            console.error(error.response);
                        }
                    }.bind(this));
            }
        },

        validate() {
            const {name} = this.form;
            const {validations} = this;

            validations.name.valid = name !== '';

            return Object.values(validations).every(validation => validation.valid);
        },

        reloadCategories() {
            EventBus.emit('reload-categories');
        },

        resetForm() {
            this.form.name = '';
        },

        resetValidations() {
            for (const field in this.validations) {
                this.validations[field].valid = true;
            }
        },

        hideModal() {
            this.show = false
        },

        setServerSideValidations(errors) {
            for (const [key, value] of Object.entries(errors)) {
                this.validations[key].valid = false;
                this.validations[key].message = value[0];
            }
        }
    }
}
</script>

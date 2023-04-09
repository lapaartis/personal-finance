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
            Edit Account
        </template>

        <template v-slot:body>
            <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-6 sm:col-span-6">
                    <div class="sm:col-span-6">
                        <label for="account-name" class="block text-sm font-medium leading-5 text-gray-700">
                            Account Name
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input v-model="form.name" id="account-name" type="text"
                                   v-bind:class="{ 'border-red-500': !validations.name.valid }"
                                   class="rounded-md shadow-sm block w-full border-gray-300">
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.name.valid"
                              v-text="validations.name.message"></span>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="account-iban" class="block text-sm font-medium leading-5 text-gray-700">
                            IBAN
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input v-model="form.iban" v-bind:class="{ 'border-red-500': !validations.iban.valid }"
                                   id="account-iban" type="text"
                                   class="rounded-md shadow-sm block w-full border-gray-300">
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.iban.valid"
                              v-text="validations.iban.message"></span>
                    </div>
                    <div class="sm:col-span-6">
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">
                                Current Balance
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span
                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                    $
                                </span>
                                <input type="number" name="current-balance" id="current-balance"
                                       v-model="form.balance"
                                       class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300"/>
                            </div>
                            <span class="text-red-500 text-sm" v-show="!validations.balance.valid"
                                  v-text="validations.balance.message"></span>
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                            Description
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input v-model="form.description"
                                   v-bind:class="{ 'border-red-500': !validations.description.valid }" id="description"
                                   type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.description.valid"
                              v-text="validations.description.message"></span>
                    </div>
                </div>
            </form>
        </template>

        <template v-slot:footer>
            <button @click="cancel" type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button @click="updateAccount()" type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Update
            </button>
        </template>

    </ModalBox>
</template>

<script>
import {EventBus} from '@/event-bus.js';
import ModalBox from '@/Components/ModalBox.vue';
import AccountsAPI from '@/Api/accounts.js';

export default {
    components: {
        ModalBox,
    },

    data() {
        return {
            show: false,
            id: '',
            form: {
                name: '',
                iban: '',
                description: '',
                balance: ''
            },
            validations: {
                name: {
                    valid: true,
                    message: 'Enter a name for this account'
                },
                iban: {
                    valid: true,
                    message: 'Please enter an account IBAN'
                },
                description: {
                    valid: true,
                    message: 'Please enter a description'
                },
                balance: {
                    valid: true,
                    message: 'Enter the current balance of your account'
                }
            }
        }
    },

    mounted() {
        this.bindEvents();
    },

    methods: {
        bindEvents() {
            EventBus.on('prompt-edit-account', function (data) {
                this.show = true;

                this.id = data.id
                this.form.name = data.name
                this.form.iban = data.iban
                this.form.balance = data.balance
                this.form.description = data.description
            }.bind(this));

            EventBus.on('close-modal', function () {
                this.resetForm();
                this.resetValidations();
                this.hideModal();
            }.bind(this));
        },

        cancel() {
            this.show = false;
        },

        updateAccount() {
            if (this.validate()) {
                AccountsAPI.update(this.id, this.form)
                    .then(function () {
                        this.reloadAccount();
                        this.resetForm();
                        this.resetValidations();
                        this.hideModal();
                    }.bind(this))
                    .catch(function (error) {
                        console.error(error.response.data.errors);
                    }.bind(this));
            }
        },

        validate() {
            const {name, iban, description, balance} = this.form;
            const {validations} = this;

            validations.name.valid = name !== '';
            validations.iban.valid = iban !== '';
            validations.description.valid = description !== '';
            validations.balance.valid = !isNaN(balance) && balance !== '';

            return Object.values(validations).every(validation => validation.valid);
        },

        reloadAccount() {
            EventBus.emit('account-updated');
        },

        resetForm() {
            this.form.name = '';
            this.form.iban = '';
            this.form.description = '';
            this.form.balance = '';
        },

        resetValidations() {
            for (const field in this.validations) {
                this.validations[field].valid = true;
            }
        },

        hideModal() {
            this.show = false
        }
    }
}
</script>

<template>
    <LayoutAuthenticated>
        <Head>
            <title>Accounts</title>
        </Head>
        <SectionMain>
            <SectionTitleLineWithButton
                :icon="mdiChartTimelineVariant"
                title="Accounts"
                main
            >
                <BaseButton
                    @click="ActionsAddAccount()"
                    :icon="mdiPlusCircle"
                    label="Add"
                    color="contrast"
                    rounded-full
                    small
                />
            </SectionTitleLineWithButton>

            <CardBox class="mb-6" has-table>
                <table class="table-auto">
                    <thead>
                    <tr>
                        <th class="">Name</th>
                        <th class="">Type</th>
                        <th class="">IBAN</th>
                        <th class="">Balance</th>
                        <th class="">Description</th>
                        <th class=""></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="account in accounts" :key="account.id">
                        <td data-label="Name">{{ account.name }}</td>
                        <td data-label="Type">{{ getAccountTypeName(account.account_type_id) }}</td>
                        <td data-label="IBAN">{{ account.iban }}</td>
                        <td data-label="Balance">{{ account.balance }}</td>
                        <td data-label="Description">{{ account.description }}</td>
                        <td class="before:hidden lg:w-1 whitespace-nowrap">
                            <BaseButton
                                :href="$route('accounts.show', account.id)"
                                label="View"
                                color="contrast"
                                small
                            />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </CardBox>
        </SectionMain>

        <ActionsAddAccount :accountTypes="accountTypes"/>
    </LayoutAuthenticated>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import {
    mdiChartTimelineVariant,
    mdiPlusCircle,
} from "@mdi/js";
import {EventBus} from '@/event-bus.js';
import SectionMain from "@/Components/SectionMain.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import BaseButton from "@/Components/BaseButton.vue";
import CardBox from "@/Components/CardBox.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import ActionsAddAccount from '@/Pages/Accounts/Actions/Add.vue';
import AccountsAPI from '@/Api/accounts.js';
import AccountTypesAPI from '@/Api/accountTypes.js';
import accountTypes from "@/Api/accountTypes.js";

export default {
    computed: {
        accountTypes() {
            return accountTypes
        }
    },
    data() {
        return {
            mdiChartTimelineVariant: mdiChartTimelineVariant,
            mdiPlusCircle: mdiPlusCircle,
            accounts: [],
            accountTypes: []
        }
    },

    components: {
        Head,
        SectionMain,
        LayoutAuthenticated,
        BaseButton,
        CardBox,
        SectionTitleLineWithButton,
        ActionsAddAccount
    },

    mounted() {
        this.bindEvents();
        this.loadAccounts();
        this.loadAccountTypes();
    },

    methods: {
        bindEvents() {
            EventBus.on('reload-accounts', function () {
                this.loadAccounts();
            }.bind(this));
        },

        loadAccounts() {
            AccountsAPI.index()
                .then(function (response) {
                    this.accounts = response.data;
                }.bind(this));
        },

        loadAccountTypes() {
            AccountTypesAPI.index()
                .then(function (response) {
                    this.accountTypes = response.data;
                }.bind(this));
        },

        getAccountTypeName(id) {
            const accountType = this.accountTypes.find(type => type.id === id);
            return accountType ? accountType.type : 'Unknown';
        },

        ActionsAddAccount() {
            EventBus.emit('prompt-add-account');
        }
    }
}
</script>


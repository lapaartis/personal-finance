<template>
    <LayoutAuthenticated>
        <Head>
            <title>Accounts</title>
        </Head>
        <SectionMain>
            <SectionTitleLineWithButton
                :title="account.name"
                main
            >
                <BaseButtons classAddon="mb-3 rounded-none last:rounded-r first:rounded-l">
                    <BaseButton
                        :icon="mdiPlus"
                        label="Add Transaction"
                        color="contrast"
                        outline
                    />
                    <BaseButton
                        @click="promptEditAccount()"
                        :icon="mdiSquareEditOutline"
                        label="Edit Account"
                        color="contrast"
                        outline
                    />
                </BaseButtons>
            </SectionTitleLineWithButton>
            {{ account }}

        </SectionMain>

        <ActionsEditAccount/>

    </LayoutAuthenticated>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import {EventBus} from '@/event-bus.js';
import {
    mdiSquareEditOutline,
    mdiPlus,
} from "@mdi/js";
import SectionMain from "@/Components/SectionMain.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import BaseButton from "@/Components/BaseButton.vue";
import CardBox from "@/Components/CardBox.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import AccountsAPI from '@/Api/accounts.js';
import BaseButtons from "@/Components/BaseButtons.vue";
import ActionsEditAccount from '@/Pages/Accounts/Actions/Edit.vue';

export default {
    props: ['id'],

    data() {
        return {
            mdiSquareEditOutline: mdiSquareEditOutline,
            mdiPlus: mdiPlus,
            loaded: false,
            account: {}
        }
    },

    components: {
        Head,
        BaseButtons,
        ActionsEditAccount,
        SectionMain,
        LayoutAuthenticated,
        BaseButton,
        CardBox,
        SectionTitleLineWithButton,
    },

    mounted() {
        this.bindEvents();
        this.getAccount();
    },

    methods: {
        bindEvents() {
            EventBus.on('account-updated', function () {
                this.getAccount();
            }.bind(this));
        },

        getAccount() {
            AccountsAPI.show(this.id)
                .then(function (response) {
                    this.account = response.data;
                    this.loaded = true;
                }.bind(this));
        },

        promptEditAccount() {
            EventBus.emit('prompt-edit-account', this.account);
        }
    }
}
</script>


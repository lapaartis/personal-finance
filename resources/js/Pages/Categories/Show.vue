<template>
    <LayoutAuthenticated>
        <Head>
            <title>Categories</title>
        </Head>
        <SectionMain>
            <SectionTitleLineWithButton
                :title="category.name"
                main
            >
                <BaseButtons classAddon="mb-3 rounded-none last:rounded-r first:rounded-l">
                    <BaseButton
                        @click="promptEditAccount()"
                        :icon="mdiSquareEditOutline"
                        label="Edit Category"
                        color="contrast"
                        outline
                    />
                </BaseButtons>
            </SectionTitleLineWithButton>
            {{ category }}

        </SectionMain>

        <ActionsEditCategory/>

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
import CategoriesAPI from '@/Api/categories.js';
import BaseButtons from "@/Components/BaseButtons.vue";
import ActionsEditCategory from '@/Pages/Categories/Actions/Edit.vue';

export default {
    props: ['id'],

    data() {
        return {
            mdiSquareEditOutline: mdiSquareEditOutline,
            mdiPlus: mdiPlus,
            loaded: false,
            category: {}
        }
    },

    components: {
        Head,
        BaseButtons,
        ActionsEditCategory,
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
            EventBus.on('category-updated', function () {
                this.getAccount();
            }.bind(this));
        },

        getAccount() {
            CategoriesAPI.show(this.id)
                .then(function (response) {
                    this.category = response.data;
                    this.loaded = true;
                }.bind(this));
        },

        promptEditAccount() {
            EventBus.emit('prompt-edit-category', this.category);
        }
    }
}
</script>


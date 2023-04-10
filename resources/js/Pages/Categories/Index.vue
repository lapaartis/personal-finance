<template>
    <LayoutAuthenticated>
        <Head>
            <title>Categories</title>
        </Head>
        <SectionMain>
            <SectionTitleLineWithButton
                :icon="mdiChartTimelineVariant"
                title="Categories"
                main
            >
                <BaseButton
                    @click="ActionsAddCategory()"
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
                        <th class=""></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in categories" :key="category.id">
                        <td data-label="Name">{{ category.name }}</td>
                        <td>
                            <BaseButton
                                :href="$route('categories.show', category.id)"
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

        <ActionsAddCategory/>
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
import ActionsAddCategory from '@/Pages/Categories/Actions/Add.vue';
import CategoriesAPI from '@/Api/categories.js';

export default {
    data() {
        return {
            mdiChartTimelineVariant: mdiChartTimelineVariant,
            mdiPlusCircle: mdiPlusCircle,
            categories: []
        }
    },

    components: {
        Head,
        SectionMain,
        LayoutAuthenticated,
        BaseButton,
        CardBox,
        SectionTitleLineWithButton,
        ActionsAddCategory
    },

    mounted() {
        this.bindEvents();
        this.loadCategories();
    },

    methods: {
        bindEvents() {
            EventBus.on('reload-categories', function () {
                this.loadCategories();
            }.bind(this));
        },

        loadCategories() {
            CategoriesAPI.index()
                .then(function (response) {
                    this.categories = response.data;
                }.bind(this));
        },

        ActionsAddCategory() {
            EventBus.emit('prompt-add-category');
        }
    }
}
</script>


<script setup>
import {Head} from "@inertiajs/vue3";
import {
    mdiChartTimelineVariant,
    mdiPlusCircle,
} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import BaseButton from "@/components/BaseButton.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";

const props = defineProps(['accounts']);
</script>

<template>
    <LayoutAuthenticated>
        <Head title="Accounts"/>
        <SectionMain>
            <SectionTitleLineWithButton
                :icon="mdiChartTimelineVariant"
                title="Overview"
                main
            >
                <BaseButton
                    href="/"
                    target="_blank"
                    :icon="mdiPlusCircle"
                    label="Add"
                    color="contrast"
                    rounded-full
                    small
                />
            </SectionTitleLineWithButton>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <li v-for="account in accounts">
                        {{ account.name }}
                    </li>
                </div>
            </div>
        </SectionMain>

    </LayoutAuthenticated>
</template>

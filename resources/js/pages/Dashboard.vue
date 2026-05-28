<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { dashboard } from '@/routes';

defineProps<{
    stats: {
        total: number
        pending: number
        in_progress: number
        completed: number
    }
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <!-- Stats Cards -->
        <div class="grid gap-4 md:grid-cols-4">
            <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-gray-800 p-6">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Tasks</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ stats.total }}</p>
            </div>
            <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-gray-800 p-6">
                <p class="text-sm text-gray-500 dark:text-gray-400">Pending</p>
                <p class="text-3xl font-bold text-yellow-500 mt-1">{{ stats.pending }}</p>
            </div>
            <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-gray-800 p-6">
                <p class="text-sm text-gray-500 dark:text-gray-400">In Progress</p>
                <p class="text-3xl font-bold text-blue-500 mt-1">{{ stats.in_progress }}</p>
            </div>
            <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border bg-white dark:bg-gray-800 p-6">
                <p class="text-sm text-gray-500 dark:text-gray-400">Completed</p>
                <p class="text-3xl font-bold text-green-500 mt-1">{{ stats.completed }}</p>
            </div>
        </div>
    </div>
</template>
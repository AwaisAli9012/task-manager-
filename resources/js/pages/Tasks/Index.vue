<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const props = defineProps<{
    tasks: Array<{
        id: number
        title: string
        description: string
        status: string
        due_date: string
    }>
}>()

const form = useForm({
    title: '',
    description: '',
    status: 'pending',
    due_date: '',
})

const submit = () => {
    form.post(route('tasks.store'), {
        onSuccess: () => form.reset(),
    })
}

const deleteTask = (id: number) => {
    if (confirm('Are you sure you want to delete this task?')) {
        useForm({}).delete(route('tasks.destroy', id))
    }
}

const updateStatus = (id: number, status: string) => {
    useForm({ status }).patch(route('tasks.updateStatus', id))
}
</script>

<template>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6 text-white">My Tasks</h1>

        <!-- Create Task Form -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-900">Add New Task</h2>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-gray-700">Title</label>
                    <input
                        v-model="form.title"
                        type="text"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 bg-white"
                        placeholder="Task title"
                    />
                    <p v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-gray-700">Description</label>
                    <textarea
                        v-model="form.description"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 bg-white"
                        placeholder="Task description"
                    ></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-gray-700">Due Date</label>
                    <input
                        v-model="form.due_date"
                        type="date"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 bg-white"
                    />
                </div>

                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Add Task
                </button>
            </form>
        </div>

        <!-- Tasks List -->
        <div class="space-y-4">
            <div
                v-for="task in tasks"
                :key="task.id"
                class="bg-white rounded-lg shadow p-4"
            >
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-lg text-gray-900">{{ task.title }}</h3>
                        <p class="text-gray-600 text-sm">{{ task.description }}</p>
                        <p class="text-gray-400 text-xs mt-1">Due: {{ task.due_date }}</p>
                    </div>
                    <div class="flex gap-2">
                        <select
                            :value="task.status"
                            @change="updateStatus(task.id, ($event.target as HTMLSelectElement).value)"
                            class="border border-gray-300 rounded px-2 py-1 text-sm text-gray-900 bg-white"
                        >
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                        <button
                            @click="deleteTask(task.id)"
                            class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            <p v-if="tasks.length === 0" class="text-gray-400 text-center py-8">
                No tasks yet. Add one above!
            </p>
        </div>
    </div>
</template>
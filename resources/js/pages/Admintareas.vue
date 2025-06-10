<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Swal from 'sweetalert2'
import moment from 'moment';

const actions = ref(true),
    showTaskPane = ref(true),
    selProjData = ref(null),
    taskId = ref(null),
    taskName = ref(null),
    dueDate = ref(null),
    projects = ref([]),
    taskData = ref([]),
    openMenuId = ref(null);

const toggleMenu = id => {
    openMenuId.value = openMenuId.value === id ? null : id;
};

const deleteTask = async (id) => {
    try {
        await axios.delete(`/tasks/${id}`)
        await getListTaskData();
        Swal.fire({
            icon: "success",
            title: "La tarea se elimino correctamente",
        });
    } catch (error) {
        console.error('Error al eliminar la tarea:', error);
    }
};

const toggleComplete = async (task) => {
    const original = task.completed;
    task.completed = !task.completed;
    try {
        await axios.put(`/tasks/${task.id}`, {
            completed: task.completed
        });
    } catch (error) {
        task.completed = original;
        console.error('Error al actualizar el estado de la tarea:', error);
    }
};

const fetchProjects = async () => {
    try {
        const response = await axios.get('/projects');
        projects.value = response.data.projects;
    } catch (error) {
        console.error('Error al obtener los proyectos:', error);
    }
};

const createTasks = async () => {
    try {
        await axios.post('/tasks', {
            project_id: selProjData.value.id,
            title: taskName.value,
            due_date: dueDate.value
        });
        await getListTaskData();
        clearInputs();
        Swal.fire({
            icon: "success",
            title: "La tarea se añadió correctamente al proyecto",
        });
    } catch (error) {
        console.error('Error al crear la tarea:', error);
    }
};

const editTask = items => {
    actions.value = false;
    taskId.value = items.id;
    taskName.value = items.title;
    dueDate.value = moment(items.due_date).format('YYYY-MM-DD');
};

const updateTask = async () => {
    try {
        await axios.put(`/tasks/${taskId.value}`, {
            title: taskName.value,
            due_date: dueDate.value
        });
        await getListTaskData();
        clearInputs();
        Swal.fire({
            icon: "success",
            title: "La tarea se actualizo correctamente",
        });
    } catch (error) {
        console.error('Error al actualizar la tarea:', error);
    }
};

const showPane = items => {
    selProjData.value = items;
    showTaskPane.value = !showTaskPane.value;
    getListTaskData()
}

const getListTaskData = async () => {
    try {
        const response = await axios.get(`/tasks/${selProjData.value.id}`);
        taskData.value = response.data.tasks
    } catch (error) {
        console.error('Error al obtener las tareas del proyecto:', error);
    }
}

const clearInputs = () => {
    actions.value = true;
    taskName.value = null;
    dueDate.value = null;
}

onMounted(fetchProjects);
</script>

<template>

    <Head title="AdminTareas" />

    <AuthenticatedLayout>
        <template #header>
            <div v-if="showTaskPane">
                <h4 class="text-center text-base/7 font-semibold text-gray-900 mb-10">
                    En este apartado puedes crear, editar y eliminar las tareas que tengas asociadas a un proyecto.
                </h4>

                <table class="min-w-full rounded-lg overflow-hidden shadow-lg bg-white">
                    <thead class="bg-indigo-600">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Id
                            </th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">
                                Usuario</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">
                                Nombre del proyecto</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">
                                Descripción</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">
                                Estatus</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">
                                Administrar tareas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="items in projects" :key="items.id"
                            class="hover:bg-indigo-50 dark:hover:bg-gray-100 transition">
                            <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-900 bg-white">{{ items.id }}
                            </td>
                            <td class="px-4 py-3 flex justify-center items-center bg-white">
                                <img class="size-10 rounded-full ring-2 ring-white shadow mx-auto"
                                    src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80"
                                    alt="">
                            </td>
                            <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-900 bg-white">{{ items.name }}
                            </td>
                            <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-900 bg-white">{{
                                items.description }}</td>
                            <td class="px-4 py-3 text-center bg-white">
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-700">
                                    {{ items.status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center bg-white">
                                <button @click="showPane(items)"
                                    class="text-green-600 hover:underline text-lg">🔎</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else>
                <div class="flex items-center justify-between mb-10">
                    <button @click="showTaskPane = true" type="button"
                        class="rounded-md bg-fuchsia-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-fuchsia-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-fuchsia-600">
                        Regresar
                    </button>
                    <h4 class="flex-1 text-center text-base/7 font-semibold text-gray-900 m-0">
                        Panel de tareas de {{ selProjData?.name }}
                    </h4>

                    <div style="width:90px"></div>
                </div>

                <div class="border-b border-gray-900/10 pb-12 mt-10">
                    <p class="mt-1 text-sm/6 text-gray-600">Agrega en los campos correspondientes la informacion para
                        crear
                        un nuevas tareas.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Titulo de
                                la tarea</label>
                            <div class="mt-2">
                                <input v-model="taskName" type="text" name="first-name" id="first-name"
                                    autocomplete="given-name"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="due-date">
                                Fecha límite
                            </label>
                            <div class="mt-2">
                                <input v-model="dueDate" type="date" id="due-date" name="due-date"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button @click="clearInputs()" type="button" class="text-sm/6 font-semibold text-gray-900">{{ actions ? 'Cancelar' : 'Regresar' }}</button>
                        <button @click="actions ? createTasks() : updateTask()" type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ actions ? 'Agregar' : 'Actualizar' }}</button>
                    </div>
                </div>

                <ul role="list" class="divide-y divide-gray-100">
                    <li v-for="items in taskData" :key="items.id" class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold text-gray-900">
                                    Tarea: {{ items.title }}
                                </p>
                                <p class="text-sm text-gray-900">
                                    Estatus: <span class="text-yellow-600">{{ items.completed ? 'Completada' :
                                        'Pendiente' }}</span>
                                </p>
                                <p class="text-sm text-gray-900 mb-1">Fecha: {{ items.due_date }}</p>
                                <!-- Botón Gestionar tarea -->
                                <div class="relative">
                                    <button type="button" @click="toggleMenu(items.id)"
                                        class="inline-flex items-center gap-x-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md px-3 py-1.5 shadow-sm hover:bg-gray-50">
                                        Gestionar tarea
                                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M5.23 7.21a.75.75 0 011.06 0L10 10.92l3.72-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <!-- Menú desplegable -->
                                    <div v-if="openMenuId === items.id"
                                        class="absolute z-20 mt-2 w-40 rounded-md bg-white shadow-lg ring-1 ring-black/5">
                                        <div class="p-2 flex flex-col gap-1">
                                            <button
                                                class="w-full text-left text-sm px-3 py-1.5 rounded hover:bg-gray-100"
                                                @click="editTask(items)">
                                                Editar
                                            </button>
                                            <button
                                                class="w-full text-left text-sm px-3 py-1.5 rounded hover:bg-gray-100 text-red-600"
                                                @click="deleteTask(items.id)">
                                                Eliminar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="relative flex items-center gap-4">
                            <!-- Toggle -->
                            <label class="block text-sm/6 font-medium text-gray-900">Completar tarea</label>
                            <button :class="[
                                'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2',
                                items.completed ? 'bg-indigo-600' : 'bg-gray-300'
                            ]" role="switch" :aria-checked="items.completed" @click="toggleComplete(items)">
                                <span :class="[
                                    'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200 ease-in-out',
                                    items.completed ? 'translate-x-5' : 'translate-x-0'
                                ]" />
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

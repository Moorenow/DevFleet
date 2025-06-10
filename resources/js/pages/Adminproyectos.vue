<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Swal from 'sweetalert2'
import axios from 'axios';
import { ref, onMounted } from 'vue';

const props = defineProps({
    auth: Object,
})

const projectId = ref(null),
    name = ref(null),
    description = ref(null),
    status = ref(null),
    projects = ref([]),
    taskData = ref([]),
    showModal = ref(false),
    actions = ref(true);

const fetchProjects = async () => {
    try {
        const response = await axios.get('/projects');
        projects.value = response.data.projects;
    } catch (error) {
        console.error('Error al obtener los proyectos:', error);
    }
};

const createProject = async () => {
    try {
        await axios.post('/projects', {
            user_id: props.auth.user.id,
            name: name.value,
            description: description.value
        });
        await fetchProjects();
        await clearInputs();
        Swal.fire({
            icon: "success",
            title: "El nuevo proyecto ha sido creado satisfactoriamente",
        });
    } catch (error) {
        console.error('Error al crear el proyecto:', error);
    }
};

const editProject = async items => {
    actions.value = false;
    projectId.value = items.id;
    name.value = items.name;
    description.value = items.description;
    status.value = items.status;
};

const clearInputs = async () => {
    actions.value = true;
    name.value = null;
    description.value = null;
    status.value = null;
};

const getListTaskData = async id => {
    try {
        const response = await axios.get(`/tasks/${id}`);
        taskData.value = response.data.tasks
        showModal.value = true
    } catch (error) {
        Swal.fire({
            icon: "info",
            title: "Este proyecto no cuenta con tareas",
        });
        console.error('Error al obtener las tareas del proyecto', error);
    }
}

const updateProject = async () => {
    try {
        await axios.put(`/projects/${projectId.value}`, {
            name: name.value,
            description: description.value,
            status: status.value
        });
        await fetchProjects();
        await clearInputs();
        Swal.fire({
            icon: "success",
            title: "El proyecto ha sido actualizado",
        });
    } catch (error) {
        console.error('Error al editar el proyecto:', error);
    }
};

const deleteProject = async id => {
    try {
        await axios.delete(`/projects/${id}`);
        await fetchProjects();
        Swal.fire({
            icon: "success",
            title: "El proyecto ha sido eliminado",
        });
    } catch (error) {
        console.error('Error al eliminar el proyecto:', error);
    }
};

onMounted(fetchProjects);
</script>

<template>

    <Head title="AdminProyectos" />

    <AuthenticatedLayout>
        <template #header>
            <h4 class="text-center text-base/7 font-semibold text-gray-900 mb-5">
                En este apartado crea, edita y elimina proyectos.
            </h4>
            <div class="border-b border-gray-900/10 pb-12">
                <p class="mt-1 text-sm/6 text-gray-600">Agrega en los campos correspondientes la informacion para crear o editar
                    un nuevo proyecto.</p>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="nameProj" class="block text-sm/6 font-medium text-gray-900">Nombre del
                            proyecto</label>
                        <div class="mt-2">
                            <input v-model="name" type="text" name="nameProj"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="descrip" class="block text-sm/6 font-medium text-gray-900">Descripción</label>
                        <div class="mt-2">
                            <input v-model="description" type="text" name="descrip"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="status" class="block text-sm/6 font-medium text-gray-900">Estatus</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select v-model="status" name="status"
                                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option value="pending">Pendiente</option>
                                <option value="active">Activo</option>
                                <option value="finished">Finalizado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button @click="clearInputs()" type="button" class="text-sm/6 font-semibold text-gray-900">{{ actions ? 'Cancelar' : 'Regresar' }}</button>
                    <button @click="actions ? createProject() : updateProject()" type="button"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ actions ? 'Agregar' : 'Actualizar' }}</button>
                </div>
            </div>

            <h5 class="mt-4 mb-2">
                En esta tabla puedes ver, editar y eliminar los proyectos existentes.
            </h5>

            <table class="min-w-full rounded-lg overflow-hidden shadow-lg bg-white">
                <thead class="bg-indigo-600">
                    <tr>
                        <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Id</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Usuario
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Nombre
                            del proyecto</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">
                            Descripción</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Estatus
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Tareas
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Editar
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Eliminar
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="items in projects" :key="items.id"
                        class="hover:bg-indigo-50 dark:hover:bg-gray-100 transition">
                        <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-900 bg-white">{{ items.id }}</td>
                        <td class="px-4 py-3 flex justify-center items-center bg-white">
                            <img class="size-10 rounded-full ring-2 ring-white shadow mx-auto"
                                src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80"
                                alt="">
                        </td>
                        <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-900 bg-white">{{ items.name }}
                        </td>
                        <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-900 bg-white">{{ items.description
                        }}</td>
                        <td class="px-4 py-3 text-center bg-white">
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-700">
                                {{ items.status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center bg-white">
                            <button @click="getListTaskData(items.id)"
                                class="text-green-600 hover:underline text-lg">👁️</button>
                        </td>
                        <td class="px-4 py-3 text-center bg-white">
                            <button @click="editProject(items)"
                                class="text-indigo-600 hover:underline text-lg">✏️</button>
                        </td>
                        <td class="px-4 py-3 text-center bg-white">
                            <button @click="deleteProject(items.id)"
                                class="text-red-600 hover:underline text-lg">❌</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-if="showModal" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div
                            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Tareas del
                                            proyecto</h3>
                                        <div class="mt-2">
                                            <ul class="list-disc pl-5">
                                                <li v-for="items in taskData" :key="items.id">{{ items.title }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button @click="showModal = false"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                    Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

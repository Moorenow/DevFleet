<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const showModal = ref(false)
</script>

<template>

    <Head title="DetallesProyectos" />

    <AuthenticatedLayout>
        <template #header>
            <h4 class="text-center mb-10">
                En este apartado puedes visualizar los proyectos con sus respectivas tareas.
            </h4>

            <table
                class="w-full table-auto border-separate border-spacing-2 border border-gray-400 dark:border-gray-500">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600">Id</th>
                        <th class="border border-gray-300 dark:border-gray-600">Nombre del proyecto</th>
                        <th class="border border-gray-300 dark:border-gray-600">Descripcion</th>
                        <th class="border border-gray-300 dark:border-gray-600">Estatus</th>
                        <th class="border border-gray-300 dark:border-gray-600">Tareas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 dark:border-gray-700">1</td>
                        <td class="border border-gray-300 dark:border-gray-700">Proyecto A</td>
                        <td class="border border-gray-300 dark:border-gray-700">Suite comercial</td>
                        <td class="border border-gray-300 dark:border-gray-700 text-center">
                            <bold class="text-green-600">Pendiente</bold>
                        </td>
                        <td class="border border-gray-300 dark:border-gray-700 text-center">
                            <button @click="showModal = true" class="text-green-600 hover:underline">👁️</button>
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
                                                <li>Diseñar la interfaz del usuario con Vue 3 y Vuetify</li>
                                                <li>Implementar la navegación con Vue Router y proteger rutas con guards
                                                </li>
                                                <li>Desarrollar componentes reutilizables para formularios y tablas</li>
                                                <li>Conectar el frontend con la API de Laravel usando Axios</li>
                                                <li>Validar formularios en el frontend y backend</li>
                                                <li>Crear endpoints en Laravel para gestión de usuarios y tareas</li>
                                                <li>Aplicar middlewares de autenticación y autorización en Laravel</li>
                                                <li>Configurar base de datos y relaciones Eloquent (por ejemplo,
                                                    proyectos y tareas)</li>
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

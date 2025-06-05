<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const isMenuOpen = ref(false);
const enabled = ref(false)

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value;
}
</script>

<template>

    <Head title="AdminTareas" />

    <AuthenticatedLayout>
        <template #header>
            <h4 class="text-center mb-10">
                En este apartado puedes crear, editar y eliminar las tareas que tengas asociadas a un proyecto.
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
                            <button @click="showModal = true" class="text-green-600 hover:underline">🔎</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="border-b border-gray-900/10 pb-12 mt-10">
                <h2 class="text-base/7 font-semibold text-gray-900">Creacion de tareas</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Agrega en los campos correspondientes la informacion para crear
                    un nuevas tareas.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Titulo de
                            la tarea</label>
                        <div class="mt-2">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="due-date">
                            Fecha límite
                        </label>
                        <div class="mt-2">

                            <input type="date" id="due-date" name="due-date"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancelar</button>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
                </div>
            </div>

            <ul role="list" class="divide-y divide-gray-100">
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold text-gray-900">
                                Tarea: Diseñar la interfaz del usuario con Vue 3 y Vuetify
                            </p>
                            <p class="text-sm text-gray-900">
                                Estatus: <span class="text-yellow-600">Pendiente</span>
                            </p>
                            <p class="text-sm text-gray-900 mb-1">Fecha: 05-06-2025</p>
                            <!-- Botón Gestionar tarea -->
                            <div class="relative">
                                <button type="button" @click="toggleMenu"
                                    class="inline-flex items-center gap-x-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md px-3 py-1.5 shadow-sm hover:bg-gray-50">
                                    Gestionar tarea
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06 0L10 10.92l3.72-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Menú desplegable -->
                                <div v-if="isMenuOpen"
                                    class="absolute  z-20 mt-2 w-40 rounded-md bg-white shadow-lg ring-1 ring-black/5">
                                    <div class="p-2 flex flex-col gap-1">
                                        <button class="w-full text-left text-sm px-3 py-1.5 rounded hover:bg-gray-100">
                                            Editar
                                        </button>
                                        <button
                                            class="w-full text-left text-sm px-3 py-1.5 rounded hover:bg-gray-100 text-red-600">
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
                            enabled ? 'bg-indigo-600' : 'bg-gray-300'
                        ]" role="switch" :aria-checked="enabled.toString()" @click="enabled = !enabled">
                            <span :class="[
                                'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200 ease-in-out',
                                enabled ? 'translate-x-5' : 'translate-x-0'
                            ]" />
                        </button>
                    </div>
                </li>
            </ul>
        </template>
    </AuthenticatedLayout>
</template>

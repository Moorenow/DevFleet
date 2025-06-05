<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="AdminProyectos" />

    <AuthenticatedLayout>
        <template #header>
            <h4 class="text-center mb-10">
                En este apartado crea, edita y elimina proyectos.
            </h4>

            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Creacion del proyecto</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Agrega en los campos correspondientes la informacion para crear
                    un nuevo proyecto.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Nombre del
                            proyecto</label>
                        <div class="mt-2">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Descripcion</label>
                        <div class="mt-2">
                            <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancelar</button>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
                </div>
            </div>

            <h5 class="mt-4">
                En esta tabla puedes editar y eliminar los proyectos existentes.
            </h5>

            <table
                class="w-full table-auto border-separate border-spacing-2 border border-gray-400 dark:border-gray-500">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600">Id</th>
                        <th class="border border-gray-300 dark:border-gray-600">Nombre del proyecto</th>
                        <th class="border border-gray-300 dark:border-gray-600">Descripcion</th>
                        <th class="border border-gray-300 dark:border-gray-600">Editar</th>
                        <th class="border border-gray-300 dark:border-gray-600">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 dark:border-gray-700">1</td>
                        <td class="border border-gray-300 dark:border-gray-700">Proyecto A</td>
                        <td class="border border-gray-300 dark:border-gray-700">Suite comercial</td>
                        <td class="border border-gray-300 dark:border-gray-700 text-center">
                            <button class="text-green-600 hover:underline">✏️</button>
                        </td>
                        <td class="border border-gray-300 dark:border-gray-700 text-center">
                            <button class="text-red-600 hover:underline">❌</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
    </AuthenticatedLayout>
</template>

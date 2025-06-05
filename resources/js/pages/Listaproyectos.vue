<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="listaProyectos" />

    <AuthenticatedLayout>
        <template #header>
            <h4 class="text-center mb-10">
                Lista de proyectos.
            </h4>

            <div class="mb-4">
                <img class="justify-self-center size-10 rounded-full ring-2 ring-white"
                    src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80"
                    alt="">
                <p class="text-sm text-gray-600">Jesus Emmanuel Lopez Ortiz</p>
            </div>
            <table
                class="w-full table-auto border-separate border-spacing-2 border border-gray-400 dark:border-gray-500">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600">Id</th>
                        <th class="border border-gray-300 dark:border-gray-600">Nombre del proyecto</th>
                        <th class="border border-gray-300 dark:border-gray-600">Descripcion</th>
                        <th class="border border-gray-300 dark:border-gray-600">Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 dark:border-gray-700">1</td>
                        <td class="border border-gray-300 dark:border-gray-700">Proyecto A</td>
                        <td class="border border-gray-300 dark:border-gray-700">Suite comercial</td>
                        <td class="border border-gray-300 dark:border-gray-700 text-center"><bold class="text-green-600">Pendiente</bold></td>
                    </tr>
                </tbody>
            </table>
        </template>
    </AuthenticatedLayout>
</template>

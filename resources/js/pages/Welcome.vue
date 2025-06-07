<script setup>
import { onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

onMounted(() => {
    if (!document.querySelector('script[src*="spline-viewer"]')) {
        const script = document.createElement('script');
        script.type = 'module';
        script.src = 'https://unpkg.com/@splinetool/viewer@1.10.2/build/spline-viewer.js';
        document.body.appendChild(script);
    }
});
</script>

<template>

    <Head title="Welcome" />

    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen w-full overflow-hidden">
            <spline-viewer url="https://prod.spline.design/L9S3PGoLfEwLpSmB/scene.splinecode"
                class="absolute inset-0 z-0"></spline-viewer>

            <div class="relative flex min-h-screen flex-col items-center justify-center selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end space-x-4 z-10 relative">
                            <Link
                                v-if="$page.props.auth.user"
                                :href="route('adminproyectos')"
                                class="text-xl rounded-md px-3 py-2 bg-gray-200 text-gray-800 ring-1 ring-transparent transition hover:bg-gray-300 hover:text-black focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Volver a DevFleet
                            </Link>

                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="text-xl rounded-md px-3 py-2 bg-gray-200 text-gray-800 ring-1 ring-transparent transition hover:bg-gray-300 hover:text-black focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Iniciar sesión
                                </Link>

                                <Link
                                    v-if="canRegister"
                                    :href="route('register')"
                                    class="text-xl rounded-md px-3 py-2 bg-gray-200 text-gray-800 ring-1 ring-transparent transition hover:bg-gray-300 hover:text-black focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Registrarse
                                </Link>
                            </template>
                        </nav>
                    </header>

                    <footer class="py-16 text-center text-xl text-black dark:text-white/70">
                        DevFleet 1.0.0
                    </footer>
                </div>
            </div>
        </div>
    </div>
</template>

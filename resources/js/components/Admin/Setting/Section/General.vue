<template>
    <div>
        <div>
            <div v-if="form.errors.length >= 1" class="mt-10 rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <!-- Heroicon name: x-circle -->
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm leading-5 font-medium text-red-800">
                            There were {{ form.errors.length }} error(s) with your submission
                        </h3>
                        <div class="mt-2 text-sm leading-5 text-red-700">
                            <ul class="list-disc pl-5">
                                <li v-for="error in form.errors" :key="error">
                                    {{ error.message }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 divide-y divide-gray-200">
                <div class="space-y-1 grid grid-cols-2">
                    <div class="align-middle">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            General
                        </h3>
                        <p class="max-w-2xl text-sm text-gray-500">
                            General settings.
                        </p>
                    </div>
                    <div class="px-4 text-right sm:px-6">

                        <!-- color:#f7630c -->
                        <div :class="loading ? 'visible' : 'invisible'" class="inline-flex items-center align-middle px-4 text-base text-pink-600 leading-6 font-medium rounded-md cursor-default" disabled="">
                            <svg class="flex-1 -ml-1 h-8 w-8 self-center" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                <defs><clipPath id="ldio-gg8f7d2322w-cp"><rect x="20" y="0" width="60" height="100"></rect></clipPath></defs>
                                <path fill="none" stroke="#e90c59" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" clip-path="url(#ldio-gg8f7d2322w-cp)" d="M90,76.7V28.3c0-2.7-2.2-5-5-5h-3.4c-2.7,0-5,2.2-5,5v43.4c0,2.7-2.2,5-5,5h-3.4c-2.7,0-5-2.2-5-5V28.3c0-2.7-2.2-5-5-5H55 c-2.7,0-5,2.2-5,5v43.4c0,2.7-2.2,5-5,5h-3.4c-2.7,0-5-2.2-5-5V28.3c0-2.7-2.2-5-5-5h-3.4c-2.7,0-5,2.2-5,5v43.4c0,2.7-2.2,5-5,5H15 c-2.7,0-5-2.2-5-5V23.3">
                                <animateTransform attributeName="transform" type="translate" repeatCount="indefinite" dur="0.7s" values="-20 0;7 0" keyTimes="0;1"></animateTransform>
                                <animate attributeName="stroke-dasharray" repeatCount="indefinite" dur="0.7s" values="0 72 125 232;0 197 125 233" keyTimes="0;1"></animate>
                                </path>
                            </svg>
                            <span class="animate-pulse self-center">Loading</span>
                        </div>

                        <!-- <button @click="doSave" type="button" class="px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">
                            Save
                        </button> -->
                    </div>
                </div>

                <div class="mt-6">
                    <dl class="divide-y divide-gray-200">
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                            <dt class="text-sm font-medium text-gray-500">
                                Dark Mode
                            </dt>
                            <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">


                                <!-- On: "bg-purple-600", Off: "bg-gray-200" -->
                                <!-- <button @click="$root.$data.darkMode = !Boolean($root.$data.darkMode)" :class="Boolean($root.$data.darkMode) ? 'bg-purple-600' : 'bg-gray-200'" type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 "> -->
                                    <!-- <span class="sr-only">Enabled</span> -->
                                    <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                    <!-- <span :class="Boolean($root.$data.darkMode) ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span> -->
                                <!-- </button> -->

                                <div class="flex items-center space-x-4 sm:ml-auto">
                                    <svg class="text-yellow-400" width="32" height="32" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2a1.4 1.4 0 011.4 1.4v1.4a1.4 1.4 0 11-2.8 0V3.4A1.4 1.4 0 0116 2zM6.1 6.1a1.4 1.4 0 011.98 0l.99.99a1.4 1.4 0 11-1.98 1.98l-.99-.99a1.4 1.4 0 010-1.98zm19.8 0a1.4 1.4 0 010 1.98l-.99.99a1.4 1.4 0 01-1.98-1.98l.99-.99a1.4 1.4 0 011.98 0zM9 16a7 7 0 1114 0 7 7 0 01-14 0zm-7 0a1.4 1.4 0 011.4-1.4h1.4a1.4 1.4 0 110 2.8H3.4A1.4 1.4 0 012 16zm23.8 0a1.4 1.4 0 011.4-1.4h1.4a1.4 1.4 0 110 2.8h-1.4a1.4 1.4 0 01-1.4-1.4zm-2.87 6.93a1.4 1.4 0 011.98 0l.99.99a1.4 1.4 0 01-1.98 1.98l-.99-.99a1.4 1.4 0 010-1.98zm-15.84 0a1.4 1.4 0 011.98 1.98l-.99.99a1.4 1.4 0 01-1.98-1.98l.99-.99zM16 25.8a1.4 1.4 0 011.4 1.4v1.4a1.4 1.4 0 11-2.8 0v-1.4a1.4 1.4 0 011.4-1.4z" fill="url(#paint0_linear)"></path>
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="2" y1="2" x2="30" y2="30" gradientUnits="userSpaceOnUse">
                                                <stop class="transition-all duration-200" stop-color="#FACC15"></stop>
                                                <stop class="transition-all duration-200" offset="1" stop-color="#FACC15"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>

                                    <!-- On: "bg-purple-600", Off: "bg-gray-200" -->
                                    <button @click="$root.$data.darkMode = !Boolean($root.$data.darkMode)" :class="Boolean($root.$data.darkMode) ? 'bg-purple-600' : 'bg-gray-200'" type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                        <span :class="Boolean($root.$data.darkMode) ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                    </button>

                                    <svg width="24" height="24" fill="currentColor" class="text-gray-300">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.353 2.939a1 1 0 01.22 1.08 8 8 0 0010.408 10.408 1 1 0 011.301 1.3A10.003 10.003 0 0112 22C6.477 22 2 17.523 2 12c0-4.207 2.598-7.805 6.273-9.282a1 1 0 011.08.22z"></path>
                                    </svg>
                                </div>

                            </dd>
                        </div>
                    </dl>
                </div>

            </div>
        </div>
        <section-license></section-license>
    </div>
</template>

<script>
import SectionLicense from "./License";

export default {
    components: {
        SectionLicense,
    },
    data() {
        return {
            form: {
                errors: []
            },
            busy: false,
            loading: false,
        }
    },
    watch: {
        busy(after, before) {
            this.loading = after;
        },
    },
}
</script>

<style>

</style>

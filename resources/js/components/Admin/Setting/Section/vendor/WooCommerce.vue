<template>
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
                        WooCommerce
                    </h3>
                    <p class="max-w-2xl text-sm text-gray-500">
                        Asura integration with WooCommerce.
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

                    <button @click="doSave" type="button" class="px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">
                        Save
                    </button>
                </div>
            </div>

            <div class="mt-6">
                <dl class="divide-y divide-gray-200">

                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt class="text-sm font-medium text-gray-500">
                            Enable Integration
                        </dt>
                        <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <!-- On: "bg-purple-600", Off: "bg-gray-200" -->
                            <button @click="settings.enabled = !Boolean(settings.enabled)" :class="Boolean(settings.enabled) ? 'bg-purple-600' : 'bg-gray-200'" type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-auto">
                                <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                <span :class="Boolean(settings.enabled) ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                            </button>
                        </dd>
                    </div>

                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt class="text-sm font-medium text-gray-500">
                            Print license' table on Payment
                        </dt>
                        <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <!-- On: "bg-purple-600", Off: "bg-gray-200" -->
                            <button @click="settings.print_table = !Boolean(settings.print_table)" :class="Boolean(settings.print_table) ? 'bg-purple-600' : 'bg-gray-200'" type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-auto">
                                <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                <span :class="Boolean(settings.print_table) ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                            </button>
                        </dd>
                    </div>

                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt class="text-sm font-medium text-gray-500">
                            Print license on receipt email
                        </dt>
                        <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <!-- On: "bg-purple-600", Off: "bg-gray-200" -->
                            <button @click="settings.send_email = !Boolean(settings.send_email)" :class="Boolean(settings.send_email) ? 'bg-purple-600' : 'bg-gray-200'" type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-auto">
                                <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                <span :class="Boolean(settings.send_email) ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                            </button>
                        </dd>
                    </div>


                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt class="font-medium text-gray-900">
                            Payment Status
                        </dt>
                    </div>

                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt></dt>
                        <dd class="flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="flex-grow  align-middle">
                                Onhold
                            </span>
                            <span class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                <select v-model="settings.payment_status.onhold" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                    <option v-for="payment_action in form.payment_actions" :key="payment_action.value" class="capitalize" :value="payment_action.value"> {{ payment_action.value }} </option>
                                </select>
                            </span>
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt></dt>
                        <dd class="flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="flex-grow  align-middle">
                                Failed
                            </span>
                            <span class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                <select v-model="settings.payment_status.failed" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                    <option v-for="payment_action in form.payment_actions" :key="payment_action.value" class="capitalize" :value="payment_action.value"> {{ payment_action.value }} </option>
                                </select>
                            </span>
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt></dt>
                        <dd class="flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="flex-grow  align-middle">
                                Pending
                            </span>
                            <span class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                <select v-model="settings.payment_status.pending" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                    <option v-for="payment_action in form.payment_actions" :key="payment_action.value" class="capitalize" :value="payment_action.value"> {{ payment_action.value }} </option>
                                </select>
                            </span>
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt></dt>
                        <dd class="flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="flex-grow  align-middle">
                                Processing
                            </span>
                            <span class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                <select v-model="settings.payment_status.processing" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                    <option v-for="payment_action in form.payment_actions" :key="payment_action.value" class="capitalize" :value="payment_action.value"> {{ payment_action.value }} </option>
                                </select>
                            </span>
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt></dt>
                        <dd class="flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="flex-grow  align-middle">
                                Refunded
                            </span>
                            <span class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                <select v-model="settings.payment_status.refunded" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                    <option v-for="payment_action in form.payment_actions" :key="payment_action.value" class="capitalize" :value="payment_action.value"> {{ payment_action.value }} </option>
                                </select>
                            </span>
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt></dt>
                        <dd class="flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="flex-grow  align-middle">
                                Cancelled
                            </span>
                            <span class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                <select v-model="settings.payment_status.cancelled" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                    <option v-for="payment_action in form.payment_actions" :key="payment_action.value" class="capitalize" :value="payment_action.value"> {{ payment_action.value }} </option>
                                </select>
                            </span>
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt></dt>
                        <dd class="flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="flex-grow  align-middle">
                                Expired
                            </span>
                            <span class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                <select v-model="settings.payment_status.expired" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                    <option v-for="payment_action in form.payment_actions" :key="payment_action.value" class="capitalize" :value="payment_action.value"> {{ payment_action.value }} </option>
                                </select>
                            </span>
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                        <dt></dt>
                        <dd class="flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="flex-grow  align-middle">
                                Pending Cancel
                            </span>
                            <span class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                <select v-model="settings.payment_status.pendingcancel" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                    <option v-for="payment_action in form.payment_actions" :key="payment_action.value" class="capitalize" :value="payment_action.value"> {{ payment_action.value }} </option>
                                </select>
                            </span>
                        </dd>
                    </div>

                </dl>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                payment_actions: [
                    {value: null},
                    {value: 'deactivate'},
                    {value: 'revoke'},
                ],
                errors: []
            },
            settings: {
                enabled: false,
                visible: false,
                print_table: false,
                send_email: false,
                payment_status: {
                    onhold: null,
                    failed: null,
                    pending: null,
                    processing: null,
                    refunded: null,
                    cancelled: null,
                    expired: null,
                    pendingcancel: null,
                }
            },
            busy: false,
            loading: false,
        }
    },
    mounted() {
        this.loadSetting();
    },
    watch: {
        busy(after, before) {
            this.loading = after;
        },
    },
    methods: {
        loadSetting() {
            if (!this.busy) {
                this.busy = true;

                axios.get(route('admin.settings.section.vendor.woocommerce.index'), {})
                .then(response => {
                    response.data;
                    this.settings = response.data;
                })
                .catch(error => {
                    Vue.toasted.show('Failed to load Settings [WooCommerce]', {
                        type : 'error',
                        iconPack: 'callback',
                        icon: (el) => {
                            el.innerHTML = '<svg viewBox="0 0 24 24" height="18" width="18"><g transform="matrix(1,0,0,1,0,0)"><path d="M11.983,0C8.777,0.052,5.72,1.365,3.473,3.653C1.202,5.914-0.052,9.002,0,12.207C-0.008,18.712,5.26,23.992,11.765,24 c0.012,0,0.023,0,0.035,0h0.214c6.678-0.069,12.04-5.531,11.986-12.209l0,0c0.015-6.498-5.24-11.778-11.738-11.794 C12.169-0.003,12.076-0.002,11.983,0z M10.5,16.542c-0.03-0.815,0.606-1.499,1.421-1.529c0.009,0,0.019-0.001,0.028-0.001h0.027 c0.82,0.002,1.492,0.651,1.523,1.47c0.03,0.814-0.605,1.499-1.419,1.529c-0.01,0-0.02,0.001-0.03,0.001h-0.027 C11.203,18.009,10.532,17.361,10.5,16.542z M11,12.5v-6c0-0.552,0.448-1,1-1s1,0.448,1,1v6c0,0.552-0.448,1-1,1S11,13.052,11,12.5z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';
                            return el;
                        },
                    });
                })
                .then(() => {
                    this.busy = false;
                });
            }
        },
        doSave() {
            if (!this.busy) {
                this.busy = true;
                this.form.errors = [];

                axios.put(route('admin.settings.section.vendor.woocommerce.update'), {
                    settings: this.settings,
                })
                .then(response => {
                    Vue.toasted.show('Settings [WooCommerce] saved successfully.', {
                        type : 'success',
                        iconPack: 'callback',
                        icon: (el) => {
                            el.innerHTML = '<svg viewBox="0 0 24 24" height="12" width="12"><g transform="matrix(1,0,0,1,0,0)"><path d="M23.146,5.4l-2.792-2.8c-0.195-0.196-0.512-0.196-0.707-0.001c0,0-0.001,0.001-0.001,0.001L7.854,14.4 c-0.195,0.196-0.512,0.196-0.707,0.001c0,0-0.001-0.001-0.001-0.001l-2.792-2.8c-0.195-0.196-0.512-0.196-0.707-0.001 c0,0-0.001,0.001-0.001,0.001l-2.792,2.8c-0.195,0.195-0.195,0.512,0,0.707L7.146,21.4c0.195,0.196,0.512,0.196,0.707,0.001 c0,0,0.001-0.001,0.001-0.001L23.146,6.1C23.337,5.906,23.337,5.594,23.146,5.4z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';
                            return el;
                        },
                        onComplete: () => {}
                    });
                })
                .catch(error => {
                    Vue.toasted.show('Failed to save Settings [WooCommerce]', {
                        type : 'error',
                        iconPack: 'callback',
                        icon: (el) => {
                            el.innerHTML = '<svg viewBox="0 0 24 24" height="18" width="18"><g transform="matrix(1,0,0,1,0,0)"><path d="M11.983,0C8.777,0.052,5.72,1.365,3.473,3.653C1.202,5.914-0.052,9.002,0,12.207C-0.008,18.712,5.26,23.992,11.765,24 c0.012,0,0.023,0,0.035,0h0.214c6.678-0.069,12.04-5.531,11.986-12.209l0,0c0.015-6.498-5.24-11.778-11.738-11.794 C12.169-0.003,12.076-0.002,11.983,0z M10.5,16.542c-0.03-0.815,0.606-1.499,1.421-1.529c0.009,0,0.019-0.001,0.028-0.001h0.027 c0.82,0.002,1.492,0.651,1.523,1.47c0.03,0.814-0.605,1.499-1.419,1.529c-0.01,0-0.02,0.001-0.03,0.001h-0.027 C11.203,18.009,10.532,17.361,10.5,16.542z M11,12.5v-6c0-0.552,0.448-1,1-1s1,0.448,1,1v6c0,0.552-0.448,1-1,1S11,13.052,11,12.5z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';
                            return el;
                        },
                    });
                    
                    for (const prop in error.response.data) {
                        error.response.data[prop].forEach(element => {
                            this.form.errors.push({message: element});
                        });
                    }
                })
                .then(() => {
                    this.busy = false;
                    this.loadSetting();
            });
            }
        },
    }
}
</script>

<style>

</style>
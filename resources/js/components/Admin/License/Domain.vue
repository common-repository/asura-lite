<template>
	<div class="p-8 bg-gray-50">
		<div class="sm:mt-0">
			<div class="md:grid md:grid-cols-3 md:gap-6">
				<div class="md:col-span-1">
					<div class="px-4 sm:px-0">
						<h3 class="text-lg font-medium leading-6 text-gray-900">
							Domains of License #{{ initialLicense.id }}
						</h3>
						<p class="mt-1 text-sm leading-5 text-gray-600">
							Manage domain activation on a license.
						</p>
					</div>
				</div>
				<div class="mt-5 md:mt-0 md:col-span-2">
					<div class="shadow sm:rounded-md">
						<div v-if="form.errors.length >= 1" class="rounded-md bg-red-50 p-4">
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

						<div class="px-4 py-5 bg-white sm:p-6">
							<div class="grid grid-cols-6 gap-6">
								<div class="col-span-6 sm:col-span-6">
									<div class="space-y-1">
										<h3 class="text-lg leading-6 font-medium text-gray-900">
											Domains
										</h3>
										<p class="max-w-2xl text-sm text-gray-500">
											Manage which domain have authority to access the resource from this license.
											Make sure the domain inputed is complied with <a href="https://www.php.net/manual/en/function.parse-url.php">PHP's <code class="bg-gray-100 p-1 rounded">parse_url</code></a>
										</p>
									</div>
								</div>
								<div class="col-span-6 sm:col-span-6">
									<div class="divide-y divide-gray-200">
										<dl class="divide-y divide-gray-200">
											<div v-for="(domain, index) in form.domains" :key="domain.domain" class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
												<dt class="col-span-2 sm:col-span-2 text-sm font-medium text-gray-500">
													{{ domain.domain }}  <!-- thelostasura.com -->
												</dt>
												<dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-1">
													<span class="ml-4 flex-shrink-0 flex items-start space-x-4">
														<!-- On: "bg-purple-600", Off: "bg-gray-200" -->
														<button @click="domain.status = !Boolean(domain.status)" :class="Boolean(domain.status) ? 'bg-purple-600' : 'bg-gray-200'" type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-auto">
															<span class="sr-only">Enabled</span>
															<!-- On: "translate-x-5", Off: "translate-x-0" -->
															<span :class="Boolean(domain.status) ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
														</button>
														<span class="text-gray-300">|</span>
														<button @click="form.domains.splice(index, 1)" type="button" class="bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
															Remove
														</button>
													</span>
												</dd>
											</div>
										</dl>
									</div>
								</div>
								


								<div class="col-span-6 sm:col-span-6">
									<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
										<div class="col-span-2 sm:col-span-2 text-sm font-medium">
											<!-- thelostasura.com -->
											<input @keyup.enter="doAdd" type="text" v-model="form.domain" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm sm:leading-5 border-gray-300 rounded-md placeholder-gray-500 placeholder-opacity-50" placeholder="thelostasura.com">
										</div>
										<div class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-1">
											<span class="mt-3 ml-4 flex-shrink-0 flex items-start space-x-4">
												<!-- On: "bg-purple-600", Off: "bg-gray-200" -->
												<button @click="form.status = !Boolean(form.status)" :class="Boolean(form.status) ? 'bg-purple-600' : 'bg-gray-200'" type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-auto">
													<span class="sr-only">Enabled</span>
													<!-- On: "translate-x-5", Off: "translate-x-0" -->
													<span :class="Boolean(form.status) ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
												</button>
												<span class="text-gray-300">|</span>
												<button @click="doAdd" type="button" class="bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
													Add
												</button>
											</span>
										</div>
									</div>
								</div>
								

							</div>
						</div>

						<div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
							<button @click="$emit('cancel')" type="button" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-0 sm:ml-0">
								Cancel
							</button>
							<button @click="doSave" type="button" class="px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">
								Save
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ['initialLicense'],
	data() {
		return {
			form : {
				domain: '',
				status: 1,
				errors: [],
				domains: null,
			},
		}
	},
	methods: {
		doAdd() {
			if (this.initialLicense.max_activated !== null && this.form.domains.length >= this.initialLicense.max_activated) {
				this.form.errors = [];
				this.form.errors.push({message: 'Max Activation Reached'});
			} else if (this.form.domain !== '') {
				var index = this.form.domains.findIndex(x => x.domain === this.form.domain)
				if (index === -1) {
					this.form.domains.push({
						domain: this.form.domain,
						status: this.form.status,
					});
					this.form.errors = [];
				}

			}
		},
		doSave() {
			if (!this.$parent.busy) {
				this.$parent.busy = true;
				this.form.errors = [];

                axios.put(route('admin.api.licenses.domains.update', {license: this.initialLicense.id}), {
					domains: this.form.domains,
					remote: this.$parent.remote.selected.value
                })
                .then(response => {
                    Vue.toasted.show(`License\' domains updated successfully`, {
                        type : 'success',
                        iconPack: 'callback',
                        icon: (el) => {
                            el.innerHTML = '<svg viewBox="0 0 24 24" height="12" width="12"><g transform="matrix(1,0,0,1,0,0)"><path d="M23.146,5.4l-2.792-2.8c-0.195-0.196-0.512-0.196-0.707-0.001c0,0-0.001,0.001-0.001,0.001L7.854,14.4 c-0.195,0.196-0.512,0.196-0.707,0.001c0,0-0.001-0.001-0.001-0.001l-2.792-2.8c-0.195-0.196-0.512-0.196-0.707-0.001 c0,0-0.001,0.001-0.001,0.001l-2.792,2.8c-0.195,0.195-0.195,0.512,0,0.707L7.146,21.4c0.195,0.196,0.512,0.196,0.707,0.001 c0,0,0.001-0.001,0.001-0.001L23.146,6.1C23.337,5.906,23.337,5.594,23.146,5.4z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';
                            return el;
                        },
                        onComplete: () => {}
					});
					
					this.$parent.fetchData();
					this.$parent.showCreateForm = false;
                })
                .catch(error => {
                    Vue.toasted.show('Failed to update license\' domains', {
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
                    this.$parent.busy = false;
                });
            }
		},
	},
	mounted() {
	},
    created() {
		this.form.domains = this.initialLicense.domains.map((current) => ({
			domain: current.domain,
			status: current.status,
		}));
	},
};
</script>
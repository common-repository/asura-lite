<template>
	<div class="p-8 bg-gray-50">
		<div class="sm:mt-0">
			<div class="md:grid md:grid-cols-3 md:gap-6">
				<div class="md:col-span-1">
					<div class="px-4 sm:px-0">
						<h3 class="text-lg font-medium leading-6 text-gray-900">
							Create License
						</h3>
						<p class="mt-1 text-sm leading-5 text-gray-600">
							Create a new License to accessing the design sets 
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
								
								<div class="col-span-6 sm:col-span-3">
									<label for="key" class="block text-sm font-medium leading-5 text-gray-700">Key <span class="text-red-800">*</span></label>
									<div class="mt-1 relative rounded-md shadow-sm">
										<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
											<!-- Heroicon name: tag -->
											<svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
											</svg>
										</div>
										<input type="text" v-model="form.key" id="key" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm sm:leading-5 border-gray-300 rounded-md placeholder-gray-500 placeholder-opacity-50" placeholder="THE-L057-ASURA">
									</div>
								</div>

								<div class="col-span-6 sm:col-span-3">
									<label for="user" class="block text-sm font-medium leading-5 text-gray-700">User <span class="text-red-800">*</span></label>
									<treeselect
										id="user"
										:multiple="false"
										:async="true"
										:cacheOptions="false"
										:load-options="searchUsers"
										v-model="form.user"
										class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm sm:leading-5 border-gray-300 rounded-md"
									/>
								</div>
								
								<div class="col-span-6 sm:col-span-2">
									<label for="status" class="block text-sm font-medium leading-5 text-gray-700">Status <span class="text-red-800">*</span></label>
									<select v-model="form.status" id="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue focus:border-blue-300 sm:text-sm sm:leading-5">
										<option value="1">✔️ Enabled</option>
										<option value="0">❌ Disabled</option>
									</select>
								</div>

								<div class="col-span-6 sm:col-span-2">
									<label for="max_activated" class="flex text-sm font-medium leading-5 text-gray-700" title="Leave blank for unlimited activation">
										<span>Max Activation</span>				
										<!-- Heroicon name: question-mark-circle -->
										<svg class="ml-1 flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
											<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
										</svg>
									</label>
									<div class="mt-1 relative rounded-md shadow-sm">
										<input type="number" v-model="form.max_activated" id="max_activated" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm sm:leading-5 border-gray-300 rounded-md placeholder-gray-500 placeholder-opacity-50" placeholder="">
									</div>
								</div>
								
								<div class="col-span-6 sm:col-span-2">
									<label for="expire_at" class="flex text-sm font-medium leading-5 text-gray-700" title="Leave blank if the license key does not expire.">
										<span>Expire at</span>
										<!-- Heroicon name: question-mark-circle -->
										<svg class="ml-1 flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
											<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
										</svg>
									</label>
									<div class="mt-1 relative rounded-md shadow-sm">
										<input type="date" v-model="form.expire_at" id="expire_at" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm sm:leading-5 border-gray-300 rounded-md placeholder-gray-500 placeholder-opacity-50" placeholder="30">
									</div>
								</div>

								<div class="col-span-6">
									<label for="terms" class="block text-sm font-medium leading-5 text-gray-700">Terms</label>
									<treeselect
										id="terms"
										:multiple="true"
										:options="terms"
										:load-options="getAvailableTerms"
										v-model="form.terms"
										class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md block w-full sm:text-sm sm:leading-5"
									>
										<label slot="option-label" slot-scope="{ node }" >
											<div class="flex m-1">
												<div class="flex-none w-16 text-center text-black bg-gray-100">
													<strong>{{ node.raw.slug }}</strong>
												</div>
												<div class="flex-1 px-2 text-left tracking-wide">
													{{ node.raw.name }}
												</div>
											</div>
										</label>
										<div slot="value-label" slot-scope="{ node }" class="whitespace-normal">
											<div class="flex">
												<div class="flex-none w-16 text-center text-black bg-gray-50">
													<strong>{{ node.raw.slug }}</strong>
												</div>
												<div class="flex-1 px-2 text-left tracking-wide">
													{{ node.raw.name }}
												</div>
											</div>
										</div>
									</treeselect>
								</div>

							</div>
						</div>
						<div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
							<button @click="$parent.showCreateForm = false" type="button" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-0 sm:ml-0">
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
import { ASYNC_SEARCH, Treeselect } from '@riophae/vue-treeselect';
import '@riophae/vue-treeselect/dist/vue-treeselect.css';

export default {
	components: { Treeselect },
	data() {
		return {
			form : {
				key: '',
				status: 1,
				max_activated: null,
				expire_at: null,
				user: null,
				terms: [],
				errors: [],
			},
			terms: null, 
		}
	},
	methods: {
		searchUsers({ action, searchQuery, callback }) {
			if (action === ASYNC_SEARCH) {
				let users = [];

				if (!this.$parent.busy) {
					this.$parent.busy = true;

					axios.get(route('admin.api.users.index'), {
						params: {
							page: 1,
							search: searchQuery,
							per_page: 10,
							remote: this.$parent.remote.selected.value
						}
					})
					.then(response => {
						users = response.data.data;
					})
					.catch(error => {
						Vue.toasted.show(`Failed to load user data from ${this.$parent.remote.selected.value}`, {
							type : 'error',
							iconPack: 'callback',
							icon: (el) => {
								el.innerHTML = '<svg viewBox="0 0 24 24" height="18" width="18"><g transform="matrix(1,0,0,1,0,0)"><path d="M11.983,0C8.777,0.052,5.72,1.365,3.473,3.653C1.202,5.914-0.052,9.002,0,12.207C-0.008,18.712,5.26,23.992,11.765,24 c0.012,0,0.023,0,0.035,0h0.214c6.678-0.069,12.04-5.531,11.986-12.209l0,0c0.015-6.498-5.24-11.778-11.738-11.794 C12.169-0.003,12.076-0.002,11.983,0z M10.5,16.542c-0.03-0.815,0.606-1.499,1.421-1.529c0.009,0,0.019-0.001,0.028-0.001h0.027 c0.82,0.002,1.492,0.651,1.523,1.47c0.03,0.814-0.605,1.499-1.419,1.529c-0.01,0-0.02,0.001-0.03,0.001h-0.027 C11.203,18.009,10.532,17.361,10.5,16.542z M11,12.5v-6c0-0.552,0.448-1,1-1s1,0.448,1,1v6c0,0.552-0.448,1-1,1S11,13.052,11,12.5z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';
								return el;
							},
						});
					})
					.then(() => {
						this.$parent.busy = false;

						const searchCallback = users.map((currentValue) => ({
							id: `${currentValue.ID}`,
							label: `👤 ${currentValue.user_nicename} (#${currentValue.ID} - ${currentValue.user_email})`,
						}));
						callback(null, searchCallback);
					});
				}
			}
		},
		async getAvailableTerms(action) {
			if (!this.$parent.busy) {
				this.$parent.busy = true;

				axios.get(route('admin.api.generators.terms.index'), {
					params: {
						remote: this.$parent.remote.selected.value
					}
				})
				.then(response => {
					this.terms = response.data.data.map((currentValue) => ({
						id: currentValue.term.term_id,
						name: currentValue.term.name,
						slug: currentValue.term.slug,
					}));
				})
				.catch(error => {
					Vue.toasted.show(`Failed to load designets data from ${this.$parent.remote.selected.value}`, {
						position: 'top-right',
						type : 'error',
						iconPack: 'callback',
						icon: (el) => {
							el.innerHTML = '<svg viewBox="0 0 24 24" height="18" width="18"><g transform="matrix(1,0,0,1,0,0)"><path d="M11.983,0C8.777,0.052,5.72,1.365,3.473,3.653C1.202,5.914-0.052,9.002,0,12.207C-0.008,18.712,5.26,23.992,11.765,24 c0.012,0,0.023,0,0.035,0h0.214c6.678-0.069,12.04-5.531,11.986-12.209l0,0c0.015-6.498-5.24-11.778-11.738-11.794 C12.169-0.003,12.076-0.002,11.983,0z M10.5,16.542c-0.03-0.815,0.606-1.499,1.421-1.529c0.009,0,0.019-0.001,0.028-0.001h0.027 c0.82,0.002,1.492,0.651,1.523,1.47c0.03,0.814-0.605,1.499-1.419,1.529c-0.01,0-0.02,0.001-0.03,0.001h-0.027 C11.203,18.009,10.532,17.361,10.5,16.542z M11,12.5v-6c0-0.552,0.448-1,1-1s1,0.448,1,1v6c0,0.552-0.448,1-1,1S11,13.052,11,12.5z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';
							return el;
						},
					});
				})
				.then(result => {
					this.$parent.busy = false;
				});
			}
		},
		doSave() {
			if (!this.$parent.busy) {
				this.$parent.busy = true;
				this.form.errors = [];

                axios.post(route('admin.api.licenses.store'), {
					key: this.form.key,
					status: this.form.status,
					max_activated: this.form.max_activated,
					expire_at: this.form.expire_at,
					user: this.form.user,
					terms: this.form.terms,
					remote: this.$parent.remote.selected.value
                })
                .then(response => {
                    Vue.toasted.show('New License added successfully.', {
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
                    Vue.toasted.show('Failed to add new License', {
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
		}
	},
	mounted() {
	},
    created() {
		this.searchUsers = _.debounce(this.searchUsers, 300);
    },
};
</script>
@extends('layouts.app')

@section('aftercontent')
@endsection
@section('script')
<script>
    @php
    $rest = [
        'site_title' => get_bloginfo('name'),
        'provider' => home_url(),
        'endpoint' => config('rest.endpoint'),
        'version' => config('rest.version'),
    ];
    @endphp

    const rest = @json($rest);
</script>
@endsection

@section('content')

<admin-api-index inline-template>
    <div>

        <!-- Page title & actions -->
        <div class="sticky top-0 bg-white bg-opacity-75 border-b border-gray-200 px-2 py-4 sm:flex sm:items-center sm:justify-between sm:px-4 lg:px-6">
            <div class="flex-1 flex min-w-0">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li>
                            <div>
                                <a href="{{ admin_url() }}" class="text-gray-400 hover:text-gray-500">
                                    <!-- Heroicon name: home -->
                                    <svg class="flex-shrink-0 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                    </svg>
                                </a>
                                <span class="sr-only">Home</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center space-x-2">
                                <!-- Heroicon name: chevron-right -->
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                <a href="{{ route('admin.apis.index') }}" class="text-sm leading-5 font-medium text-gray-500 hover:text-gray-700">APIs</a>
                            </div>
                        </li>
                    </ol>
                </nav>
                
                <span class="flex-initial px-3 shadow-sm rounded-md">
                                                                                                                        
                    <button @click="showCreateForm = true" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-0 sm:ml-0 cursor-pointer">
                        Add New
                    </button>
                </span>
                <div class="flex-initial px-3">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <!-- Heroicon name: search -->
                            <svg class="mr-3 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" v-model="search" class="focus:ring-indigo-500 focus:border-indigo-500 w-full block pl-9 sm:text-sm sm:leading-5 border-gray-300 rounded-md placeholder-gray-500 placeholder-opacity-50" placeholder="Search">
                    </div>
                </div>
            </div>

            <div class="flex">
                <!-- color:#f7630c -->
                <div :class="loading ? 'visible' : 'invisible'" class="inline-flex items-center px-4 text-base text-pink-600 leading-6 font-medium rounded-md cursor-default" disabled="">
                    <svg class="flex-1 -ml-1 h-8 w-8 self-center" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <defs><clipPath id="ldio-gg8f7d2322w-cp"><rect x="20" y="0" width="60" height="100"></rect></clipPath></defs>
                        <path fill="none" stroke="#e90c59" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" clip-path="url(#ldio-gg8f7d2322w-cp)" d="M90,76.7V28.3c0-2.7-2.2-5-5-5h-3.4c-2.7,0-5,2.2-5,5v43.4c0,2.7-2.2,5-5,5h-3.4c-2.7,0-5-2.2-5-5V28.3c0-2.7-2.2-5-5-5H55 c-2.7,0-5,2.2-5,5v43.4c0,2.7-2.2,5-5,5h-3.4c-2.7,0-5-2.2-5-5V28.3c0-2.7-2.2-5-5-5h-3.4c-2.7,0-5,2.2-5,5v43.4c0,2.7-2.2,5-5,5H15 c-2.7,0-5-2.2-5-5V23.3">
                          <animateTransform attributeName="transform" type="translate" repeatCount="indefinite" dur="0.7s" values="-20 0;7 0" keyTimes="0;1"></animateTransform>
                          <animate attributeName="stroke-dasharray" repeatCount="indefinite" dur="0.7s" values="0 72 125 232;0 197 125 233" keyTimes="0;1"></animate>
                        </path>
                    </svg>
                    <span class="animate-pulse self-center">Loading</span>
                </div>

                <a @click="doRefresh" class="ml-4 text-base font-medium leading-6 text-gray-900 sm:truncate self-center cursor-pointer" title="Refresh data">
                    <i class="fas fa-sync" :class="loading && lastAction === 'doRefresh' ? 'fa-spin' : ''"></i>
                </a>

            </div>
        </div>

        <transition name="fade">
            <admin-api-create v-if="showCreateForm"></admin-api-create>
        </transition>

        <!-- Projects table (small breakpoint and up) -->
        <div class="align-middle inline-block min-w-full border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr class="border-t border-gray-200">
                        <th class="pl-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Label</span>
                        </th>
                        <th class="py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Key</span>
                        </th>
                        <th class="py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Secret</span>
                        </th>
                        <th class="py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Permission
                        </th>
                        <th class="py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            User
                        </th>
                        <th class="pr-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody v-if="apis.length > 0" class="bg-white divide-y divide-gray-100">
                    <tr v-for="(api, index) in apis" :key="api.id">
                        <template v-if="api.showEditForm">
                            <td colspan="7">
                                <admin-api-edit :initial-api="api" @cancel="editForm(index)" ></admin-api-edit>
                            </td>
                        </template>
                        <template v-else>
                            <td :title="Boolean(api.status) == true ? 'Enabled' : 'Disabled'" class="pl-9 py-3">
                                <button @click="doStatus(api.id, Boolean(api.status))" :disabled="loading" class="flex items-center cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                    <span class="h-4 w-4 rounded-full flex items-center justify-center" :class="Boolean(api.status) == true ? 'bg-green-100' : 'bg-gray-100'">
                                        {{-- <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full opacity-50" :class="Boolean(api.status) == true ? 'bg-green-400' : 'bg-gray-400'"></span> --}}
                                        <span class="h-2 w-2 relative inline-flex rounded-full" :class="Boolean(api.status) == true ? 'bg-green-400' : 'bg-gray-400'"></span>
                                    </span>
                                </button>
                            </td>
                            <td class="max-w-max-content whitespace-nowrap text-base leading-5 font-medium text-gray-900 tracking-wider">
                                <div class="text-sm font-normal">
                                    <strong>@{{ api.label }}</strong> 
                                    <span class="text-xs leading-5 text-gray-400">ID: @{{api.id}}</span>
                                </div>
                            </td>
                            <td class="py-3 max-w-max-content whitespace-nowrap text-sm leading-5 text-gray-800">
                                <div class="flex items-center space-x-3 ">
                                    <code @dblclick="mask(index)" class="px-2 py-1 bg-gray-100" v-if="api.mask === false">@{{ api.key }}</code>
                                    <code @dblclick="mask(index)" class="px-2 py-1 bg-gray-100 cursor-pointer select-none" v-else>●●●●●●●●●●●●●●●</code>
                                    <button v-if="remote.selected.value === 'local'" type="button" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        <svg @click="connector(api)" class="h-5 w-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </button>
                                    
                                </div>
                            </td>
                            <td class="py-3 max-w-max-content whitespace-nowrap text-sm leading-5 font-medium text-gray-900">
                                <div class="flex items-center py-1 space-x-3 ">
                                    <code @dblclick="mask(index)" class="px-2 py-1 bg-gray-100" v-if="api.mask === false">@{{ api.secret }}</code>
                                    <code @dblclick="mask(index)" class="px-2 py-1 bg-gray-100 cursor-pointer select-none" v-else>●●●●●●●●●●●●●●●●●●●●●●●●●●●●●●●●</code>
                                </div>
                            </td>
                            <td class="py-3 max-w-max-content whitespace-nowrap text-sm leading-5 font-medium text-gray-900">
                                <div class="flex items-center space-x-3 ">
                                    <i :class="api.permission === 'custom' ? 'fa-cog' : 'fa-globe'" class="mt-1 fal fa-lg pr-1"></i>
                                    @{{ api.permission }}
                                </div>
                            </td>
                            <td class="py-3 text-sm leading-5 text-gray-500 font-medium">
                                <a v-if="api.user" :href="`${connectorstring.provider}/wp-admin/user-edit.php?user_id=${api.user.ID}`" target="_blank" class="flex-shrink-0 group block focus:outline-none"  :title="`${api.user.user_email} — #${api.user.ID}`">
                                    <div class="flex items-center justify-end">
                                        <div>
                                            <img class="inline-block h-9 w-9 rounded-full" :src="gravatar(api.user.user_email)" :alt="`${api.user.user_email} — #${api.user.ID}`">
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm leading-5 font-medium text-gray-700 group-hover:text-gray-900">
                                                @{{ api.user.display_name }}
                                            </p>
                                            <p class="text-xs leading-4 font-normal text-gray-500 group-hover:text-gray-700">
                                                View profile
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td class="pr-6">
                                <div class="relative flex justify-end items-center">
                                    <button @click="actionPanel(index)" aria-has-popup="true" type="button" class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        <!-- Heroicon name: dots-vertical -->
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                        </svg>
                                    </button>
                                    <!--
                                        Dropdown panel, show/hide based on dropdown state.

                                        Entering: "transition ease-out duration-100"
                                        From: "transform opacity-0 scale-95"
                                        To: "transform opacity-100 scale-100"
                                        Leaving: "transition ease-in duration-75"
                                        From: "transform opacity-100 scale-100"
                                        To: "transform opacity-0 scale-95"
                                    -->
                                    <div v-if="api.showActionPanel === true" class="z-10 mx-3 origin-top-right absolute right-7 top-0 w-48 mt-1 rounded-md shadow-lg">
                                        <div class="z-10 rounded-md bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="project-options-menu-0">
                                            <div class="py-1">
                                                <a @click="editForm(index)" class="group flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 cursor-pointer" role="menuitem">
                                                    <!-- Heroicon name: pencil-alt -->
                                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <a @click="doReset(api.id)" class="group flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 cursor-pointer" role="menuitem">
                                                    <!-- Heroicon name: finger-print -->
                                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                                                    </svg>
                                                    Reset credential
                                                </a>
                                            </div>
                                            <div class="border-t border-gray-100"></div>
                                            <div class="py-1">
                                                <a @click="doDestroy(api.id)" class="group flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 cursor-pointer" role="menuitem">
                                                    <!-- Heroicon name: trash -->
                                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </template>
                    </tr>
                </tbody>
                <tbody v-else class="bg-white divide-y divide-gray-100">
                </tbody>
            </table>
            <pagination :disabled="loading" v-if="apis.length > 0" :pagination="pagination" @paginate="fetchData" :offset="4"></pagination>
        </div>
    </div>

</admin-api-index>


@endsection
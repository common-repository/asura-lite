<div id="app">
	<asura-demo inline-template>
		<div id="asura_demo" class="overflow-hidden asura-demo__wrap">

			<!-- NAVIGATION BAR -->
			<div id="asura_preview" class="fixed bg-white w-full border-b border-solid border-black asura-demo__navbar">
				<div class="max-w-7xl mx-auto px-2 sm:px-4 asura-demo__top-navbar-wrap">
					<div class="flex justify-between items-center border-gray-100 py-1 md:justify-start md:space-x-5 asura-demo__top-navbar">
						<div class="asura-demo__navbar-sitetitle-wrap">
							<a href="{{ get_home_url() }}" class="flex text-xl font-bold text-gray-600 hover:text-gray-900 asura-demo__navbar-sitetitle-link">
								<h1 class="asura-demo__navbar-sitetitle">
									{{ strtoupper(get_bloginfo('name')) }}
								</h1>
							</a>
						</div>

						<!-- ASURA:DESIGNSET SLUG -->
						<label class="block text-sm leading-5 font-medium text-gray-700 asura-demo__navbar-designset-slug-label">Design Set:</label>
						<div class="space-y-1 asura-demo__navbar-designset-slug-wrap" title="DESIGNSET">
							<select v-model="navbar.designsets.selectedSlug" class="rounded-md shadow-sm w-full border border-gray-300 bg-white pl-3 pr-10 py-2 text-left focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition ease-in-out duration-150 sm:text-sm sm:leading-5  asura-demo__navbar-designset-slug-select">
								<option v-for="designset in designsets" v-bind:value="designset">
									@{{ designset }}
								</option>
							</select>
						</div>

						<!-- ASURA:DESIGN_TYPE -->
						<nav class="md:flex asura-demo__navbar-designset-type-wrap">
							<span class="inline-flex rounded-md shadow-sm asura-demo__navbar-designset-type-span">
								<a 
									@click="navbar.designsets.selectedType = 'pages'" 
									v-if="navbar.designsets.type.page" 
									title="Pages" 
									:class="navbar.designsets.selectedType == 'pages' ? 'bg-gray-700 asura-demo__navbar-designset-type-button_selected' : ''" 
									class="cursor-pointer whitespace-no-wrap inline-flex items-center justify-center w-10 h-10 px-2 py-2 m-1 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150 asura-demo__navbar-designset-type-button"
								>
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
									</svg>
								</a>
								<a 
									@click="navbar.designsets.selectedType = 'components'" 
									v-if="navbar.designsets.type.component" 
									title="Components" 
									:class="navbar.designsets.selectedType == 'components' ? 'bg-gray-700  asura-demo__navbar-designset-type-button_selected' : ''" 
									class="cursor-pointer whitespace-no-wrap inline-flex items-center justify-center w-10 h-10 px-2 py-2 m-1 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150 asura-demo__navbar-designset-type-button"
								>
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
									</svg>
								</a>
							</span>
						</nav>

						<!-- ASURA:DESIGNSETS_PAGE_COMPONENT -->
						<div class="overflow-auto md:flex items-center justify-end space-x-8 md:flex-1 lg:w-0 asura-demo__navbar-designset-component-wrap">
							<ul class="flex flex-row w-full h-full asura-demo__navbar-designset-component-ul">
								<li 
									v-for="design in navbar.items" 
									class="cursor-pointer w-auto h-full mx-1 asura-demo__navbar-designset-component-li" 
									:class="theframe.url == design.url? 'rounded border-2 border-black asura-demo__navbar-designset-component-li_selected' : ''"
								>
									<a 
										@mouseover="theframe.image_preview = design.screenshot_url; theframe.title_preview = design.name" 
										@mouseleave="theframe.image_preview = null; theframe.title_preview = design.null" 
										@click="theframe.url = design.url" 
										class="text-sm hover:font-bold contents asura-demo__navbar-designset-component-preview-label"
									>
										<img style="max-height: 3.125rem;" class="w-auto max-w-sm h-full transition-all rounded-sm object-contain object-center asura-demo__navbar-designset-component-preview-img" :src="design.screenshot_url" alt="design.name">
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="asura-demo__navbar-category-wrap">
					<ul v-if="navbar.designsets.selectedType != null" class="flex flex-row asura-demo__navbar-category-ul">
						<li class="cursor-pointer px-2 asura-demo__navbar-category-li">
							<a 
								@click="navbar.designsets.selectedCategory = null" 
								:class="!navbar.designsets.selectedCategory ? 'font-bold asura-demo__navbar-category_active' : ''" 
								class="text-sm hover:font-bold asura-demo__navbar-category"
							>
								All
							</a>
						</li>
						<li v-for="(cat, index) in items.categories[navbar.designsets.selectedType]" class="cursor-pointer px-2 asura-demo__navbar-category-li">
							<a 
								@click="navbar.designsets.selectedCategory = cat.key" 
								:class="navbar.designsets.selectedCategory && navbar.designsets.selectedCategory == cat.key ? 'font-bold asura-demo__navbar-category_active' : ''" 
								class="text-sm hover:font-bold asura-demo__navbar-category"
							>
								@{{cat.label}}
							</a>
						</li>
					</ul>
				</div>

				<div class="asura-demo__navbar-preview" v-if="theframe.image_preview">
					<img :src="theframe.image_preview" class="z-50 fixed justify-center align-middle border-b border-r border-black shadow-lg asura-demo__navbar-preview-image">
					<h2 class="z-50 fixed justify-center align-middle p-2 bg-yellow-300 asura-demo__navbar-preview-title">
						@{{ theframe.title_preview }}
					</h2>
				</div>

			</div>

			<!-- ASURA:PREVIEW_CONTAINER -->
			<div id="preview_container" class="flex justify-center bg-black asura-demo__container">
				<iframe id="theframe" class="transition-all duration-700 ease-in-out h-full min-h-screen bg-white asura-demo__container-iframe" :src="theframe.url" :width="theframe.breakpoints"></iframe>
				<img v-if="theframe.loading_image" class="fixed content-center z-auto" src="{{ ASURA_PLUGIN_URL.'public/img/loading/wave.svg' }}" alt="">
			</div>

			<!-- ASURA:DEVICE -->
			<nav id="preview_device" class="fixed right-0 shadow-xs hover:opacity-100 h-10 asura-demo__device">
				@php
					$breakpoints = [
						[
							'breakpoint' => 'full_screen',
							'label' => 'Full',
							'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>'
						],
						[
							'breakpoint' => 'max_width',
							'label' => 'Max-width',
							'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>'
						],
						[
							'breakpoint' => 'tablet',
							'label' => 'Tablet',
							'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>'
						],
						[
							'breakpoint' => 'phone_landscape',
							'label' => 'Mobile (landscape)',
							'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" transform="rotate(-90)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>'

						],
						[
							'breakpoint' => 'phone_portrait',
							'label' => 'Mobile (potrait)',
							'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>'
						],
					];
				@endphp

				<span class="inline-flex rounded-md shadow-sm flex-col asura-demo__device-breakpoint-span">
					@foreach ($breakpoints as $breakpoint)
					<a 
						@click="changeWidthBreakpoint(breakpoints.{{ $breakpoint['breakpoint'] }})" 
						:title="'{{ $breakpoint['label'] }} — width: ' + breakpoints.{{ $breakpoint['breakpoint'] }} + '{{ $breakpoint['breakpoint'] != 'full_screen' ? 'px' : '' }}'" 
						:class="theframe.breakpoints == breakpoints.{{ $breakpoint['breakpoint'] }} + '{{ $breakpoint['breakpoint'] != 'full_screen' ? 'px' : '' }}' ? 'bg-gray-700 asura-demo__device-breakpoint_active' : ''" 
						class="whitespace-no-wrap inline-flex items-center justify-center w-10 h-10 px-2 py-2 m-1 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 asura-demo__device-breakpoint"
					>
						{!! $breakpoint['icon'] !!}
					</a>
					@endforeach

				</span>
			</nav>

		</div>
	</asura-demo>
</div>

<style>
	html {
		margin-top: 0px !important;
	}

	* html body {
		margin-top: 0px !important;
	}

	@media screen and (max-width: 782px) {
		html {
			margin-top: 0px !important;
		}

		* html body {
			margin-top: 0px !important;
		}
	}
</style>
<template>
  
</template>

<script>
export default {
    data: function () {
		return {
			designsets: [],
			items: [],
			navbar: {
				designsets: {
					selectedSlug: null,
					type: {
						page: false,
						component: false
					},
					selectedType: null,
					selectedCategory: null
				},
				items: []
			},
			breakpoints: {
				full_screen: '',
				max_width: '',
				tablet: '',
				phone_landscape: '',
				phone_portrait: '',
			},
			theframe: {
				loading_image: false,
				image_preview: null,
				title_preview: null,
				url: '',
				breakpoints: '100%',
			},
		}
	},
    mounted() {
		this.designsets = asura.designsets;
		this.breakpoints = asura.breakpoints;
		if(this.designsets.length > 0) {
			this.navbar.designsets.selectedSlug = this.designsets[0];
		}
		this.adjustPreviewFrameHeight();
	},
	watch: {
		'navbar.designsets.selectedSlug': function(val, oldVal) {
			this.navbar.designsets.selectedType = null;
            this.fetchDesignsetItems();
			this.adjustPreviewFrameHeight();
		},
		'navbar.designsets.selectedType': function(val, oldVal) {
			this.updateSelectedCategory(null);
			this.adjustPreviewFrameHeight(400);
		},
		'navbar.designsets.selectedCategory': function(val, oldVal) {
			this.updateSelectedCategory(val);
			this.adjustPreviewFrameHeight(400);
		},
		'theframe.url': function(val, oldVal) {
			this.theframe.loading_image = true;
			this.adjustPreviewFrameHeight(400);
			document.getElementById('theframe').onload = this.theframeLoading;
		},
		items: function(val) {
			this.navbar.designsets.type.page = (Array.isArray(val.pages) && val.pages.length) ;		
			this.navbar.designsets.type.component = (Array.isArray(val.components) && val.components.length) ;		
			
			if (this.items.categories.pages.length) {
				this.navbar.designsets.selectedType = 'pages';
				this.theframe.url = this.items.pages[0].url;
			} else if (this.items.categories.components.length) {
				this.navbar.designsets.selectedType = 'components';
				this.theframe.url = this.items.components[0].url;
			}

			this.adjustPreviewFrameHeight(400);
		},
	},
	methods: {
		theframeLoading: function() {
			this.theframe.loading_image = false;
		},
		updateSelectedCategory: function(val){
			this.navbar.designsets.selectedCategory = val;

			if (val) {
				this.navbar.items = this.items[this.navbar.designsets.selectedType].filter(obj => {
					return obj.category === val
				});

			} else {
				this.navbar.items = this.items[this.navbar.designsets.selectedType];
			}
		},
		adjustPreviewFrameHeight: (duration = 100) => {
			setTimeout((duration) => {
				document.getElementById('preview_device').style.top = document.getElementById('preview_container').style.paddingTop = document.getElementById('asura_preview').offsetHeight + "px";
				document.getElementById('preview_container').style.height = "100vh";
			}, duration);
		},
		changeWidthBreakpoint: function(w) {
			this.theframe.breakpoints = typeof w === 'string' ? w : w+'px';
		},
		fetchDesignsetItems: function () {
			const params = new URLSearchParams();
			params.append('action', 'asura_demo_get_items');
			params.append('term_slug', this.navbar.designsets.selectedSlug);
			params.append('_wpnonce', asura.nonce);

            axios.post(asura.ajaxurl, params
            )
			.then((response) => {
				this.items = response.data;
			})
			.catch();
		},
	}
}
</script>

<style>

</style>
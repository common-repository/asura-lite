<template>
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm leading-5 text-gray-700">
                    Showing
                    <span class="font-medium">{{ pagination.from }}</span>
                    to
                    <span class="font-medium">{{ pagination.to }}</span>
                    of
                    <span class="font-medium">{{ pagination.total }}</span>
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex shadow-sm cursor-pointer">
                    <a 
                        :class="(pagination.current_page > 1) ? '': 'hidden'"
                        @click="change(pagination.current_page -1)"
                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring-blue" 
                        aria-label="Previous"
                    >   
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a
                        v-for="page in pages" :key="page"
                        @click="change(page)"
                        :class="{'border-t-2 border-indigo-500 text-indigo-500' : (page == pagination.current_page)}"
                        class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring-blue"
                    >
                        {{ page }}
                    </a>
                    <a
                        @click="change(pagination.current_page + 1)"
                        :class="(pagination.current_page < pagination.last_page) ? '': 'hidden'"
                        class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring-blue" 
                        aria-label="Next"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            pagination: {
                type: Object,
                required: true
            },
            offset: {
                type: Number,
                default: 4
            }
        },
        computed: {
            'pagination.current_page': function(){
                return Number(this.pagination.current_page);
            },
            pages() {
                if (!this.pagination.to) {
                    return null;
                }
                let from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                let to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                let pages = [];
                for (let page = from; page <= to; page++) {
                    pages.push(page);
                }
                return pages;
            },
        },
        methods: {
            change: function(page) {
                if (!this.$parent.busy) {
                    this.pagination.current_page = page;
                    this.$emit('paginate');
                }
            }
        }
    }
</script>
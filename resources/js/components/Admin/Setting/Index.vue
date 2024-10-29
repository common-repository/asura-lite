<template>
        <div class="relative max-w-4xl mx-auto md:px-8 xl:px-0">
        <div class="pt-10 pb-16">
            <div class="px-4 sm:px-6 md:px-0">
                <h1 class="text-3xl font-extrabold text-gray-900">Settings</h1>
            </div>
        
            <div class="px-4 sm:px-6 md:px-0">
                <div class="py-6">

                    <div class="block">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex">
                                <a v-for="_tab in tab.tabs"
                                    :key="_tab.value"
                                    @click="tab.selected = _tab.value"
                                    :class="tab.selected === _tab.value ? 'border-purple-500 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" 
                                    class="whitespace-nowrap mr-8 py-4 px-1 border-b-2 font-medium text-sm cursor-pointer"
                                >
                                    {{ _tab.text }}
                                </a>
                                
                            </nav>
                        </div>
                    </div>
                    <keep-alive>
                        <component :is="tab.selected"></component>
                    </keep-alive>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import SectionGeneral from "./Section/General";
import SectionEasydigitaldownloads from "./Section/Vendor/EasyDigitalDownloads";
import SectionWoocommerce from "./Section/Vendor/WooCommerce";

export default {
    components: {
        SectionGeneral,
        SectionEasydigitaldownloads,
        SectionWoocommerce,
    },
    data() {
        return {
            tab: {
                tabs: [
                    {value: 'section-general', text: 'General'},
                    {value: 'section-woocommerce', text: 'WooCommerce'},
                    {value: 'section-easydigitaldownloads', text: 'Easy Digital Downloads'},
                ],
                selected: 'section-general'
            }
        }
    },
}
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>
<script setup lang="ts">

import {ArrowLongLeftIcon, ArrowLongRightIcon} from "@heroicons/vue/20/solid";


const props = defineProps({
        pagination: {type: Object, required: true},
        links: {type: Object, required: true}
    })

const emit = defineEmits(['paginate'])

</script>

<template>
    <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0 dark:border-white/10">
        <div class="-mt-px flex w-0 flex-1 " >
            <a
                href="javascript:void(0)"
                @click.prevent="links.prev && emit('paginate', links.prev)"
                class="items-center border-t-2 border-transparent
                                 pt-4 pr-1 text-sm font-medium text-gray-500 hover:border-gray-300
                                  hover:text-gray-700 dark:text-gray-400 dark:hover:border-white/20
                                   dark:hover:text-gray-200 "
                :class="props.links.prev ? 'inline-flex' : 'hidden'"
            >
                <ArrowLongLeftIcon
                    class="mr-3 size-5 text-gray-400 dark:text-gray-500"
                    aria-hidden="true"
                />
                {{ $t('pagination.previous') }}
            </a>
        </div>
        <div class="hidden md:-mt-px md:flex">
            <a
                v-if="pagination.current_page - 2 > 0"
                @click.prevent="pagination.links[1]['url'] && emit('paginate', pagination.links[1]['url'])"
                href="javascript:void(0)"
                class="inline-flex items-center border-t-2 border-transparent px-4 pt-4
                                       text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700
                                       dark:text-gray-400 dark:hover:border-white/20 dark:hover:text-gray-200"
            >
                1
            </a>
            <a
                v-if="pagination.current_page - 2 > 1 && pagination.current_page === 4"
                @click.prevent="pagination.links[2]['url'] && emit('paginate', pagination.links[2]['url'])"
                href="javascript:void(0)"
                class="inline-flex items-center border-t-2 border-transparent px-4 pt-4
                                       text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700
                                       dark:text-gray-400 dark:hover:border-white/20 dark:hover:text-gray-200"
            >
                2
            </a>
            <span
                v-if="pagination.current_page - 2 > 1 && pagination.current_page !== 4"
                class="inline-flex items-center border-t-2 border-transparent
                                       px-4 pt-4 text-sm font-medium text-gray-500">
                                ...
                            </span>
            <a
                v-if="pagination.current_page - 1 > 0"
                @click.prevent="pagination.links[pagination.current_page - 1]['url'] && emit('paginate', pagination.links[pagination.current_page - 1]['url'])"

                href="javascript:void(0)"
                class="inline-flex items-center border-t-2 border-transparent px-4 pt-4
                                       text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700
                                       dark:text-gray-400 dark:hover:border-white/20 dark:hover:text-gray-200"
            >
                {{pagination.current_page - 1}}
            </a>
            <a
                href="javascript:void(0)"
                class="inline-flex items-center border-t-2  px-4 pt-4
                                       text-sm font-medium dark:hover:text-gray-200
                                       border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400'"
            >
                {{pagination.current_page}}
            </a>

            <a
                v-if="pagination.current_page + 1 < pagination.last_page"
                @click.prevent="pagination.links[pagination.current_page + 1]['url'] && emit('paginate', pagination.links[pagination.current_page + 1]['url'])"
                href="javascript:void(0)"
                class="inline-flex items-center border-t-2 border-transparent px-4 pt-4
                                       text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700
                                       dark:text-gray-400 dark:hover:border-white/20 dark:hover:text-gray-200"
            >
                {{pagination.current_page + 1}}
            </a>
            <span
                v-if="pagination.current_page + 2 < pagination.last_page && pagination.current_page + 2 !== pagination.last_page - 1"
                class="inline-flex items-center border-t-2 border-transparent
                                       px-4 pt-4 text-sm font-medium text-gray-500">
                                ...
                            </span>
            <a
                v-if="pagination.current_page + 2 < pagination.last_page && pagination.current_page + 2 === pagination.last_page - 1"
                @click.prevent="pagination.links[pagination.last_page - 1]['url'] && emit('paginate', pagination.links[pagination.last_page - 1]['url'])"
                href="javascript:void(0)"
                class="inline-flex items-center border-t-2 border-transparent px-4 pt-4
                                       text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700
                                       dark:text-gray-400 dark:hover:border-white/20 dark:hover:text-gray-200"
            >
                {{pagination.last_page - 1}}
            </a>
            <a
                v-if="pagination.current_page !== pagination.last_page"
                @click.prevent="pagination.links[pagination.last_page]['url'] && emit('paginate', pagination.links[pagination.last_page]['url'])"
                href="javascript:void(0)"
                class="inline-flex items-center border-t-2 border-transparent px-4 pt-4
                                       text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700
                                       dark:text-gray-400 dark:hover:border-white/20 dark:hover:text-gray-200"
            >
                {{pagination.last_page}}
            </a>
        </div>
        <div class="-mt-px flex w-0 flex-1 justify-end">
            <a
                href="javascript:void(0)"
                @click.prevent="links.next && emit('paginate', links.next)"
                class="items-center border-t-2 border-transparent pt-4
                                 pl-1 text-sm font-medium text-gray-500 hover:border-gray-300
                                 hover:text-gray-700 dark:text-gray-400 dark:hover:border-white/20
                                 dark:hover:text-gray-200"
                :class="links.next ? 'inline-flex' : 'hidden'"
            >
                {{  $t( 'pagination.next' ) }}
                <ArrowLongRightIcon
                    class="ml-3 size-5 text-gray-400 dark:text-gray-500"
                    aria-hidden="true"
                />
            </a>
        </div>
    </nav>

</template>

<style scoped>

</style>
